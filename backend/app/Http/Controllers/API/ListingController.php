<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\{Category,listing,OpeningHours,UserPlan,Marketplace,Job,Property};
use Illuminate\Support\Str;

class ListingController extends Controller
{

    public function index(Request $request ,$category, $city)
    {
        $category = Category::where('slug', $category)->first();
        if($category)
        {
            $perPage = 5;
            $page    = $request->get('page', 1);
            $query = listing::where([
                ['category_id', $category->id],
                ['is_approved', '1'],
                ['city', $city]
            ]);

            if ($request->filled('ag_verified')) {
                $query->where('ag_verified', 1);
            }

            $query->withCount('viewLogs');

            if ($request->filled('sort_by')) {
                switch ($request->sort_by) {
                    case 'newest':
                        $query->orderBy('id', 'DESC');
                        break;

                    case 'oldest':
                        $query->orderBy('id', 'ASC');
                        break;

                    case 'popular':
                        $query->orderBy('view_logs_count', 'DESC');
                        break;

                    default:
                        $query->orderBy('id', 'DESC');
                }
            }

        
            $data = $query->select([
                'id', 'category_id', 'slug', 'business_name', 'business_address',
                'ad_description', 'services', 'logo', 'mobile_number', 'ag_verified'])
                ->with(['category:id,name', 'view', 'ratings'])
                ->paginate($perPage, ['*'], 'page', $page);

           
            $data->transform(function ($listing)
            {
                $star = $listing->ratings()->avg('rating') ?? 0;
    
                return [
                    'id'              => $listing->id,
                    'ag_verified'     => $listing->ag_verified,
                    'slug'            => $listing->slug,
                    'business_name'   => $listing->business_name,
                    'business_address'=> $listing->business_address,
                    'ad_description'  => $listing->ad_description,
                    'services'        => $listing->service_names,
                    'logo'            => $listing->logo,
                    'mobile_number'   => $listing->mobile_number,
                    'category'        => optional($listing->category)->name,
                    'views'           => $listing->viewLogs()->count(), 
                    'rating'          => $listing->ratings()->count(),
                    'star'            => $star, 
                ];
            });

            $hasData = $data->count() > 0;

            return response()->json([
                'code'          => $hasData ? 200 : 404,
                'error'         => !$hasData,
                'status'        => $hasData,
                'current_page'  => $data->currentPage(),
                'total'         => $data->total(),
                'per_page'      => $data->perPage(),
                'has_more'      => $data->hasMorePages(),   
                'next_page'     => $data->hasMorePages() ? $data->currentPage() + 1 : null,
                'message'       => $hasData ? 'ok' : 'No records found',
                'result'        => $hasData ? $data->items() : [],
            ], 200);
        }
        else
        {
            return response()->json([
                'data'   => [],
                'success'=> false,
                'message'=> 'Unable to find the category whoose listings are requested.',
            ], 404);
        }
    }   


    public function lending($slug)
    {
        $data = listing::where('slug', $slug)->first();

        if($data)
        {
            $star = $data->ratings()->avg('rating') ?? 0;

            $data['services_id']   = $data->service_ids;    
            $data['services']      = $data->service_names;
            $data['facilities_id'] = $data->facilitie_ids;  
            $data['facilities']    = $data->facilitie_names;  
            $data['payments_id']   = $data->payment_ids;     
            $data['payments']      = $data->payment_names;     
            $data['category']      = $data->category->name;  
            $data['rating']        = $data->ratings()->count();  
            $data['ratings']       = $data->ratings;  
            $data['opening_hours'] = $data->opening_hours;  
            $data['views']         = $data->viewLogs()->count();
            $data['star']          = $star;

            return response()->json([
                'success'=> true, 
                'message'=> 'listing fetched successfully.',
                'data'   => $data
            ],200);
        }
        else
        {
            return response()->json([
                'success'=> false,
                'message'=> 'listing not found.',
                'data'   => []
            ], 404);
        }
    }

