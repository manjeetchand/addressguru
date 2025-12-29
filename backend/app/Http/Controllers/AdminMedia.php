<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Media;
use App\Coaching;
use App\Http\Requests\MediaRequest;
use App\Http\Requests;

class AdminMedia extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
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

        $data = $request->image;


        list($type, $data) = explode(';', $data);

        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);

        $image_name= time().'.png';

        $path = "images/" . $image_name;

        Media::create(['name'=>$image_name, 'post_id'=>$input['id']]);

        file_put_contents($path, $data);

        Session::flash('insert', 'Successfully Uploaded');

        return response()->json(['success'=>'done']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = Media::where('post_id', '=', $id)->get();

        $post = Coaching::findOrFail($id);

        return view('admin.media.index', compact('post', 'photo'));
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

        return view('admin.media.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MediaRequest $request, $id)
    {
        $input = $request->all();

        $file = $request->file('file');
        
        $name = rand() . '.' . $file->getClientOriginalExtension();

        $file->move('images', $name);

        Media::whereId($id)->first()->update(['name'=>$name]);

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
        $photo = Media::findOrFail($id);

        $photo->delete();

        return redirect()->back();
    }
}
