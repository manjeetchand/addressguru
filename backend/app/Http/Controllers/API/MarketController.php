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
 * @package    MarketController
 * @author     Robin Tomar <robintomr@icloud.com>
 * @author     Jatin Jangra <jatinjangra10@rediffmail.com>
 * @copyright  2020-2022 Address Guru
 */
namespace App\Http\Controllers\API;

use App\Media;
use App\Cities;
use App\States;
use App\AdsApp;
use App\Product;
use App\Query;
use App\Personal;
use App\Coaching;
use App\Mcategory;
use App\Msubcategory;
use App\MarketplaceTypes;
use App\MarketAttributes;
use App\{listing,OpeningHours};
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
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
    
class MarketController extends Controller
{
    /**
     * Method to show a welcome msg on marketplace api route
     * 
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function index(Request $request)
    {
        // Start building the base query
        $products = Product::where('post_status', '=', 1)
            ->with('medias', 'mcategory', 'msubcategory')
            ->where('status', '=', 1);
        // Apply search filter only if search parameter is provided
        if ($request->has('search') && !empty($request->search)) {
            $products->where('name', 'like', '%' . $request->search . '%');
        }
        // Apply city filter only if city parameter is provided
        if ($request->has('city') && !empty($request->city)) {
            $products->where('city', $request->city);
        }
        // Apply category filter only if category_id parameter is provided
        if ($request->has('category') && !empty($request->category)) {
            $products->where('category_id', $request->category);
        }
        // Apply subcategory filter only if subcategory_id parameter is provided
        if ($request->has('subcategory') && !empty($request->subcategory)) {
            $products->where('subcategory_id', $request->subcategory);
        }
        // Apply price ordering and filter based on 'order' and 'condition'
        if ($request->has('order') && $request->has('condition') && !empty($request->condition)) {
            $condition = $request->condition;
            if ($request->order == "high to low") {
                $products->where('amount', '>=', $condition)
                     ->orderBy('amount', 'DESC');
            } elseif ($request->order == "low to high") {
                $products->where('amount', '<=', $condition)
                     ->orderBy('amount', 'ASC');
            }
        }
        // Apply condition filter only if condition parameter is provided
        if ($request->has('condition') && !empty($request->condition)) {
            $products->where('condition', 'like', '%' . $request->condition . '%');
        }
        // Apply price filter only if price parameter is provided and properly formatted
        if ($request->has('price') && !empty($request->price)) {
            $priceRange = explode(',', $request->price);
            // Ensure that the price range contains two values
            if (count($priceRange) === 2) {
                $products->whereBetween('price', [$priceRange[0], $priceRange[1]]);
            }
        }
        // Final query with sorting and pagination
        $products = $products->orderBy('package', 'DESC')
            ->orderBy('id', 'DESC')
            ->paginate(25);
        // Check if products exist
        if ($products->count() > 0) {
            foreach ($products as $product) {
                $mediaNames = $product->medias->pluck('name')->toArray(); // Convert media names to an array
                if (!empty($mediaNames)) {
                    // Wrap each media name in a full URL and return it as an array
                    $product->photo = array_map(function ($name) {
                        return 'https://addressguru.sg/images/' . $name;
                    }, $mediaNames);
                } else {
                    $product->photo = []; // Set as empty array if no media found
                }
            }
            return response()->json([
                'code'     => 200,
                'error'    => false,
                'status'   => true,
                'total'    => $products->total(), // Total count of products
                'current_page' => $products->currentPage(), // Current page number
                'result'   => $products->items(), // Fetches just the paginated items
                'message'  => 'ok',
            ], 200);
        } else {
            return response()->json([
                'code'     => 503,
                'error'    => true,
                'status'   => false,
                'result'   => [],
                'message'  => 'error',
            ], 200);
        }
    }


    /**
     * 
     */
    public function listingCategories()
    {
        return Mcategory::all();
    }



