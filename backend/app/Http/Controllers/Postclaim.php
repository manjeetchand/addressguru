<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coaching;
use App\Http\Requests;
use App\Claim;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ClaimRequest;

class Postclaim extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $claim = Claim::orderBy('id', 'DESC')->get();

        return view('admin.claim.index', compact('claim'));
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
    public function store(ClaimRequest $request)
    {
        $input = $request->all();

        $cla = Claim::create($request->all());

         $to = 'suyalvikas@gmail.com';
        $subject = "Claim ".$cla->post->business_name." | Address Guru";
        $htmlContent = "
               <div style='margin:auto;width:1000px;'>
    <div style='background-color:#DDF2FB;padding:40px;'>
        <h1 style='color:#337AB7;font-size:30px;'><b>Contact Details</b></h1><hr/>
        <h3 style='color:#3DB0E2;font-size:20px;'><b>Name:</b> <span style='color:black;font-size:18px;'>".$input['name']."</span></h3>
        <h3 style='color:#3DB0E2;font-size:20px;'><b>Email:</b> <span style='color:black;font-size:18px;'><a href='mailto:".$input['email']."' style='float:none!important;display:inline!important;'>".$input['email']."</a></span></h3>
        <h3 style='color:#3DB0E2;font-size:20px;'><b>Mobile Number:</b> <span style='color:black;font-size:18px;'>".$input['mobile_number']."</span></h3>
        <h3 style='color:#3DB0E2;font-size:20px;'><b>Message:</b> <span style='color:black;font-size:18px;'>".$input['message']."</span></h3><br/>
        <center><img src='http://addressguru.sg/images/logo.png' style='width:150px;'></center>
    </div>
</div>
              ";
        $headers = 'MIME-Version: 1.0' . "\r\n" .
        'Content-type:text/html;charset=UTF-8' . "\r\n" .
        'From: '.$input['name'].' <'.env('EMAIL').'>' . "\r\n" .
          'Reply-To: '.$input['name'].' <'.env('EMAIL').'>' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
        $mail = mail($to, $subject, $htmlContent, $headers);

        return response()->json(['message' => 'Successfully Claimd ! It will appear after aproval']);
        Session::flash('claimed', 'Submitted Successfully!');   

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

        $user = User::findOrFail($post->user_id);

        return view('claim.index', compact('post', 'user'));
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
        Claim::findOrFail($id)->delete();

        return redirect()->back();
    }
}
