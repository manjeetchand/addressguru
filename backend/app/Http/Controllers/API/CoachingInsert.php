<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CoachingRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use App\Personal;
use App\Packages;
use App\SEO;
use App\PaymentMode;
use App\lapp;
use App\Plan;
use App\SubCategory;
use App\Product;
use App\Views;
use App\User;
use App\Clock;
use App\Msubcategory;
use App\Media;
use App\Category;
use App\Coaching;
use App\Mcategory;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use URL;

class CoachingInsert extends Controller
{
    public function create(Request $request){
        // dd($request->all());


        // return response()->json([
        //     'code'    => 201,
        //     'error'   => false,
        //     'status'  => true,
        //     'data' => $request->all(),
        //     'message' => 'Post added successfully!',
        // ], 201);
        $this->validate($request, [
             //deafult
            'category_id' => 'numeric',
            'subcategory_id' => 'numeric',
            //form 1 
            'business_name' => 'required|min:20|max:100',
            'business_address' => 'required|min:20|max:100',
            'ad_description' => 'required|min:50',
            'payment_modes' => 'required|array',
            // 'payment_modes.*' => 'exists:payment_mode,name',
            'services' => 'array',
            // 'services.*' => 'exists:services,name',
            'courses' => 'array',
            'facilities' => 'array',
            // 'facilities.*' => 'exists:facilities,name',
            //form 2 
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            //form 3
            'name' => 'required',
            'email' => 'required|email',
            'ph_number' => 'required',
            'state' => 'required',
            'city' => 'required',
            'location' => 'required',
            //form 4    
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2000',
            //form 5
            'payment_plan_id' => 'required|numeric',
        ]);

        
        
        $input = $request->all();
        
        if (isset($input['category_id'])) 
        {
          $category = $input['category_id'];
          $subcategory = null;
        }
       else
        {
          $subcategory = $input['subcategory_id'];
          $se = SubCategory::findOrFail($subcategory);
          $category = $se->category_id;
        }
        
        try {
            if ($file = $request->file('photo')) 
            {
                $name = rand() . '.' . $file->getClientOriginalExtension();
            }

            $coaching = Coaching::create([
                'user_id'          => Auth::user()->id,
                'add_by'            =>1,
                'category_id'      => $category,
                'subcategory_id'   => $subcategory,
                'business_name'    => $this->stringsaafchahiye($input['business_name']),
                'business_address' => $this->stringsaafchahiye($input['business_address']),
                'ad_description'   => $this->stringsaafchahiye($input['ad_description']),
                'payment'          => json_encode($input['payment_modes']),
                'course' =>         json_encode($input['courses']),
                'facility'         => json_encode($input['facilities']),
                'service'          => json_encode($input['services']),
                'web_link'         => $input['web_link'] ?? '',
                'map'           => $input['map'] ?? '',
                'video'            => $input['video_link'] ?? '',
                'postal_code'      => $input['postal_code'],
                'tin_no'           => $input['tin_no'] ?? '',
                'h_star'           => $input['h_star'] ?? '',
                'r_type'           => $input['r_type']?? '',
                'floor'            => $input['floor']?? '',
                'area'             => $input['area']?? '',
                'furnished'        => $input['furnished']?? '',
                'bathroom'         => $input['bathroom']?? '',
                'religion_view'    => $input['religion_view']?? '',
                'only_for'         => $input['only_for']?? '',
                'rent'             => $input['rent']?? '',
                'ifsc'             => $input['ifsc']?? '',
                'ip'               => \Request::ip(),
                'list_by'          => $input['list_by']?? '',
                'pet_friend'       => $input['pet_friend']?? '',
                'bedroom'          => $input['bedroom']?? '',
                'facing'           => $input['facing']?? '',
                'dwelling'         => $input['dwelling']?? '',
                'job_category'     => $input['job_category']?? '',
                'photo'  => $name ?? '',
                'post_status' =>1 ,
            ]);  
        
            Personal::create([
                'post_id'    => $coaching->id,
                'user_id'    => Auth::user()->id,
                'category_id'=> $category,
                'subcategory_id'=> $subcategory,
                'name' => $input['name'],
                'ph_number' => $input['ph_number'],
                'ph_number1' => $input['ph_number1']?? '',
                'state' => $input['state'],
                'city' => $input['city'],
                'location' => $input['location'],
                'email' => $input['email'],
                'agent'      => 0,
                'is_active'  => 1,
    
            ]);
            
            lapp::create([
                'user_id' =>0,
                'coaching_id' =>  $coaching->id
                ]); 
            
           // Save base64 image if provided
            if ($request->hasFile('images')) {
                $this->uploadImages($request->file('images'), $coaching->id); // Assuming a helper method for uploading images
            } else {
                return response()->json(['msg' => 'Please provide at least one image!'], 400);
            }
        
            return response()->json([
                'code'    => 201,
                'error'   => false,
                'status'  => true,
                'message' => 'Post added successfully!',
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'code'    => 500,
                'error'   => true,
                'status'  => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
        
    }
    

    private function uploadImages($files, $productId)
    {
        $year  = date('Y');
        $month = date('m');
        $path  = 'images/' . $year . '/' . $month;
    
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
                'post_id' => $productId,
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
    
     public function edit($id)
    {
        $data = Coaching::with('media', 'personals','views')->findOrFail($id);
    
        if ($data) {
            // Decode JSON fields
            $data->service = $this->decodeJsonField($data->service);
            $data->course = $this->decodeJsonField($data->course);
            $data->payment = $this->decodeJsonField($data->payment);
            $data->facility = $this->decodeJsonField($data->facility);
            $data->featured_img = 'https://addressguru.sg/images/' . $data->photo;
    
            // Handle media and photo URLs
            $mediaNames = $data->media->pluck('name')->toArray();
            if (!empty($mediaNames)) {
                $data->photos = array_map(function ($name) {
                    return 'https://addressguru.sg/images/' . $name;
                }, $mediaNames);
            } else {
                $data->photos = []; // Set as an empty array if no media found
            }
    
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
    
        
    public function update(Request $request ,$id){
        
         $this->validate($request, [
             //deafult
            'category_id' => 'numeric',
            'subcategory_id' => 'numeric',
            
            //form 1 
            'business_name' => 'required|min:20|max:100',
            'business_address' => 'required|min:20|max:100',
            'ad_description' => 'required|min:50',
            'payment_modes' => 'required|array',
            // 'payment_modes.*' => 'exists:payment_mode,name',
            'services' => 'array',
            // 'services.*' => 'exists:services,name',
            'courses' => 'array',
            'facilities' => 'array',
            // 'facilities.*' => 'exists:facilities,name',
            
            //form 2 
            'featured_img' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            
            //form 3
            'name' => 'required',
            'email' => 'required|email',
            'ph_number' => 'required',
            'state' => 'required',
            'city' => 'required',
            'location' => 'required',
            
            //form 4
            'images ' => 'image|mimes:jpeg,png,jpg|max:2000',
             
            //form 5
            'payment_plan_id' => 'required|numeric',
            
        ]);
        $input = $request->all();
        
        if (isset($input['category_id'])) 
        {
          $category = $input['category_id'];
          $subcategory = null;
        }
       else
        {
          $subcategory = $input['subcategory_id'];
          $se = SubCategory::findOrFail($subcategory);
          $category = $se->category_id;
        }
        
        try {
            if ($file = $request->file('featured_img')) 
            {
                $name = rand() . '.' . $file->getClientOriginalExtension();
            }
            
            $coaching = Coaching::findorFail($id);
            $personal =  Personal::where('post_id',$coaching->id)->first();

            $coaching->update([
                'user_id'          => Auth::user()->id,
                'add_by'            =>1,
                'category_id'      => $category,
                'subcategory_id'   => $subcategory,
                'business_name'    => $this->stringsaafchahiye($input['business_name']),
                'business_address' => $this->stringsaafchahiye($input['business_address']),
                'ad_description'   => $this->stringsaafchahiye($input['ad_description']),
                'payment'          => json_encode($input['payment_modes']),
                'course'           => json_encode($input['courses']),
                'facility'         => json_encode($input['facilities']),
                'service'          => json_encode($input['services']),
                'web_link'         => $input['web_link'] ?? '',
                'video'            => $input['video_link'] ?? '',
                'postal_code'      => $input['postal_code'],
                'tin_no'           => $input['tin_no'] ?? '',
                'h_star'           => $input['h_star'] ?? '',
                'r_type'           => $input['r_type']?? '',
                'floor'            => $input['floor']?? '',
                'area'             => $input['area']?? '',
                'furnished'        => $input['furnished']?? '',
                'bathroom'         => $input['bathroom']?? '',
                'religion_view'    => $input['religion_view']?? '',
                'only_for'         => $input['only_for']?? '',
                'rent'             => $input['rent']?? '',
                'ifsc'             => $input['ifsc']?? '',
                'ip'               => \Request::ip(),
                'list_by'          => $input['list_by']?? '',
                'pet_friend'       => $input['pet_friend']?? '',
                'bedroom'          => $input['bedroom']?? '',
                'facing'           => $input['facing']?? '',
                'dwelling'         => $input['dwelling']?? '',
                'job_category'     => $input['job_category']?? '',
                'photo'  => $name ?? '',
                'post_status' =>1 ,
            ]);  
       
        
            $personal->update([
                'post_id'    => $coaching->id,
                'user_id'    => Auth::user()->id,
                'category_id'=> $category,
                'subcategory_id'=> $subcategory,
                'name' => $input['name'],
                'ph_number' => $input['ph_number'],
                'ph_number1' => $input['ph_number1']?? '',
                'state' => $input['state'],
                'city' => $input['city'],
                'location' => $input['location'],
                'email' => $input['email'],
                'agent'      => 0,
                'is_active'  => 1,
    
            ]);

            if ($request->hasFile('images')) {
                $this->uploadImages($request->file('images'), $coaching->id); // Assuming a helper method for uploading images
            }
        
            return response()->json([
                'code'    => 201,
                'error'   => false,
                'status'  => true,
                'message' => 'Post Update successfully!',
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'code'    => 500,
                'error'   => true,
                'status'  => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
        
    }
    
    
    public function paymentPlan(){
        $data =  Plan::where('status',1)->get();
        if($data){
            return response()->json([
                'code'    => 200,
                'error'   => false,
                'message' => "Data fetched successfully.",
                'result'  => $data,
                'status'  => true,
            ], 200);
        }else{
            return response()->json([
                'code'    => 404,
                'error'   => true,
                'message' => "Data not found.",
                'result'  => null,
                'status'  => false,
            ], 404);
        }
    }
    
    public function destroy($id)
    {
        $coaching = Coaching::where('user_id', auth()->user()->id)->where('id', $id)->first();
        if (!$coaching) {
            return response()->json([
                'code'    => 404,
                'error'   => true,
                'message' => "Coaching data not found.",
                'status'  => false,
            ], 404);
        }
    
        try {
            $personal = Personal::where('post_id', $coaching->id)->first();
    
            // Check if the related Personal record exists before attempting to delete
            if ($personal) {
                $personal->delete();
            }
    
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