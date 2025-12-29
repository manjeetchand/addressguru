<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Message;
use App\Coaching;
use App\User;
use App\Query;
use App\Product;
use App\Rating;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class UserIndex extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $query = Query::where('user_id', $user->id)->count();

        $rating = Rating::where('user_id', '=', $user->id)->count();

        $listing = Coaching::where('user_id', '=', Auth::user()->id)->count();

        $message = Message::where('user_id', '=', Auth::user()->id)->where('status', '=', 0)->orderBy('id', 'DESC')->get();

        $product = Product::where('user_id', '=', Auth::user()->id)->count();

        return view('user.index', compact('query', 'rating', 'user', 'message', 'listing', 'product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = Product::where('user_id', '=', Auth::user()->id)->orderBy('id', 'DESC')->paginate(50);

        return view('user.product.index', compact('product'));
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
        Message::findOrFail($id)->update(['status'=>1]);

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
        Product::findOrFail($id)->delete();

        Session::flash('insert', 'Successfully Deleted!');

        return redirect()->back();
    }
}
