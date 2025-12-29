<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coaching;
use App\Media;
use App\Category;
use App\SEO;
use App\Personal;
use App\Packages;
use App\Views;
use App\Rating;
use App\Http\Requests;

class Preview extends Controller
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
   public function show($slug)
    {
        $post = Coaching::where('slug', '=', $slug)->first();

        $photo = Media::where('post_id', '=', $post->id)->get();

        $category = Category::all();

        $seo = SEO::where('post_id', '=', $post->id)->get();

        $personal = Personal::where('post_id', '=', $post->id)->get();

        $views = Views::where('post_id', '=', $post->id)->get();

        $pack = Packages::where('post_id', '=', $post->id)->get();

        return view('posts.preview', compact('post', 'category', 'photo', 'seo', 'personal', 'views', 'pack'));
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
