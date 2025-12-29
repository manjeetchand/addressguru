<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coaching;
use App\Category;
use App\Banner;
use App\Personal;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class Bannerad extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $post = Coaching::where('status', '=', 1)->where('user_id', '=', $user->id)->orderBy('id', 'DESC')->get();

        $category = Category::all();

        return view('banner.index', compact('post', 'category'));
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
    public function store(Request $request)
    {
        $this->validate($request, [
           'image' => 'required|image|mimes:jpeg,png,jpg|max:500|dimensions:width=1200,height=110',
           'name' => 'required',
           'business_name' => 'required',
           'category' => 'required',
        ]);

        $user = Auth::user();

        $input = $request->all();

        if ($file = $request->file('image')) 
        {
            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);

        }

        $banner = Banner::create([

            'user_id' => $user->id,
            'coaching_id' => $input['business_name'],
            'category' => json_encode($input['category']),
            'name' => $input['name'],
            'image' => $name,

        ]);

        Session::flash('comp', 'Successfully Uploaded! will be live after approvel');
        return redirect()->route('banner-ad.show', $banner->id);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $banner = Banner::findOrFail($id);

        $post = Coaching::findOrFail($banner->coaching_id);

        $personal = Personal::where('post_id', '=', $banner->coaching_id)->get();

        return view('banner.create', compact('post', 'personal', 'banner'));
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
