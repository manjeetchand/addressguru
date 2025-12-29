<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Packages;
use App\Http\Requests;
use App\Http\Requests\PackageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AgentPack extends Controller
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
    public function create($id)
    {
        $new = base64_encode($id);

        $user = Auth::user();

        $pack = Packages::where('post_id', '=', $new)->get();

        return view('agent.package.create', compact('new', 'user', 'pack'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
        Packages::create($request->all());

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
        $pack = Packages::findOrFail($id);

        return view('agent.package.edit', compact('pack'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, $id)
    {
        Packages::findOrFail($id)->update($request->all());

        Session::flash('update', 'Updated Successfully!');

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
        Packages::findOrFail($id)->delete();

        return redirect()->back();
    }
}
