<?php
/**
 * Address Guru's General Business General API's Controller
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
use Illuminate\Http\Request;
use App\Views;
use App\Personal;
use App\PaymentMode;
use App\Coaching;
use App\Rating;
use App\Report;
use App\Claim;
use App\Query;


use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    /**
     * 
     */
    public function cities()
    {
        $return = [];
        $cities = Personal::distinct('city')->orderBy('city')->get(['city']);

        foreach($cities as $city)
        {
            if(!empty($city->city))
            {
                $return[] = $city->city;
            }
        }

        return $return;
    }


    /**
     * 
     */
    public function states()
    {
        $return = [];
        $states = Personal::distinct('state')->orderBy('state')->get(['state']);

        foreach($states as $state)
        {
            if(!empty($state->state))
            {
                $return[] = $state->state;
            }
        }

        return $return;
    }


    /**
     *
     */
    public function recentListings()
    {
        $listings = Coaching::with('personals','category')->where('status', '=', 1)->orderBy('id', 'DESC')->limit(21)->get();

        return $listings;
    }

    /**
     * 
     */
    public function mostViewedListings()
    {
        $views = Views::with('coaching')->where('views', '!=', 0)->orderBy('views', 'DESC')->limit(10)->get();

        $listings = [];

        foreach($views as $view)
        {
            $view->coaching->views = $view->views;

            $listings[] = $view->coaching;
        }

        return $listings;
    }
    
    public function paymentMode(){
        $result = PaymentMode::orderBy('name','asc')->get();
        return response()->json([
            'msg' => 'ok',
            'result' => $result,
        ],200);
    }
    
    public function ratingSave(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'type' => 'required|in:business,property,job,product',
            'post_id' => 'required',
            'rating' => 'required|numeric|min:1|max:5', // Assume ratings range from 1 to 5
            'name' => 'required|string|max:255',
            'rating_email' => 'required|email|max:255',
            'message' => 'required|string|min:20|max:100',
        ]);
    
        try {
            // Create a new Rating instance
            $rating = new Rating();
    
            // Map the type to the corresponding field dynamically
            $typeFieldMap = [
                'business' => 'post_id',
                'property' => 'property_id',
                'job' => 'job_id',
                'product' => 'post_id',
            ];
    
            $field = $typeFieldMap[$validatedData['type']] ?? null;
            if ($field) {
                $rating->{$field} = $validatedData['post_id'];
            }
    
            // Assign remaining data to the model
            $rating->name = $validatedData['name'];
            $rating->rating_email = $validatedData['rating_email'];
            $rating->rating = $validatedData['rating'];
            $rating->message = $validatedData['message'];
    
            // Save the rating
            $rating->save();
    
            // Return success response
            return response()->json([
                'code' => 201,
                'error' => false,
                'status' => true,
                'message' => 'Rating added successfully!',
            ], 201);
    
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'code' => 500,
                'error' => true,
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    
    public function claimSave(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'type' => 'required|in:business,property,job,product',
            'post_id' => 'required',
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|numeric',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:20|max:100',
        ]);
    
        try {
            // Create a new Rating instance
            $rating = new Claim();
            // Map the type to the corresponding field dynamically
            $typeFieldMap = [
                'business' => 'post_id',
                'property' => 'property_id',
                'job' => 'job_id',
                'product' => 'post_id',
            ];
    
            $field = $typeFieldMap[$validatedData['type']] ?? null;
            if ($field) {
                $rating->{$field} = $validatedData['post_id'];
            }
    
            // Assign remaining data to the model
            $rating->name = $validatedData['name'];
            $rating->email = $validatedData['email'];
            $rating->mobile_number = $validatedData['mobile_number'];
            $rating->message = $validatedData['message'];
    
            // Save the rating
            $rating->save();
    
            // Return success response
            return response()->json([
                'code' => 201,
                'error' => false,
                'status' => true,
                'message' => 'Claim added successfully!',
            ], 201);
    
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'code' => 500,
                'error' => true,
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
    
    
  public function Report(Request $request)
    {
        // Initial validation
        $validatedData = $request->validate([
            'type' => 'required|in:business,property,job,product',
            'post_id' => 'required',
            'report' => 'required|string',
            'email' => 'required|email|max:255',
        ]);
    
        // Additional validation if the report type is "Other"
        if ($request->report === 'Other') {
            $request->validate([
                'message' => 'required|string|min:20|max:100',
            ]);
        }
    
        try {
            // Create a new Report instance
            $report = new Report();
    
            // Map the type to the corresponding field dynamically
            $typeFieldMap = [
                'business' => 'post_id',
                'property' => 'property_id',
                'job' => 'job_id',
                'product' => 'post_id',
            ];
    
            $field = $typeFieldMap[$validatedData['type']] ?? null;
            if ($field) {
                $report->{$field} = $validatedData['post_id'];
            }
    
            // Assign other attributes
            $report->report = $validatedData['report'];
            $report->email = $validatedData['email'];
    
            // Add the message only if it exists
            if ($request->report === 'Other' && $request->has('message')) {
                $report->msg = $request->message;
            }
    
            // Save the report
            $report->save();
    
            // Return success response
            return response()->json([
                'code' => 201,
                'error' => false,
                'status' => true,
                'message' => 'Report added successfully!',
            ], 201);
    
        } catch (\Exception $e) {
            // Return error response
            return response()->json([
                'code' => 500,
                'error' => true,
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }
    
   public function viewsPost(Request $request)
{
    $validatedData = $request->validate([
        'type' => 'required|in:business,property,job,product',
        'post_id' => 'required|integer',
        'count' => 'required|in:calls,views,website,whatshapp,email,sms',
    ]);

    try {
        // Map the type to the corresponding field dynamically
        $typeFieldMap = [
            'business' => 'post_id',
            'property' => 'property_id',
            'job' => 'job_id',
            'product' => 'post_id',
        ];

        $field = $typeFieldMap[$validatedData['type']] ?? null;

        if (!$field) {
            return response()->json([
                'code' => 400,
                'error' => true,
                'status' => false,
                'message' => 'Invalid type provided.',
            ], 400);
        }

        if ($validatedData['count'] === 'views') {
            // Get client IP address
            $clientIp = $request->ip();

            // Check if a record with the same IP and post exists within the last 24 hours
            $recentView = Views::where($field, $validatedData['post_id'])
                ->where('ip', $clientIp)
                ->where('created_at', '>=', now()->subDay())
                ->first();

            if ($recentView) {
                return response()->json([
                    'code' => 200,
                    'error' => false,
                    'status' => true,
                    'message' => 'View already counted within 24 hours.',
                ], 200);
            }

            // Check if a record for the post already exists
            $existingReport = Views::where($field, $validatedData['post_id'])->first();

            if ($existingReport) {
                // Increment the count for views
                $existingReport->increment('views');
            } else {
                // Create a new Views instance if no record exists
                $existingReport = new Views();
                $existingReport->{$field} = $validatedData['post_id'];
                $existingReport->views = 1; // Set the views count field to 1
            }

            // Save the IP address in the views table
            $existingReport->ip = $clientIp;
            $existingReport->save();
        } else {
            // Old logic for other count types
            $existingReport = Views::where($field, $validatedData['post_id'])->first();

            if ($existingReport) {
                // Increment the count for the specified field
                $existingReport->increment($validatedData['count']);
            } else {
                // Create a new Views instance if no record exists
                $report = new Views();
                $report->{$field} = $validatedData['post_id'];
                $report->{$validatedData['count']} = 1; // Set the count field to 1
                $report->save();
            }
        }

        return response()->json([
            'code' => 201,
            'error' => false,
            'status' => true,
            'message' => 'Report added/updated successfully!',
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'code' => 500,
            'error' => true,
            'status' => false,
            'message' => 'An error occurred: ' . $e->getMessage(),
        ], 500);
    }
}

    public function views(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'type' => 'required|in:business,property,job,product',
            'post_id' => 'required|integer',
        ]);
    
        try {
            // Define the field mapping based on the type
            $typeFieldMap = [
                'business' => 'post_id',
                'property' => 'property_id',
                'job' => 'job_id',
                'product' => 'product_id',
            ];
    
            // Get the appropriate field based on the type
            $field = $typeFieldMap[$validatedData['type']] ?? null;
    
            if (!$field) {
                return response()->json([
                    'code' => 400,
                    'error' => true,
                    'status' => false,
                    'message' => 'Invalid type provided.',
                ], 400);
            }
    
            // Query the Views table for matching records
            $data = Views::where($field, $validatedData['post_id'])->first();
    
            // Calculate related counts
            $ratingCount = Rating::where($field, $validatedData['post_id'])->count();
            $queryCount = Query::where($field, $validatedData['post_id'])->count();
    
            if ($data) {
                // Add dynamic attributes
                $data->setAttribute('rating', $ratingCount);
                $data->setAttribute('query', $queryCount);
    
                return response()->json([
                    'code' => 200,
                    'error' => false,
                    'status' => true,
                    'data' => $data,
                    'message' => 'Record found.',
                ], 200);
            } else {
                // No Views record found, return counts as null
                return response()->json([
                    'code' => 201,
                    'error' => false,
                    'status' => true,
                    'data' => [
                        'rating' => $ratingCount,
                        'query' => $queryCount,
                    ],
                    'message' => 'No record found.',
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => 500,
                'error' => true,
                'status' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }


        
        
    



}