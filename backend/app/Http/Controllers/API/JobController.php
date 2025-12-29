<?php

/**

 * Address Guru's Marketplace API's Controller

 *

 * Handles API requests for Address Guru's Marketplace data

 *

 * PHP version 7.4

 *

 * LICENSE: This source file is private software of Address Guru. No one

 * is allowed to copy, delete, change, distribute this file or data without 

 * a written permission from the Director of Address Guru.

 *

 * @category   Application Route return []

 * @package     PropertyController

 * @author     ManjeetChnad manjeetchand01@gmail.com

 * @copyright  2024-2025 Address Guru

 */



namespace App\Http\Controllers\API;



use App\Media;

use App\Cities;

use App\States;

use App\AdsApp;

use App\Product;

use App\Personal;

use App\Job;

use App\InactiveJob;

use App\Coaching;

use App\Mcategory;

use App\Msubcategory;

use App\MarketplaceTypes;

use App\MarketAttributes;

use Illuminate\Support\Str;



use App\Helpers\StaticData;

use App\Helpers\API\Assistant;



use App\Traits\ResponseAPI;

use App\Traits\PaymnetPlansTrait;



use App\Http\Controllers\Controller;



use Illuminate\Http\Request;



use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Support\Facades\Validator;



use Illuminate\Pagination\Paginator;

use Illuminate\Pagination\LengthAwarePaginator;



class JobController extends Controller

{

    private function sanitizeInput($input)

    {

        return htmlspecialchars(strip_tags(trim($input)));

    }

    

    public function index(Request $request)

    {

        $query = Job::orderBy('title', 'asc');

    

        // Apply filters based on request parameters

        if($request->has('city') && !empty($request->city)) {

            $query->where('city', $request->city);

        }

        

        // Paginate the results

        $data = $query->paginate(20);

    

        if ($data->count() > 0) {

            // Transform the paginated collection to decode JSON fields and update image paths

            $data->getCollection()->transform(function ($job) {

                $job->qualification = json_decode($job->qualification, true);

                $job->responsibility = json_decode($job->responsibility, true);

                $job->skills = json_decode($job->skills, true);

                $job->image = $job->image ? 'https://addressguru.sg/' . $job->image : null;

                return $job;

            });

    

            return response()->json([

                'code'         => 200,

                'error'        => false,

                'status'       => true,

                'total'        => $data->total(), // Total count of jobs

                'current_page' => $data->currentPage(), // Current page number

                'result'       => $data->items(), // Paginated items

                'message'      => 'ok',

            ], 200);

        }

    

        return response()->json([

            'code'     => 503,

            'error'    => true,

            'status'   => false,

            'result'   => [],

            'message'  => 'No jobs found',

        ], 200);

    }

    

    

    

    public function jobDetails($slug){

     

        $data = InactiveJob::with('mcategory','msubcategory')->where('slug',$slug)->first();

        if ($data) {

            // Decode JSON fields

            $data->qualification = json_decode($data->qualification, true);

            $data->responsibility = json_decode($data->responsibility, true);

            $data->skills = json_decode($data->skills, true);

            $data->image = 'https://addressguru.sg/' . $data->image;

    

    

            return response()->json([

                'code'    => 200,

                'error'   => false,

                'message' => "Data fetched successfully.",

                'result'  => $data,

                'status'  => true,

            ], 200);

        }

    

        // Handle case when data is not found

        return response()->json([

            'code'    => 404,

            'error'   => true,

            'message' => "Data not found.",

            'result'  => null,

            'status'  => false,

        ], 404);

    }

    

    public function userListing(Request $request)

