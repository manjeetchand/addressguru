<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coaching;
use App\Media;
use App\Http\Requests;

class EditorImage extends Controller
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
            'file'=>'required|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        $input = $request->all();

        $file = $request->file('file');

        $name = rand() . '.' . $file->getClientOriginalExtension();

        $file->move('images', $name);

        Media::create(['name'=>$name, 'post_id'=>$input['post_id']]);

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
        $post = Coaching::findOrFail($id);

        $photo = Media::where('post_id', '=', $id)->get();

        return view('editor.slider', compact('photo', 'post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Media::findOrFail($id);

        return view('editor.editslide', compact('photo'));
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

        if (request()->has('zora')) 
        {
            $this->validate($request, [
            'file'=>'required|image|mimes:jpeg,png,jpg|max:2000',
            ]);

        
            $file = $request->file('file');
        
            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);

            Media::whereId($id)->first()->update(['name'=>$name]);
        }
        else
        {
            $this->validate($request, [
            'photo'=>'required|image|mimes:jpeg,png,jpg|max:2000',
            ]);

        
            $file = $request->file('photo');
        
            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);

            Coaching::whereId($id)->first()->update(['photo'=>$name]);
        }
        

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
