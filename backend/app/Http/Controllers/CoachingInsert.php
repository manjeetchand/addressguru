<?php

namespace App\Http\Controllers;

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
use App\SubCategory;
use App\Product;
use App\Views;
use App\User;
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
    private $_api_context;

    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function previewpost($slug)
    {
        $post = Product::where('slug', '=', $slug)->with('medias')->first();

        return view('market.show', compact('post'));
    }

    public function mcategory()
    {
        $cat = Mcategory::orderBy('id', 'ASC')->get();

        return view('market.post', compact('cat'));
    }

    public function mstepone($id)
    {
        $category = Msubcategory::findOrFail(Crypt::decrypt($id));

        return view('market.post.index', compact('category'));
    }

    public function msteponeedit($id)
    {
        $listing = Product::findOrFail(Crypt::decrypt($id));

        return view('market.post.edit', compact('listing', 'id'));
    }

    public function msteptwo($id)
    {
        $listing = Product::with('medias')->findOrFail(Crypt::decrypt($id));

        return view('market.post.steptwo', compact('listing', 'id'));
    }

    public function mstepthree($id)
    {
        $listing = Product::findOrFail(Crypt::decrypt($id));

        return view('market.post.stepthree', compact('listing', 'id'));
    }

    public function mstepfour($id)
    {
        $listing = Product::findOrFail(Crypt::decrypt($id));

        return view('market.post.stepfour', compact('listing', 'id'));
    }

    public function index()
    {
       $user = Auth::user();

       $personal = Personal::where('email', $user->email)->count();

       $cat = Category::with(['sub_categories' => function($subcategory){$subcategory->orderBy('name', 'ASC');}])->orderBy('name', 'ASC')->get();

        return view('admin.post.index', compact('user', 'personal', 'cat'));
    }

    public function mstore(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:20|max:100',
            'description' => 'required|min:50',
            'price' => 'required',
        ]);

        $input = $request->all();
        $idcat = Msubcategory::findOrFail($input['subcategory_id']);
        $post = Product::create([
            'condition' => $input['condition'],
            'title' => $this->stringsaafchahiye($input['title']),
            'description' => $this->stringsaafchahiye($input['description']),
            'price' => $input['price'],
            'amount' => $input['amount'],
            'user_id' => Auth::user()->id,
            'subcategory_id' => $idcat->id,
            'category_id' => $idcat->mcategory->id,
            'model' => $input['model'],
            'only_for' => $input['only_for'],
            'pro_by' => $input['pro_by'],
            'dob' => $input['dob'],
            'available' => $input['available'],
            'job_type' => $input['job_type'],
            'company_name' => $input['company_name'],
            'company_website' => $input['company_website'],
            'ea_number' => $input['ea_number'],
            'edu_level' => $input['edu_level'],
            'cc' => $input['cc'],
            'fuel_type' => $input['fuel_type'],
            'year' => $input['year'],
            'km' => $input['km'],
            'trans' => $input['trans'],
            'color' => $input['color'],
            'share' => $input['share'],
            'dwelling' => $input['dwelling'],
            'size' => $input['size'],
            'bedroom' => $input['bedroom'],
            'bathroom' => $input['bathroom'],
            'smoking' => $input['smoking'],
            'pet' => $input['pet'],
            'gender' => $input['gender'],
            'cea' => $input['cea'],
            'parking' => $input['parking'],
        ]);

        return redirect()->to('sell-step-two/'.Crypt::encrypt($post->id));
    }

    public function mupdate(Request $request, $id)
    {
   
        $input = $request->all();
        $post = Product::findOrFail(Crypt::decrypt($id));
        if (request()->has('condition')) 
        {
            $this->validate($request, [
                'title' => 'required|min:20|max:100',
                'description' => 'required|min:50',
                'price' => 'required',
            ]);

            $post->update([

                'condition' => $input['condition'],
                'title' => $this->stringsaafchahiye($input['title']),
                'description' => $this->stringsaafchahiye($input['description']),
                'price' => $input['price'],
                'amount' => $input['amount'],
                'model' => $input['model'],
                'only_for' => $input['only_for'],
                'pro_by' => $input['pro_by'],
                'dob' => $input['dob'],
                'available' => $input['available'],
                'job_type' => $input['job_type'],
                'company_name' => $input['company_name'],
                'company_website' => $input['company_website'],
                'ea_number' => $input['ea_number'],
                'edu_level' => $input['edu_level'],
                'cc' => $input['cc'],
                'fuel_type' => $input['fuel_type'],
                'year' => $input['year'],
                'km' => $input['km'],
                'trans' => $input['trans'],
                'color' => $input['color'],
                'share' => $input['share'],
                'dwelling' => $input['dwelling'],
                'size' => $input['size'],
                'bedroom' => $input['bedroom'],
                'bathroom' => $input['bathroom'],
                'smoking' => $input['smoking'],
                'pet' => $input['pet'],
                'gender' => $input['gender'],
                'cea' => $input['cea'],
                'parking' => $input['parking'],
            ]);

            if (Auth::user()->role->name == "User") 
            {
                $post->update(['status'=>0]);
            }


            return redirect()->to('sell-step-two/'.$id);
        }
        elseif (request()->has('media')) 
        {
   
            $me = Media::where('product_id', '=', $post->id)->count();

            if ($me == 0) 
            {
                Session::flash('no', 'Please Upload Image First!');

                return redirect()->back();
            }
            else
            {
                return redirect()->to('sell-step-three/'.$id);
            }

            if (Auth::user()->role->name == "User") 
            {
                $post->update(['status'=>0]);
            }
        }
        elseif (request()->has('product_id')) 
        {
            $this->validate($request, [
                'file' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            ]);

            $input = $request->all();

            $file = $request->file('file');

            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);

            Media::create(['name' => $name, 'product_id' => $post->id]);

            if (Auth::user()->role->name == "User") 
            {
                $post->update(['status'=>0]);
            }
            return redirect()->back();
        }
        elseif (request()->has('contact')) 
        {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'state' => 'required',
                'city' => 'required',
                'locality' => 'required',
                'phone' => 'required',
            ]);

            if (Auth::user()->role->name == "User") 
            {
                $email = Auth::user()->email;
            }
            else
            {
                $email = $input['email'];
            }

            $post->update([
                'name' => $input['name'],
                'email' => $email,
                'state' => $input['state'],
                'city' => $input['city'],
                'locality' => $input['locality'],
                'phone' => $input['phone'],
            ]);

            if (Auth::user()->role->name == "User") 
            {
                $post->update(['status'=>0]);
            }

            return redirect()->to('sell-step-four/'.$id);
        }
        elseif (request()->has('payment')) 
        {
         
            if ($input['amount'] == 0) 
            {
                $post->update(['post_status'=>1]);

                if (Auth::user()->role->name == "Admin") 
                {
                    Session::flash('insert', 'Successfully Submitted');

                    return redirect()->to('ads-approval-request');
                }
                elseif(Auth::user()->role->name == "Agent")
                {
                    Session::flash('insert', 'Successfully Submitted | Ad will be live after review!');

                    return redirect()->to('Partner Dashboard');
                }
                else
                {
                    Session::flash('insert', 'Successfully Submitted | Ad will be live after review!');

                    return redirect()->route('Dashboard.index');
                }                
            }
            elseif ($input['amount'] == 1) 
            {
                $amount1 = env('first_price');
                $description = "Payment for Highlight Ad"; 
            }
            elseif ($input['amount'] == 2) 
            {
                $amount1 = env('second_price');
                $description = "Payment for Featured Ad"; 
            }
            elseif ($input['amount'] == 3) 
            {
                $amount1 = env('third_price');
                $description = "Payment for Featured Ad"; 
            }
            elseif ($input['amount'] == 4) 
            {
                $amount1 = env('four_price');
                $description = "Payment for Top Ad"; 
            }
            elseif ($input['amount'] == 5) 
            {
                $amount1 = env('five_price');
                $description = "Payment for Top Ad"; 
            }
            else
            {
                Session::flash('no', 'Invalid Attempt');

                return redirect()->back();
            }

            $payer = new Payer();
            $payer->setPaymentMethod('paypal');

            $item_1 = new Item();

            $item_1->setName('Item 1') /** item name **/
                ->setCurrency('SGD')
                ->setQuantity(1)
                ->setPrice($amount1); /** unit price **/

            $item_list = new ItemList();
            $item_list->setItems(array($item_1));

            $amount = new Amount();
            $amount->setCurrency('SGD')
                ->setTotal($amount1);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription($description);

            $redirect_urls = new RedirectUrls();
            $redirect_urls->setReturnUrl(URL::to('payment-success/'.Crypt::encrypt($post->id).'')) /** Specify return URL **/
                ->setCancelUrl(URL::to('payment-success/'.Crypt::encrypt($post->id).''));

            $payment = new Payment();
            $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/
            try {

                $payment->create($this->_api_context);

            } catch (\PayPal\Exception\PPConnectionException $ex) {

                if (\Config::get('app.debug')) {

                    \Session::put('no', 'Connection timeout');
                    return Redirect::to('sell-step-four/'.Crypt::encrypt($post->id).'');

                } else {

                    \Session::put('no', 'Some error occur, sorry for inconvenient');
                    return Redirect::to('sell-step-four/'.Crypt::encrypt($post->id).'');

                }

            }

            foreach ($payment->getLinks() as $link) {

                if ($link->getRel() == 'approval_url') {

                    $redirect_url = $link->getHref();
                    break;

                }

            }

            /** add payment ID to session **/
            Session::put('paypal_payment_id', $payment->getId());
            Session::put('paypal_amount', $amount);


            if (isset($redirect_url)) {

                /** redirect to paypal **/
                return Redirect::away($redirect_url);

            }

            \Session::put('no', 'Unknown error occurred');
            return Redirect::to('sell-step-four/'.Crypt::encrypt($post->id).'');
        }      
    }

    public function success($id)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        $amount = Session::get('paypal_amount');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            \Session::put('no', 'Payment failed');
            return Redirect::to('sell-step-four/'.$id.'');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            \Session::put('success', 'Payment success');

            DB::insert('insert into payments (user_id, product_id, amount, payment_id, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [Auth::user()->id, Crypt::decrypt($id), $amount, $payment_id, NOW(), NOW()]);  

            Session::forget('paypal_amount');

            return Redirect::to('success-product/'.Crypt::encrypt($id).'');

        }

        \Session::put('no', 'Payment failed');
        return Redirect::to('sell-step-four/'.$id.'');
    }

    public function successdone($id)
    {
        $pro = Product::findOrFail(Crypt::decrypt($id));

        return view('market.post.thanku', compact('pro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = $request->all();

        $sub = Msubcategory::where('category_id', '=', $input['id'])->orderBy('name', 'ASC')->get();

        echo "<ul>";
            foreach ($sub as $value) 
            {
                echo "<a href=".url('sell-step-one', Crypt::encrypt($value->id))."><li><i class='".$value->icon." fa-fw' style='color:".$value->colors."'></i> ".$value->name."</li></a>";
            }
        echo "</ul>";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoachingRequest $request)
    {
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

        $lis = Coaching::create([
            'user_id'          => Auth::user()->id,
            'category_id'      => $category,
            'subcategory_id'   => $subcategory,
            'business_name'    => $this->stringsaafchahiye($input['business_name']),
            'business_address' => $this->stringsaafchahiye($input['business_address']),
            'ad_description'   => $this->stringsaafchahiye($input['ad_description']),
            'payment'          => json_encode($input['payment']),
            'course'           => json_encode($input['course']),
            'facility'         => json_encode($input['facility']),
            'service'          => json_encode($input['service']),
            'h_star'           => $input['h_star'],
            'r_type'           => $input['r_type'],
            'floor'            => $input['floor'],
            'area'             => $input['area'],
            'furnished'        => $input['furnished'],
            'bathroom'         => $input['bathroom'],
            'religion_view'    => $input['religion_view'],
            'only_for'         => $input['only_for'],
            'rent'             => $input['rent'],
            'ifsc'             => $input['ifsc'],
            'ip'               => \Request::ip(),
            'list_by'          => $input['list_by'],
            'pet_friend'       => $input['pet_friend'],
            'bedroom'          => $input['bedroom'],
            'facing'           => $input['facing'],
            'dwelling'         => $input['dwelling'],
            'job_category'     => $input['job_category'],

        ]);

        Views::create(['post_id' => $lis->id]);

        lapp::create(['coaching_id'=>$lis->id, 'user_id'=>0]);

        if (Auth::user()->role->name == 'Agent')
        {
            Personal::create([

                'post_id'    => $lis->id,
                'user_id'    => Auth::user()->id,
                'category_id'=> $category,
                'subcategory_id'=> $subcategory,
                'agent'      => 1,
                'is_active'  => 0,

            ]);
        }
        else
        {
            Personal::create([

                'post_id'    => $lis->id,
                'user_id'    => Auth::user()->id,
                'category_id'=> $category,
                'subcategory_id'=> $subcategory,
                'agent'      => 0,
                'is_active'  => 1,

            ]);
        }
      
        return redirect()->to('step-two/'.Crypt::encrypt($lis->id));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Media::findOrFail($id)->delete();

        Session::flash('insert', 'Successfully Deleted!');

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $listing = Coaching::findOrFail(Crypt::decrypt($id));

        return view('admin.post.edit', compact('listing', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $ids = Crypt::decrypt($id);

        $list = Coaching::findOrFail($ids);

        if (request()->has('business_name')) 
        {
            $this->validate($request, [
                'business_name' => 'required|max:100',
                'business_address' => 'required',
                'ad_description' => 'required|max:2500|min:200',
            ]);

            $list->update([
                
                'business_name'    => $this->stringsaafchahiye($input['business_name']),
                'business_address' => $this->stringsaafchahiye($input['business_address']),
                'ad_description'   => $this->stringsaafchahiye($input['ad_description']),
                'payment'          => json_encode($input['payment']),
                'course'           => json_encode($input['course']),
                'facility'         => json_encode($input['facility']),
                'service'          => json_encode($input['service']),
                'h_star'           => $input['h_star'],
                'r_type'           => $input['r_type'],
                'floor'            => $input['floor'],
                'area'             => $input['area'],
                'furnished'        => $input['furnished'],
                'bathroom'         => $input['bathroom'],
                'religion_view'    => $input['religion_view'],
                'only_for'         => $input['only_for'],
                'rent'             => $input['rent'],
                'ifsc'             => $input['ifsc'],
                'list_by'          => $input['list_by'],
                'pet_friend'       => $input['pet_friend'],
                'bedroom'          => $input['bedroom'],
                'facing'           => $input['facing'],
                'dwelling'         => $input['dwelling'],
                'job_category'     => $input['job_category'],

            ]);

            return redirect()->to('step-two/'.$id);
        }
        elseif (request()->has('social')) 
        {
            $this->validate($request, [
                'image' => 'image|mimes:jpeg,png,jpg|max:2000',
            ]);

            if ($file = $request->file('image')) 
            {
                $name = rand() . '.' . $file->getClientOriginalExtension();

                $file->move('images', $name);

            }
            else
            {

                $name = $list->photo;
            }

            $list->update([

                'web_link' => $input['web_link'],
                'video' => $input['video'],
                'photo' => $name,
                'map' => $input['map'],
            ]);

            if (Auth::user()->role->name != 'Admin' OR Auth::user()->role->name != "Editor") 
            {
                $list->update(['status'=>0]);
                Personal::where('post_id', '=', $ids)->update(['status'=>0]);
            }

            return redirect()->to('step-three/'.$id);
        }
        elseif (request()->has('contact')) 
        {
            $this->validate($request, [
                'name' => 'required',
                'ph_number' => 'required',
                'state' => 'required',
                'city' => 'required',
                'location' => 'required',
                'email' => 'required|email',
            ]);

            Personal::where('post_id', '=', $ids)->update([

                'name' => $input['name'],
                'ph_number' => $input['ph_number'],
                'ph_number1' => $input['ph_number1'],
                'state' => $input['state'],
                'city' => $input['city'],
                'location' => $input['location'],
                'email' => $input['email']
            ]);

            if (Auth::user()->role->name != 'Admin' OR Auth::user()->role->name != "Editor") 
            {
                $list->update(['status'=>0]);
                Personal::where('post_id', '=', $ids)->update(['status'=>0]);
            }

            return redirect()->to('step-five/'.$id);
        }
        elseif (request()->has('khatam_karo')) 
        {
            $photo = Media::where('post_id', '=', $ids)->count();

            if ($photo == 0) 
            {
                Session::flash('no', 'First Upload Slider Images!');

                return redirect()->back();
            }

            $list->update(['post_status'=>1]);

            $email = Personal::where('post_id', '=', $ids)->first();

            $email->update(['post_status'=>1]);

            $to = $email->email;
                $subject = "Thankyou for listing with AddressGuru";
                $htmlContent = "
               <div style='margin:auto;width:1000px;'>
                <div style='background-color:#FFE1CC;padding:40px 15px 40px 15px;'>
                <h1 style='color:#FE6E04;font-size:24px;'><b>Thankyou for listing with AddressGuru</b></h1><hr/>
                <p style='font-family:arial;'><b>".$list->business_name."</b> will be approved soon!</p>
        
                <center><img src='".url('/')."/images/logopng.png' style='width:150px;'></center>
                </div>
                </div>
              ";
            $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type:text/html;charset=UTF-8' . "\r\n" .
            'From: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
            'Reply-To: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $htmlContent, $headers);

            if (Auth::user()->role->name == 'Agent') 
            {
                $rand = rand(10, 1000000);
                $per = Personal::where('post_id', '=', $ids)->first();
                
                $to = $per->email;
                $subject = "Approval request for ".$per->post->business_name." | AddressGuru";
                $htmlContent = "
               <div style='margin:auto;width:1000px;'>
                <div style='background-color:#F3F3F3;padding:40px 15px 40px 15px;'>
                    <h1 style='color:red;font-size:24px;'><b>Approval request for <b>".$per->post->business_name."</b> | AddressGuru.</b></h1><hr/><br/>
                    <span style='font-family:arial;color:#645d5d;'>
                        Hi, ".$per->name."<br/><br/>
                        Your business has been listed with AddressGuru by ".$per->user->name."<br/>
                        preview link: <a href='".url('/', $per->post->slug)."'>".$per->post->business_name."</a><br/><br/><br/><br/>
                        <center><a href='".url('approve-listing', base64_encode($per->post_id))."' style='padding:6px 20px 6px 20px;background-color:green;color:#fff;border-radius:4px;text-decoration:none;font-size:14px;'> Approve</a> &nbsp;&nbsp; <a href='".url('dis-approve-listing', base64_encode($per->post_id))."' style='padding:6px 20px 6px 20px;background-color:red;color:#fff;border-radius:4px;text-decoration:none;font-size:14px;'> Dis-Approve</a></center>
 
                            <br/><br/><br/>
                            Thank you!<br/>
                            <b>AddressGuru</b>

                    </span><br/><br/>
                    
                    <center><img src='https://www.addressguru.in/images/logopng.png' style='width:150px;'></center>
                </div>
            </div>
              ";
              $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type:text/html;charset=UTF-8' . "\r\n" .
            'From: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
            'Reply-To: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $htmlContent, $headers);

            $per->update([

                'verify'     => $rand,
                
            ]);

            }

            return redirect()->to('step-six/'.$id);
        }
        elseif (request()->has('payment')) 
        {
          return redirect()->to('thankyou/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function post(request $request)
    // {

    //     $data= $request->id;

    //     return view('admin.post.test', compact('data'));

    // }

    public function steptwo($id)
    {
      $listing = Coaching::findOrFail(Crypt::decrypt($id));

      return view('admin.post.steptwo', compact('listing', 'id'));
    }

    public function stepthree($id)
    {
      $listing = Coaching::findOrFail(Crypt::decrypt($id));

      $user = Auth::user();

      $personals = Personal::where('post_id', '=', Crypt::decrypt($id))->get()->first();

      return view('admin.post.stepthree', compact('listing', 'id', 'user', 'personals'));
    }

    public function stepfour($id)
    {
      $listing = Coaching::findOrFail(Crypt::decrypt($id));

      $seo = SEO::where('post_id', '=', Crypt::decrypt($id))->first();

      return view('admin.post.stepfour', compact('listing', 'id', 'seo'));
    }

    public function stepfive($id)
    {
      $listing = Coaching::findOrFail(Crypt::decrypt($id));

      $photo = Media::where('post_id', '=', Crypt::decrypt($id))->get();

      return view('admin.post.stepfive', compact('listing', 'id', 'photo'));
    }

    public function stepsix($id)
    {
      $listing = Coaching::findOrFail(Crypt::decrypt($id));

      $per = Personal::where('post_id', '=', Crypt::decrypt($id))->first();

      return view('admin.post.stepsix', compact('listing', 'id', 'per'));
    }

    public function thankyou($id)
    {
        $listing = Category::with('facilities','services')->findOrFail(Crypt::decrypt($id));

        return view('admin.post.thanku', compact('listing'));
    }

    public function category($id)
    {
        $id = Crypt::decrypt($id);
        $category = Category::with('facilities','services')->findOrFail($id);
        $paymentMode = PaymentMode::orderBy('name','asc')->get();
        
        return view('admin.post.posting', compact('category', 'id','paymentMode'));
    }

    public function subcategory($id)
    {
        $subcategory = SubCategory::findOrFail(Crypt::decrypt($id));

        $id = $subcategory->category->id;

        return view('admin.post.posting', compact('subcategory', 'id'));
    }

    public function media(Request $request)
    {
        $input = $request->all();

        $data = $request->image;        

        list($type, $data) = explode(';', $data);

        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);

        $image_name= time().'.png';

        $path = "images/" . $image_name;

        Media::create(['name'=>$image_name, 'post_id'=>$input['id']]);

        file_put_contents($path, $data);

        Session::flash('insert', 'Successfully Uploaded');

        return response()->json(['success'=>'done']);
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

}


//  elseif (request()->has('description')) 
//         {
//             $this->validate($request, [
//                 'description' => 'required',
//                 'keywords' => 'required',
//             ]);

//             $se = SEO::where('post_id', '=', $ids)->count();

//             if ($se == 0) 
//             {
//                 SEO::create([

//                     'user_id' => Auth::user()->id,
//                     'post_id' => $ids,
//                     's_description' => $input['description'],
//                     'keywords' => $input['keywords'],
//                 ]);
//             }
//             else
//             {
//                 SEO::where('post_id', '=', $ids)->update([

//                     's_description' => $input['description'],
//                     'keywords' => $input['keywords'],
//                 ]);
//             }

//             if (Auth::user()->role->name != 'Admin' OR Auth::user()->role->name != "Editor") 
//             {
//                 $list->update(['status'=>0]);
//                 Personal::where('post_id', '=', $ids)->update(['status'=>0]);
//             }

//             return redirect()->to('step-five/'.$id);

//         }