    {

        $query = InactiveJob::where('user_id',auth()->user()->id)->orderBy('title', 'asc');

        // Apply filters based on request parameters

        if ($request->has('city') && !empty($request->city)) {

            $query->where('city', $request->city);

        }

        

        // Paginate the results

        $data = $query->paginate(20);

    

        if ($data->count() > 0) {

            // Transform the paginated collection to decode JSON fields and update image paths

            $data->getCollection()->transform(function ($job) {

                $job->qualification = json_decode($job->qualification, true);

                $job->responsibility = json_decode($job->responsibility, true);

                $job->skills = json_decode($job->skills, true);

                $job->image = $job->image ? 'https://addressguru.sg/' . $job->image : null;

                return $job;

            });

    

            return response()->json([

                'code'         => 200,

                'error'        => false,

                'status'       => true,

                'total'        => $data->total(), // Total count of jobs

                'current_page' => $data->currentPage(), // Current page number

                'result'       => $data, // Paginated items

                'message'      => 'ok',

            ], 200);

        }

    

        return response()->json([

            'code'     => 503,

            'error'    => true,

            'status'   => false,

            'result'   => [],

            'message'  => 'No jobs found',

        ], 200);

    }

    

    private function decodeJsonField($field)

    {

        if (is_null($field) || $field === '') {

            return [];

        }

    

        // Handle double-encoded JSON

        $decoded = json_decode($field, true);

        if (is_string($decoded)) {

            $decoded = json_decode($decoded, true);

        }

    

        return $decoded ?? [];

    }

    

    public function store(Request $request)

    {

        // Validate request data

        $validated = $request->validate([

            'title'         => 'required|min:20|max:100',

            'description'   => 'required|min:50',

            'name'          => 'required',

            'email'         => [

                'required',

                'email',

                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'

            ],

            'state'         => 'required',

            'city'          => 'required',

            'locality'      => 'required',

            'phone'         => 'required|digits:8',

            'image'         => 'nullable|mimes:jpeg,png,jpg|max:2000',

        ]);

  

        $slug = Str::slug($validated['title']);

        // Prepare job data for insertion

        $jobData = [

            'user_id'        => auth()->id(),

            'title'          => $this->sanitizeInput($validated['title']),

            'slug'           => $slug,

            'job_category'  =>$request->get('job_category'),

            'job_type'       => $request->get('job_type'),

            'company_name'   => $request->get('company_name'),

            'company_website'=> $request->get('company_website'),

            'edu_level'      => $request->get('edu_level'),

            'description'    => $this->sanitizeInput($validated['description']),

            'ea_number'      => $request->get('ea_number'),

            'salary_from'    => $request->get('salary_from'),

            'salary_to'      => $request->get('salary_to'),

            'skills'         => $request->get('skills'),

            'experience'     => $request->get('experience'),

            'qualification'  => $request->get('qualification'),

            'responsibility' => $request->get('responsibility'),

            'name'           => $validated['name'],

            'email'          => $validated['email'],

            'state'          => $validated['state'],

            'city'           => $validated['city'],

            'locality'       => $validated['locality'],

            'phone'          => $validated['phone'],

            'postel_code'    => $request->get('postel_code'),

        ];

    

        // Handle image upload

       if ($request->hasFile('image')) {

            $jobData['image'] = $this->uploadImage('job', $request->file('image'), null);

        }

    

        // Insert job data into the database

        DB::table('inactive_jobs')->insert($jobData);

    

        // Handle payment logic if applicable

        if ($request->has('payment') && is_numeric($request->amount)) {

        }

    

        // Return success response

        return response()->json([

            'ok'  => 1,

            'msg' => 'Data saved successfully',

        ]);

    }



    public function uploadImage($type, $image, $id)

    {

        $year  = date('Y');

        $month = date('m');

        $path  = 'uploads/jobs/' . $year . '/' . $month;

    

        // Generate a unique filename

        $name = uniqid() . '.' . $image->getClientOriginalExtension();

    

        // Create directory if it doesn't exist

        if (!file_exists(public_path($path))) {

            mkdir(public_path($path), 0755, true);

        }

    

        // Move the file to the destination folder

        $image->move(public_path($path), $name);

    

        // Return the file path

        return $path . '/' . $name;

    }





    public function edit($id){

        $data = InactiveJob::with('mcategory','msubcategory')->findOrFail($id);



        if ($data) {

            // Decode JSON fields

            $data->qualification = json_decode($data->qualification, true);

            $data->responsibility = json_decode($data->responsibility, true);

            $data->skills = json_decode($data->skills, true);

            $data->image = 'https://addressguru.sg/' . $data->image;

    

    

            return response()->json([

                'code'    => 200,

                'error'   => false,

                'message' => "Data fetched successfully.",

                'result'  => $data,

                'status'  => true,

            ], 200);

        }

    

        // Handle case when data is not found

        return response()->json([

            'code'    => 404,

            'error'   => true,

            'message' => "Data not found.",

            'result'  => null,

            'status'  => false,

        ], 404);

    }





