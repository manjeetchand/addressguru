<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Role;
use App\Coaching;
use App\Query;
use App\SEO;
use App\Personal;
use App\Category;
use App\Http\Requests;

class AdminUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('updated_at', 'DESC')->where('role_id', '!=', 1)->where('role_id', '!=', 4)->paginate(50);

        $todayuser = User::orderBy('updated_at', 'DESC')->where('role_id', '!=', 1)->where('role_id', '!=', 4)->where('created_at', 'LIKE', '%' . Date('Y-m-d') . '%')->count();

        return view('admin.user.index', compact('user', 'todayuser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Coaching::where('user_id', '!=', 67)->with('lapps')->where('status', '=', 0)->where('post_status', '=', 1)->orderBy('updated_at', 'DESC')->paginate(50);

        $rjected = Personal::where('is_active', '=', 1)->where('user_id', '=', 67)->where('post_status', '=', 1)->count();

        return view('admin.request', compact('data', 'rjected'));
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

        $todayuser = User::orderBy('updated_at', 'DESC')->where('role_id', '!=', 1)->where('role_id', '!=', 4)->where('created_at', 'LIKE', '%' . Date('Y-m-d') . '%')->count();

        $user = User::where('name', 'LIKE', '%' . $input['name'] . '%')->orderBy('id', 'DESC')->paginate(2000);

        return view('admin.user.index', compact('user', 'todayuser'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        Auth::login($user);

        if ($user->isAgent()) 
        {
            return redirect()->route('Partner Dashboard.index');
        }
        elseif ($user->isUser()) 
        {
            return redirect()->route('Dashboard.index');
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $role = Role::all();

        return view('admin.user.edit', compact('user', 'role'));
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
        $user = User::findOrFail($id);

        if (trim($request->password) == '') 
        {
            $input = $request->except('password');
        }
        else
        {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        $user->update($input);
        Session::flash('update', 'Successfully updated user !');

        return redirect('admin-user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        Coaching::where('user_id', '=', $user->id)->delete();
       
        Personal::where('email', '=', $user->email)->delete();

        Query::where('user_id', '=', $user->id)->delete();

        SEO::where('user_id', '=', $user->id)->delete();
    
        $user->delete();

       return redirect('admin-user');
    }

}
