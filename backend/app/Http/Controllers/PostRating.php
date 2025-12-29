<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rating;
use App\Http\Requests;
use App\Http\Requests\RatingRequest;
use App\Coaching;
use Illuminate\Support\Facades\Session;

class PostRating extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $post = Coaching::where('user_id', '=', $user->id)->get();

        return view('user.reviews.index', compact('post'));
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
    public function store(RatingRequest $request)
    {
        $input = $request->all();

        $check = Rating::where('rating_email', '=', $input['rating_email'])->where('post_id', '=', $input['post_id'])->count();

        if ($check == 0) 
        {
            Rating::create($request->all());
            return response()->json(['message' => 'Successfully Rated ! It will appear after aproval']);
            Session::flash('created', 'Successfully Rated ! It will appear after aproval');
        }
        else
        {
            return response()->json(['message' => 'Already Reviewed with this Email ID: '.$input['rating_email']]);
            Session::flash('danger', 'Already Reviewed with this Email ID: '.$input['rating_email']);
        }

        
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
        $new = base64_decode($id);

        $rating = Rating::where('post_id', '=', $new)->get();

        return view('user.reviews.show', compact('rating'));
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
        $rat = Rating::findOrFail($id)->update($request->all());

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
