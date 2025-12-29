<?php

namespace App\Http\Controllers;
use App\Personal;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminVerify extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per = Personal::where('is_active', '=', 0)->where('post_status', '=', 1)->orderBy('id', 'DESC')->paginate(50);

        $user = User::where('role_id', '!=', 1)->where('role_id', '!=', 4)->get();

        return view('admin.verify.index', compact('per', 'user'));
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
        $input = $request->all();

        $per = Personal::where('user_id', '=', $input['user'])->where('is_active', '=', 0)->where('post_status', '=', 1)->orderBy('id', 'DESC')->paginate(2000);

        $user = User::where('role_id', '!=', 1)->where('role_id', '!=', 4)->get();

        return view('admin.verify.index', compact('per', 'user'));
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
        $input = $request->all();
        
        Personal::findOrFail($input['wid'])->update(['is_active'=>1]);
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
