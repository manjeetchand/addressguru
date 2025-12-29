<?php

namespace App\Http\Controllers;
use App\Msubcategory;
use App\Mcategory;
use App\ChildCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminMsub extends Controller
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
        $this->validate($request, [
            'og_image'=>'required|image|mimes:jpeg,jpg,png|max:2000',
        ]);

        if ($file = $request->file('og_image')) 
        {
            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);
        }

        $input = $request->all();

        Msubcategory::create([

            'category_id' => $input['category_id'],
            'icon' => $input['icon'],
            'colors' => $input['color'],
            'name' => $input['name'],
            'og' => $name,
        ]);

        Session::flash('insert', 'Successfully Added!');

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
        $category = Msubcategory::where('category_id', '=', $id)->orderBy('id', 'DESC')->get();

        $cat_name = Mcategory::findOrFail($id);

        return view('admin.mcategory.msub.index', compact('category', 'cat_name'));
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
        $this->validate($request, [
            'og_image'=>'image|mimes:jpeg,jpg,png|max:2000',
        ]);

        $m = Msubcategory::findOrFail($id);

        if ($file = $request->file('og_image')) 
        {
            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);
        }
        else
        {
            $name = $m->og;
        }

        $input = $request->all();

        $m->update([

            'name' => $input['name'],
            'icon' => $input['icon'],
            'colors' => $input['color'],
            'og' => $name,
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
        Msubcategory::findOrFail($id)->delete();

        Session::flash('insert', 'Successfully Deleted!');

        return redirect()->back();
    }
    
    
    public function dropdown($id){
        $categories = ChildCategory::where('msub_category_id',$id)->get();
        return view('admin.mcategory.msub.dropdwon',compact('categories','id'));
    }
    
    public function dropdownStore(Request $request){
        $m = new ChildCategory();
        $m->create([
            'label' => $request->name,
            'msub_category_id' => $request->category,
        ]);
        Session::flash('insert', 'Successfully Add!');

        return redirect()->back();
    }
    
    public function dropdownUpdate(Request $request,$id){
        $m = ChildCategory::find($id);
        $m->update([
            'label' => $request->name,
        ]);
        Session::flash('insert', 'Successfully Updated!');
        return redirect()->back();
    }
    
    
    public function dropdownDestroy($id)
    {
        ChildCategory::findOrFail($id)->delete();
        Session::flash('insert', 'Successfully Deleted!');
        return redirect()->back();
    }
}
