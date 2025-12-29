<?php
/**
 * Address Guru's User API's Controller
 *
 * Handles API requests for Address Guru's User data
 *
 * PHP version 7.4
 *
 * LICENSE: This source file is private software of Address Guru. No one
 * is allowed to copy, delete, change, distribute this file or data without 
 * a written permission from the Director of Address Guru.
 *
 * @category   Application Route Controller
 * @package    MarketController
 * @author     Robin Tomar <robintomr@icloud.com>
 * @author     Jatin Jangra <jatinjangra10@rediffmail.com>
 * @copyright  2020-2022 Address Guru
 */
namespace App\Http\Controllers\API;
use App\Insightp;
use App\AllViews;
use App\AllWebViews;
use App\AllCalls;
use App\Query;
use App\User;
use App\Product;
use App\Category;
use App\Personal;
use App\Coaching;
use App\Mcategory;
use App\Helpers\StaticData;
use App\Helpers\API\Assistant;
use App\Rating;
use App\lapp;
use App\SEO;
use App\Jobs;
use App\Media;
use App\Notification;
use App\Views;
use App\Clock;
use Carbon\Carbon;
use App\{listing,Job,MarketPlace,Property};
use App\BusinessType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    /**
     * Method to throw details of Authenticated User
     * 
     * @param NULL
     * @author Robin Tomar <robintomr@icloud.com>
     * @return PHP Object
     */
    public function authUser()
    {
        return response(['user'=> auth()->user()]);
    }
    /**
     * Method to throw Listings of Authenticated User
     * 
     * @param NULL
     * @author Robin Tomar <robintomr@icloud.com>
     * @author Jatin Jangra <jatinjangra10@rediffmail.com>
     * @return array
     */
