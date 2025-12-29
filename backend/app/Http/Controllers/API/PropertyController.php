<?php
/**
 * Address Guru's Property API's Controller
 *
 * Handles API requests for Address Guru's Property data
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
use App\Property;
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


class PropertyController extends Controller
{
    private function sanitizeInput($input)
    {
        return htmlspecialchars(strip_tags(trim($input)));
    }
    public function index(){
        $subcategories= Msubcategory::where('category_id',2)->orderBy('name','asc')->get();
        if($subcategories){
              return response()->json([
             'ok'   => 1,
             'msg' => 'success',
             'result' =>$subcategories,
             ],200);
        }else{
              return response()->json([
             'ok'   => 1,
             'msg' => 'error',
             'result' =>[],
             ], 503);
        }
    }
    public function allData(Request $request)
    {
        $query = Property::with('media','views','ratings')->orderBy('title', 'asc');
        // Apply filters based on request parameters
        if ($request->has('city') && !empty($request->city)) {
            $query->where('city', $request->city);
        }
        if ($request->has('rent_or_sell') && !empty($request->rent_or_sell)) {
            if ($request->rent_or_sell == "1") {
                $query->where('property_for', 'For Rent');
            } elseif($request->rent_or_sell == "2")  {
                $query->where('property_for', 'For Sale');
            }
        }
        // Paginate the results
        $data = $query->paginate(20);
        if ($data->count() > 0) {
            // Add 'photo' attribute to each paginated item
            $data->getCollection()->transform(function ($product) {
                $mediaNames = $product->media->pluck('name', 'id')->toArray();
                $photos = [];
                if (!empty($mediaNames)) {
                    foreach ($mediaNames as $id => $name) {
                        $photos[] = [
                            'id'  => $id,
                            'url' => 'https://addressguru.sg/images/' . $name,
                        ];
                    }
                }
                // Add the 'photo' attribute
                $product->setAttribute('photo', $photos);
                return $product;
            });
            // Return success response
            return response()->json([
                'code'         => 200,
                'error'        => false,
                'status'       => true,
                'total'        => $data->total(),       // Total count of items
                'current_page' => $data->currentPage(), // Current page number
                'result'       => $data->items(),       // Paginated items
                'message'      => 'ok',
            ], 200);
        }
        // Return error response if no data found
        return response()->json([
            'code'    => 503,
            'error'   => true,
            'status'  => false,
            'result'  => [],
            'message' => 'No Property found',
        ], 200);
    }
    public function userListing(Request $request)
    {
        $query = Property::where('user_id',auth()->user()->id)->orderBy('title', 'asc');
        // Apply filters based on request parameters
        if ($request->has('city') && !empty($request->city)) {
            $query->where('city', $request->city);
        }
        // Paginate the results
        $data = $query->paginate(20);
        if ($data->count() > 0) {
            foreach ($data as $product) {
                // Handle media URLs by ID
                $mediaNames = $product->media->pluck('name', 'id')->toArray();
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
    public function propertyDetails($slug){
        $data = Property::with('mcategory','msubcategory','media','views')->where('slug',$slug)->first();
        if ($data) {
            $mediaNames = $data->media->pluck('name', 'id')->toArray();
            if (!empty($mediaNames)) {
                // Create an array of objects with media ID and URL
                foreach ($mediaNames as $id => $name) {
                    $photos[] = [
                        'id'  => $id,
                        'url' => 'https://addressguru.sg/images/' . $name
                    ];
                }
            }else{
                $photos =[]; 
            }
            // Set the 'photo' attribute as an array of objects
            $data->setAttribute('photo', $photos);
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
    
    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'title'         => 'required|min:20|max:100',
            'description'   => 'required',
            'name'          => 'required',
            'email'         => 'required|email',
            'state'         => 'required',
            'city'          => 'required',
            'locality'      => 'required',
            'phone'         => 'required|digits:8',
            'image'         => 'nullable|mimes:jpeg,png,jpg|max:2000',
        ]);

        // Get all input data
        $input = $request->all();
        // Find subcategory
        $idcat = Msubcategory::find($input['subcategory_id']);
        if (!$idcat) {
            return response()->json(['msg' => 'An invalid subcategory provided!'], 200);
        }
        $slug = Str::slug($validated['title']);
        // Create the product
        $property = Property::create([
            'title'          => $this->sanitizeInput($input['title']),
            'slug'           => $slug,
            'description'    => $this->sanitizeInput($input['description']),
            'price'          => $input['price'],
            'amount'         => $input['amount'],
            'user_id'        => auth()->user()->id ?? 0,
            'subcategory_id' => $idcat->id,
            'category_id'    => $idcat->mcategory->id,
            'only_for'       => $request->get('only_for'),
            'pro_by'         => $request->get('pro_by'),
            'dob'            => $request->get('dob'),
            'available'      => $request->get('available'),
            'ea_number'      => $request->get('ea_number'),
            'edu_level'      => $request->get('edu_level'),
            'share'          => $request->get('share'),
            'dwelling'       => $request->get('dwelling'),
            'size'           => $request->get('size'),
            'bedroom'        => $request->get('bedroom'),
            'bathroom'       => $request->get('bathroom'),
            'bathroom_no'       => $request->get('bathroom_no'),
            'furnishing'       => $request->get('furnishing'),
            'smoking'        => $request->get('smoking'),
            'listed_by'        => $request->get('listed_by'),
            'religion'        => $request->get('religion'),
            'vegetarian'        => $request->get('vegetarian'),
            'security_amt'        => $request->get('security_amt'),
            'area_type'        => $request->get('area_type'),
            'type'        => $request->get('type'),
            'tenant_type'        => $request->get('tenant_type'),
            'balcony_no'        => $request->get('balcony_no'),
            'property_type'        => $request->get('property_type'),
            'property_for'        => $request->get('property_for'),
            'con_status'        => $request->get('con_status'),
            'length'        => $request->get('length'),
            'breadth'        => $request->get('breadth'),
            'built_area'        => $request->get('built_area'), 
            'carpet_area'        => $request->get('carpet_area'),   
            'facing'        => $request->get('facing'),
            'floor_no'        => $request->get('floor_no'),
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
            'tin_number'          => $request->get('tin_number'),
            'project_name'          => $request->get('project_name'),
            'payment_plan' => $request->get('payment_plan'),
            'rent_amt' => $request->get('rent_amt'),
            'maintance_amt' => $request->get('maintance_amt'),
        ]);
        // Handle image upload
        if ($request->hasFile('images')) {
            $this->uploadImages($request->file('images'), $property->id); // Assuming a helper method for uploading images
        } else {
            return response()->json(['msg' => 'Please provide at least one image!'], 400);
        }
        // Check for payment and update status
        if ($request->has('payment') && intval($request->amount)) {
            $property->update(['post_status' => 1]);
        }
        return response()->json([
            'ok'      => 1,
            'msg'     => 'Data saved successfully',
        ]);
    }
    private function uploadImages($files, $productId)
    {
        $year  = date('Y');
        $month = date('m');
        $path  = 'uploads/property/' . $year . '/' . $month;
        foreach ($files as $file) {
            // Generate a unique filename
            $name = uniqid() . '.' . $file->getClientOriginalExtension();
            // Create directory if it doesn't exist
            if (!file_exists(public_path($path))) {
                mkdir(public_path($path), 0755, true);
            }
            // Move the file to the destination folder
            $file->move(public_path($path), $name);
            // Save the media record in the database
            \App\Media::create([
                'name'       => $name,
                'property_id' => $productId,
                'path'       => $path . '/',
            ]);
        }
    }
    public function stringsaafchahiye($string)
    {
        $i = preg_replace('^(ht|f)tp(s?)\:\/\/[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*(:(0-9)*)*(\/?)([a-zA-Z0-9\-‌​\.\?\,\'\/\\\+&amp;%\$#_]*)?$^', '', $string);
        $co = preg_match_all( "/[0-9]/", $i);
        if ($co > 5) 
        {
            return preg_replace('/[0-9]+/', '', $i);
        }
        else
        {
            return $i;
        }
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
    public function edit($id)
    {
        try {
            // Fetch property with relationships
            $data = Property::with('media','views')->findOrFail($id);
            $mediaNames = $data->media->pluck('name', 'id')->toArray(); // Convert media names to an array
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
                $data->setAttribute('photo', $photos);
            return response()->json([
                'code'    => 200,
                'error'   => false,
                'message' => "Data fetched successfully.",  
                'result'  => $data,
                'status'  => true,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle not found exception
            return response()->json([
                'code'    => 404,
                'error'   => true,
                'message' => "Data not found.",
                'result'  => null,
                'status'  => false,
            ], 404);
        }
    }
    public function update(Request $request,$id)
    {
        // Validate request data
        $validated = $request->validate([
            'title'         => 'required|min:20|max:100',
            'description'   => 'required',
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
        // Retrieve the property by ID
        $property = Property::find($id);
        if (!$property) {
            return response()->json(['msg' => 'Property not found!'], 404);
        }
        // Find subcategory
        $idcat = Msubcategory::find($request->input('subcategory_id'));
        if (!$idcat) {
            return response()->json(['msg' => 'An invalid subcategory provided!'], 400);
        }
        $slug = Str::slug($validated['title']);
        // Update the property
        $property->update([
            'title'          => $this->sanitizeInput($request->input('title')),
            'slug'           => $slug,
            'description'    => $this->sanitizeInput($request->input('description')),
            'price'          => $request->input('price'),
            'amount'         => $request->input('amount'),
            'subcategory_id' => $idcat->id,
            'category_id'    => $idcat->mcategory->id,
            'available'      => $request->get('available'),
            'ea_number'      => $request->get('ea_number'),
            'edu_level'      => $request->get('edu_level'),
            'share'          => $request->get('share'),
            'dwelling'       => $request->get('dwelling'),
            'size'           => $request->get('size'),
            'bedroom'        => $request->get('bedroom'),
            'bathroom'       => $request->get('bathroom'),
            'bathroom_no'    => $request->get('bathroom_no'),
            'furnishing'     => $request->get('furnishing'),
            'smoking'        => $request->get('smoking'),
            'listed_by'      => $request->get('listed_by'),
            'religion'       => $request->get('religion'),
            'vegetarian'     => $request->get('vegetarian'),
            'security_amt'        => $request->get('security_amt'),
            'area_type'      => $request->get('area_type'),
            'type'           => $request->get('type'),
            'tenant_type'        => $request->get('tenant_type'),
            'balcony_no'        => $request->get('balcony_no'),
            'property_type'  => $request->get('property_type'),
            'property_for'   => $request->get('property_for'),
            'con_status'     => $request->get('con_status'),
            'length'         => $request->get('length'),
            'breadth'        => $request->get('breadth'),
            'built_area'     => $request->get('built_area'), 
            'carpet_area'    => $request->get('carpet_area'),   
            'facing'         => $request->get('facing'),
            'floor_no'       => $request->get('floor_no'),
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
            'tin_number'     => $request->get('tin_number'),
            'project_name'   => $request->get('project_name'),
            'payment_plan'   => $request->get('payment_plan'),
            'rent_amt'       => $request->get('rent_amt'),
            'maintance_amt'  => $request->get('maintance_amt'),
        ]);
        // Handle image upload
        if ($request->hasFile('images')) {
            $this->uploadImages($request->file('images'), $property->id); // Assuming a helper method for uploading images
        }
        // Check for payment and update status
        if ($request->has('payment') && intval($request->input('amount'))) {
            $property->update(['post_status' => 1]);
        }
        return response()->json([
            'ok'  => 1,
            'msg' => 'Property updated successfully',
        ]);
    }
    public function destroy($id)
    {
        try {
            // Retrieve the property owned by the authenticated user
            $property = Property::where('user_id', auth()->user()->id)->where('id', $id)->firstOrFail();
            // Retrieve and delete related Media records
            Media::where('property_id', $property->id)->delete();
            // Retrieve and delete the related Personal record if it exists
            $personal = Personal::where('property_id', $property->id)->first();
            if ($personal) {
                $personal->delete();
            }
            // Delete the property
            $property->delete();
            return response()->json([
                'code'    => 200,
                'error'   => false,
                'message' => "Data deleted successfully.",
                'status'  => true,
            ], 200);
        } catch (ModelNotFoundException $e) {
            // Handle case where the property is not found
            return response()->json([
                'code'    => 404,
                'error'   => true,
                'message' => "Property data not found.",
                'status'  => false,
            ], 404);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'code'    => 500,
                'error'   => true,
                'message' => "An error occurred: " . $e->getMessage(),
                'status'  => false,
            ], 500);
        }
    }
    public function active(Request $request)
    {
        $validated = $request->validate([
            'property_id'    => 'required|numeric|exists:properties,id', // Ensure property exists
            'available'      => 'required|boolean', // Ensure it's a boolean
        ]);
        try {
            // Retrieve the property by ID
            $property = Property::findOrFail($request->property_id);
            // Update the property
            $property->update([
                'available'      => $request->available,
            ]);
            return response()->json([
                'code'    => 200,
                'error'   => false,
                'message' => "Property status updated successfully.",
                'status'  => true,
            ], 200);
        } catch (ModelNotFoundException $e) {
            // Handle property not found case
            return response()->json([
                'code'    => 404,
                'error'   => true,
                'message' => "Property not found.",
                'status'  => false,
            ], 404);
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'code'    => 500,
                'error'   => true,
                'message' => "An error occurred: " . $e->getMessage(),
                'status'  => false,
            ], 500);
        }
    }
}