    public function test()
    {
        dd('asdf');
    }
    /**
     * Method to throw localities of the marketplace products
     * 
     * @param string state The state of the localities
     * @param string city  The city of the localities
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function localities()
    {
        $city  = request()->get('city');
        $state = request()->get('state');
        $param = [];
        $query = "SELECT DISTINCT `locality` FROM `products` WHERE `locality` IS NOT NULL";
        if($state)
        {
            $query  .= ' AND `state` = ?';
            $param[] = $state;
        }
        if($city)
        {
            $query  .= ' AND `city` = ?';
            $param[] = $city;
        }
        $records    = DB::select($query, $param);
        $localities = [];
        foreach($records as $record)
        {
            if(!is_numeric($record->locality))
            {
                $localities[] = $record->locality;
            }
        }
        return $localities;
    }
    /**
     * Method to throw products matched to the search string
     * 
     * @param string $state    The state where to search
     * @param string $city     The city where to search
     * @param string $locality The locality where to search
     * @param string $query    The string to be searched
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function search()
    {
        $from     = request()->get('from') ?? 0;
        $take     = request()->get('take') ?? 20;
        $city     = request()->get('city');
        $state    = request()->get('state');
        $search   = request()->get('query');
        $locality = request()->get('locality');
        $category = request()->get('category');
        $results  = [];
        if($search)
        {
            $param  = [1, 1];
            $query  = "SELECT `id`, `title`, `description`, `price`, `amount`, `state`, `city`, `locality`, `slug`, `created_at` ";
            $query .= "FROM `products` ";
            $query .= "WHERE `category_id` != 4 ";
            $query .= "AND ( CONCAT(' ', LOWER(`title`), ' ') LIKE LOWER('% $search %') ";
            $query .= "OR CONCAT(' ', LOWER(`description`), ' ') LIKE LOWER('% $search %') ) ";
            $query .= "AND `post_status` = ? AND `status` = ?";
            if($category)
            {
                $query  .= " AND `category_id` = ?";
                $param[] = $category;
            }
            if($state)
            {
                $query  .= " AND LOWER(`state`) = LOWER(?)";
                $param[] = $state;
            }
            if($city)
            {
                $query  .= " AND LOWER(`city`) = LOWER(?)";
                $param[] = $city;
            }
            if($locality)
            {
                $query  .= " AND LOWER(`locality`) = LOWER(?)";
                $param[] = $locality;
            }
            $query .= " LIMIT ?, ?";
            $param[] = $from;
            $param[] = $take;
            $results = DB::select($query, $param);
            if(!empty($results))
            {
                $medias   = DB::select('SELECT `product_id`, `name` FROM `media` WHERE `product_id` IS NOT NULL');
                foreach($results as &$result)
                {
                    if(!isset($result->images))
                    {
                        $result->images = [];
                    }
                    foreach($medias as &$media)
                    {
                        if($media->product_id == $result->id && empty($result->images))
                        {
                            $result->images[] = $media->name;
                        }
                    }
                }
                $results = collect($results)->shuffle();
            }
        }
        return $results;
    }
    /**
     * Method to throw featured Products
     * 
     * @param int $take     Number items to throw
     * @param string $city  The city of which featured products to be sent
     * @param string $state The state of which featured products to be sent
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function featured()
    {
        $city  = request()->get('city');
        $take  = request()->get('take');
        $take  = ($take && is_numeric($take)) ? $take : 20;
        $state = request()->get('state');
        $param = [1, 1, 1];
        $query = 'SELECT `id`, `title`, `amount`, `package`, `price`, `city`, `state`, `created_at` FROM `products` WHERE `post_status` = ? AND `status` = ? AND `package` = ?';
        if($state)
        {
            $query  .= ' AND LOWER(`state`) = LOWER(?)';
            $param[] = $state;
        }
        if($city)
        {
            $query .= ' AND LOWER(`city`) = LOWER(?)';
            $param[]= $city;
        }
        $query .= ' AND `deleted_at` IS NULL';
        $query .= ' ORDER BY `id` DESC';
        $query .= ' LIMIT 0, ' . $take;
        $featured = DB::select($query, $param);
        if(!empty($featured))
        {
            $medias   = DB::select('SELECT `product_id`, `name` FROM `media` WHERE `product_id` IS NOT NULL');
            foreach($featured as &$feat)
            {
                if(!isset($feat->images))
                {
                    $feat->images = [];
                }
                foreach($medias as &$media)
                {
                    if($media->product_id == $feat->id && empty($feat->images))
                    {
                        $feat->images[] = $media->name;
                    }
                }
            }
        }
        return $featured;
    }
    /**
     * Method to throw latest Products
     * 
     * @param int $take     Number items to throw
     * @param string $city  The city of which recent listings to be sent
     * @param string $state The state of which recent listings to be sent
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function recent()
    {
        $city  = request()->get('city');
        $take  = request()->get('take');
        $take  = ($take && is_numeric($take)) ? $take : 20;
        $state = request()->get('state');
        $param = [1, 1];
        $query = 'SELECT `id`, `title`, `amount`, `package`, `price`, `city`, `state`, `created_at` FROM `products` WHERE `post_status` = ? AND `status` = ?';
        if($state)
        {
            $query  .= ' AND LOWER(`state`) = LOWER(?)';
            $param[] = $state;
        }
        if($city)
        {
            $query .= ' AND LOWER(`city`) = LOWER(?)';
            $param[]= $city;
        }
        $query .= ' AND `deleted_at` IS NULL';
        $query .= ' ORDER BY `id` DESC';
        $query .= ' LIMIT 0, ' . $take;
        $products = DB::select($query, $param);
        if(!empty($products))
        {
            $medias   = DB::select('SELECT `product_id`, `name` FROM `media` WHERE `product_id` IS NOT NULL');
            foreach($products as &$product)
            {
                if(!isset($product->images))
                {
                    $product->images = [];
                }
                foreach($medias as &$media)
                {
                    if($media->product_id == $product->id && empty($product->images))
                    {
                        $product->images[] = $media->name;
                    }
                }
            }
        }
        return $products;
    }
    /**
     * Method to throw Categories of Marketplace
     * 
     * @param NULL
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function categories()
    {
        $categories = [];
        $record     = Mcategory::with('msubcategory')->
        whereNotIn('id',['4','1'])->get(['id', 'name', 'icon', 'colors']);
        $products   = DB::select(
            "SELECT
                `category_id` AS `cat`,
                `subcategory_id` AS `scat`
            FROM
                `products`
            WHERE
                `category_id` != 4
            AND
                `post_status` = 1
            AND
                `status` = 1
            AND
                `deleted_at` IS NULL"
        );
        foreach($record as $data)
        {
            $category = (object) [];
            $category->id             = $data->id;
            $category->name           = $data->name;
            $category->info           = $data->des;
            $category->icon           = $data->icon;
            $category->color          = $data->colors;
            $category->products       = 0;
            foreach($products as $prod)
            {
                if($data->id == $prod->cat)
                {
                    ++$category->products;
                }
            }
            $category->sub_cats       = 0;
            $category->sub_categories = NULL;
            if(!empty($data->msubcategory))
            {
                $category->sub_cats       = count($data->msubcategory);
                $category->sub_categories = [];
                foreach($data->msubcategory as $subcat)
                {
                    $sub = (object) [];
                    $sub->id    = $subcat->id;
                    $sub->name  = $subcat->name;
                    $sub->icon  = $subcat->icon;
                    $sub->color = $subcat->colors;
                    $category->sub_categories[] = $sub;
                }
            }
            $categories[] = $category;
        }
        return $categories;
    }
    /**
     * Method to throw Sub Categories of Marketplace
     * @param NULL
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function subCategories()
    {
        $subs = Msubcategory::withCount('products')->with('mcategory')->get();
        $subCategories = [];
        if(!empty($subs))
        {
            foreach($subs as &$sub)
            {
                $sub->color    = $sub->colors;
                $sub->products = $sub->products_count;
                $sub->category = (object) [];
                $sub->category->id    = $sub->mcategory->id ?? 0;
                $sub->category->name  = $sub->mcategory->name ?? '';
                $sub->category->info  = $sub->mcategory->des ?? '';
                $sub->category->icon  = $sub->mcategory->icon ?? '';
                $sub->category->color = $sub->mcategory->colors ?? '';
                unset($sub->colors);
                unset($sub->mcategory);
                unset($sub->created_at);
                unset($sub->updated_at);
                unset($sub->deleted_at);
                unset($sub->category_id);
                unset($sub->products_count);
                $subCategories[] = $sub;
            }
        }
        return $subCategories;
    }
    /**
     * Method to throw Sub Category of provided category_id
     * 
     * @param int $category_id Category id whose subcategories to be find
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function subCategory(Request $request)
    {
        $cat_id = request()->get('category_id');
        if($cat_id)
        {
            $subcat = Msubcategory::query();
            if($request->type){
                $subcat->where('type',$request->type);
            }
            $subcat = $subcat->whereNotIn('id',['6','3'])->
            where('category_id', '=', $cat_id)->get(['id', 'name', 'icon', 'colors AS color','type']);
            if($subcat)
            {
                return $subcat;
            }
        }
        return response()->json(['msg'=> 'The requested data not found.'], 404);
    }
    /**
     * 
     */
    public function stuffForSale($type)
    {
        $records = [];
        if(in_array($type, ['categories', 'conditions', 'select-categories', 'price', 'ad-plans']))
        {
            if($type == 'categories')
            {
                $cat = MCategory::where('name', 'Stuff For Sale')->first();
                $scats   = MSubcategory::where('category_id', $cat->id)->orderBy('name')->get();
                foreach($scats as $cat)
                {
                    $records[] = (object) [
                        'id'    => $cat->id,
                        'og'    => $cat->og,
                        'name'  => $cat->name,
                        'icon'  => $cat->icon,
                        'colors'=> $cat->colors,
                    ];
                }
            }
            elseif($type == 'conditions')
            {
                $records = ['New', 'Used'];
            }
            elseif($type == 'price')
            {
                $records = ['Amount', 'Free', 'Contact For Price', 'Swap/Trade'];
            }
            elseif($type == 'select-categories')
            {
                $cat_id  = intval(request()->get('cat_id'));
                $records = $this->getsCat($cat_id);
            }
            elseif($type == 'ad-plans')
            {
                $records = [
                    ['days'=> 0, 'price'=> 0, 'badge'=> NULL],
                    ['days'=> 7, 'price'=> env('first_price'), 'badge'=> NULL],
                    ['days'=> 7, 'price'=> env('second_price'), 'badge'=> NULL],
                    ['days'=> 31, 'price'=> env('third_price'), 'badge'=> 'Best Deal'],
                    ['days'=> 7, 'price'=> env('four_price'), 'badge'=> NULL],
                    ['days'=> 31, 'price'=> env('five_price'), 'badge'=> 'Best Deal'],
                ];
            }
        }
        return $records;
    }
    /**
     * 
     */
    public function jobPost($type)
    {
        $records = [];
        if(in_array($type, ['categories', 'select-categories', 'job-type', 'education-level', 'price', 'ad-plans']))
        {
            if($type == 'categories')
            {
                $cat   = MCategory::where('name', 'Jobs')->first();
                $scats = MSubcategory::where('category_id', $cat->id)->orderBy('name')->get();
                foreach($scats as $cat)
                {
                    $records[] = (object) [
                        'id'    => $cat->id,
                        'og'    => $cat->og,
                        'name'  => $cat->name,
                        'icon'  => $cat->icon,
                        'colors'=> $cat->colors,
                    ];
                }
            }
            elseif($type == 'select-categories')
            {
               $records = ['Accounting & Audit Jobs', 'Admin & Office Jobs', 'Banking & Finance Jobs', 'Beauty & Wellness Jobs', 'Building & Construction Jobs', 'Community & Social Services Jobs', 'Customer Service Jobs', 'Design Jobs', 'Engineering Jobs', 'Events & Promotions Jobs', 'Food & Beverage Jobs', 'General Jobs', 'Health & Fitness Jobs', 'Hospitality & Tourism Jobs', 'Human Resources Jobs', 'Information Technology Jobs', 'Insurance Jobs', 'Legal & Professional Services Jobs', 'Management Jobs', 'Manufacturing Jobs', 'Marketing & Public Relations Jobs', 'Media & Advertising Jobs', 'Medical Services Jobs', 'Merchandising & Purchasing Jobs', 'Nursery', 'Nanny & Domestic Helpers Jobs', 'Property Jobs', 'Government & Civil Service Jobs', 'Research & Development Jobs', 'Retail & Sales Jobs', 'Teaching Jobs', 'Telecommunications Jobs', 'Transportation & Logistics Jobs','Secretary', 'Admin & Office', 'Cashier', 'Data Entry & Survey', 'Drivers & Delivery', 'Event & Flyer Distribution', 'Nursery', 'Maid & Babysitters', 'Retail & Sales', 'Customer Service & Telemarketing', 'Server', 'Bartender & Waiter', 'Other', 'Packer', 'Mover & Logistics', 'Human Resources', 'Artist & Creative', 'Beautician & Wellness'];
            }
            elseif($type == 'job-type')
            {
                $records = ['Casual', 'Temporary', 'Contract', 'Part-Time', 'Full-Time', 'Graduate', 'Internship', 'Volunteer'];
            }
            elseif($type == 'education-level')
            {
                $records = ['Doctorate', 'Master', 'Degree', 'Diploma', 'Professional Certifications (e.g. ACCA, CPA)', 'Higher Nitec', 'A-Level', 'O-Level', 'N-Level', 'Primary', 'Not Applicable', 'Not Specified'];
            }
        }
        return $records;
    }
    /**
     * 
     */
    public function editListing($slug)
    {
        $result = Coaching::with('category', 'subcategory', 'personals', 'ratings')->where('slug', $slug)->first();
        if ($result)
        {
            $result['payment']  = json_decode($result->payment, true); // Convert payment JSON string to array
            $result['facility'] = json_decode($result->facility, true); // Convert facility JSON string to array
            $result['photo']    = explode(',','https://addressguru.sg/images/'.$result->photo);// Corrected typo: $resault -> $result
            // Format 'created_at' as "25 Sep, 2024"
            $result['posted_at'] = Carbon::parse($result->created_at)->format('d M, Y');
            $result['service'] = json_decode($result->service, true);   
            $result['course']  = json_decode($result->course, true);
        }
        else
        {
            $result = Product::with('mcategory', 'msubcategory','medias')->where('slug', $slug)->first();
            // Handle media URLs by ID
            $mediaNames = $result->medias->pluck('name', 'id')->toArray(); // Convert media names with IDs
            $photos = [];
            if (!empty($mediaNames)) {
                // Create an array of objects with media ID and URL
                foreach ($mediaNames as $id => $name) {
                    $photos[] = [
                        'id'  => $id, 
                        'url' => 'https://addressguru.sg/images/' . $name
                    ];
                }
            }
            // Set the 'photo' attribute
            $result->setAttribute('photo', $photos);
        }
        return response()->json([
            'code' => 200,
            'error' => false,
            'message' => "success",
            'result' => $result,
            'status' => true
        ]);
    }
    /**
     * 
     */
    public function saveSFSData(Request $request)
    {
        $required = [
            'title'         => 'required|min:20|max:100',
            'description'   => 'required|min:50',
            'subcategory_id'=> 'required|numeric|exists:msubcategories,id,deleted_at,NULL',
            'name'          => 'required',
            'email'         => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'state'         => 'required',
            'city'          => 'required',
            'locality'      => 'required',
            'phone' => 'required|max:10|min:8',
            'images'        => 'required|array',
            'images.*'      => 'required|mimes:jpeg,png,jpg|max:5000',
            'amount'        => 'required|numeric',
            'only_for'        => 'required',
        ];
    // Additional validation for price if necessary
    if (true) {
        $required['price'] = 'required';
    }
    $validator = Validator::make($request->all(), $required);
    if ($validator->fails()) {
        return response()->json(['msg' => $validator->errors()->first()], 200);
    }
    // Get all input data
    $input = $request->all();
    // Find subcategory
    $idcat = Msubcategory::find($input['subcategory_id']);
    if (!$idcat) {
        return response()->json(['msg' => 'An invalid subcategory provided!'], 200);
    }
    // Create the product
    $product = Product::create([
        'title'          => $this->sanitizeInput($input['title']),
        'condition'      => $input['condition'],
        'description'    => $this->sanitizeInput($input['description']),
        'price'          => $input['price'],
        'amount'         => $input['amount'],
        'user_id'        => auth()->user()->id,
        'subcategory_id' => $idcat->id,
        'category_id'    => $idcat->mcategory->id,
        'model'          => $request->get('model'),
        'only_for'       => $request->get('only_for'),
        'pro_by'         => $request->get('pro_by'),
        'dob'            => $request->get('dob'),
        'available'      => $request->get('available'),
        'job_type'       => $request->get('job_type'),
        'company_name'   => $request->get('company_name'),
        'company_website'=> $request->get('company_website'),
        'ea_number'      => $request->get('ea_number'),
        'edu_level'      => $request->get('edu_level'),
        'cc'             => $request->get('cc'),
        'fuel_type'      => $request->get('fuel_type'),
        'year'           => $request->get('year'),
        'km'             => $request->get('km'),
        'trans'          => $request->get('trans'),
        'color'          => $request->get('color'),
        'share'          => $request->get('share'),
        'dwelling'       => $request->get('dwelling'),
        'size'           => $request->get('size'),
        'bedroom'        => $request->get('bedroom'),
        'bathroom'       => $request->get('bathroom'),
        'smoking'        => $request->get('smoking'),
        'pet'            => $request->get('pet'),
        'gender'         => $request->get('gender'),
        'cea'            => $request->get('cea'),
        'parking'        => $request->get('parking'),
        'name'           => $request->get('name'),
        'email'          => $request->get('email'),
        'state'          => $request->get('state'),
        'city'           => $request->get('city'),
        'locality'       => $request->get('locality'),
        'phone'          => $request->get('phone'),
    ]);
    // Handle image upload
    if ($request->hasFile('images')) {
        $this->uploadImages($request->file('images'), $product->id); // Assuming a helper method for uploading images
    } else {
        return response()->json(['msg' => 'Please provide at least one image!'], 400);
    }
    // Check for payment and update status
    if ($request->has('payment') && intval($request->amount)) {
        $product->update(['post_status' => 1]);
    }
    return response()->json([
        'ok'      => 1,
        'msg'     => 'Data saved successfully',
        'post_id' => Crypt::encrypt($product->id),
    ]);
}

