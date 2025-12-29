<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Personal;
use App\Coaching;
use App\Query;
use App\SEO;
use App\User;
use App\Http\Requests;

class PartnerClient extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user(); 

        $personal = Personal::where('user_id', '=', $user->id)->orderBy('id', 'DESC')->paginate(50);

        return view('agent.client.index', compact('user', 'personal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agent.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input['verify'] = $user->verify;

        Mail::send('email.agent', $input, function($message) use ($input)
        {
            $message->from('contact@addressguru.in', 'Address Guru');
            $message->subject('Verify OTP');
            $message->to($input['email']);

        }); 

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

        $image = Coaching::findOrFail($new);

        return view('agent.listing.image', compact('image'));
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
        
        $client = Personal::findOrFail($id);

        return view('agent.client.edit', compact('client'));
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
        
        $per = Personal::findOrFail($id);

        if ($per->is_active == 0) 
        {
           $input = $request->all();

           Personal::where('verify', '=', $input['verify'])->update(['is_active'=>1]);

           return redirect()->back();
        }
        else
        {

            if (Auth::user()->id == $per->user_id) 
            {
                $this->validate($request, [
                'name'=>'required',
                'ph_number'=>'required',
                'location' => 'required',
                ]);

                $per->update($request->all());

                Session::flash('clientupdate', 'Successfully Updated ');

                return redirect('agent-client');
            }
            else
            {
                Session::flash('stop', "Owner of the listing can only update!");

                return redirect('agent-client');
            }

           
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $per = Personal::findOrFail($id);

       Coaching::where('id', '=', $per->post_id)->delete();

       Query::where('post_id', '=', $per->post_id)->delete();

       SEO::where('post_id', '=', $per->post_id)->delete();

       $per->delete();

       return redirect()->back();
    }

}
