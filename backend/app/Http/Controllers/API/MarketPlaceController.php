<?php
/**
 * Address Guru's Marketplace API's Controller
 *
 * Handles API requests for Address Guru's Marketplace data
 *
 * PHP version 8.2
 *
 * LICENSE: This source file is private software of Address Guru. No one
 * is allowed to copy, delete, change, distribute this file or data without 
 * a written permission from the Director of Address Guru.
 *
 * @category   Application Route return []
 * @package    MarketPlaceController
 * @author     Manjeet Chand <manjeetchand01@gmail.com>
 * @copyright  2025 Address Guru
 */

namespace App\Http\Controllers\API;

use App\{MarketPlace,Category,Mcategory,Msubcategory};
use App\Helpers\StaticData;
use App\Traits\ResponseAPI;
use App\Helpers\API\Assistant;
use App\Traits\PaymnetPlansTrait;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class MarketPlaceController extends Controller
{
    public function index($category = null){
        if($category){
            $data = MarketPlace::where('category_id',$category)->get();
        }else{
            $data = MarketPlace::get();
        }
        $data->transform(function ($listing) { 
            $listing['images']   = $listing->images;    
            return $listing;
        });
            
        if($data && count($data) > 0){
            return response()->json([
                'success' => true, 
                'message' => 'Products fetched successfully.',
                'data' => $data
            ],200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Products not found.',
                'data' => []
            ], 404);
        }
       
    }

    public function lending($id)
    {
        $data = MarketPlace::find($id);

        if($data)
        {
            return response()->json([
                'success' => true, 
                'message' => 'Products fetched successfully.',
                'data' => $data
            ],200);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Products not found.',
                'data' => []
            ], 404);
        }
         
    }

    public function categories()
    {
        return Mcategory::get(['id', 'name', 'icon', 'colors']);
    }


    public function subCategories()
    {
        // $category_id = request('cat_id') ?? 0;
        $category_id = 1;
        
        if($category_id)
        {
            return Msubcategory::where('category_id', $category_id)
                ->where('parent_id', 0)
                ->orderBy('name')
                ->get(['id', 'name', 'icon', 'colors', 'og']);
        }

        return response()->json([
            'msg'=> 'Kindly provide a category id'
        ], 400);
    }


    public function subCategory()
    {
        $fetchSubs   = request('sub') ?? 0;
        $category_id = request('cat_id') ?? 0;

        if($category_id)
        {
            $get  = ['id', 'name'];
            $cats = Msubcategory::query();

            if($fetchSubs)
            {
                $cats->where('parent_id', $category_id);
            }
            else
            {
                $get[] = 'og';
                $get[] = 'icon';
                $get[] = 'colors';
                $cats->where('id', $category_id);
            }

            return $cats->get($get);
        }

        return response()->json([
            'msg'=> 'Kindly provide a category id'
        ], 400);
    }

    public function store(Request $request)
    {
        $step = $request->step ?: 1;

        if($request->filled('listing_id'))
        {
            $listing = MarketPlace::where('id', $request->listing_id)->where('user_id', auth()->id())->firstOrFail();
        }
        elseif($step == 1)
        {
            $listing = new Marketplace;
            $listing->user_id = auth()->id();
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Listing Id is required for this step.'
            ], 400);
        }

        switch($step)
        {
            case 1:
                $validator = Validator::make($request->all(), [
                    'title'          => 'required|string|min:2|max:100',
                    'amount'         => 'nullable|numeric',
                    'condition'      => 'required|in:used,new',
                    'price_type'     => 'required|in:amount,free,contact_for_sale,swap_trade',
                    'description'    => 'required|string|min:20|max:1000',
                    'category_id'    => 'required|numeric',
                    'sub_category_id'=> 'nullable|numeric',
                    // 'sub_sub_category_id'=> '',
                ]);

                break;
            case 2:
                $validator = Validator::make($request->all(), [
                    'images'   => 'required|array|max:10',
                    'images.*' => 'image|mimes:jpg,jpeg,png,webp,svg|max:2048',
                ]);
                break;
            case 3:
                $validator = Validator::make($request->all(), [
                    'name'         => 'required|string|min:2|max:100',
                    'email'        => 'required|email|max:100',
                    'city'         => 'required|string|min:2|max:100',
                    'locality'     => 'required|string|min:20|max:200',
                    'mobile_number'=> 'required|numeric|digits_between:8,15',
                ]);
                break;
            case 4:
                $validator = Validator::make($request->all(), [
                    'meta_title'         => 'required|string|min:2|max:100',
                    'meta_description'   => 'required|string|max:500',
                ]);
                break;
        }

        /*
        $rules =[
            'category_id'     => 'required|numeric|exists:categories,id',
            'sub_category_id' => 'nullable|numeric|exists:categories,id',

            # 1 form 
            'title'      => 'required|string|min:2|max:100',
            'amount'     => 'nullable|numeric',
            'services'   => 'required',
            'condition'  => 'required|in:used,new',
            'price_type' => 'required|in:amount,free,contact_for_sale,swap_trade',
            'description'=> 'required|string|min:20|max:1000',

            # 2 form
            'images'   => 'required|array|max:10',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp,svg|max:2048',
    
            # 3 form
            'name'         => 'required|string|min:2|max:100',
            'email'        => 'required|email|max:100',
            'city'         => 'required|string|min:2|max:100',
            'locality'     => 'required|string|min:20|max:200',
            'mobile_number'=> 'required|numeric|digits_between:8,15',
        ];

        if ($request->price_type === "amount") {
            $rules['amount'] = 'required|numeric';
        }
        */

        // $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if($step == 1)
        {
            $listing->fill($request->only([
                'title', 'amount', 'condition', 'price_type', 'description',
                'category_id', 'sub_category_id'
            ]));

            $listing->slug = Str::slug($request->title, '-');
        }
        elseif($step == 2)
        {
            if ($request->hasFile('images'))
            {
                $imagePaths     = uploadImages('uploads/marketplace/images', $request->file('images'));
                $data['images'] = json_encode($imagePaths);
            }
        }
        elseif($step == 3)
        {
            $listing->fill($request->only([
                'name', 'email', 'city', 'locality', 'mobile_number'
            ]));
        }
        elseif($step == 4)
        {
            $listing->fill($request->only([
                'meta_title', 'meta_description'
            ]));
        }

        if($listing->save())
        {
            return response()->json([
                'id'     => $listing->id,
                'success'=> true,
                'message'=> 'Marketplace Post ' . ( ($step > 1) ? 'updated' : 'created' ) . ' successfully.',
            ], 201); 
        }
        else
        {
            return response()->json([
                'success'=> false,
                'message'=> 'Somthing went wrong, Please try again later !',
            ], 503); 
        }

        /*
        try {
            $data         = $request->all();
            $slug         = Str::slug($request->title, '-');
            $data['slug'] = $slug;

            // images
            if ($request->hasFile('images'))
            {
                $imagePaths = uploadImages('uploads/marketplace/images', $request->file('images'));
                $data['images'] = json_encode($imagePaths);
            }

            MarketPlace::create($data);

            return response()->json([
                'success'=> true,
                'message'=> 'Post create successfully.',
            ], 201); 
        }

        catch(Exception $e) {
            return response()->json([
                'success'=> false,
                'message'=> 'Somthing went wrong, Please try again later!',
            ], 503); 
        }
        */

    }
}