    // Helper function to sanitize inputs
    private function sanitizeInput($input)
    {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    /**
     *
     */

    /**
     * 
     */
    private function uploadImages($files, $productId)
    {
        try {
            foreach ($files as $file) {
                $name = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move('images', $name);
                \App\Media::create([
                    'name'       => $name,
                    'product_id' => $productId,
                ]);
            }
        } catch (\Exception $e) {
            // Log the error and return an appropriate response
            \Log::error($e->getMessage());
            throw new \Exception('File upload failed');
        }
    }
    /**
     * 
     */
    private function handlesfsStepTwoData(Product $post)
    {
        $return = ['ok'=> 0, 'msg'=> ''];
        $validator = Validator::make($request->all(), [
            'title'      => 'required|min:20|max:100',
            'price'      => 'required',
            'description'=> 'required|min:50',
        ]);
        if(!$validator->fails())
        {
            $post->update([
                'condition'      => $input['condition'],
                'title'          => $this->stringsaafchahiye($input['title']),
                'description'    => $this->stringsaafchahiye($input['description']),
                'price'          => $input['price'],
                'amount'         => $input['amount'],
                'model'          => $input['model'],
                'only_for'       => $input['only_for'],
                'pro_by'         => $input['pro_by'],
                'dob'            => $input['dob'],
                'available'      => $input['available'],
                'job_type'       => $input['job_type'],
                'company_name'   => $input['company_name'],
                'company_website'=> $input['company_website'],
                'ea_number'      => $input['ea_number'],
                'edu_level'      => $input['edu_level'],
                'cc'             => $input['cc'],
                'fuel_type'      => $input['fuel_type'],
                'year'           => $input['year'],
                'km'             => $input['km'],
                'trans'          => $input['trans'],
                'color'          => $input['color'],
                'share'          => $input['share'],
                'dwelling'       => $input['dwelling'],
                'size'           => $input['size'],
                'bedroom'        => $input['bedroom'],
                'bathroom'       => $input['bathroom'],
                'smoking'        => $input['smoking'],
                'pet'            => $input['pet'],
                'gender'         => $input['gender'],
                'cea'            => $input['cea'],
                'parking'        => $input['parking'],
            ]);
            if(auth()->user()->role->name == "User") 
            {
                $post->update(['status'=> 0]);
            }
            $return['ok']  = 1;
            $return['msg'] = '';
        }
        else
        {
            $return['msg'] = $validator->errors()->first();
        }
        return $return;
    }

    public function marketRentCategories(Request $request)
    {
        try
        {
            $data = Msubcategory::query();
            $data->select('id','name','icon','colors as color');
            $data->where('type',$request->type);
            if($request->category_id)
            {
                $data->where('id',$request->category_id);
            }
            $response = $data->with('attributes')->orderBy('name','ASC')->get();
            foreach($response as $d)
            {
                if(count($d->attributes) > 0)
                {
                    foreach($d->attributes as $e)
                    {
                        $e['cat_name'] = $d->name;
                    }
                }
            }
            return $this->success("success",$response,200);
        }
        catch(\Exception $e)
        {
            // return $e->getMessage();
            return $this->error($e->getMessage(), '500');
        }
        // return $this->assistant->getProducts();
    }

    /**
     * Method to throw Products of Marketplace
     * 
     * @param int $init         Is first request
     * @param int $category     Category Id of the Products
     * @param string $state     State of the Products
     * @param string $city      City of the Products
     * @param string $locality  Locality of the Products
     * @param string $sort      Sort Data Ascending/Descending
     */
//     public function products(Request $request)
//     {   
//       public function products(Request $request)
// {
//     try {
//         $table1Query = Product::query();
//         $table1Query->with(['media', 'packages']);
//         $table1Query->where('is_featured', '1');
//         $table1Query->where('category_id', '!=', '4');
//         $table1Query->where('post_status', '1');
//         $table1Query->where('status', '1');
//         $table1Query->limit(8);
//         $table1Query = $table1Query->get();
//         $table2Query = Product::query();
//         $table2Query->with(['media', 'packages']);
//         $table2Query->where('is_featured', '0');
//         $table2Query->where('category_id', '!=', '4');
//         $table2Query->where('post_status', '1');
//         $table2Query->where('status', '1');
//         if ($request->category) {
//             $table1Query->where('category_id', $request->category);
//             $table2Query->where('category_id', $request->category);
//         }
//         if ($request->subcategory) {
//             $table1Query->where('subcategory_id', $request->subcategory);
//             $table2Query->where('subcategory_id', $request->subcategory);
//         }
//         if ($cityid = $request->get('city')) {
//             $city = Cities::find($cityid);
//             $table1Query->where('city', $city->name);
//             $table2Query->where('city', $city->name);
//         }
//         if ($stateid = $request->get('state')) {
//             $state = States::find($stateid);
//             // $table1Query->where('state', $state->name);
//             $table2Query->where('state', $state->name);
//         }
//         if ($request->search) {
//             $searchTerm = '%' . $request->search . '%';
//             // $table1Query->where(function ($query) use ($searchTerm) {
//             //     $query->where('title', 'LIKE', $searchTerm)
//             //           ->orWhere('description', 'LIKE', $searchTerm);
//             // });
//             $table2Query->where(function ($query) use ($searchTerm) {
//                 $query->where('title', 'LIKE', $searchTerm)
//                       ->orWhere('description', 'LIKE', $searchTerm);
//             });
//         }
//         if ($request->rent_or_sell) {
//             $table1Query->where('rent_or_sell', $request->rent_or_sell);
//             $table2Query->where('rent_or_sell', $request->rent_or_sell);
//         }
//         if ($request->search_type) {
//             // $table1Query->where('property_type', $request->search_type);
//             $table2Query->where('property_type', $request->search_type);
//         }
//         $table2Query = $table2Query->paginate(12);
//         $data = collect($table1Query)->merge($table2Query);
//         // $data = $table1Query->unionAll($table1Query)->get();
//         // $new = collect($data);
//         // dd($data->toArray());
//         // Chunk the featured and unfeatured products separately
//         $featured = $data->where('is_featured', '1')->chunk(4);
//         $unfeatured = $data->where('is_featured', '0')->chunk(6);
//         // Merge the chunks alternately
//         $result = collect();
//         $maxCount = max($featured->count(), $unfeatured->count());
//         for ($i = 0; $i < $maxCount; $i++) {
//             if ($featured->count() > $i) {
//                 $result = $result->concat($featured[$i]);
//             }
//             if ($unfeatured->count() > $i) {
//                 $result = $result->concat($unfeatured[$i]);
//             }
//         }
//         $response['total'] = $table2Query->total() + ($table1Query->count() ?? 0);
//         $response['current_page'] = $table2Query->currentPage();
//         $response['data'] = $result;
//         foreach ($response['data'] as $d) {
//             if (isset($d->media->path)) {
//                 $d['images'] = [url('storage/' . $d->media->path . $d->media->name)];
//             } else {
//                 $d['images'] = [url('images/' . $d->media->name)];
//             }
//             $d['posted_ago'] = $d->created_at->diffForHumans();
//             unset($d['media']);
//         }
//         return $this->success("success", $response, 200);
//     } catch (\Exception $e) {
//         return $this->error($e->getMessage(), '500');
//     }
// }
//     }

    public function products(Request $request)
    {
     try{    
        $feature = Product::query();
        if($request->search){
                $feature->WhereRaw("slug LIKE '%" . lcfirst($request->search) . "%'");
        }
        if($request->category){
            $feature->where('category_id',$request->category);
        }
        if($request->subcategory){
            $feature->where('subcategory_id',$request->subcategory);
        }
        if($cityid = $request->get('city') ){
         $city = Cities::find($cityid);
         $feature->where('city',$city->name);
        }
        if($request->state){
            $stateid =  $request->state;
            $state = States::find($stateid);
            $feature->where('state',$state->name);
        }
        if($request->search_type){
                $feature->where('property_type',$request->search_type);
        }
        if($request->rent_or_sell){
                $feature->where('rent_or_sell',$request->rent_or_sell);
        }
        if($request->condition){
            $feature->where('condition',$request->condition);
        }
        if($request->price){
            $price = explode('-',$request->price);
            $feature->whereBetween('amount', [$price[0], $price[1]]);
        }
        $feature = $feature->where('post_status', '=', 1)
            ->where('category_id', '!=', 4)
            ->with('medias')
            ->where('status', '=', 1)
            ->where('is_featured','1')
            ->inRandomOrder()
            ->paginate(4);

        $unfeaturedPag = '16' + ('4' - $feature->count());
        $unfeature = Product::query();

        if($request->search) {
            $unfeature->WhereRaw("slug LIKE '%" . lcfirst($request->search) . "%'");
        }

        // if($request->minPrice && $request->maxPrice){
        //     $unfeature->whereBetween('amount', [$minPrice->minPrice, $request->maxPrice]);
        // }
        if($request->price){
            $price = explode('-',$request->price);
            $unfeature->whereBetween('amount', [$price[0], $price[1]]);
        }
        if($request->condition){
                $unfeature->where('condition',$request->condition);
        }
        if($request->category){
                $unfeature->where('category_id',$request->category);
        }
        if($request->subcategory){
                $unfeature->where('subcategory_id',$request->subcategory);
        }
        if($cityid = $request->get('city') ){
            $city = Cities::find($cityid);
            $unfeature->where('city',$city->name);
        }
        if($request->rent_or_sell){
            $unfeature->where('rent_or_sell',$request->rent_or_sell);
        }
        if($request->search_type){
            $unfeature->where('property_type',$request->search_type);
        }
        if($stateid = $request->state ){
            $state = States::find($stateid);
            $unfeature->where('state',$state->name);
        }
         //filters 
        if($request->bathroom_no){
            $unfeature->where('bathroom_no',$request->bathroom_no);
        }
        if($request->bathroom){
            $unfeature->where('bathroom',$request->bathroom);
        }
        if($request->bedroom){
            $unfeature->where('bedroom',$request->bedroom);
        }
        if ($request->built_area) {
            $builtAreaRange = explode('-', $request->built_area);
            $unfeature->whereRaw('built_area BETWEEN '.$builtAreaRange[0].' AND '.$builtAreaRange[1]);
        }
        if ($request->carpet_area) {
            $carpetAreaRange = explode('-', $request->carpet_area);
            $unfeature->whereRaw('carpet_area BETWEEN '.$carpetAreaRange[0].' AND '.$carpetAreaRange[1]);
        }
        if($request->vegetarian){
            $unfeature->where('vegetarian',$request->vegetarian);
        }
        if($request->maintain){
            $unfeature->where('maintain',$request->maintain);
        }
        if($request->floor){
            $unfeature->where('floor',$request->floor);
        }
        if($request->tenant_type){
            $unfeature->where('tenant_type',$request->tenant_type);
        }
         if($request->religion){
            $unfeature->where('religion',$request->religion);
        }
        if($request->floor_no){
            $unfeature->where('floor_no',$request->floor_no);
        }
        if($request->facing){
            $unfeature->where('facing',$request->facing);
        }
        if($request->parking){
            $unfeature->where('parking',$request->parking);
        }
        if($request->balcony){
            $unfeature->where('balcony',$request->balcony);
        }
        if($request->length){
            $unfeature->where('length',$request->length);
        }
         if($request->breadth){
            $unfeature->where('breadth',$request->breadth);
        }
          if($request->brand){
            $unfeature->where('brand',$request->brand);
        }
        if($request->year){
            $unfeature->where('year',$request->year);
        }
        if($request->company_name){
            $unfeature->where('company_name',$request->company_name);
        }
        if($request->pets){
            $unfeature->where('pets',$request->pets);
        }
        if($request->security_amt){
            $unfeature->where('security_amt',$request->security_amt);
        }
         if($request->kitchen_type){
            $unfeature->where('kitchen_type',$request->kitchen_type);
        }
        if($request->negotiable){
            $unfeature->where('pets',$request->pets);
        } 
        if($request->area_type){
            $unfeature->where('pets',$request->pets);
        }
        if($request->listed_by){
            $unfeature->where('listed_by',$request->listed_by);
        }
        if($request->furnishing){
            $unfeature->where('furnishing',$request->furnishing);
        }
        if($request->order){
            $unfeature->orderBy('amount',$request->order);
        }else{
            $unfeature->orderBy('id','DESC');
        }
        $unfeature = $unfeature->where('post_status', '=', 1)
        ->where('category_id', '!=', 4)
        ->with('medias')
        ->where('status', '=', 1)
        ->where('is_featured','0')
        ->paginate($unfeaturedPag);

        $featuredCollection = collect($feature->items())->chunk(2);
        $unfeaturedCollection = collect($unfeature->items())->chunk(8);
        $resultCollection = collect();
        $i = 0;

        while (!$featuredCollection->isEmpty() || !$unfeaturedCollection->isEmpty()) {
            if(!$featuredCollection->isEmpty()){
                $featuredItems = $featuredCollection->shift();
                $resultCollection = $resultCollection->concat($featuredItems);
            }
            if(!$unfeaturedCollection->isEmpty()){
                $unfeaturedItems = $unfeaturedCollection->shift();
                $resultCollection = $resultCollection->concat($unfeaturedItems);
            }
        }
        $resultCollection = new LengthAwarePaginator(
            $resultCollection,
            $feature->total() + $unfeature->total(),
            20,
            $feature->currentPage(),
            ['path' => Paginator::resolveCurrentPath()]
        );

        // // Usage:
        // $resultCollection->items(); // Access the paginated items
        // $response['total'] = $resultCollection->total(); // Total count of items across both queries
        // $resultCollection->count(); // Count of items in the current page
        // $resultCollection->links(); // Render pagination links

        $response['total'] = $resultCollection->total();
        $response['current_page'] = $feature->currentPage();
        $response['data'] = $resultCollection->items();

        foreach($response['data'] as $d)
        {
            if(isset($d->media->path))
            {
                $d['images'] = [ url('storage/'.$d->media->path.$d->media->name) ];
            }
            else
            {
                $d['images'] = [ url('images/'.$d->media->name) ];
            }
            // $d['created_att'] = date("d M Y",strtotime($d->created_at));
            $d['posted_ago'] = $d->created_at->diffForHumans();
            unset($d['media']);
        }

        return $this->success("success",$response,200);
        } catch(\Exception $e) {
            return $this->error($e->getMessage(), '500');
        }
        // return $this->assistant->getProducts();
    }


    /**
     * Method to throw the product
     * 
     * @param int product_id The id of the product to throw
     * @author Robin Tomar <robintomar@icloud.com>
     * @return object
     */
    // public function product()
    // {
    //     // $test    = request()->get('test');
    //     $prod_id = request()->get('id');
    //     $product = DB::select('
    //         SELECT
    //             `id`,
    //             `km`,
    //             `city`,
    //             `name`,
    //             `slug`,
    //             `type`,
    //             `year`,
    //             `brand`,
    //             `floor`,
    //             `email`,
    //             `phone`,
    //             `price`,
    //             `state`,
    //             `title`,
    //             `trans`,
    //             `amount`,
    //             `facing`,
    //             NULL AS `images`,
    //             `length`,
    //             `status`,
    //             `description` AS `content`,
    //             `bedroom`,
    //             `breadth`,
    //             NULL AS `contact`,
    //             `parking`,
    //             `package`,
    //             NULL AS `reviews`,
    //             NULL AS `category`,
    //             `bathroom`,
    //             `floor_no`,
    //             `locality`,
    //             `maintain`,
    //             `only_for`,
    //             `pro_name`,
    //             NULL AS `packages`,
    //             `condition`,
    //             `listed_by`,
    //             `salary_to`,
    //             `con_status`,
    //             `furnishing`,
    //             `built_area`,
    //             `post_status`,
    //             `carpet_area`,
    //             `salary_from`,
    //             `category_id`,
    //             `created_at`,
    //             `updated_at`
    //         FROM
    //             `products`
    //         WHERE
    //             `id` = ? AND
    //             `category_id` != 4 AND
    //             `deleted_at` IS NULL
    //         ', [$prod_id]);
    //     $product = !empty($product) ? $product[0] : NULL;
    //     if($product)
    //     {
    //         $product->date_posted  = Carbon::parse($product->created_at);
    //         $product->date_updated = Carbon::parse($product->updated_at);
    //         $images = DB::select('
    //             SELECT
    //                 `name` AS `img`
    //             FROM `media`
    //             WHERE `product_id` = ?
    //         ', [$product->id]);
    //         $contact = [
    //             'city'     => $product->city,
    //             'phone'    => $product->phone,
    //             'email'    => $product->email,
    //             'state'    => $product->state,
    //             'agent'    => NULL,
    //             'person'   => $product->name,
    //             'location' => $product->locality,
    //             'phone_alt'=> NULL
    //         ];
    //         $category = DB::select('
    //             SELECT
    //                 `id`,
    //                 `name`,
    //                 `des` AS `info`,
    //                 `icon`,
    //                 `colors` AS `color`
    //             FROM
    //                 `mcategories`
    //             WHERE
    //                 `id` = ?
    //         ', [$product->category_id])[0];
    //         $subcategory = DB::select('
    //             SELECT
    //                  `id`,
    //                 `name`,
    //                 `icon`,
    //                 `colors` AS `color`
    //             FROM
    //                 `msubcategories`
    //             WHERE
    //                 `id` = ?
    //         ', [$category->id])[0];
    //         $imgArr = [];
    //         foreach($images as $image)
    //         {   
    //              if(isset($image)){
    //                 $imgArr[] = (is_null($image->path)) ? asset('images/'.$image->name ?? '') : asset('storage/'.$image->path.$image->name);
    //           }else{
    //               $imgArr[] = $image;
    //           }
    //             $imgArr[] = $image->img;
    //         }
    //         $product->images   = !empty($imgArr) ? $imgArr : NULL;
    //         $product->contact  = $contact;
    //         $product->category = $category;
    //         $product->subcategory = $subcategory;
    //         unset(
    //             $product->city,
    //             $product->name,
    //             $product->phone,
    //             $product->email,
    //             $product->state,
    //             $product->created_at,
    //             $product->updated_at,
    //             $product->category_id
    //         );
    //         return $this->success("success",$product,'200');
    //     }
    //     return response()->json(['msg'=> 'Requested data not found.'], 404);
    // }

    public function product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric|exists:products,id,deleted_at,NULL'
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors()->all(),422);
        }
        $id = $request->id;
        $data = Product::select(  
                'id',
                'km',
                'city',
                'name',
                'slug',
                'type',
                'year',
                'brand',
                'floor',
                'email',
                'phone',
                'price',
                'state',
                'title',
                'trans',
                'amount',
                'facing',
                'length',
                'status',
                'description AS content',
                'bedroom',
                'breadth',
                'parking',
                'package',
                'bathroom',
                'floor_no',
                'locality',
                'maintain',
                'only_for',
                'pro_name',
                'condition',
                'listed_by',
                'salary_to',
                'con_status',
                'furnishing',
                'built_area',
                'post_status',
                'carpet_area',
                'salary_from',
                'category_id',
                'subcategory_id',
                'updated_at',
                'created_at',
                'rent_or_sell',
                'property_type',
                'pets',
                'vegetarian',
                'security_amt',
                'religion',
                'tenant_type',
                'bathroom_no',
                'balcony',
                'kitchen_type',
                'negotiable',
                'area_type',
                'created_at'
            )->with(['medias','category:id,name,des as info,icon,colors as color','subcategory:id,name,icon,colors as color'])->
            where('id',$id)->
        where('category_id','!=','4')->first();
        $data->posted_at = date('d M,Y',strtotime($data->created_at));
        $array = [];
        if(isset($data->medias)){
            foreach($data->medias as $media){
                $image = (is_null($media->path)) ? asset('images/'.$media->name ?? '') : asset('storage/'.$media->path.$media->name);
                array_push($array,$image);
            }
        }
        if(count($array) > 0){
                $data->images = $array;
        }
        $data['contact'] = [
                'city'     => $data->city ?? '',
                'phone'    => $data->phone ?? '',
                'email'    => $data->email ?? '',
                'state'    => $data->state ?? '',
                'agent'    => NULL,
                'person'   => $data->name ?? '',
                'location' => $data->locality ?? '',
                'phone_alt'=> NULL
        ];
        unset($data->medias);
        return $this->success("success",$data,'200');
    }

    /**
     * Method to get the Listing Plan
     */
    private function getPlan($id)
    {
        $plans = [NULL, NULL, NULL, 'Basic', 'Professional'];
     return $plans[$id];
    }

    public function UserMarketPlaceListings(Request $request)
    {
        try{
            $userid = auth()->user()->id;
            $data = Product::query();
            if(isset($request->category_id)){
                $data->where('category_id',$request->category_id);
            }else{
                 $data->where('category_id','!=','1');
            }
            // $data->select('user_id','category_id','subcategory_id','city','state',
            // 'slug','id','title','description','price','amount','package','created_at','status','post_status','is_active');
            $data->with(['category','media','dpackage:name,id,description,price','category:id,name,icon,colors','subcategory:id,icon,name,colors','views', 'calls','webViews','queries']);
            $data->where('user_id',$userid);
            $data->where('package','!=','0');
            $data->where('category_id','!=','4');
            $data = $data->orderBy('id','DESC')->paginate('20');
            foreach ($data->items() as $d) {
                if($d->post_status == 1 && $d->status == 1){ //accept
                    $d->status = 2;
                }elseif($d->post_status == 2 && $d->status == 0){//rejected
                    $d->status = 3;
                }elseif($d->post_status == 3 && $d->status == 0){//rejected
                    $d->status = 3;
                }elseif($d->post_status == 4 && $d->status == 0){//rejected
                    $d->status = 4;
                }elseif($d->post_status == 1 && $d->status == 0){//rejected
                    $d->status = 1;
                }else{
                    $d->status = 0;
                }
                $view = $d->views->market_views ?? '0';
                $calls = $d->calls->market_calls ?? 0;
                $web_views = $d->web_views->market_web_views ?? 0;
                unset($d['views'],$d['calls'],$d['web_views']);
                $d->views =  $view;
                $d->calls = $calls;
                $d->queries = $d->queries;
                $d->web_view = $web_views;
               if(isset($d->media)){
                    $d['image'] = (is_null($d->media->path)) ? asset('images/'.$d->media->name ?? '') : asset('storage/'.$d->media->path.$d->media->name);
               }else{
                   $d['image'] = $d->media;
               }
                $d['package'] = $d->dpackage;
                $date = $d->created_at->format('d M,Y');
                unset($d['media'],$d['created_at'],$d['dpackage']);
                $d['created_date'] = $date;
            }
            $response['total'] = $data->total();
            $response['current_page'] = $data->currentPage();
            $response['data'] = $data->items();
            return $this->success("success",$response,'200');
        }catch(\Extension $e){
                return $this->error("Error! Please Try Again After Sometime.", '500');
        }
    }

    public function UserMarketPlaceListing(Request $request, $id)
    {
        try{
            $userid = auth()->user()->id;
            $data = Product::with(['medias','category:id,name,colors,icon','subcategory:id,name,colors,icon'])->where('id',$id)->where('user_id',$userid)->first();
            $array = [];
            if(isset($data->medias)){
                foreach($data->medias as $key => $media){
                    $image = (is_null($media->path)) ? asset('images/'.$media->name ?? '') : asset('storage/'.$media->path.$media->name);
                    $array[$key]['uri'] = $image;
                    $array[$key]['assetId'] = $media->id;
                    $array[$key]['type'] = 'image';
                    $array[$key]['cancelled'] = false;
                }
            }
            unset($data->medias);
            if($data){
                $data->images = $array;
            }
            return $this->success("success",$data,'200');
        }catch(\Extension $e){
            return $this->error("Error! Please Try Again After Sometime.", '500');
        }
    }

    public function UserMarketPlaceListingDelete(Request $request)
    {
        try{
            $id = $request->id;
            $userid = auth()->user()->id;
            $data = Product::where('id',$id)->where('user_id',$userid)->delete();
            if($data){
                 return $this->success("success","Successfully Deleted",'200');
            }
             return $this->success("success","Error! Please Try Again After Sometime.",'200');
        }catch(\Extension $e){
                return $this->error("Error! Please Try Again After Sometime.", '500');
        }
    }

    public function UserMarketstatus(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [
            'status' => 'required|numeric|in:1,0',
            'product_id' => 'required|numeric|exists:products,id'
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors()->all(),422);
        }
        $user_id = auth()->user()->id;
        Product::where('user_id', $user_id )->where('id',$request->product_id)->update(['is_active' => $request->status]);
        return $this->success("success","Status updated Successfully.", 200);
        }catch(\Extension $e){
                return $this->error("Error! Please Try Again After Sometime.", '500');
        }
    }

    public function UserMarketingCreate(Request $request)
    {
        // dd($request->all());
         $data = $this->validate($request, [
                'title' => 'required|min:20|max:100',
                'ip' => 'ip',
                'description' => 'required|min:50|max:1000',
                'price' => 'required',
                'subcategory_id' => 'required|numeric|exists:msubcategories,id,deleted_at,NULL',
                'files' => 'required',
                'files.*' => 'required|image|mimes:jpeg,png,jpg|max:5000',
                'name' => 'required',
                'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'state' => 'required',
                'city' => 'required',
                'locality' => 'required',
                'phone' => 'required|max:10|min:8',
                'payment_type' => 'required|numeric',
            ]);
            if ($request->amount != "null" && $request->amount != "undefined" && $request->amount  !=  NULL) {
                $data['amount'] = $request->amount;
            }
            if ($request->brand != "null" && $request->brand != "undefined" && $request->brand  !=  NULL) {
                $data['brand'] = $request->brand;
            }
            if ($request->year != "null" && $request->year != "undefined" && $request->year  !=  NULL) {
                $data['year'] = $request->year;
            }
            if ($request->trans != "null" && $request->trans != "undefined" && $request->trans  !=  NULL) {
                $data['trans'] = $request->trans;
            }
            if ($request->km != "null" && $request->km != "undefined" && $request->km  !=  NULL) {
                $data['km'] = $request->km;
            }
            if ($request->type != "null" && $request->type != "undefined" && $request->type  !=  NULL) {
                $data['type'] = $request->type;
            }
            if ($request->condition != "null" && $request->condition != "undefined" && $request->condition  !=  NULL) {
                $data['condition'] = $request->condition;
            }
            if ($request->company_name != "null" && $request->company_name != "undefined" && $request->company_name  !=  NULL) {
                $data['company_name'] = $request->company_name;
            }
            if ($request->bedroom != "null" && $request->bedroom != "undefined" && $request->bedroom  !=  NULL) {
                $data['bedroom'] = $request->bedroom;
            }
            if ($request->bathroom != "null" && $request->bathroom != "undefined"  && $request->bathroom  !=  NULL) {
                $data['bathroom'] = $request->bathroom;
            }
            if ($request->furnishing != "null" && $request->furnishing != "undefined" && $request->furnishing  !=  NULL) {
                $data['furnishing'] = $request->furnishing;
            }
            if ($request->listed_by != "null" && $request->listed_by != "undefined" && $request->listed_by  !=  NULL) {
                $data['listed_by'] = $request->listed_by;
            }
            if ($request->built_area != "null" && $request->built_area != "undefined" && $request->built_area  !=  NULL) {
                $data['built_area'] = $request->built_area;
            }
            if ($request->carpet_area != "null" && $request->carpet_area != "undefined" && $request->carpet_area  !=  NULL) {
                $data['carpet_area'] = $request->carpet_area;
            }
            if ($request->maintain != "null" && $request->maintain != "undefined" && $request->maintain  !=  NULL) {
                $data['maintain'] = $request->maintain;
            }
            if ($request->floor != "null" && $request->floor != "undefined" && $request->floor  !=  NULL) {
                $data['floor'] = $request->floor;
            }
            if ($request->floor_no != "null" && $request->floor_no != "undefined" && $request->floor  !=  NULL) {
                $data['floor_no'] = $request->floor_no;
            }
            if ($request->parking != "null" && $request->parking != "undefined" && $request->parking  !=  NULL) {
                $data['parking'] = $request->parking;
            }
            if ($request->facing != "null" && $request->facing != "undefined" && $request->facing  !=  NULL) {
                $data['facing'] = $request->facing;
            }
            if ($request->pro_name != "null" && $request->pro_name != "undefined" && $request->pro_name  !=  NULL) {
                $data['pro_name'] = $request->pro_name;
            }
            if ($request->only_for != "null" && $request->only_for != "undefined" && $request->only_for  !=  NULL) {
                $data['only_for'] = $request->only_for;
            }
            if ($request->length != "null" && $request->length != "undefined" && $request->length  !=  NULL) {
                $data['length'] = $request->length;
            }
            if ($request->breadth != "null" && $request->breadth != "undefined" && $request->breadth  !=  NULL) {
                $data['breadth'] = $request->breadth;
            }
            if ($request->property_type != "null" && $request->property_type != "undefined" && $request->property_type  !=  NULL) {
                $data['property_type'] = $request->property_type;
            }
            if ($request->con_status != "null" && $request->con_status != "undefined" && $request->con_status  !=  NULL) {
                $data['con_status'] = $request->con_status;
            }
            if ($request->religion != "null" && $request->religion != "undefined" && $request->religion  !=  NULL) {
                $data['religion'] = $request->religion;
            }
            if ($request->security_amt != "null" && $request->security_amt != "undefined" && $request->security_amt  !=  NULL) {
                $data['security_amt'] = $request->security_amt;
            }
            if ($request->tenant_type != "null" && $request->tenant_type != "undefined" && $request->tenant_type  !=  NULL) {
                $data['tenant_type'] = $request->tenant_type;
            }
            if ($request->bathroom_no != "null" && $request->bathroom_no != "undefined" && $request->bathroom_no  !=  NULL) {
                $data['bathroom_no'] = $request->bathroom_no;
            }
            if ($request->kitchen_type != "null" && $request->kitchen_type != "undefined" && $request->kitchen_type  !=  NULL) {
                $data['kitchen_type'] = $request->kitchen_type;
            }
            if ($request->negotiable != "null" && $request->negotiable != "undefined" && $request->negotiable  !=  NULL) {
                $data['negotiable'] = $request->negotiable;
            }
            if ($request->area_type != "null" && $request->area_type != "undefined" && $request->area_type  !=  NULL) {
                $data['area_type'] = $request->area_type;
            }
            if ($request->balcony != "null" && $request->balcony != "undefined" && $request->balcony  != NULL) {
                $data['balcony'] = $request->balcony;
            }
            if($request->category_id == '1'){
                $this->validate($request, [
                    'rent_or_sell' => 'required|numeric|in:1,2,3',
                ]);
            }
            if($request->company_website){
                $this->validate($request, [
                    'company_website' => 'url|min:5|max:1000',
                ]);
                $data['company_website'] = $request->company_website;
            }
            $data['rent_or_sell'] = $request->rent_or_sell ?? 0;
        try{
            $input = $request->all();
            $idcat = Msubcategory::findOrFail($input['subcategory_id']);
            $data['vegetarian'] = $request->vegetarian ?? '';
            $data['pets'] = $request->vegetarian ?? '';
            $data['user_id'] = auth()->user()->id;
            $data['category_id'] = $idcat->mcategory->id;
            $data['title'] = $this->stringsaafchahiye($input['title']);
            $data['description'] = $this->stringsaafchahiye($input['description']);
            if($plan = $this->checkFreePlanExistsForThis($request->payment_type,'MARKETPLACE')){
                $data['post_status'] = '1';
                $data['package'] = $plan->id;
            }
            $post = Product::create($data);
            //Upload images
            if($request->hasFile('files')){
            StaticData::UploadImagesOnNewDirectory($request,$post->id,'files',$request->state,'2');
            }
            $response = Product::where('id',$post->id)->first();
            $response['media'] = $post->medias;
            return $this->success(!$post->id ? "Product created": "Product Created",$response, $post->id ? 200 : 201);
        }catch(\Exception $e) {
            // return $e->getMessage();
            return $this->error("Error! Please Try Again After Sometime.", '500');
        }
    }

    public function stringsaafchahiye($string)
    {
        $i = preg_replace('^(ht|f)tp(s?)\:\/\/[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*(:(0-9)*)*(\/?)([a-zA-Z0-9\-‌​\.\?\,\'\/\\\+&amp;%\$#_]*)?$^', '', $string);
        $co = preg_match_all( "/[0-9]/", $i);
        if ($co > 9) 
        {
            return preg_replace('/[0-9]+/', '', $i);
        }
        else
        {
            return $i;
        }
    }

    public function marketPlaceTypes()
    {
        $data = collect(MarketplaceTypes::select('id','name','type','status')->where('status','1')->get());
        $types = $data->unique('type')->pluck('type')->values()->all();
        $array = [];
        if(is_array($types)){
            foreach($types as $key => $type){
                $array[$type] = $data->where('type',$type)->values()->toArray();
            }
        }
        $response['data'] = $array;
        return $this->success("success",$response,'200');
    }

    public function adsAppImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:HOME,MARKETPLACE,JOBS,BUSINESS,PROPERTIES'
        ]);
        if ($validator->fails()) {
            return $this->error($validator->errors()->all(),422);
        }
        if($request->type == 'JOBS'){
            $request->type = 'JOB';
        }
        if($request->r_type){
            $rtype = 1;
        }else{
            $rtype = 0;
        }
        $data =  AdsApp::query();
        $data = $data->select('id','image_name as image','link','r_name','r_type');
        if($request->r_name){
            $data->where('r_name',$request->r_name);
        }
        $data = $data->where('type',$request->type)
        ->where('r_type',$rtype)->where('status','1')->orderByRaw('RAND()')->first();
        return $this->success("success",$data,'200');
    }

    public function UserMarketingUpdate(Request $request)
    {
        $data = $request->validate([
                'id' => 'required|numeric|exists:products,id,deleted_at,NULL',
                'title' => 'required|min:20|max:100',
                'ip' => 'ip',
                'description' => 'required|min:50|max:1000',
                'price' => 'required',
                'files.*' => 'image|mimes:jpeg,png,jpg|max:5000',
                'name' => 'required',
                'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'state' => 'required',
                'city' => 'required',
                'locality' => 'required',
                'phone' => 'required|max:10|min:10',
        ]);
        if($request->company_website){
             $this->validate($request, [
                'company_website' => 'url|min:5|max:1000',
            ]);
            $data['company_website'] = $request->company_website;
        }
        if ($request->amount != "null" && $request->amount != "undefined" && $request->amount  !=  NULL) {
            $data['amount'] = $request->amount;
        }
        if ($request->brand != "null" && $request->brand != "undefined" && $request->brand  !=  NULL) {
            $data['brand'] = $request->brand;
        }
        if ($request->year != "null" && $request->year != "undefined" && $request->year  !=  NULL) {
            $data['year'] = $request->year;
        }
        if ($request->trans != "null" && $request->trans != "undefined" && $request->trans  !=  NULL) {
            $data['trans'] = $request->trans;
        }
        if ($request->km != "null" && $request->km != "undefined" && $request->km  !=  NULL) {
            $data['km'] = $request->km;
        }
        if ($request->type != "null" && $request->type != "undefined" && $request->type  !=  NULL) {
            $data['type'] = $request->type;
        }
        if ($request->condition != "null" && $request->condition != "undefined" && $request->condition  !=  NULL) {
            $data['condition'] = $request->condition;
        }
        if ($request->company_name != "null" && $request->company_name != "undefined" && $request->company_name  !=  NULL) {
            $data['company_name'] = $request->company_name;
        }
        if ($request->bedroom != "null" && $request->bedroom != "undefined" && $request->bedroom  !=  NULL) {
            $data['bedroom'] = $request->bedroom;
        }
        if ($request->bathroom != "null" && $request->bathroom != "undefined"  && $request->bathroom  !=  NULL) {
            $data['bathroom'] = $request->bathroom;
        }
        if ($request->furnishing != "null" && $request->furnishing != "undefined" && $request->furnishing  !=  NULL) {
            $data['furnishing'] = $request->furnishing;
        }
        if ($request->listed_by != "null" && $request->listed_by != "undefined" && $request->listed_by  !=  NULL) {
            $data['listed_by'] = $request->listed_by;
        }
        if ($request->built_area != "null" && $request->built_area != "undefined" && $request->built_area  !=  NULL) {
            $data['built_area'] = $request->built_area;
        }
        if ($request->carpet_area != "null" && $request->carpet_area != "undefined" && $request->carpet_area  !=  NULL) {
            $data['carpet_area'] = $request->carpet_area;
        }
        if ($request->maintain != "null" && $request->maintain != "undefined" && $request->maintain  !=  NULL) {
            $data['maintain'] = $request->maintain;
        }
        if ($request->floor != "null" && $request->floor != "undefined" && $request->floor  !=  NULL) {
            $data['floor'] = $request->floor;
        }
        if ($request->floor_no != "null" && $request->floor_no != "undefined" && $request->floor  !=  NULL) {
            $data['floor_no'] = $request->floor_no;
        }
        if ($request->parking != "null" && $request->parking != "undefined" && $request->parking  !=  NULL) {
            $data['parking'] = $request->parking;
        }
        if ($request->facing != "null" && $request->facing != "undefined" && $request->facing  !=  NULL) {
            $data['facing'] = $request->facing;
        }
        if ($request->pro_name != "null" && $request->pro_name != "undefined" && $request->pro_name  !=  NULL) {
            $data['pro_name'] = $request->pro_name;
        }
        if ($request->only_for != "null" && $request->only_for != "undefined" && $request->only_for  !=  NULL) {
            $data['only_for'] = $request->only_for;
        }
        if ($request->length != "null" && $request->length != "undefined" && $request->length  !=  NULL) {
            $data['length'] = $request->length;
        }
        if ($request->breadth != "null" && $request->breadth != "undefined" && $request->breadth  !=  NULL) {
            $data['breadth'] = $request->breadth;
        }
        if ($request->property_type != "null" && $request->property_type != "undefined" && $request->property_type  !=  NULL) {
            $data['property_type'] = $request->property_type;
        }
        if ($request->con_status != "null" && $request->con_status != "undefined" && $request->con_status  !=  NULL) {
            $data['con_status'] = $request->con_status;
        }
        if ($request->religion != "null" && $request->religion != "undefined" && $request->religion  !=  NULL) {
            $data['religion'] = $request->religion;
        }
        if ($request->security_amt != "null" && $request->security_amt != "undefined" && $request->security_amt  !=  NULL) {
            $data['security_amt'] = $request->security_amt;
        }
        if ($request->tenant_type != "null" && $request->tenant_type != "undefined" && $request->tenant_type  !=  NULL) {
            $data['tenant_type'] = $request->tenant_type;
        }
        if ($request->bathroom_no != "null" && $request->bathroom_no != "undefined" && $request->bathroom_no  !=  NULL) {
            $data['bathroom_no'] = $request->bathroom_no;
        }
        if ($request->kitchen_type != "null" && $request->kitchen_type != "undefined" && $request->kitchen_type  !=  NULL) {
            $data['kitchen_type'] = $request->kitchen_type;
        }
        if ($request->negotiable != "null" && $request->negotiable != "undefined" && $request->negotiable  !=  NULL) {
            $data['negotiable'] = $request->negotiable;
        }
        if ($request->area_type != "null" && $request->area_type != "undefined" && $request->area_type  !=  NULL) {
            $data['area_type'] = $request->area_type;
        }
        if ($request->balcony != "null" && $request->balcony != "undefined" && $request->balcony  !=  NULL) {
            $data['balcony'] = $request->balcony;
        }
        if($request->category_id == '1'){
            $this->validate($request, [
                'rent_or_sell' => 'required|numeric|in:1,2,3',
            ]);
        }
        $data['amount'] = ($request->amount == 'null') ? NULL : $request->amount;
        $data['rent_or_sell'] = $request->rent_or_sell ?? 0;
        try{
            $input = $request->all();    
            $data['title'] = $this->stringsaafchahiye($input['title']);
            $data['description'] = $this->stringsaafchahiye($input['description']);
            //Upload images
            if($request->hasFile('files')){
                Media::where('product_id',$request->id)->delete();
                StaticData::UploadImagesOnNewDirectory($request,$request->id,'files',$request->state,'2');
            }
            unset($data['files']);
            $userid = auth()->user()->id;
            $post = Product::where('id',$request->id)->
            where('user_id',$userid)
            ->update($data);
            $response = Product::with('medias')->find($request->id);
            if(isset($post->medias)){
                $reponse['media'] = $post->medias;   
            }
            $msg = "Product updated successfully.";
            return $this->success($msg,$response,200);
        }catch(\Exception $e) {
            // return $e->getMessage();
            return $this->error("Error! Please Try Again After Sometime.", '500');
        }
    }

    /**
     * 
     */
    private function getsCat($cat_id)
    {
        $cats = [
            [
                "id"=> 25,
                "og"=> null,
                "name"=> "Ad-hoc-Part-time Jobs",
                "icon"=> "fa fa-search",
                "color"=> "#4285F4",
                "scats"=> ['Secretary', 'Admin & Office', 'Cashier', 'Data Entry & Survey', 'Drivers & Delivery', 'Event & Flyer Distribution', 'Nursery', 'Maid & Babysitters', 'Retail & Sales', 'Customer Service & Telemarketing', 'Server', 'Bartender & Waiter', 'Other', 'Packer', 'Mover & Logistics', 'Human Resources', 'Artist & Creative', 'Beautician & Wellness']
            ],
            [
                "id"=> 12,
                "og"=> null,
                "name"=> "Baby & Children",
                "icon"=> "fa fa-child",
                "color"=> "#337AB7",
                "scats"=> ["Children's Clothing", "Maternity & Pregnancy", 'Bedding', "Children's Furniture", 'Nursery', 'Feeding', 'Car Seats', 'Playtime & Readings', 'Other Baby & Children Items', 'Prams & Strollers', 'Bathing & Changing']
            ],
            [
                "id"=> 27,
                "og"=> null,
                "name"=> "Cars",
                "icon"=> "fa fa-car",
                "color"=> "#E61D74",
                "scats"=> ['Acura', 'Alfa Romeo', 'Aston Martin', 'Audi', 'Bentley', 'BMW', 'Chrysler', 'Citroen', 'Daewoo', 'Daihatsu', 'Daimler', 'Ferrari', 'Fiat', 'Ford', 'Hino', 'Honda', 'Hummer', 'Hyundai', 'Isuzu', 'Jaguar', 'Jeep', 'Kia', 'Lamborghini', 'Land Rover', 'Lexus', 'Lotus', 'Maserati', 'Maybach', 'Mazda', 'Mercedes-Benz', 'Mini', 'Mitsubishi', 'Mitsuoka', 'Nissan', 'Opel', 'Peugeot', 'Porsche', 'Renault', 'Rolls-Royce', 'Rover', 'Saab', 'Smart', 'Ssangyong', 'Subaru', 'Suzuki', 'Toyota', 'UD', 'Volkswagen', 'Volvo', 'Other']
            ],
            [
                "id"=> 4,
                "og"=> null,
                "name"=> "Clothes & Accessories",
                "icon"=> "fa fa-dropbox",
                "color"=> "#21D68C",
                "scats"=> ["Women's Clothing", 'Women Shoes & Heels', 'Men Shoes', "Women's Bags", "Men's Bags & Accessories", 'Watches', "Women's Accessories", "Men's Clothing", 'Other Clothes']
            ],
            [
                "id"=> 7,
                "og"=> null,
                "name"=> "Electronics",
                "icon"=> "fa fa-plug",
                "color"=> "#302028",
                "scats"=> ['Cameras', 'Audio Systems', 'Other Electonics', 'TV & Video', 'Computer']
            ],
            [
                "id"=> 2,
                "og"=> null,
                "name"=> "Health & Beauty",
                "icon"=> "fa fa-female",
                "color"=> "#540F13",
                "scats"=> ['Makeup', 'Bath & Body Care', 'Medical Equipment', 'Perfume & Cologne', 'Nail Care', 'Other Health & Beauty', 'Skin Care', 'Hair Care']
            ],
            [
                "id"=> 1,
                "og"=> "1956331024.jpeg",
                "name"=> "Home Furnishing",
                "icon"=> "fa fa-gavel",
                "color"=> "#3F2F53",
                "scats"=> ['Furniture', 'Home Appliances', 'Other Home Furnishing Items', 'Household & Decoration', 'Gardening']
            ],
            [
                "id"=> 10,
                "og"=> "1044215737.jpeg",
                "name"=> "Mobile Phones",
                "icon"=> "fa fa-mobile",
                "color"=> "#FED700",
                "scats"=> ['iPhone', 'Samsung Mobile Phones', 'ASUS Mobile Phones', 'Blackberry Mobile Phones', 'HTC Mobile Phones', 'Huawei Mobile Phones', 'LG Mobile Phones', 'Motorola Mobile Phones', 'Nokia Mobile Phones', 'Oppo Mobile Phones', 'Sony Mobile Phones', 'Xiaomi Mobile Phones', 'ZTE Mobile Phones', 'Other Mobile Phones', 'Screen Protectors', 'Cases & Cover', 'Accessories', 'Power & Cables', 'Other Phone Items']
            ],
            [
                "id"=> 28,
                "og"=> null,
                "name"=> "Motorbikes & Scooters",
                "icon"=> "fa fa-motorcycle",
                "color"=> "#FFE001",
                "scats"=> ['Acura', 'Alfa Romeo', 'Aston Martin', 'Audi', 'Bentley', 'BMW', 'Chrysler', 'Citroen', 'Daewoo', 'Daihatsu', 'Daimler', 'Ferrari', 'Fiat', 'Ford', 'Hino', 'Honda', 'Hummer', 'Hyundai', 'Isuzu', 'Jaguar', 'Jeep', 'Kia', 'Lamborghini', 'Land Rover', 'Lexus', 'Lotus', 'Maserati', 'Maybach', 'Mazda', 'Mercedes-Benz', 'Mini', 'Mitsubishi', 'Mitsuoka', 'Nissan', 'Opel', 'Peugeot', 'Porsche', 'Renault', 'Rolls-Royce', 'Rover', 'Saab', 'Smart', 'Ssangyong', 'Subaru', 'Suzuki', 'Toyota', 'UD', 'Volkswagen', 'Volvo', 'Other']
            ],
            [
                "id"=> 24,
                "og"=> null,
                "name"=> "Permanent-Full-time Jobs",
                "icon"=> "fa fa-search",
                "color"=> "#F70000",
                "scats"=> ['Accounting & Audit Jobs', 'Admin & Office Jobs', 'Banking & Finance Jobs', 'Beauty & Wellness Jobs', 'Building & Construction Jobs', 'Community & Social Services Jobs', 'Customer Service Jobs', 'Design Jobs', 'Engineering Jobs', 'Events & Promotions Jobs', 'Food & Beverage Jobs', 'General Jobs', 'Health & Fitness Jobs', 'Hospitality & Tourism Jobs', 'Human Resources Jobs', 'Information Technology Jobs', 'Insurance Jobs', 'Legal & Professional Services Jobs', 'Management Jobs', 'Manufacturing Jobs', 'Marketing & Public Relations Jobs', 'Media & Advertising Jobs', 'Medical Services Jobs', 'Merchandising & Purchasing Jobs', 'Nursery', 'Nanny & Domestic Helpers Jobs', 'Property Jobs', 'Government & Civil Service Jobs', 'Research & Development Jobs', 'Retail & Sales Jobs', 'Teaching Jobs', 'Telecommunications Jobs', 'Transportation & Logistics Jobs']
            ],
            [
                "id"=> 26,
                "og"=> null,
                "name"=> "Post your resume (For job seeker)",
                "icon"=> "fa fa-file",
                "color"=> "#F6C505",
                "scats"=> ['Doctorate', 'Master', 'Degree', 'Diploma', 'Professional Certifications (e.g. ACCA, CPA)', 'Higher Nitec', 'Nitec', 'A-Level', 'O-Level', 'N-Level', 'Primary', 'Not Applicable', 'Not Specified']
            ],
            [
                "id"=> 17,
                "og"=> null,
                "name"=> "Property for Rent",
                "icon"=> "fa fa-cube",
                "color"=> "#408D00",
                "scats"=> ['Apartment', 'Condo', 'House', 'Land', 'HDB', 'Villa', 'Room', 'Other']
            ],
            [
                "id"=> 42,
                "og"=> null,
                "name"=> "Rabbits",
                "icon"=> "fa fa-paw",
                "color"=> "#A769A4",
                "scats"=> ['Apartment', 'Condo', 'House', 'Land', 'HDB', 'Villa', 'Room', 'Other']
            ],
            [
                "id"=> 14,
                "og"=> null,
                "name"=> "Room for Rent & Flat Share",
                "icon"=> "fa fa-building",
                "color"=> "#E41A22",
                "scats"=> ['Apartment', 'Condo', 'House', 'Land', 'HDB', 'Villa', 'Room', 'Other']
            ],
            [
                "id"=> 8,
                "og"=> null,
                "name"=> "Toys & Games",
                "icon"=> "fa fa-gamepad",
                "color"=> "#238AE6",
                "scats"=> ['Models & Figures', 'Game Softwares', 'Other Toys', 'Kids Toys', 'Game Consoles']
            ]
        ];
        $return = [];
        foreach($cats as $cat)
        {
            if($cat_id == $cat['id'])
            {
                $return = $cat['scats'];
                break;
            }
        }
        return $return;
    }
    public function saveJobData(Request $request){
        $validator = Validator::make($request->all(), [
            'title'           => 'required|string|min:20|max:100',
            'subcategory_id'  => 'required|numeric|exists:msubcategories,id',
            'job_type'        => 'required|string',
            'company_name'    => 'required|string',
            'company_website' => 'required|url',
            'edu_level'       => 'required|string',
            'description'     => 'required|string|min:50',
            'ea_number'       => 'string',
            'images'          => 'required|image',
            'images.*'        => 'required|array|mimes:jpeg,png,jpg|max:2048',
            'name'            => 'required|string',
            'email'           => 'required|email', 
            'state'           => 'required|string',
            'city'            => 'required|string',
            'locality'        => 'required|string',
            'experience'        => 'required|string',
            'qualification'   => 'required|string',
            'responsibility'        => 'required|string',
            'salary_from' =>  'required|string',
            'salary_to' =>  'required|string',
            'skills'  =>  'required|string',
            'phone'           => 'required|numeric|digits_between:8,10',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        $input = $validator->validated();
        $subcategory = Msubcategory::findOrFail($input['subcategory_id']);
        $post = Product::create([
            'title'           => $this->stringsaafchahiye($input['title']),
            'description'     => $this->stringsaafchahiye($input['description']),
            'price'           => $input['price'] ?? 0,  
            'amount'          => $input['amount'] ?? null, 
            'user_id'         => auth()->user()->id,
            'subcategory_id'  => $subcategory->id,
            'category_id'     => $subcategory->mcategory->id,
            'job_type'        => $input['job_type'],
            'company_name'    => $input['company_name'],
            'company_website' => $input['company_website'],
            'ea_number'       => $input['ea_number'],
            'edu_level'       => $input['edu_level'],
            'model'           => $input['model'] ?? null, 
            'only_for'        => $input['only_for'] ?? null, 
            'pro_by'          => $input['pro_by'] ?? null,
            'dob'             => $input['dob'] ?? null, 
            'available'       => $input['available'] ?? null, 
            'cc'              => $input['cc'] ?? null, 
            'fuel_type'       => $input['fuel_type'] ?? null,
            'year'            => $input['year'] ?? null,
            'km'              => $input['km'] ?? null, 
            'trans'           => $input['trans'] ?? null,
            'color'           => $input['color'] ?? null, 
            'share'           => $input['share'] ?? null, 
            'dwelling'        => $input['dwelling'] ?? null, 
            'size'            => $input['size'] ?? null,
            'bedroom'         => $input['bedroom'] ?? null,
            'bathroom'        => $input['bathroom'] ?? null, 
            'smoking'         => $input['smoking'] ?? null,
            'pet'             => $input['pet'] ?? null, 
            'gender'          => $input['gender'] ?? null, 
            'cea'             => $input['cea'] ?? null,
            'parking'         => $input['parking'] ?? null,
            'skills'         => $input['skills'] ?? null,
            'experience'        => $input['experience'] ?? null,
            'qualification'        => $input['qualification'] ?? null,
            'responsibility'        =>$input['responsibility'] ?? null,
            'salary_from' => $input['salary_from'] ?? null,
            'salary_to' =>  $input['salary_to'] ?? null,
            'state'  =>  $input['state'] ?? null,
            'city'  =>  $input['city'] ?? null,
            'locality'  =>  $input['locality'] ?? null,
            'name'  =>  $input['name'] ?? null,
            'email'  =>  $input['email'] ?? null,
            'phone'  =>  $input['phone'] ?? null,
        ]);
        if ($request->has('images')) {
            $file = $request->file('images');
            $name = rand() . '.' . $file->getClientOriginalExtension();
            $file->move('images', $name);
            Media::create(['name' => $name, 'product_id' => $post->id]);
                $post->update(['status'=>0]);
        }
        return response()->json([
            'ok'      => 1,
            'msg' => 'Job post successfully created.',
        ], 201); 
    }
    public function editSF(Request $request, $id)
    {
        $product = Product::with('mcategory', 'msubcategory', 'medias')->findOrFail($id);
        // Extract media names with IDs from the product's media relationship
        $mediaNames = $product->medias->pluck('name', 'id')->toArray();
        // Initialize an empty array for photos
        $photos = [];
        $product->qualification = json_decode($product->qualification, true);
        $product->responsibility = json_decode($product->responsibility, true);
        $product->skills = json_decode($product->skills, true);
        // Check if media exists
        if (!empty($mediaNames)) {
            // Create an array of objects with media ID and URL
            foreach ($mediaNames as $id => $name) {
                $photos[] = [
                    'id'  => $id,
                    'url' => 'https://addressguru.sg/images/' . $name
                ];
            }
        }
        // Set the 'photo' attribute as an array of objects
        $product->setAttribute('photo', $photos);
        // Return the response with product data
        return response()->json([
            'ok'     => 1,
            'result' => $product,
        ], 200);
    }
     public function editJob(Request $request, $id)
    {
        // Fetch the product with relationships or throw 404 if not found
        $product = Product::with('mcategory', 'msubcategory', 'medias')->findOrFail($id);
        $product->qualification = json_decode($product->qualification, true);
        $product->responsibility = json_decode($product->responsibility, true);
        $product->skills = json_decode($product->skills, true);
        // Extract media names from the product's media relationship
        $mediaNames = $product->medias->pluck('name', 'id')->toArray(); // Convert media names to an array
        // Wrap each media name in a full URL or set as an empty array if no media found
        if (!empty($mediaNames)) {
            // Create an array of objects with media ID and URL
            foreach ($mediaNames as $id => $name) {
                $photos[] = [
                    'id'  => $id,
                    'url' => 'https://addressguru.sg/images/' . $name
                ];
            }
        }
         // Set the 'photo' attribute as an array of objects
        $product->setAttribute('photo', $photos);
        // Return the response with product data
        return response()->json([
            'ok'     => 1,
            'result' => $product,
        ], 200);
    }
    public function editSFData(Request $request){
        // Validation rules
        $required = [
            'project_id' => 'required|numeric',
            'title' => 'required|min:20|max:100',
            'description' => 'required|min:50',
            'subcategory_id' => 'required|numeric|exists:msubcategories,id,deleted_at,NULL',
            'name' => 'required|string',
            'email' => 'required|email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'state' => 'required|string',
            'city' => 'required|string',
            'locality' => 'required|string',
            'phone' => 'required|max:10|min:8',
            'images' => 'required|array',
            'images.*' => 'required|mimes:jpeg,png,jpg|max:5000',
            'amount' => 'nullable',
            'only_for' => 'required|string',
            'condition' => 'required|string',  // Add validation for condition
            'model' => 'nullable|string',      // Add validation for model
        ];
        // Additional validation for price
        if ($request->has('price')) {
            $required['price'] = 'required';
        }
        $validator = Validator::make($request->all(), $required);
        // Check validation errors
        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->first()], 422);
        }
        // Find subcategory
        $input = $request->all();
        $idcat = Msubcategory::find($input['subcategory_id']);
        if (!$idcat) {
            return response()->json(['msg' => 'An invalid subcategory provided!'], 422);
        }
        // Update product
        $product = Product::findOrFail($request->project_id);
        $product->update([
            'title' => $this->sanitizeInput($input['title']),
            'condition' => $input['condition'],
            'description' => $this->sanitizeInput($input['description']),
            'price' => $input['price'] ?? 0,
            'amount' => $input['amount'],
            'user_id' => auth()->user()->id,
            'subcategory_id' => $idcat->id,
            'category_id' => $idcat->mcategory->id,
            'model' => $input['model'] ?? null,
            'only_for' => $input['only_for'],
            'pro_by' => $input['pro_by'] ?? null,
            'dob' => $input['dob'] ?? null,
            'available' => $input['available'] ?? null,
            'job_type' => $input['job_type'] ?? null,
            'company_name' => $input['company_name'] ?? null,
            'company_website' => $input['company_website'] ?? null,
            'ea_number' => $input['ea_number'] ?? null,
            'edu_level' => $input['edu_level'] ?? null,
            'cc' => $input['cc'] ?? null,
            'fuel_type' => $input['fuel_type'] ?? null,
            'year' => $input['year'] ?? null,
            'km' => $input['km'] ?? null,
            'trans' => $input['trans'] ?? null,
            'color' => $input['color'] ?? null,
            'share' => $input['share'] ?? null,
            'dwelling' => $input['dwelling'] ?? null,
            'size' => $input['size'] ?? null,
            'bedroom' => $input['bedroom'] ?? null,
            'bathroom' => $input['bathroom'] ?? null,
            'smoking' => $input['smoking'] ?? null,
            'pet' => $input['pet'] ?? null,
            'gender' => $input['gender'] ?? null,
            'cea' => $input['cea'] ?? null,
            'parking' => $input['parking'] ?? null,
            'name' => $input['name'],
            'email' => $input['email'],
            'state' => $input['state'],
            'city' => $input['city'],
            'locality' => $input['locality'],
            'phone' => $input['phone'],
        ]);
        // Handle image upload
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            // Loop through each uploaded image
            foreach ($files as $file) {
                $name = rand() . '.' . $file->getClientOriginalExtension();
                $file->move('images', $name);
                // Save each image to the Media model
                Media::create([
                    'name' => $name, 
                    'product_id' => $product->id
                ]);
            }
            // Update post status if the user role is 'User'
            if (auth()->user()->role->name == "User") {
                $product->update(['status' => 0]);
            }
        } else {
            return response()->json(['msg' => 'Please provide at least one image!'], 422);
        }
        // Update post status based on payment
        if ($request->has('payment') && intval($request->amount)) {
            $product->update(['post_status' => 1]);
        }
        return response()->json([
            'ok' => 1,
            'msg' => 'Data Update successfully',
            'post_id' => Crypt::encrypt($product->id),
        ]);
    }
    public function editJobData(Request $request)
    {
        // Validation rules
        $required = [
            'product_id' => 'required|numeric|exists:products,id',
            'title' => 'required|string|min:20|max:100',
            'subcategory_id' => 'required|numeric|exists:msubcategories,id',
            'job_type' => 'required|string',
            'company_name' => 'required|string',
            'company_website' => 'url',
            'edu_level' => 'required|string',
            'description' => 'required|string|min:50',
            'ea_number' => 'nullable|string',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string',
            'email' => 'required|email',
            'state' => 'required|string',
            'city' => 'required|string',
            'locality' => 'required|string',
            'experience' => 'required|string',
            'qualification' => 'required|string',
            'responsibility' => 'required|string',
            'salary_from' => 'required|string',
            'salary_to' => 'required|string',
            'skills' => 'required|string',
            'phone' => 'required|numeric|digits_between:10,15',
        ];
        $validator = Validator::make($request->all(), $required);
        // Check validation errors
        if ($validator->fails()) {
            return response()->json(['msg' => $validator->errors()->first()], 422);
        }
        // Get input data
        $input = $request->all();
        $subcategory = Msubcategory::find($input['subcategory_id']);
        if(!$subcategory){
            return response()->json([
            'ok' => 1,
            'msg' => ' subcategory error',
            ]); 
        }
        // Update job post
        $product = Product::find($input['product_id']);
        if(!$product){
            return response()->json([
            'ok' => 1,
            'msg' => 'product error',
            ]); 
        }
        $product->update([
            'title' => $this->stringsaafchahiye($input['title']),
            'description' => $this->stringsaafchahiye($input['description']),
            'price' => $input['price'] ?? 0,
            'amount' => $input['amount'] ?? null,
            'user_id' => auth()->user()->id,
            'subcategory_id' => $subcategory->id,
            'category_id' => $subcategory->mcategory->id,
            'job_type' => $input['job_type'],
            'company_name' => $input['company_name'],
            'company_website' => $input['company_website'],
            'ea_number' => $input['ea_number'] ?? null,
            'edu_level' => $input['edu_level'],
            'experience' => $input['experience'],
            'qualification' => $input['qualification'],
            'responsibility' => $input['responsibility'],
            'salary_from' => $input['salary_from'],
            'salary_to' => $input['salary_to'],
        ]);
        // Handle image uploads
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            // Loop through each uploaded image
            foreach ($files as $file) {
                $name = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move('images', $name);
                // Save each image to the Media model
                Media::create([
                    'name' => $name,
                    'product_id' => $product->id,
                ]);
            }
        }
        // Update post status if the user role is 'User'
        if (auth()->user()->role->name === "User") {
            $product->update(['status' => 0]);
        }
        // Final response
        return response()->json([
            'ok' => 1,
            'msg' => ' Job Post updated successfully',
        ]);
    }
    public function allProduct(){
        $products = Product::with('mcategory','msubcategory','medias','views')->where('category_id','!=',5)->where('user_id', auth()->user()->id)->paginate(10);
        if ($products->isEmpty()) {
            return response()->json([
                'ok'  => 0,
                'msg' => 'No products found for this user.',
            ], 404); // 404 for not found
        }
        foreach ($products as $product) {
            $mediaNames = $product->medias->pluck('name')->toArray(); // Convert media names to an array
            if (!empty($mediaNames)) {
                // Wrap each media name in a full URL and return it as an array
                $product->photo = array_map(function($name) {
                    return 'https://addressguru.sg/images/' . $name;
                }, $mediaNames);
            } else {
                $product->photo = []; // Set as empty array if no media found
            }
        }

        return response()->json([
            'ok'   => 1,
            'result' => $products,
        ], 200);
    }
    public function allJobPost()
    {
        // Retrieve products with related categories and media
        $products = Product::with('mcategory', 'msubcategory', 'medias','views') // Including 'medias' relation
                            ->where('category_id', 5)
                            ->where('user_id', auth()->user()->id)
                            ->paginate(10);
        // Check if products are found
        if ($products->isEmpty()) {
            return response()->json([
                'ok'  => 0,
                'msg' => 'No products found for this user.',
            ], 404); // 404 for not found
        }
        // Iterate through each product
        foreach ($products as $product) {
            // Decode the JSON fields if they exist
            $product->qualification = json_decode($product->qualification, true);
            $product->responsibility = json_decode($product->responsibility, true);
            $product->skills = json_decode($product->skills, true);
            // Handle media URLs by ID
            $mediaNames = $product->medias->pluck('name', 'id')->toArray(); // Convert media names with IDs
            $photos = [];
            if (!empty($mediaNames)) {
                // Create an array of objects with media ID and URL
                foreach ($mediaNames as $id => $name) {
                    $photos[] = [
                        'id'  => $id, 
                        'url' => 'https://addressguru.sg/images/' . $name
                    ];
                }
            }
            // Set the 'photo' attribute
            $product->setAttribute('photo', $photos);
        }
        // Return the result
        return response()->json([
            'ok'   => 1,
            'result' => $products,
        ], 200);
    }
    public function mediaDelete($id)
    {
        $media = Media::findorfail($id);
        if($media){
            $media->delete();
           return response()->json([
            'ok'   => 1,
            'msg' => 'ok',
            ], 200);
        }else{
             return response()->json([
            'ok'   => 1,
            'msg' => 'error',
            ], 503);
        }
    }
    public function enquiry(Request $request,$id){
        $rules = [
            'name' => 'required|string',
            'email' => 'required',
            'phone' => 'required|numeric',
            'message' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'msg' => $validator->errors(),
                'code' => 422,
                'error' => true,
                'status' => false,
            ], 422);
        }
        $query =new  Query();
        $query->product_id = $id;
        $query->name = $request->name;
        $query->email = $request->email;
        $query->ph_number = $request->phone;
        $query->message = $request->message;
          if ($query->save()) {
            return response()->json([
                'code' => 201,
                'error' => false,
                'status' => true,
                'message' => 'Query added successfully!',
            ], 201);
        }
        // Return a response if the save operation fails
        return response()->json([
            'code' => 503,
            'error'  => false,
            'status' => true,
            'message' => 'Query not added successfully!',
        ], 503);
    }
    public function jobs(Request $request)
    {
        // Fetch products with conditions
        if ($request->has('city')) {
            $products = Product::with('mcategory', 'msubcategory', 'medias')
                ->where('post_status', '=', 1)->where('status', '=', 1)
                ->where('category_id', 5)
                ->where('city', $request->city)
                ->paginate(20);
        } else {
            $products = Product::with('mcategory', 'msubcategory', 'medias')
              ->where('post_status', '=', 1)->where('status', '=', 1)
                ->where('category_id', 5)
                ->paginate(20);
        }
        foreach ($products as $product) {
            // Handle media URLs by ID
            $mediaNames = $product->medias->pluck('name', 'id')->toArray();
            $photos = [];
            if (!empty($mediaNames)) {
                foreach ($mediaNames as $id => $name) {
                    $photos[] = [
                        'id'  => $id, 
                        'url' => 'https://addressguru.sg/images/' . $name
                    ];
                }
            }
            // Set the 'photo' attribute
            $product->setAttribute('photo', $photos);
        }
        // Check if products are available
        if (!$products->isEmpty()) {
            return response()->json([
                'code' => 201,
                'error' => false,
                'status' => true,
                'total' => $products->total(),
                'current_page' => $products->currentPage(),
                'result' => $products->items(), // Includes all pagination data
                'message' => 'success',
            ], 201);
        } else {
            // Return response if no data found
            return response()->json([
                'code' => 503,
                'error' => true,
                'status' => false,
                'result' => null,
                'message' => 'No Data Found!',
            ], 503);
        }
    }
    public function destroy($id)
    {
        $coaching = Product::where('user_id',auth()->user()->id)->where('id',$id)->first();
        if (!$coaching) {
            return response()->json([
                'code'    => 404,
                'error'   => true,
                'message' => "Product data not found.",
                'status'  => false,
            ], 404);
        }
        try {
            // Delete the coaching record
            $coaching->delete();
            return response()->json([
                'code'    => 200,
                'error'   => false,
                'message' => "Data deleted successfully.",
                'status'  => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([   
                'code'    => 500,
                'error'   => true,
                'message' => "An error occurred: " . $e->getMessage(),
                'status'  => false,
            ], 500);
        }
    }
}