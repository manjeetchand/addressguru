<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personal;
use App\Message;
use App\Http\Requests;
use App\Payment;
use App\Product;
use App\Coaching;
use App\Rating;
use Illuminate\Support\Facades\Auth;

class PartnerIndex extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Personal::where('agent', '=', '1')->where('user_id', '=', Auth::user()->id)->count();

        $rating = Rating::where('user_id', '=', Auth::user()->id)->count();

        $product = Product::where('user_id', '=', Auth::user()->id)->count();

        $check = Payment::where('user_id', '=', Auth::user()->id)->get();

        $message = Message::where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->orderBy('id', 'DESC')->get();

        $sum = 0;
        foreach ($check as $key) 
        {
            $sum += $key->amount;
        }

        // GST charge 18%
        $gst = 18; 

        $per = ($sum / 100) * $gst;

        $pay = $sum - $per; 

        // Payment Gateway charge 4%
        $gateway = 4;

        $cal = ($pay / 100) * $gateway;

        $charge = $pay - $cal;

        // Agent Comission 40%

        $com = 40;

        $comm = ($charge / 100) * $com;

        $total = number_format($comm, 2);

        return view('agent.index', compact('client', 'rating', 'total', 'message', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pro = Product::where('user_id', '=', Auth::user()->id)->orderBy('id', 'DESC')->paginate(50);

        return view('agent.product', compact('pro'));
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

        $user = Auth::user();

        $post = Coaching::where('user_id', '=', $user->id)->where('business_name', 'LIKE', '%' . $input['find'] . '%')->get();

        return view('agent.search', compact('post'));
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