    public function update(Request $request)

    {

        // Validate request data

        $validated = $request->validate([

            'job_id' => 'required|numeric',

            'title' => 'required|min:20|max:100',

            'description' => 'required|min:50',

            'name' => 'required',

            'email' => [

                'required',

                'email',

                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'

            ],

            'state' => 'required',

            'city' => 'required',

            'locality' => 'required',

            'phone' => 'required|digits:8',

            'image' => 'nullable|mimes:jpeg,png,jpg|max:2000', // Image validation

        ]);

    



        // Generate the slug from the title

        $slug = Str::slug($validated['title']);

    

        // Find the job entry to update

        $inactivejob = InactiveJob::findOrFail($validated['job_id']);

        

        // Start updating the inactive job data

        $inactivejob->update([

            'user_id' => auth()->id(),

            'title' => $this->sanitizeInput($validated['title']),

            'slug' => $slug,

            'job_category' => $request->get('job_category'),

            'job_type' => $request->get('job_type'),

            'company_name' => $request->get('company_name'),

            'company_website' => $request->get('company_website'),

            'edu_level' => $request->get('edu_level'),

            'description' => $this->sanitizeInput($validated['description']),

            'ea_number' => $request->get('ea_number'),

            'salary_from' => $request->get('salary_from'),

            'salary_to' => $request->get('salary_to'),

            'skills' => $request->get('skills'),

            'experience' => $request->get('experience'),

            'qualification' => $request->get('qualification'),

            'responsibility' => $request->get('responsibility'),

            'name' => $validated['name'],

            'email' => $validated['email'],

            'state' => $validated['state'],

            'city' => $validated['city'],

            'locality' => $validated['locality'],

            'phone' => $validated['phone'],

            'postel_code' => $request->get('postel_code'),

        ]);

    

        // Find or create the associated Job record

        $job = Job::where('inactive_job_id', $inactivejob->id)->firstOrFail();

    

        // Update the job with data from inactive job

        $jobData = $inactivejob->toArray();

        unset($jobData['id']); // Remove ID to prevent conflicts

        $jobData['inactive_job_id'] = $inactivejob->id;

    

        $job->update($jobData);

    

        // Handle image upload if provided

        if ($request->hasFile('image')) {

            $job->image = $this->uploadImage('job', $request->file('image'), null);

            $job->save(); // Save the updated image path

        }

    

        // Handle job status for users with role 'User'

        if (auth()->user()->role->name == "User") {

            $job->update(['status' => 0]);

        }

    

        // Handle post status update based on payment (if applicable)

        if ($request->has('payment') && is_numeric($request->amount) && intval($request->amount)) {

            $job->update(['post_status' => 1]);

        }

    

        return response()->json([

            'ok' => 1,

            'msg' => 'Data updated successfully',

        ]);

    }



    public function destroy($id)

    {

        try {

            // Retrieve the property owned by the authenticated user

            $inactivejob = InactiveJob::where('user_id', auth()->user()->id)

                ->where('id', $id)

                ->firstOrFail();

            if($inactivejob){

                $jobs = Job::where('inactive_job_id',$inactivejob->id)->first();

                // Check if a related job exists and delete it if so

                if ($jobs) {

                    $jobs->delete(); 

                }

                 // Delete the InactiveJob entry

                $inactivejob->delete();

            }

            // Return a success response

            return response()->json([

                'code'    => 200,

                'error'   => false,

                'message' => "Data deleted successfully.",

                'status'  => true,

            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            // Handle the case where the InactiveJob is not found

            return response()->json([

                'code'    => 404,

                'error'   => true,

                'message' => "InactiveJob not found.",

                'status'  => false,

            ], 404);

        } catch (\Exception $e) {

            // Handle other exceptions and provide a generic error message

            return response()->json([

                'code'    => 500,

                'error'   => true,

                'message' => "An error occurred: " . $e->getMessage(),

                'status'  => false,

            ], 500);

        }

    }





}