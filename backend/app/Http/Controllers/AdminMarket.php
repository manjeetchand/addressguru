<?php

namespace App\Http\Controllers;
use App\Mcategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminMarket extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Mcategory::orderBy('id', 'ASC')->get();

        return view('admin.mcategory.index', compact('category'));
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
        Mcategory::create([
            'name' => $input['name'],
            'icon' => $input['icon'],
            'colors' => $input['colors'],
        ]);
        Session::flash('insert', 'Successfully Created');
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

        Mcategory::findOrFail($id)->update([

            'name' => $input['name'],
            'icon' => $input['icon'],
            'colors' => $input['color'],
        ]);

        Session::flash('insert', 'Successfully Updated!');

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
        Mcategory::findOrFail($id)->delete();

        Session::flash('insert', 'Deleted Successfully!');

        return redirect()->back();
    }
}
