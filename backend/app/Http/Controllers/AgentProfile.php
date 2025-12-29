<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Coaching;
use App\Personal;
use App\Payment;
use Hash;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Support\Facades\Session;

class AgentProfile extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $post = $client = Personal::where('agent', '=', '1')->where('user_id', '=', $user->id)->get();

        $check = Payment::where('user_id', '=', $user->id)->get();

        $sum = 0;
        foreach ($check as $key) 
        {
            $sum += $key->amount;
        }

        // GST charge 18%
        $gst = 18; 

        $per = ($sum / 100) * $gst;

        $pay = $sum - $per; 

        // Payment Gateway charge 4%
        $gateway = 4;

        $cal = ($pay / 100) * $gateway;

        $charge = $pay - $cal;

        // Agent Comission 40%

        $com = 40;

        $comm = ($charge / 100) * $com;

        $total = number_format($comm, 2);

        return view('agent.profile.index', compact('user', 'post', 'total'));
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

        return view('agent.profile.change', compact('user'));
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

        return view('agent.profile.edit', compact('user'));
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
