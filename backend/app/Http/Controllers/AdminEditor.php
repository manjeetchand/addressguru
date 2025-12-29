<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class AdminEditor extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('role_id', '=', 4)->get();

        $category = Category::orderBy('name', 'ASC')->get();

        return view('admin.editor.index', compact('user', 'category'));
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
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'category_id' => 'required',
            'mobile_number' => 'required',
        ]);

        $input = $request->all();

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890*#@!%&()_+|~:?><.,;';
        $pass = array(); 
        $alphaLength = strlen($alphabet) - 1; 
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $password = implode($pass);

        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'category_id' => $input['category_id'],
            'role_id' => 4,
            'is_active' => 1,
            'password' => bcrypt($password),
            'mobile_number' => $input['mobile_number'],
            'verify' => ' ',

            ]);

        $to = $input['email'];
        $subject = "Addressguru has apointed you as Editor";
        $htmlContent = "
              <h4>Account Details</h4>
              <p>Username: ".$input['email']."</p>
              <p>Password: ".$password."</p>
              ";
        $headers = 'MIME-Version: 1.0' . "\r\n" .
        'Content-type:text/html;charset=UTF-8' . "\r\n" .
        'From: Address Guru <'.env('EMAIL').'>' . "\r\n" .
          'Reply-To: Address Guru <'.env('EMAIL').'>' . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
        $mail = mail($to, $subject, $htmlContent, $headers);

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
        $user = User::findOrFail($id);

        $category = Category::orderBy('name', 'ASC')->get();

        return view('admin.editor.edit', compact('user', 'category'));
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
        User::findOrFail($id)->delete();

        return redirect()->back();
    }
}
