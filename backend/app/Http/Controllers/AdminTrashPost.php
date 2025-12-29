<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coaching;
use App\Personal;
use App\SEO;
use App\User;
use App\Media;
use App\Views;
use App\Query;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminTrashPost extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Coaching::onlyTrashed()->orderBy('id', 'DESC')->paginate(50);

        return view('admin.trash.post', compact('post'));
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
        Coaching::withTrashed()->where('id', '=', $id)->restore();

        Personal::withTrashed()->where('post_id', '=', $id)->restore();

        Query::withTrashed()->where('post_id', '=', $id)->restore();

        SEO::withTrashed()->where('post_id', '=', $id)->restore();

        Session::flash('active', 'Successfully Activated !');

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
        Coaching::onlyTrashed()->where('id', '=', $id)->forceDelete();

        Personal::withTrashed()->where('post_id', '=', $id)->forceDelete();

        Query::withTrashed()->where('post_id', '=', $id)->forceDelete();

        SEO::withTrashed()->where('post_id', '=', $id)->forceDelete();

        Media::where('post_id', '=', $id)->delete();

        Views::where('post_id', '=', $id)->delete();

        Session::flash('active', 'Successfully Activated !');

        return redirect()->back();
    }
}
