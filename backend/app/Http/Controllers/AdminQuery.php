<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Query;
use Illuminate\Support\Facades\Auth;
use App\Coaching;
use App\lapp;
use App\Notifications\FacebookPost;
use App\Personal;
use App\Http\Requests;

class AdminQuery extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Query::where('post_id', '=', 0)->where('user_id', '=', 0)->orderBy('id', 'DESC')->paginate(20);

       return view('admin.query.index', compact('query'));
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
        //
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

        return view('admin.listing.images', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query = Query::where('post_id',$id)->orderBy('id', 'DESC')->paginate(20);
       return view('admin.query.index', compact('query'));
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
        $user = Auth::user();

        $input = $request->all();

        $id = isset($input['wid']) ? $input['wid'] : $id;

        $post = Coaching::findOrFail($id);

        $email = Personal::where('post_id', '=', $id)->first();

        if ($input['status'] == 1) 
        {
            $to = $email->email;
            $subject = "Great news! ".$post->business_name." has Published with AddressGuru.";
            $htmlContent = "
               <div style='margin:auto;width:1000px;'>
                <div style='background-color:#FFE1CC;padding:40px 15px 40px 15px;'>
                    <h1 style='color:#FE6E04;font-size:24px;'><b>Great news! <b>".$post->business_name."</b> has Published with AddressGuru.</b></h1><hr/>
                    <span style='font-family:arial;'>Link: <a href='https://www.addressguru.sg/".$post->slug."' target='_blank'>https://www.addressguru.sg/".$post->slug."</a> visit your listing!</span><br/>
                    
                    <center><img src='https://www.addressguru.sg/images/logopng.png' style='width:150px;'></center>
                </div>
            </div>
              ";
            $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type:text/html;charset=UTF-8' . "\r\n" .
            'From: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
              'Reply-To: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
              'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $htmlContent, $headers);

            // $post->notify(new FacebookPost);
        }

        $post->update($request->all());

        $email->update($request->all());

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
        
    }
}
