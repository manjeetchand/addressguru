<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Filters extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $to = $user->email;
        $subject = "Verify OTP";
        $htmlContent = '<div style="margin:auto;width:1000px;">
    <div style="background-color:#FFE1CC;padding:40px 15px 40px 15px;">
      <h1 style="color:#FE6E04;font-size:30px;"><b>Welcome To Address Guru</b></h1><hr/>
      <h3 style="color:#282323;font-size:20px;">Thanks for being part of Address Guru</h3>
      <p>AddressGuru is online local business directory that provide information about your daily needs just one click away. We get your business listed on it and grow online by reaching everyone who search you online.</p>
      <h4 style="font-size:18px;">&#128273; Your one time password: '.$user->verify.'</h4>
      <br/>
      <center><img src="http://www.addressguru.in/images/logopng.png" style="width:150px;"></center>
    </div>
  </div>';
        $headers = 'MIME-Version: 1.0' . "\r\n" .
        'Content-type:text/html;charset=UTF-8' . "\r\n" .
        'From: AddressGuru <'.env('EMAIL').'>' . "\r\n" .
          'Reply-To: AddressGuru <'.env('EMAIL').'>' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
        $mail = mail($to, $subject, $htmlContent, $headers);

        Session::flash('send', 'Mail sent Successfully');

        return redirect()->back();

        
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
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