    public function user_listing($type)
    {
        // Validate allowed types
        $allowedTypes = ['listing', 'marketplace', 'jobs', 'property'];

        if (!in_array($type, $allowedTypes)) {
            return response()->json([
                'success'=> false,
                'message'=> 'Invalid request type.',
            ], 403);
        }

        try {
            // Map type to model class
            $modelClass = match ($type) {
                'jobs'       => Job::class,
                'listing'    => Listing::class,
                'property'   => Property::class,
                'marketplace'=> Marketplace::class,
            };

            // Fetch records for logged-in user
            $query = $modelClass::where('user_id', auth()->id());
          
            $data = $query->get();
            if ($type === 'listing') {
                $query->with(['category', 'ratings', 'opening_hours']);
            }
           
            // Append additional fields for listing type
            if ($type === 'listing') {
                $data = $data->map(function ($item) {
                    // Convert the model to array (includes all DB fields + relationships)
                    $array = $item->toArray();
                    // Add your custom computed fields
                    $array['services']       = $item->service_names;
                    $array['facilities']     = $item->facilitie_names;
                    $array['payments']       = $item->payment_names;
                    $array['category_name']  = optional($item->category)->name;
                    $array['ratings']        = $item->ratings;
                    $array['view_count']  = 0;
                    $array['call_count']  = 0;
                    $array['website_count']  = 0;
                    $array['whatshapp_count']  = 0;
                    $array['lead_count']  = 0;
                    $array['review_count']  = 0;

                    return $array;
                });
            }

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => ucfirst($type) . ' fetched successfully.',
            ], 200);

        } catch (\Throwable $e) {
            // Use Throwable to catch both Exception and Error
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    public function user_listing_details($type, $slug)
    {
        // Validate allowed types
        $allowedTypes = ['listing', 'marketplace', 'jobs', 'property'];

        if (!in_array($type, $allowedTypes)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request type.',
            ], 403);
        }

        try {
            // Map type to model class
            $modelClass = match ($type) {
                'listing'    => Listing::class,
                'marketplace'=> Marketplace::class,
                'jobs'       => Job::class,
                'property'   => Property::class,
            };

            // Fetch records for logged-in user
            $data  = $query->first();
            $query = $modelClass::where('slug', $slug);

            if ($type === 'listing') {
                $query->with(['view','category', 'ratings', 'opening_hours']);
            }
           
            // Append additional fields for listing type
            if ($type === 'listing') {
                $data['services']       = $data->service_names;
                $data['facilities']     = $data->facilitie_names;
                $data['payments']       = $data->payment_names;
                $data['category_name']  = optional($data->category)->name;
                $data['ratings']        = $data->ratings;
                $data['view_count']     = $data->view->views ?? 0;
                $data['call_count']     = $data->view->phone_views ?? 0;
                $data['website_count']  = $data->view->website_views ?? 0;
                $data['whatshapp_count']= $data->view->whatsapp_views ?? 0;
                $data['lead_count']     = $data->queries->count() ?? 0;
                $data['review_count']   = $data->ratings->count() ?? 0;

                return $data;
            }

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => ucfirst($type) . ' fetched successfully.',
            ], 200);

        } catch (\Throwable $e) {
            // Use Throwable to catch both Exception and Error
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $step = $request->input('step', 1);

        // Step-wise handling
        if ($request->filled('listing_id')) {
            // Fetch specific listing for the logged-in user
            $listing = Listing::where('id', $request->listing_id)
                ->where('user_id', auth()->id())
                ->firstOrFail();
        } else {
            // Create a new listing only in Step 1
            if ($step == 1) {
                $listing = new Listing();
                $listing->user_id = auth()->id();
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Listing Id is required for this step.'
                ], 400);
            }
        }

        switch ($step) {

            // STEP 1 - Basic Info
            case 1:
                $validator = Validator::make($request->all(), [
                    'category_id'     => 'required|numeric|exists:categories,id',
                    'sub_category_id' => 'nullable|numeric|exists:categories,id',
                    'business_name'   => 'required|string|min:2|max:100',
                    'business_address'=> 'required|string|min:20|max:200',
                    'ad_description'  => 'required|string|min:20|max:1000',
                    'payments'        => 'required|array',
                    'services'        => 'required|array',
                    'facilities'      => 'required|array',
                    'hours'           => 'required',
                    'establishment_year' => 'nullable|numeric',
                    'registration_year'  => 'nullable|numeric',
                    'gst_number'         => 'nullable|string|max:50',
                ]);

                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                $listing->fill($request->only([
                    'category_id', 'sub_category_id', 'business_name',
                    'business_address', 'ad_description', 'establishment_year',
                    'registration_year', 'gst_number'
                ]));

                $listing->services = $request->services;
                $listing->payments = $request->payments;
                $listing->facilities = $request->facilities;
                $listing->slug = Str::slug($request->business_name, '-');
                $listing->user_id = auth()->id();
                $listing->save();

                // handle opening hours
                $hours = $request->hours;
                if (is_string($hours)) $hours = json_decode($hours, true);

                foreach ($hours as $day => $details) {
                    OpeningHours::updateOrCreate(
                        ['listing_id' => $listing->id, 'day' => $day],
                        [
                            'is_open'    => isset($details['is_open']) ? 1 : 0,
                            'open_time'  => $details['open_time'] ?? null,
                            'close_time' => $details['close_time'] ?? null,
                        ]
                    );
                }

                break;

            // STEP 2 - Links
            case 2:
                $validator = Validator::make($request->all(), [
                    'website_link' => 'required|url|max:100',
                    'video_link'   => 'required|url|max:100',
                ]);
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $listing->fill($request->only(['website_link', 'video_link']))->save();
                break;

            // STEP 3 - Contact Info
            case 3:
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|min:2|max:100',
                    'email' => 'required|email|max:100',
                    'city' => 'required|string|min:2|max:100',
                    'locality' => 'required|string|min:20|max:200',
                    'mobile_number' => 'required|numeric|digits_between:8,15',
                    'secound_mobile_number' => 'nullable|numeric|digits_between:8,15',
                ]);
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $listing->fill($request->only([
                    'name', 'email', 'city', 'locality',
                    'mobile_number', 'secound_mobile_number'
                ]))->save();
                break;

            // STEP 4 - SEO Info
            case 4:
                $validator = Validator::make($request->all(), [
                    'seo_title' => 'required|string|min:2|max:100',
                    'seo_description' => 'required|string|min:2|max:500',
                ]);
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                $listing->fill($request->only(['seo_title', 'seo_description']))->save();
                break;

            // STEP 5 - Images
            case 5:
                $validator = Validator::make($request->all(), [
                    'logo'     => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                    'images'   => 'nullable|array|min:2|max:10',
                    'images.*' => 'image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                ]);
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                if ($request->hasFile('logo')) {
                    $listing->logo = uploadImages('uploads/listings/logo', $request->file('logo'));
                }
                if ($request->hasFile('images')) {
                    $listing->images = uploadImages('uploads/listings/images', $request->file('images'));
                }
                $listing->save();
                break;

            // STEP 6 - Plan
            case 6:
                $validator = Validator::make($request->all(), [
                    'plan_id' => 'required|numeric|exists:plans,id',
                ]);
                if ($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 422);
                }

                // UserPlan::updateOrCreate(
                //     ['user_id' => auth()->id()],
                //     ['plan_id' => $request->plan_id, 'status' => 1]
                // );
                break;
        }

        return response()->json([
            'success' => true,
            'listing_id' => $listing->id,
            'data' => $listing->fresh(),
            'message' => "Step {$step} saved successfully."
        ]);
    }
}