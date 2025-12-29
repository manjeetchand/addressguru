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
 * @author     Manjeet Chand  
 * @copyright  2024-2025 Address Guru Singapore
 */
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\Service;
use App\Facility;
use App\Template;
use App\Query;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

class TemplateController extends Controller
{
    public function index(Request $request)
    {
       if($request->has('type')){
            $templates =Template::where('type',$request->type)->get();
       }else{
             $templates =Template::get();
       }
         if($templates){
             return response()->json([
                'code'   => 200,
                'error'  => false,
                'status' => true,
                'result' =>  $templates ,
                'message'=>'ok',
            ],200);
            
        }else{
             return response()->json([
                'code'   => 503,
                'error'  => true,
                'status' => false,
                'result' =>  $templates ,
                'message'=> 'error',
            ],200);
        }
    }

    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'title' => 'required|string',
            'type' => 'required|string',
            'message' => 'required|string',
        ];
    
        // Conditional rule for 'subject' when type is 'email'
        if ($request->type === "email") {
            $rules['subject'] = 'required|string';
        }
    
        // Create a validator instance
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
    
        // Create and save the new template
        $template = new Template();
        $template->title = $request->title;
        $template->type = $request->type;
        $template->message = $request->message;
        $template->subject = $request->type === "email" ? $request->subject : null;
    
        // Check if the template is saved successfully
        if ($template->save()) {
            return response()->json([
                'code' => 201,
                'error' => false,
                'status' => true,
                'message' => 'Template added successfully!',
            ], 201);
        }
    
        // Return a response if the save operation fails
        return response()->json([
            'code' => 503,
            'error'  => false,
            'status' => true,
            'message' => 'Template not added successfully!',
        ], 503);
    }

    
    public function update(Request $request ,$id){
         $rules = [
            'title' => 'required|string',
            'type' => 'required|string',
            'message' => 'required|string',
        ];
    
        // Conditional rule for 'subject' when type is 'email'
        if ($request->type === "email") {
            $rules['subject'] = 'required|string';
        }
    
        // Create a validator instance
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
    
        $template = Template::find($id); 
        $template->title = $request->title;
        $template->type = $request->type;
        $template->message = $request->message;
        $template->subject = $request->type === "email" ? $request->subject : null;
        if($template->save()){
             return response()->json([
                'code'   => 200,
                'error'  => false,
                'status' => true,
                'message'=>'Template Update Successfully !!',
            ],200);
        }else{
             return response()->json([
                'code'   => 503,
                'error'  => true,
                'status' => false,
                'message'=>'Template Not Update Successfully !!',
            ],200);
        }

    }
    
    public function destroy($id){
        $template = Template::find($id); 
        
         if($template->delete()){
             return response()->json([
                'code'   => 200,
                'error'  => false,
                'status' => true,
                'message'=>'Template Delete Successfully !!',
            ],200);
        }else{
             return response()->json([
                'code'   => 503,
                'error'  => true,
                'status' => false,
                'message'=>'Template Not Delete Successfully !!',
            ],200);
        }
    }
    
public function leads(Request $request)
{
    if ($request->category == 'business') {
        $data = Query::with('product')->whereNotNull('product_id')->orderBy('id', 'desc')->paginate(20);

        foreach ($data as $d) {
            $d->days_diff = Carbon::now()->diffInDays($d->created_at); // Calculate days difference

            if ($d->product) {
                $d->title = $d->product->title;
                $d->address = $d->product->locality;
            } else {
                $d->title = null;
                $d->address = null;
            }
        }
    } elseif ($request->category == 'marketplace') {
        $data = Query::with('post')->whereNotNull('post_id')->orderBy('id', 'desc')->paginate(20);

        foreach ($data as $d) {
            $d->days_diff = Carbon::now()->diffInDays($d->created_at); // Calculate days difference

            if ($d->post) {
                $d->title = $d->post->business_name;
                $d->address = $d->post->business_address;
            } else {
                $d->title = null;
                $d->address = null;
            }
        }
    } elseif ($request->category == 'job' || $request->category == 'properties') {
        $data = Query::orderBy('id', 'desc')->paginate(20);
    } else {
        $data = Query::orderBy('id', 'desc')->paginate(20);
    }

    if (!$data->isEmpty()) {
        return response()->json([
            'code' => 201,
            'error' => false,
            'status' => true,
            'total' => $data->total(),
            'current_page' => $data->currentPage(),
            'result' => $data->items(), // Only the items without pagination metadata
            'message' => 'success',
        ], 201);
    } else {
        return response()->json([
            'code' => 503,
            'error' => true,
            'status' => false,
            'result' => null,
            'message' => 'No Data Found!',
        ], 503);
    }
}



}