public function listings()
{
    $listings = [];
    $response = [];
    // Initialize the query for Coaching records
    $records = Coaching::query();
    // Check if a category filter exists and apply it, otherwise exclude category 42
    if (request()->has('category_id')) {
        $records->where('category_id', request()->category_id);
    } else {
        $records->where('category_id', '!=', '42');
    }
    // Filter by authenticated user's records
    $records->with('category')->where('user_id', auth()->id());
    // Optionally load relationships
    // $records->with('clocks', 'views', 'calls', 'queries', 'ratings', 'webviews', 'category:id, name, colors, icon', 'subcategory:id, name', 'package:id, name, price, type');
    // Order by descending id and paginate the results
    $records = $records->orderby('id', 'DESC')->paginate(20);
    // Iterate over the paginated records
    foreach ($records as $record) {
        $tmp = clone $record;
        // Remove specific fields from the cloned object
        unset($tmp->{'calls'}, $tmp->{'views'}, $tmp->{'webviews'});
        // Assign calls, views, and web_views values
        $tmp->calls     = $record->calls->business_calls ?? 0;
        $tmp->views     = $record->viewss->business_views ?? 0;
        $tmp->web_views = $record->webviews->business_web_views ?? 0;
        // Determine status based on post_status and status
        if ($record->post_status == 1 && $record->status == 1) {
            $tmp->status = 2; // accept
        } elseif ($record->post_status == 2 && $record->status == 0) {
            $tmp->status = 3; // rejected
        } elseif ($record->post_status == 3 && $record->status == 0) {
            $tmp->status = 3; // rejected
        } elseif ($record->post_status == 4 && $record->status == 0) {
            $tmp->status = 4; // rejected
        } elseif ($record->post_status == 1 && $record->status == 0) {
            $tmp->status = 1; // rejected
        } else {
            $tmp->status = 0; // default status
        }
        // Add the payment, facility, photo, and posted_at fields to each listing
        $tmp->payment   = json_decode($record->payment, true);
        $tmp->facility  = json_decode($record->facility, true);
        $tmp->photo     = explode(',', 'https://addressguru.sg/images/' . $record->photo);
        $tmp->posted_at = Carbon::parse($record->created_at)->format('d M, Y');
        // Add the processed record to the listings array
        $listings[] = $tmp;
    }
    // Prepare the response with necessary data
    if ($records->count() > 0) {
        // Pagination info
        $response['total']        = $records->total();
        $response['current_page'] = $records->currentPage();
        $response['data']         = $listings;
    }
    // Return the final JSON response
    return response()->json([
        'code' => 200,
        'error' => false,
        'message' => "success",
        'result' => $response,
        'status' => true
    ]);
}
    /**
     * Method to throw Posts of Authenticated User
     * 
     * @param NULL
     * @author Robin Tomar <robintomr@icloud.com>
     * @author Jatin Jangra <jatinjangra10@rediffmail.com>
     * @return array
     */
    public function posts()
    {
        $uid      = auth()->id();
        $type     = request()->get('type');
        $type     = ( $type && in_array($type, ['listing', 'product', 'job', 'home-service', 'real-estate']) ) ? $type : NULL;
        $posts    = [];
        $records  = Coaching::where('user_id', '=', auth()->user()->id)
            ->with('views', 'calls', 'queries')
            ->where('status', '=', 1)->get();
        if($type)
        {
            if($type == 'listing')
            {
                return $this->assistant->getListings($uid);
                $records = DB::select(
                    'SELECT
                        `c`.`id`,
                        `c`.`ip`,
                        `c`.`lat`,
                        `c`.`lng`,
                        `c`.`map`,
                        `c`.`ifsc`,
                        `c`.`web_link` AS `url`,
                        `c`.`photo` AS `img`,
                        `c`.`paid`,
                        NULL AS `plan`,
                        `c`.`area`,
                        `c`.`rent`,
                        `c`.`slug`,
                        NULL AS `calls`,
                        `c`.`floor`,
                        `c`.`business_name` AS `title`,
                        NULL AS `views`,
                        NULL AS `mkeys`,
                        NULL AS `mdesc`,
                        `c`.`h_star`,
                        `c`.`r_type`,
                        NULL AS `images`,
                        `c`.`ad_description` AS `content`,
                        NULL AS `contact`,
                        `c`.`course` AS `courses`,
                        `c`.`payment`,
                        NULL AS `reviews`,
                        `c`.`only_for`,
                        `c`.`service` AS `services`,
                        `c`.`bathroom`,
                        `c`.`furnished`,
                        `c`.`facility` AS `facilities`,
                        `c`.`category_id`,
                        `c`.`created_at`,
                        `c`.`updated_at`,
                        `v`.`views`,
                        (
                            SELECT
                                `call`
                            FROM
                                `calls`
                            WHERE
                                `post_id` = `c`.`id`
                        ) AS `calls`
                    FROM
                        `coachings` `c`
                    LEFT JOIN `views` `v` ON
                        `v`.`post_id` = `c`.`id`
                    WHERE
                        `c`.`user_id` = ? AND
                        `c`.`deleted_at` IS NULL
                    ORDER BY
                        `c`.`created_at`',
                    [$uid]
                );
                foreach($records as &$record)
                {
                    $record->date_posted  = Carbon::parse($record->created_at);
                    $record->date_updated = Carbon::parse($record->updated_at);
                    unset($record->created_at, $record->updated_at);
                }
                return $records;
            }
            elseif($type='product')
            {
                return $this->assistant->getProducts($uid);
            }
        }
        if(! empty($records))
        {
            foreach($records as $record)
            {
                $tmp = clone $record;
                unset($tmp->{'calls'}, $tmp->{'views'});
                if(isset($record->calls) && isset($record->calls->call))
                {
                    $tmp->calls = $record->calls->call;
                }
                if(isset($record->views) && isset($record->views->views))
                {
                    $tmp->views = $record->views->views;
                }
                $listings[] = $tmp;
            }
        }
        return $listings;
    }
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details()
    { 
        $leads = Query::where('user_id', '=', Auth::user()->id)->get();
        $m = array();
        foreach ($leads as $value) {
            $m[] = array(
                'name'        => $value->name,
                'email'       => $value->email,
                'phone_number'=> $value->ph_number,
                'message'     => $value->message,
                'post_name'   => isset($value->post) ? $value->post->business_name : 'Listing Deleted!'
            );
        }
        return response()->json(['success' => $m], $this-> successStatus);  
    }
    /**
     * Method to throw Enquiries for Authenticated User's Listings
     * 
     * @param NULL
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function enquiries($type,Request $request)
    {       
        $id = auth()->user()->id;
        $q = Query::query();
        $q->select('id','user_id','job_id','product_id','post_id','message as msg','name','email','ph_number as phone','created_at','exp','skills');
        if($type == 'JOB'){
            if($request->id){
                $q->where('job_id',$request->id);
            }
            $q->whereHas('job',function($query) {
                $query->whereNotNull('id')->where('user_id',auth()->user()->id);
            })->with('job')->whereNotNull('job_id');
        }elseif($type == 'BUSINESS'){
            if($request->id){
                $q->where('post_id',$request->id);
            }
            $q->whereHas('post', function($query){
                 $query->whereNotNull('id')->where('user_id',auth()->user()->id);;
            })->with('post')->whereNotNull('post_id');
        }elseif($type == 'MARKET'){
            if($request->id){
                $q->where('product_id',$request->id);
            }
             $q->whereHas('product', function($query){
                 $query->whereNotNull('id');
                $query->where('category_id','!=','1')->where('user_id',auth()->user()->id);
             })->with('product')->whereNotNull('product_id');
        }elseif($type == 'PROPERTIES'){
             if($request->id){
                $q->where('product_id',$request->id);
            }
             $q->whereHas('product', function($query){
                $query->whereNotNull('id');
                $query->where('category_id','1')->where('user_id',auth()->user()->id);
             })->with('product')->whereNotNull('product_id');
        }else{
            return "NOT FOUND";
        }
         $data = $q->orderby('id','DESC')->paginate(20);
        foreach($data->items() as $key => $d){
            if($type == 'JOB'){
                $d->title = $d->job->title ?? '';
                $d->company_website = $d->job->company_website ?? '';
                $d->address = ($d->job->locality ?? '').', '.($d->job->cityname->name ?? '').', '.($d->job->statename->name ?? '');
                unset($d->job);
            } 
            elseif($type == 'BUSINESS') {
                $d->title = $d->post->business_name ?? '';
                $d->company_website = $d->post->web_link ?? '';
                $d->address = ($d->post->business_address ?? '').','.($d->post->personals->city ?? '').', '.($d->post->statename->state ?? '');
                unset($d->post);
            }
            elseif($type == 'MARKET' || $type == 'PROPERTIES') {
                $d->title = $d->product->title ?? '';
                $d->company_website = $d->product->company_website ?? '';
                $d->address = ($d->product->locality ?? '').','.($d->product->city ?? '').', '.($d->product->state ?? '');
                unset($d->product);
            }
            else{
                $d->title = '';
            }
        }
        $response['total'] = $data->total();
        $response['current_page'] = $data->currentPage();
        $response['data'] = $data->items();
        return $this->success("success",$response,'200');
    }
    /**
     * Method to throw the enquiry
     * 
     * @param int $id The id of inquiry to send
     * $author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function enquiry()
    {
        $id = request()->get('id') ?? 0;
        $enquiry = Query::with('post', 'product')->find($id);
        if($enquiry)
        {
            return $enquiry;
        }
        return response()->json(['msg'=> 'Requested data not found.'], 404);
    }
    /**
     * Method to record lead for a Listing
     * 
     * @param Illuminate\Http\Request $request The incoming request
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function enquire(Request $request)
    {
        if($request->filled('prod_id'))
        {
            $product = Product::find($request->prod_id);
            $to      = $product->email;
            $body    = '<h3>Contact Details</h3>';
            $body   .= '<p><b>Name</b> '.$input['name'].'</p>';
            $body   .= '<p><b>Email</b> '.$input['email'].'</p>';
            $body   .= '<p><b>Phone</b> '.$input['ph_number'].'</p>';
            $body   .= '<p><b>Message</b> '.$input['message'].'</p>';
            $subject = "Query at " . $product->title . " | AddressGuru";
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
            $headers .= 'From: '.$input['name'].' <contact@addressguru.in>' . "\r\n";
            $headers .= 'Reply-To: '.$input['name'].' <contact@addressguru.in>' . "\r\n";
            $headers .= 'X-Mailer: PHP/' . phpversion();
            $mail = mail($to, $subject, $htmlContent, $headers);
        }
        else
        {
            $posts = Coaching::findOrFail($input['post_id']);
            $per   = Personal::where('post_id', '=', $input['post_id'])->first();
            $to          = $per->email;
            $subject     = "Query at ".$posts->business_name." | AddressGuru";
            $htmlContent = StaticData::getMailTemplate();
            $headers     = 'MIME-Version: 1.0' . "\r\n";
            $headers    .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
            $headers    .= 'From: '.$input['name'].' <contact@addressguru.in>' . "\r\n";
            $headers    .= 'Reply-To: '.$input['name'].' <contact@addressguru.in>' . "\r\n";
            $headers    .= 'X-Mailer: PHP/' . phpversion();
            $mail        = mail($to, $subject, $htmlContent, $headers);
        }
    }
    private function sendResponse($message, $data = null, $statusCode, $isSuccess = true)
    {
        // Check the params
        if(!$message) return response()->json(['message' => 'Message is required'], 500);
        // Send the response
        if($isSuccess)
        {
            return response()->json([
                'code'   => $statusCode,
                'error'  => false,
                'status' => true,
                'results'=> $data,
                'message'=> $message,
            ], $statusCode);
        }
        else
        {
            return response()->json([
                'code'   => $statusCode,
                'error'  => true,
                'status' => false,
                'message'=> $message,
            ], $statusCode);
        }
    }

    public function dashboard(){
        try{
            $userId = auth()->id();

            // 1️⃣ Count of all items posted by user
            $listingsCount   = Listing::where('user_id', $userId)->count();
            $jobsCount       = Job::where('user_id', $userId)->count();
            $productsCount   = Marketplace::where('user_id', $userId)->count();
            $propertiesCount = Property::where('user_id', $userId)->count();

            // Common model list for morph queries
            $models = [Listing::class, Job::class, Marketplace::class, Property::class];

             // 2️⃣ Total leads (queries on user items)
            $leadsCount = Query::whereHasMorph(
                'queryable',
                $models,
                function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                }
            )->count();

            // 3️⃣ Total reviews (ratings for items posted by user)
            $reviewsCount = Rating::whereHasMorph(
                'queryable',
                $models,
                function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                }
            )->count();

            // 4️⃣ Total views for all user items
            $totalViews = Views::whereHasMorph(
                'queryable',
                $models,
                function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                }
            )->sum('views');

            // 5️⃣ Total phone views
            $totalPhoneViews = Views::whereHasMorph(
                'queryable',
                $models,
                function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                }
            )->sum('phone_views');

            // 6️⃣ Total website views
            $totalWebsiteViews = Views::whereHasMorph(
                'queryable',
                $models,
                function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                }
            )->sum('website_views');

            // 7️⃣ Total WhatsApp views
            $totalWhatsappViews = Views::whereHasMorph(
                'queryable',
                $models,
                function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                }
            )->sum('whatsapp_views');

            // 🔥 Final return array
            $count = [
                'listings'  => $listingsCount,
                'jobs'      => $jobsCount,
                'products'  => $productsCount,
                'properties'=> $propertiesCount,
                'leads'     => $leadsCount,
                'reviews'   => $reviewsCount,
                'views'     => $totalViews,
                'calls'     => $totalPhoneViews,
                'website'   => $totalWebsiteViews,
                'whatsapp'  => $totalWhatsappViews,
            ];

            return response()->json([
                'success' => true, 
                'message' => 'count fetched successfully.',
                'data' => $count
            ],200);
        }catch(Exception $e){
            return response()->json([
                'success'  => false,
                'error' => $e->getMessages(),   
                'message' => 'Somthing went wrong, Please try again later !',
            ], 503); 
        }
    }

}