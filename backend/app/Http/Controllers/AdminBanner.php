<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Query;
use App\User;
use App\Claim;
use App\Rating;
use App\SEO;
use App\Personal;
use App\Report;
use App\Coaching;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class AdminBanner extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banner = Banner::orderBy('id', 'DESC')->get();

        return view('admin.banner.index', compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = Query::where('post_id', '!=', 0)->where('product_id', '=', null)->orderBy('id', 'DESC')->paginate(50);

        return view('admin.all', compact('query'));
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

        $user = User::findOrFail(67);

        Personal::where('post_id', '=', $post->id)->update([

            'user_id'  => $user->id,

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
        $ban = Banner::findOrFail($id);

        return view('admin.banner.edit', compact('ban'));
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
        Banner::findOrFail($id)->update($request->all());

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
        Banner::findOrFail($id)->delete();

        return redirect()->back();
    }
}
