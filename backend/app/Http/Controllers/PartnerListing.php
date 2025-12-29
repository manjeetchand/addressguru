<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coaching;
use App\Http\Requests;
use App\Query;
use App\Personal;
use App\SEO;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UserPostRequest;

class PartnerListing extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $new = base64_decode($id);
        
        $post = Coaching::where('id', '=', $new)->get();

        return view('agent.listing.index', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $new = base64_decode($id);

        $post = Coaching::findOrFail($new);

        $local = Personal::where('post_id', '=', $new)->get();

        return view('agent.listing.edit', compact('post', 'local'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserPostRequest $request, $id)
    {
        $this->validate($request, [
            'business_address' => 'required',
            'map' => 'required',
            'web_link' => 'required',
            'video' => 'required',
            'ad_description' => 'required',
            'location' => 'required',
        ]);
        
        $input = $request->all();

        Coaching::findOrFail($id)->update([

            'business_address' => $input['business_address'],
            'map' => $input['map'],
            'web_link' => $input['web_link'],
            'service' => json_encode($input['service']),
            'facility' => json_encode($input['facility']),
            'payment' => json_encode($input['payment']),
            'course' => json_encode($input['course']),
            'video' => $input['video'],
            'ad_description' => $input['ad_description'],
            'status' => 0,

        ]);

        Personal::where('post_id', '=', $id)->update(['location'=>$input['location']]);

        Session::flash('update', 'Successfully Updated ');
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
        $new = base64_decode($id);

        $cat = Coaching::findOrFail($new);

        Personal::where('post_id', '=', $cat->id)->delete();

        Query::where('post_id', '=', $cat->id)->delete();

        SEO::where('post_id', '=', $cat->id)->delete();

        $cat->delete();

        return redirect()->back();
    }

    public function change(Request $request, $id)
    {
        $this->validate($request, [
           'photo' => 'required|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $input = $request->all();

        $file = $request->file('photo');

        $name = rand() . '.' . $file->getClientOriginalExtension();

        $file->move('images', $name);

        Coaching::findOrFail($id)->update(['photo'=> $name]);

        return redirect()->back();
    }
}
