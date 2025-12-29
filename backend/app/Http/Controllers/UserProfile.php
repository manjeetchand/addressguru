<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
use Hash;
use App\User;
use App\Coaching;
use App\Query;

class UserProfile extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $post = Coaching::where('user_id', '=', $user->id)->get();

        $query = Query::where('user_id', '=', $user->id)->get();

        return view('user.profile.index', compact('user', 'post', 'query'));
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

        $user = User::findOrFail($new);

        return view('user.profile.change', compact('user'));
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

        $user = User::findOrFail($new);

        return view('user.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserProfileRequest $request, $id)
    {
        $input = $request->all();

        if ($file = $request->file('photo')) 
        {
            $name = rand() . '.' . $file->getClientOriginalExtension();

            $file->move('images', $name);

            User::findOrFail($id)->update([
                'name' => $input['name'],
                'mobile_number' => $input['mobile_number'],
                'photo' => $name,

            ]);
        }
        else
        {
            User::findOrFail($id)->update($request->all());
        }

        Session::flash('update', 'Successfully updated post !');

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

    public function password(Request $request)
    {
        $this->validate($request, [
           'oldpass' => 'required|min:6',
           'newpass' => 'required|min:6',
        ]);
        
        $input = $request->all();

        $user = Auth::user();

        $currentpass = $user->password;
        if(Hash::check($input['oldpass'], $currentpass))
        {                                  
            $obj_user = User::find($user->id);
            $obj_user->password = Hash::make($input['newpass']);;
            $obj_user->save(); 

            Session::flash('change', 'Successfully changed password !');
            return redirect()->back();
        }
        else
        {   
            Session::flash('nochange', 'Current password not matched!');
            return redirect()->back();
        }

    }

}
