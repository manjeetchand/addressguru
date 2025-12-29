<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Query;
use App\Personal;
use App\Coaching;
use App\SEO;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class smsquery extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $post = Coaching::findBySlugOrFail($slug);

        $seo = SEO::where('post_id', '=', $post->id)->get();

        return view('posts.profile', compact('post', 'seo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
           'g-recaptcha-response' => 'required|captcha',
           'phone' => 'max:10|min:10',
        ]);

        $input = $request->all();

        Query::create([
            'user_id' => 0,
            'post_id' => $input['post_id'],
            'name' => $input['name'],
            'ph_number' => $input['phone'],
            'email' => $input['email'],
            'message' => "no",
        ]);

        
        $per = Personal::where('post_id', '=', $input['post_id'])->first();

        $post = Coaching::findOrFail($input['post_id']);

        $to = $per->email;
        $subject = "Query at ".$post->business_name." | AddressGuru";
        $htmlContent = "
               <div style='margin:auto;width:1000px;'>
    <div style='background-color:#F3F3F3;padding:40px 15px 40px 15px;'>
        <h1 style='color:#FE6E04;font-size:24px;'><b>".$input['name']." interested in your business | ".$post->business_name."</b></h1><hr/>
        <h3 style='color:#282323;font-size:18px;'><b>Name:</b> <span style='color:#716969;font-size:18px;'>".$input['name']."</span></h3>
        <h3 style='color:#282323;font-size:18px;'><b>Email:</b> <span style='color:#716969;font-size:18px;'><a href='mailto:".$input['email']."' style='float:none!important;display:inline!important;'>".$input['email']."</a></span></h3>
        <h3 style='color:#282323;font-size:18px;'><b>Mobile Number:</b> <span style='color:#716969;font-size:18px;'>".$input['phone']."</span></h3><br/>
        <center><img src='http://www.addressguru.sg/images/logopng.png' style='width:150px;'></center>
    </div>
</div>
              ";
        $headers = 'MIME-Version: 1.0' . "\r\n" .
        'Content-type:text/html;charset=UTF-8' . "\r\n" .
        'From: '.$input['name'].' <'.env('EMAIL').'>' . "\r\n" .
          'Reply-To: '.$input['name'].' <'.env('EMAIL').'>' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
        $mail = mail($to, $subject, $htmlContent, $headers);
$msg =  
$post->business_name."
Contact person: ".$per->name."
Mobile Number: ".$per->ph_number."
Address: ".substr($post->business_address, 0, 35)."...
www.addressguru.in";

$msg1 = 
$input['name']." interested in your business ".$post->business_name."
Mobile Number: ".$input['phone']."
www.addressguru.in";

      $ch = curl_init();        
      curl_setopt_array($ch, array(            
      CURLOPT_URL =>  "http://mysms.educationmasters.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=6d128a6f7b32da9251257692e7911e&message=".urlencode($msg)."&senderId=ADRGUR&routeId=1&mobileNos=".$input['phone']."&smsContentType=english",        
      CURLOPT_RETURNTRANSFER => true,            
      CURLOPT_SSL_VERIFYHOST => 0,           
       CURLOPT_SSL_VERIFYPEER => 0            
      ));   
      //get response
            
      $output = curl_exec($ch);
                       
      // $err = curl_error($ch);

curl_close($ch);

 $chs= curl_init();        
      curl_setopt_array($chs, array(            
      CURLOPT_URL =>  "http://mysms.educationmasters.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=6d128a6f7b32da9251257692e7911e&message=".urlencode($msg1)."&senderId=ADRGUR&routeId=1&mobileNos=".$per->ph_number."&smsContentType=english",        
      CURLOPT_RETURNTRANSFER => true,            
      CURLOPT_SSL_VERIFYHOST => 0,           
       CURLOPT_SSL_VERIFYPEER => 0            
      ));   
      //get response
            
      $outputs = curl_exec($chs);
                       
      // $err = curl_error($ch);

curl_close($chs);



  Session::flash('created', 'Submitted Successfully!');

        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Coaching::where('slug', '=', $slug)->first();

        return view('posts.profile-preview', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
}
