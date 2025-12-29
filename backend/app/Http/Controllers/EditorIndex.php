<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coaching;
use App\SEO;
use App\lapp;
use App\User;
use App\Claim;
use App\Query;
use App\Rating;
use App\Report;
use App\Personal;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class EditorIndex extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

         $post = Coaching::where('category_id', '=', $user->category_id)->where('status', '=', 0)->orderBy('id', 'DESC')->get();

        return view('editor.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        $post = Coaching::where('category_id', '=', $user->category_id)->where('status', '=', 0)->orderBy('id', 'DESC')->get();

        return view('editor.show', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $post = Coaching::findOrFail($input['post_id']);

        $to = $post->user->email;
        $subject = "Rejection email for ".$post->business_name." | AddressGuru.";
        $htmlContent = "
               <div style='margin:auto;width:1000px;'>
                <div style='background-color:#F3F3F3;padding:40px 15px 40px 15px;'>
                    <h1 style='color:red;font-size:24px;'><b>Rejection email <b>for ".$post->business_name."</b> | AddressGuru.</b></h1><hr/><br/>
                    <span style='font-family:arial;color:#645d5d;'>
                        Hi, ".$post->user->name."<br/><br/>
                        Thank you so much for your interest in Internship with AddressGuru. We appreciate you taking the time for data entry job.<br/><br/>
 

We found your listing not up to the mark. However, we were impressed with your technical knowledge.<br/><br/>
 

We will be posting a few more data entry jobs in the coming weeks, and hope you’ll consider applying again. Otherwise, we wish you the best of luck in your career endeavors.
 <br/><br/>
 

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

        $user = User::findOrFail(67);

        Personal::where('post_id', '=', $post->id)->update([

            'user_id'  => $user->id,
            'name'     => $user->name,
            'email'    => $user->email,

        ]);

        Claim::where('user_id', '=', $post->user_id)->update(['user_id'=>$user->id]);

        Query::where('post_id', '=', $post->id)->update(['user_id'=>$user->id]);

        Rating::where('post_id', '=', $post->id)->update(['user_id'=>$user->id]);

        SEO::where('post_id', '=', $post->id)->update(['user_id'=>$user->id]);

        Report::where('user_id', '=', $post->user_id)->update(['user_id'=>$user->id]);

        $post->update(['user_id'=>$user->id]);

        Session::flash('transfer', 'Successfully Rejected & Transfered !');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Coaching::findOrFail($id);

        return view('editor.image', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Coaching::findOrFail($id);

        $seo = SEO::where('post_id', '=', $post->id)->get();

        return view('editor.edit', compact('post', 'seo'));
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

        $user = Auth::user();

        $post = Coaching::findOrFail($id);

        $email = Personal::where('post_id', '=', $id)->first();

        $to = $email->email;
        $subject = "Great news! ".$post->business_name." has Published with AddressGuru.";
        $htmlContent = "
               <div style='margin:auto;width:1000px;'>
        <div style='background-color:#FFE1CC;padding:40px 15px 40px 15px;'>
        <h1 style='color:#FE6E04;font-size:24px;'><b>Great news! <b>".$post->business_name."</b> has Published with AddressGuru.</b></h1><hr/>
        <span style='font-family:arial;'>Link: <a href='https://www.addressguru.in/".$post->slug."' target='_blank'>https://www.addressguru.in/".$post->slug."</a> visit your listing!</span><br/>
        
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


        $post->update(['status'=>$input['status']]);

        lapp::where('coaching_id', '=', $id)->update(['user_id'=>$user->id]);

        return redirect()->back();
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
