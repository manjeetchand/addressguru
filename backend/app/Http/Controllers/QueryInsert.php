<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\QueryRequest;
use App\Query;
use App\Personal;
use App\Product;
use App\Category;
use App\Coaching;
use App\Http\Requests;

class QueryInsert extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Query::where('user_id', '=', Auth::user()->id)->paginate(50);

       return view('user.query.index', compact('query'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QueryRequest $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'ph_number' => 'required|numeric',
            'message' => 'required|string',
        ]);

        $input = $request->all();

        Query::create($input);

        if (isset($input['post_id']) != 0) 
        {
            $posts = Coaching::findOrFail($input['post_id']);

            $per = Personal::where('post_id', '=', $input['post_id'])->first();

            $to = $per->email;
            $subject = "Query at ".$posts->business_name." | AddressGuru";
            $htmlContent = "
                   <div style='margin:auto;width:1000px;'>
            <div style='background-color:#F3F3F3;padding:40px 15px 40px 15px;'>
                <h1 style='color:#FE6E04;font-size:24px;'><b>".$posts->business_name."</b></h1><hr/>
                <h3 style='color:#282323;font-size:18px;'><b>Name:</b> <span style='color:#716969;font-size:18px;'>".$input['name']."</span></h3>
                <h3 style='color:#282323;font-size:18px;'><b>Email:</b> <span style='color:#716969;font-size:18px;'><a href='mailto:".$input['email']."' style='float:none!important;display:inline!important;'>".$input['email']."</a></span></h3>
                <h3 style='color:#282323;font-size:18px;'><b>Mobile Number:</b> <span style='color:#716969;font-size:18px;'>".$input['ph_number']."</span></h3>
                <h3 style='color:#282323;font-size:18px;'><b>Message:</b> <span style='color:#716969;font-size:18px;'>".$input['message']."</span></h3><br/>
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
        }
        elseif (request()->has('product_id')) 
        {
            $pro = Product::findOrFail($input['product_id']);

            $to = $pro->user->email;
            $subject = "Query at ".$pro->title." | AddressGuru";
            $htmlContent = "
                   <div style='margin:auto;width:1000px;'>
            <div style='background-color:#F3F3F3;padding:40px 15px 40px 15px;'>
                <h1 style='color:#FE6E04;font-size:24px;'><b>".$pro->title."</b></h1><hr/>
                <h3 style='color:#282323;font-size:18px;'><b>Name:</b> <span style='color:#716969;font-size:18px;'>".$input['name']."</span></h3>
                <h3 style='color:#282323;font-size:18px;'><b>Email:</b> <span style='color:#716969;font-size:18px;'><a href='mailto:".$input['email']."' style='float:none!important;display:inline!important;'>".$input['email']."</a></span></h3>
                <h3 style='color:#282323;font-size:18px;'><b>Mobile Number:</b> <span style='color:#716969;font-size:18px;'>".$input['ph_number']."</span></h3>
                <h3 style='color:#282323;font-size:18px;'><b>Message:</b> <span style='color:#716969;font-size:18px;'>".$input['message']."</span></h3><br/>
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

        }

        Session::flash('created', 'Submitted Successfully!');

        return response()->json(['message' => 'Form submitted successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Query::findOrFail($id)->delete();

        return redirect()->back();
    }

   
}
