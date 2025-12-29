<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\{Category,JobType,EducationLevel,Job,Company};
use App\JobQuery;

class JobsController extends Controller
{
    public function categories(){
        $categories = Category::where('type','jobs')->where('status',1)->get(['id','name']);
        if($categories){
            return response()->json([
                'success' => true, 
                'message' => 'Categories fetched successfully.',
                'categories' => $categories
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No categories found.',
                'categories' => []
            ], 404);
        }
    }

    public function types(){
        $types = JobType::where('status',1)->get(['id','type']);
        if($types){
            return response()->json([
                'success' => true, 
                'message' => 'Types fetched successfully.', 
                'types' => $types
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No types found.',
                'types' => []
            ], 404);
        }
    }

    public function education_level(){
        $level = EducationLevel::where('status',1)->get(['id','level']);
        if($level){
            return response()->json([
                'success' => true, 
                'message' => 'Education level fetched successfully.',
                'education_level' => $level
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'No education level found.',
                'education_level' => []
            ], 404);
        }

    }

    public function index()
    {
        $jobs = Job::with(['company'])
                ->where('is_approved',1)
                ->get();    
        
        $jobs->transform(function ($job) {
            // Qualifications
            $qualificationIds = json_decode($job->qualification, true);
            $job->qualifications = !empty($qualificationIds)
                ? \App\EducationLevel::whereIn('id', $qualificationIds)->pluck('level')
                : [];

            // Decode skills, roles, key_skills
            $job->skills = json_decode($job->skills, true) ?? [];
            $job->roles = json_decode($job->roles, true) ?? [];
            $job->key_skills = json_decode($job->key_skills, true) ?? [];

            // Add category name safely
            $job->category_name = $job->category?->name;

            // Add job type name safely
            $job->job_type_name = $job->job_type?->type;

            // Remove raw qualification field
            unset($job->qualification);
            unset($job->category);
            unset($job->job_type);

            return $job;
        });

        if ($jobs->count() > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Jobs fetched successfully.',
                'jobs' => $jobs
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Jobs not found.',
                'jobs' => []
            ], 404);
        }
    }

    public function details($slug){
        $job = Job::with(['company'])->find($slug);

        $qualificationIds = json_decode($job->qualification, true);
        $job->qualifications = !empty($qualificationIds)
            ? \App\EducationLevel::whereIn('id', $qualificationIds)
                ->get(['id', 'level'])
                ->toArray()      
            : [];
        // Decode skills, roles, key_skills
        // $job->qualifications = json_decode($job->qualifications, true) ?? [];
        $job->skills = json_decode($job->skills, true) ?? [];
        $job->roles = json_decode($job->roles, true) ?? [];
        $job->key_skills = json_decode($job->key_skills, true) ?? [];

        // Add category name safely
        $job->category_name = $job->category?->name;

        // Add job type name safely
        $job->job_type_name = $job->job_type?->type;

        // Remove raw qualification field
        unset($job->qualification);
        unset($job->category);
        unset($job->job_type);
        
        if ($job) {
            return response()->json([
                'success' => true,
                'message' => 'Job fetched successfully.',
                'jobs' => $job
            ],200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Job not found.',
                'jobs' => []
            ], 404);
        }
    }

    public function store(Request $request){
    
        $step = $request->input('step', 1);
        // Step-wise handling
        if ($request->filled('job_id')) {
            // Fetch specific job for the logged-in user
            $job = Job::where([['id', $request->job_id],['user_id', auth()->id()]])->first();
            if (!$job) {
                return response()->json([
                    'success' => false,
                    'message' => 'Job ID not persent.'
                ], 400);
            }
        } else {
            if ($step != 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Job ID is required for this step.'
                ], 400);
            }

            $job = new Job();
            $job->user_id = auth()->id();
        }

        switch ($step) {
            // STEP 1 - Jobs Info
            case 1:
                $validator = Validator::make($request->all(), [
                    'job_type'   => 'required|numeric|exists:job_types,id',
                    'category' =>  'required|numeric|exists:categories,id',
                    'qualification' => 'required|array',
                    'qualification.*' => 'required|numeric|exists:education_level,id',
                    'title' => 'required|string|min:2|max:100',
                    'description' => 'required|string|min:10|max:1000',
                    'salary_from' => 'required|numeric|min:10|lte:salary_to',
                    'salary_to'   => 'required|numeric|min:10|gte:salary_from',
                    'experience'   => 'required|numeric|min:0|max:10',
                    'openings'   => 'required|numeric|min:0|max:100',
                    'skills' => 'required|array',
                    'skills.*' => 'required|string|min:2|max:100',
                    'roles' => 'required|array',
                    'roles.*' => 'required|string|min:2|max:100',
                    'key_skills' => 'required|array',
                    'key_skills.*' => 'required|string|min:2|max:100',
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                    $job->step = 1;
                    $job->job_type_id = $request->job_type;
                    $job->category_id = $request->category;
                    $job->qualification = json_encode($request->qualification);
                    $job->title = $request->title;
                    $job->description = $request->description;
                    $job->salary_from = $request->salary_from;
                    $job->salary_to = $request->salary_to;
                    $job->experience = $request->experience;
                    $job->openings = $request->openings;
                    $job->skills = json_encode($request->skills);
                    $job->roles = json_encode($request->roles);
                    $job->key_skills = json_encode($request->key_skills);
                    $job->save();
            break;
            // STEP 2 - Company Info
            case 2:
                $validator = Validator::make($request->all(), [
                    'company_logo'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
                    'company_name' => 'required|string|min:2|max:100',
                    'company_description' => 'required|string|min:10|max:1000',
                    'company_website' => 'required|url|max:100',
                    'name' => 'required|string|min:2|max:100',
                    'email' => 'required|email|max:100',
                    'phone' => 'required|numeric|digits_between:8,12',
                    'city' => 'required|string|min:2|max:100',
                    'address' => 'required|string|min:2|max:200',
                    'zip_code' => 'required|numeric|digits_between:6,8',
                ]);
                
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
        

                $logo = null;
                if ($request->hasFile('company_logo')) {
                    $logo = uploadImages('uploads/company/logo', $request->file('company_logo'));
                }

                $company = Company::create([
                    'user_id' => auth()->id(),
                    'name' => $request->company_name,
                    'website' => $request->company_website,
                    'description' => $request->company_description,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'city' => $request->city,
                    'address' => $request->address,
                    'zip_code' => $request->zip_code,
                    'image' => $logo,
                ]);

                $job->update([
                    'step' => 2,
                    'company_id' => $company->id,
                ]);
            break;
        }

        return response()->json([
            'success' => true,
            'job_id' => $job->id,
            'data' => $job->fresh(),
            'message' => "Step {$step} saved successfully."
        ]);
    
    }

    public function update(Request $request,$id){
        $rules = [
            # step 1  
            'job_type'   => 'required|numeric|exists:job_types,id',
            'category' =>  'required|numeric|exists:categories,id',
            'education_level' => 'required|array',
            'education_level.*' => 'required|numeric|exists:education_levels,id',
            'title' => 'required|string|min:2|max:100',
            'description' => 'required|string|min:10|max:1000',
            'salary_from' => 'required|numeric|min:10|lte:salary_to',
            'salary_to'   => 'required|numeric|min:10|gte:salary_from',
            'experience'   => 'required|numeric|min:0|max:10',
            'openings'   => 'required|numeric|min:0|max:100',
            'skills' => 'required|array',
            'skills.*' => 'required|string|min:2|max:100',
            'roles' => 'required|array',
            'roles.*' => 'required|string|min:2|max:100',
            'key_skills' => 'required|array',
            'key_skills.*' => 'required|string|min:2|max:100',

            # step 2
            'company_logo'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'company_name' => 'required|string|min:2|max:100',
            'company_description' => 'required|string|min:10|max:1000',
            'company_website' => 'required|url|max:100',
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|numeric|digits_between:8,12',
            'city' => 'required|string|min:2|max:100',
            'address' => 'required|string|min:2|max:200',
            'zip_code' => 'required|numeric|digits_between:6,8',
        ];
       
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }

        try{
            $job = Job::where('slug',$slug)->first();
            $jobs->update($request->all());
            return response()->json([
                'success' => true,  
                'message' => 'Job created successfully.',
                'job' => $jobs
            ], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'Something went wrong, Please try again later.'], 500);
            // return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function edit($slug){
        $job = Job::where('slug',$slug)->first();
        try{
            return response()->json([
                'success' => true,  
                'message' => 'Job fetched successfully.',
                'job' => $job
            ], 200);

        }catch(\Exception $e){
            return response()->json(['message' => 'Something went wrong, Please try again later.'], 500);
            // return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function queries(Request $request){
        $rules = [
            'job_id' => 'required|numeric',
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|numeric|digits_between:8,15',
            'experience' => 'required|numeric',
            'skills' => 'required|string|max:500',
            'message' => 'required|string|max:1000'
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 422);
        }
   
        try{
          $job = JobQuery::firstOrCreate(
                [
                    'email' => $request->email,
                ],
                [
                    'job_id' =>$request->job_id,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'experience' => $request->experience,
                    'skills' => $request->skills,
                    'message' => $request->message,
                ]
            );
            if ($job->wasRecentlyCreated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Query submitted successfully.',
                    'job' => $job,
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Query already submitted.',
                    'job' => $job,
                ], 200);
            }
        }catch(\Exception $e){
            // return response()->json(['message' => $e->getMessage()], 500);
            return response()->json(['message' => 'Something went wrong, Please try again later.'], 500);
        }
    }

    public function filter(){
        $work_mode =  JobType::where('status',1)->get(['id','type']);
        $filter =[
            'work_mode' =>$work_mode
        ];

        if($filter){
            return response()->json([
                'success' => true, 
                'message' => 'Filter fetched successfully.',
                'filter' => $filter
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Filter not found.',
                'filter' => []
            ], 404);
        }
    }
}