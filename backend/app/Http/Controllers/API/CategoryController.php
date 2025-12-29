<?php
/**
 * Address Guru's General Business Category API's Controller
 *
 * Handles API requests for Address Guru's Business Listing routes
 *
 * PHP version 7.4
 *
 * LICENSE: This source file is private software of Address Guru. No one
 * is allowed to copy, delete, change, distribute this file or data without 
 * a written permission from the Director of Address Guru.
 *
 * @category   Application Route Controller
 * @package    p
 * @author     Robin Tomar <robintomr@icloud.com>
 * @copyright  2020-2023 Address Guru Singapore
 */
namespace App\Http\Controllers\API;

use App\Service;
use App\Category;
use App\Coaching;
use App\Facility;
use App\Mcategory;
use App\PaymentMode;
use App\SubCategory;
use App\Msubcategory;
use App\ChildCategory;
use App\{listing,Marketplace,Job,Query};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index($type)
    {
        if (! in_array($type, ['listing', 'marketplace', 'subcategories', 'jobs', 'properties']))
        {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Request',
            ], 200);
        }

        $categories =Category::where([
            ['status', 1],
            ['type', $type]
        ])
        ->whereNull('parent_id')
        ->get(['id', 'slug', 'name', 'icon', 'colors', 'svg_code']);

        if($categories)
        {
            return response()->json([
                'result' =>  $categories ,
                'success'=> true,
                'message'=>'category fetchd successfully.',
            ], 200);
        }
        else
        {
            return response()->json([
                'success'=> false,
                'result' => $categories ,
                'message'=> 'category not found.',
            ], 404);
        }
    }

    public function recent($type)
    {
        if (!in_array($type, ['listing', 'marketplace', 'jobs', 'properties']))
        {
            return response()->json([
                'success'=> false,
                'message'=> 'Invalid Request',
            ], 400);
        }

        switch ($type) {
            case 'listing':
                $query = Listing::query();
                $query->where('is_approved',1);
                break;
            case 'marketplace':
                $query = Marketplace::query();
                break;
            case 'jobs':
                $query = Job::query();
                $query = Job::with('company:id,image,name,address')
                    ->where('is_approved', 1);
                break;
            case 'properties':
                $query = Property::query();
                break;
        }

        $data = $query->latest()->take(6)->get();

        if ($data->isNotEmpty()) {
            return response()->json([
                'success'=> true,
                'result' => $data,
                'message'=> 'Recent ' . $type . ' fetched successfully.',
            ], 200);
        } else {
            return response()->json([
                'result' => [],
                'success'=> false,
                'message'=> ucfirst($type) . ' not found.',
            ], 404);
        }
    }

    public function form($id)
    {
        $category = Category::with('attributes')->findOrFail($id);
        if($category){
            return response()->json([
                'success' => true,
                'result' =>  $category ,
                'message'=>'category attributes fetchd successfully.',
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'result' =>  $category ,
                'message'=> 'category attributes not found.',
            ],404);
        }
    }

    public function sub_category($id)
    {
        $type = request()->get('type') != 'marketplace' ? 'listing' : 'marketplace';

        if($type == 'marketplace')
        {
            $categories = Msubcategory::where('category_id', $id)->get();
            return $categories;
        }
        else
        {
            $categories = Category::where([
                ['status', 1],
                ['type', $type],
                ['parent_id', $id],
            ])->get(['id', 'name', 'icon', 'colors', 'svg_code']);
        }


        if($categories)
        {
            return response()->json([
                'success'=> true,
                'message'=>'Sub category fetchd successfully.',
                'result' =>  $categories,
            ],200);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message'=> 'Sub category not found.',
                'result' =>  [] ,
            ],404);
        }
    }

    public function edit($id)
    {
        // Fetch data with pagination 
        $data = Coaching::with('category','subcategory','media','personals','ratings')->where('category_id', $id)->paginate(20);
        if ($data->count() > 0) {
            foreach ($data as $product) {
                $mediaNames = $product->media->pluck('name')->toArray(); // Convert media names to an array
                if (!empty($mediaNames)) {
                    // Wrap each media name in a full URL and return it as an array
                    $product->photo = array_map(function ($name) {
                        return 'https://addressguru.sg/images/' . $name;
                    }, $mediaNames);
                } else {
                    $product->photo = []; // Set as empty array if no media found
                }
            }
            // Return response with pagination details
            return response()->json([
                'code'    => $data->isNotEmpty() ? 200 : 404,
                'error'   => $data->isEmpty(),
                'status'  => $data->isNotEmpty(), 
                'current_page' => $data->currentPage(),
                'total'        => $data->total(),
                'per_page'     => $data->perPage(),
                'last_page'    => $data->lastPage(),
                'message' => $data->isNotEmpty() ? 'ok' : 'No records found',
                'result'  => $data->isNotEmpty() ? $data->items() : null, 
            ], 200);
        }
    }

    // public function subCategory($id){
    //     $subCategories = SubCategory::orderBy('name','asc')->where('category_id',$id)->get();
    //     if($subCategories){
    //          return response()->json([
    //             'code'   => 200,
    //             'error'  => true,
    //             'status' => false,
    //             'result' =>  $subCategories ,
    //             'message'=>'ok',
    //         ],200);
    //     }else{
    //          return response()->json([
    //             'code'   => 503,
    //             'error'  => true,
    //             'status' => false,
    //             'result' =>  $subCategories ,
    //             'message'=> 'error',
    //         ],200);
    //     }
    // }

    public function allCategoryData($id,$status =null){
        if($status == 1){
        }else{
        }
        $subCategories = SubCategory::orderBy('name','asc')->where('category_id',$id)->get();
        if($subCategories){
             return response()->json([
                'code'   => 200,
                'error'  => true,
                'status' => false,
                'result' =>  $subCategories ,
                'message'=>'ok',
            ],200);
        }else{
             return response()->json([
                'code'   => 503,
                'error'  => true,
                'status' => false,
                'result' =>  $subCategories ,
                'message'=> 'error',
            ],200);
        }
    }


    public function service($category_id)
    {
        $service = Service::where('category_id', $category_id)->orderBy('name', 'asc')->get(['name','id']);
        $facilitis = Facility::where('category_id', $category_id)->orderBy('name', 'asc')->get(['name','id']);
        $data = [
            'service' => $service,
            'facilitis' => $facilitis
        ];
        if (!$service->isEmpty() || !$facilitis->isEmpty()) {
            return response()->json([
                'success' => true,
                'data' => $data,
                'message'=> 'service  & facilitis fatched successfully !',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => $data,
                'message'=> 'No data found',
            ], 200);
        }
    }

    public function facility($category_id, $id = null){
        if($id){
            $data = Facility::where('sub_category_id',$category_id)->orderBy('name','asc')->get();
        }else{
            $data = Facility::where('category_id',$category_id)->orderBy('name','asc')->get();
        }
        if($data){
             return response()->json([
                'code'   => 200,
                'error'  => true,
                'status' => false,
                'result' =>  $data ,
                'message'=>'ok',
            ],200);
        }else{
             return response()->json([
                'code'   => 503,
                'error'  => true,
                'status' => false,
                'result' =>  $data ,
                'message'=> 'error',
            ],200);
        }
    }

    public function categoryFormData($category_id, $sub_category_id = null)
    {
        // Fetch either SubCategory or Category with related services and facilities
        $data = $sub_category_id 
            ? SubCategory::with('services', 'facilities')->find($sub_category_id)
            : Category::with('services', 'facilities')->find($category_id);
        // Fetch payment modes
        $paymentModes = PaymentMode::orderBy('name', 'asc')->get();
        // Initialize an empty array to hold all dropdown values
        $dropdowns = [];
        if ($data) {
            // Set service attributes based on conditions
            $this->setServiceAttributes($data, $category_id);
            $this->setFacilitiesAttributes($data, $category_id);
            // Add dropdown values for each child category label
            foreach ($data->childcategory as $childcategory) {
                $childDropdowns = ChildCategory::where('parent', $childcategory->id)->get();
                $childDropdownValues = $childDropdowns->map(function ($dropdown) use ($childcategory) {
                    return [
                        'id'              => $dropdown->id,
                        'category_id'     => $dropdown->category_id,
                        'sub_category_id' => $dropdown->sub_category_id,
                        'label'           => $childcategory->label,
                        'value'           => $dropdown->value,
                        'parent'          => $dropdown->parent,
                        'created_at'      => $dropdown->created_at,
                        'updated_at'      => $dropdown->updated_at,
                        'deleted_at'      => $dropdown->deleted_at,
                    ];
                });
                // Add to the main dropdown array
                $dropdowns[] = [
                    'label' => $childcategory->label,
                    'values' => $childDropdownValues,
                ];
            }
        }
        // Return the response with data or an error message, including dropdowns in the data array
        return response()->json([
            'code'    => $data ? 200 : 503,
            'error'   => !$data,
            'status'  => (bool) $data,
            'result'  => $data ? [
                'data' => $data->setAttribute('dropdowns', $dropdowns),
                'payment_modes' => $paymentModes
            ] : null,
            'message' => $data ? 'ok' : 'error',
        ], 200);
    }

    public function marketplaceCategoryFormData($category_id, $sub_category_id = null)
        {
            // Fetch either SubCategory or Category with related services and facilities
            $data = $sub_category_id 
                ? Msubcategory::find($sub_category_id)
                : Mcategory::find($category_id);
            // Fetch payment modes
            $paymentModes = PaymentMode::orderBy('name', 'asc')->get();
            // Initialize an empty array to hold all dropdown values
            $dropdowns = [];
            if ($data) {
                // Set service attributes based on conditions
                // $this->setServiceAttributes($data, $category_id);
                // $this->setFacilitiesAttributes($data, $category_id);
                // Add dropdown values for each child category label
                foreach ($data->childcategory as $childcategory) {
                    $childDropdowns = ChildCategory::where('parent', $childcategory->id)->get();
                    $childDropdownValues = $childDropdowns->map(function ($dropdown) use ($childcategory) {
                        return [
                            'id'              => $dropdown->id,
                            'category_id'     => $dropdown->category_id,
                            'sub_category_id' => $dropdown->sub_category_id,
                            'label'           => $childcategory->label,
                            'value'           => $dropdown->value,
                            'parent'          => $dropdown->parent,
                            'created_at'      => $dropdown->created_at,
                            'updated_at'      => $dropdown->updated_at,
                            'deleted_at'      => $dropdown->deleted_at,
                        ];
                    });
                    // Add to the main dropdown array
                    $dropdowns[] = [
                        'label' => $childcategory->label,
                        'values' => $childDropdownValues,
                    ];
                }
            }
            // Return the response with data or an error message, including dropdowns in the data array
            return response()->json([
                'code'    => $data ? 200 : 503,
                'error'   => !$data,
                'status'  => (bool) $data,
                'result'  => $data ? [
                    'data' => $data->setAttribute('dropdowns', $dropdowns),
                    'payment_modes' => $paymentModes
                ] : null,
                'message' => $data ? 'ok' : 'error',
            ], 200);
        }
    /**
     * Set service attributes on the data object.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $data
     * @param  int  $category_id
     * @return void
     */
    protected function setServiceAttributes($data, $category_id)
    {
        if ($data->services->count() >= 1) {
            $data->setAttribute('service_checkbox', 'true');
            $data->setAttribute('service_text', 'false');
        } elseif (in_array($category_id, [1, 3, 6, 33, 42, 43, 44, 47, 48, 49, 54, 55])) {
            $data->setAttribute('service_checkbox', 'false');
            $data->setAttribute('service_text', 'true');
        } else {
            $data->setAttribute('service_checkbox', 'false');
            $data->setAttribute('service_text', 'false');
        }
    }

    protected function setFacilitiesAttributes($data, $category_id)
    {
        if ($data->facilities->count() >= 1) {
            $data->setAttribute('facilitie_checkbox', 'true');
            $data->setAttribute('facilitie_text', 'false');
        } elseif (in_array($category_id, [1, 3, 6, 33, 42, 43, 44, 47, 48, 49, 54, 55])) {
            $data->setAttribute('facilitie_checkbox', 'false');
            $data->setAttribute('facilitie_text', 'true');
        } else {
            $data->setAttribute('facilitie_checkbox', 'false');
            $data->setAttribute('facilitie_text', 'false');
        }
    }

    public function query_submit(Request $request,$type,$id){

        if (in_array($type, ['listing', 'marketplace', 'jobs', 'property'])) {
            $rules = [
                'name' => 'required|max:100',
                'email' => 'required|email',
                'phone' => 'required|numeric|digits_between:8,15',
                'message' => 'required|max:1000',
            ];

            if($type == 'jobs'){
                $rules['experience'] = 'required|numeric';
                $rules['skills'] =  'required|max:200';
            }

            $request->validate($rules);

            try{
                $modelClass = match($type) {
                    'listing' => listing::class,
                    'marketplace' => Marketplace::class,
                    'jobs' => Job::class,
                    'property' => Property::class,
                    default => null
                };

                $model = $modelClass::findOrFail($id);
                $model->queries()->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'message' => $request->message,
                    'experience' => $request->experience,
                    'skills' => $request->skills,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Your query has been submitted  successfully.'
                ]);
            }catch(\Exception $e){
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong, Please try again later.',
                    'error' => $e->getmessage(),
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Request.'
            ]);
        }
    }

    public function ratings_submit(Request $request,$type,$id){
        if (in_array($type, ['listing', 'marketplace', 'jobs', 'property'])) {
            $rules = [
                'name' => 'required|max:100',
                'email' => 'required|email',
                'rating' => 'required|numeric|min:1|max:5',
                'message' => 'required|max:1000',
            ];

            $request->validate($rules);

            try{
                $modelClass = match($type) {
                    'listing' => listing::class,
                    'marketplace' => Marketplace::class,
                    'jobs' => Job::class,
                    'property' => Property::class,
                    default => null
                };

                $model = $modelClass::findOrFail($id);
                $model->ratings()->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'rating' =>$request->rating,
                    'message' => $request->message,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Rating request has been submitted successfully.'
                ]);
            }catch(\Exception $e){
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong, Please try again later.',
                    'error' => $e->getmessage(),
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Request.'
            ]);
        }
    }

    public function claim_submit(Request $request,$type,$id){

        if (in_array($type, ['listing', 'marketplace', 'jobs', 'property'])) {
            $rules = [
                'name' => 'required|max:100',
                'email' => 'required|email',
                'phone' => 'required|numeric|digits_between:8,15',
                'message' => 'required|max:1000',
            ];

            $request->validate($rules);

            try{
                $modelClass = match($type) {
                    'listing' => listing::class,
                    'marketplace' => Marketplace::class,
                    'jobs' => Job::class,
                    'property' => Property::class,
                    default => null
                };

                $model = $modelClass::findOrFail($id);
                $model->claim()->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' =>$request->phone,
                    'message' => $request->message,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Claim request has been submitted  successfully.'
                ]);
            }catch(\Exception $e){
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong, Please try again later.',
                    'error' => $e->getmessage(),
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Request.'
            ]);
        }
    }


    public function report_submit(Request $request, $type, $id)
    {
        if (in_array($type, ['listing', 'marketplace', 'jobs', 'property']))
        {
            $rules = [
                'report'       => 'required|max:1000',
                'grc_response'=> 'required'
            ];

            $request->validate($rules, [
                'grc_response.required'=> 'Kindly Complete the reCPATCHA Challenge',
            ]);

            try {
                $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret'  => env('NOCAPTCHA_SECRET'),
                    'response'=> urldecode($request->grc_response),
                    // 'remoteip'=> $request->ip(), // Optional: for reCAPTCHA v3 score calculation
                ]);

                $result = $response->json();
                return $result;
                if ($result['success'])
                {
                    $modelClass = match($type) {
                        'jobs'       => Job::class,
                        'default'    => null,
                        'listing'    => listing::class,
                        'property'   => Property::class,
                        'marketplace'=> Marketplace::class,
                    };

                    $model = $modelClass::findOrFail($id);

                    $model->report()->create([
                        'report' => $request->report,
                    ]);

                    return response()->json([
                        'success'=> true,
                        'message'=> 'Report request has been submitted  successfully.'
                    ]);
                }
                else
                {
                    return response()->json(['message' => 'reCAPTCHA verification failed.'], 422);
                }
            }catch(\Exception $e) {
                return response()->json([
                    'error'  => $e->getmessage(),
                    'success'=> false,
                    'message'=> 'Something went wrong, Please try again later.',
                ]);
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Request.'
            ]);
        }
    }
    
    public function view(Request $request, $type, $id)
    {
        if(!in_array($type, ['listing', 'marketplace', 'jobs', 'property']))
        {
            return response()->json([
                'success'=> false,
                'message'=> 'Invalid Request.'
            ]);
        }

        try {
            $modelClass = match($type) {
                'jobs'       => Job::class,
                'listing'    => listing::class,
                'property'   => Property::class,
                'marketplace'=> Marketplace::class,
            };

            $model = $modelClass::findOrFail($id);

            // view type 
            $userIp   = $request->ip();
            $viewType = $request->input('view_type', 'normal');
            // phone, whatsapp, website, normal

            // Check 24hr condition
            $recentLog = $model->viewLogs()
                ->where('ip_address', $userIp)
                ->where('view_type', $viewType)
                ->where('created_at', '>=', now()->subDay())
                ->first();

            if (!$recentLog) {
                // Save the new log
                $model->viewLogs()->create([
                    'ip_address' => $userIp,
                    'view_type'  => $viewType,
                ]);

                // Fetch view record
                $view = $model->view()->first();

                // If not exist → create and reassign
                if (!$view) {
                    $view = $model->view()->create([
                        'views'          => 0,
                        'phone_views'    => 0,
                        'whatsapp_views' => 0,
                        'website_views'  => 0,
                    ]);
                }

                // Increase correct counter
                match($viewType) {
                    default   => $view->increment('views'),
                    'phone'   => $view->increment('phone_views'),
                    'website' => $view->increment('website_views'),
                    'whatsapp'=> $view->increment('whatsapp_views'),
                };
            }

            return response()->json([
                'success' => true,
                'message' => 'View update/create successfully.'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong, Please try again later.',
                'error'   => $e->getMessage(),
            ]);
        }
    }

    public function global_search(Request $request)
    {
        // 1. Normalize search text
        $search = strtolower(trim($request->search));

        // 2. Remove stop words
        $stopWords = ['top','best','in','near','nearby','list','of','the','10'];
        $words = array_values(array_diff(explode(' ', $search), $stopWords));

        // 3. Category mapping
        $categoryMap = [
            'gym' => 'gym',
            'fitness' => 'gym',
            'salon' => 'salon',
            'spa' => 'spa',
            'hotel' => 'hotel',
            'hospital' => 'hospital',
        ];

        $category = null;
        $city = $request->city; // keep URL city if passed

        // 4. Detect category & city from keywords
        foreach ($words as $word) {

            // category detection
            if (isset($categoryMap[$word])) {
                $category = $categoryMap[$word];
            }

            // city detection (only if not already passed)
            if (!$city && City::whereRaw('LOWER(name) = ?', [$word])->exists()) {
                $city = $word;
            }
        }

        // 5. Fetch category record (optional)
        $categoryData = null;
        if ($category) {
            $categoryData = Category::whereRaw('LOWER(name) = ?', [$category])->first();
        }

        // DEBUG (remove later)
        // return [
        //     'words' => $words,
        //     'category' => $category,
        //     'city' => $city,
        //     'category_data' => $categoryData
        // ];
        $categoryId = $categoryData->id;
        $data = Listing::where('is_approved', 1)
        ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
        ->when($city, fn ($q) => $q->where('city', 'LIKE', "%{$city}%"))
        ->paginate(20);

        $hasData = $data->count() > 0;

        return response()->json([
            'code'          => $hasData ? 200 : 404,
            'error'         => !$hasData,
            'status'        => $hasData,
            'current_page'  => $data->currentPage(),
            'total'         => $data->total(),
            'per_page'      => $data->perPage(),
            'last_page'     => $data->lastPage(),
            'message'       => $hasData ? 'ok' : 'No records found',
            'result'        => $hasData ? $data->items() : [],
            'category'      => $category,
        ], 200);
    }


    public function send_leads(Request $request){
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email',
            'category' => 'required',
        ];
        $request->validate($rules);
        $category = Category::where('slug',$request->category)->first();
        $listing = Listing::where('category_id',$category->id)->orderBy('id','DESC')->limit(10)->get();
        return $listing;

        // $subject  = 'Lead Testing';
        // $details     = (object) [
        //     'otp'  => $user->verify
        // ];
        // try {
        //     Mail::to($user->email)->send(new EMail($details, $subject, 'mails.notification.user.mailotp'));
        // }catch(\Exception $e){
        //     Log::error($e);
        // }
    }
}