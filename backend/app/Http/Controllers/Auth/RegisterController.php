<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use App\User;

use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    use RegistersUsers;

    /*

    |--------------------------------------------------------------------------

    | Register Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles the registration of new users as well as their

    | validation and creation. By default this controller uses a trait to

    | provide this functionality without requiring any additional code.

    |

    */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();

    }


    public function redirectToGoogle()
    {
        session(['from_login_page' => true]);
        session(['url' => request()->url]);
        return Socialite::driver('google')->redirect();
    }


    public function handleProviderCallback($provider)
    {
        try
        {
            $user = Socialite::driver($provider)->stateless()->user();

            $finduser = User::where('provider_id', $user->id)->first();

            if($finduser)
            {
                Auth::login($finduser);

                return redirect()->route('Dashboard.index');
            }
            else
            {
                $check = User::where('email', '=', $user->email)->count();

                if ($check == 0) 
                {
                    $newUser = User::create([
                        'name'       => $user->name,
                        'email'      => $user->email,
                        'role_id'    => 2,
                        'provider'   => strtoupper($provider),
                        'is_active'  => 1,
                        'provider_id'=> $user->id,
                    ]);

                    Auth::login($newUser);

                    return redirect()->route('Dashboard.index');
                }
                else
                {
                    Session::flash('no', 'Email Already Exist!');

                    return redirect('login');
                }
            }
        } 
        catch (Exception $e) 
        {
            dd($e->getMessage());
        }
    }



    /**

     * Where to redirect users after registration.

     *

     * @var string

     */
    protected function authenticated(Request $request, $user)
    {
        if ( $user->isAdmin() ) 
        {
            return redirect()->route('admin.index');
        }
        elseif ($user->isAgent()) 
        {
            return redirect()->route('Partner Dashboard.index');
        }
        elseif ($user->isUser()) 
        {
            return redirect()->route('Dashboard.index');
        }
        elseif ($user->isEditor()) 
        {
            return redirect()->route('editor-dashboard.index');
        }
        else
        {
            return redirect('/');
        }            
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'                => 'required|max:255',
            'email'               => 'required|email|max:255|unique:users',
            'password'            => 'required|min:6|confirmed',
            'mobile_number'       => 'required|max:10|min:10',
            'g-recaptcha-response'=> 'required|captcha',
        ]);
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $rands = rand(10, 1000000);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile_number' => $data['mobile_number'],
            'password' => bcrypt($data['password']),
            'verify'=> $rands,
        ]);

        $to          = $data['email'];
        $subject     = "Verify OTP | AddressGuru";
        $htmlContent = '
            <html>
                <head></head>

                <body>
                    <div style="margin:auto;width:1000px;">
                        <div style="background-color:#FFE1CC;padding:40px 15px 40px 15px;">
                            <h1 style="color:#FE6E04;font-size:30px;">
                                <b>Welcome To Address Guru</b>
                            </h1>
                            <hr />
                            <h3 style="color:#282323;font-size:20px;">Thanks for being part of Address Guru</h3>

                            <p>AddressGuru is online local business directory that provide information about your daily needs just one click away. We get your business listed on it and grow online by reaching everyone who search you online.</p>

                            <h4 style="font-size:18px;">&#128273; Your one time password: '.$rands.'</h4>
                            <br />
                            <center>
                                <img src="http://www.addressguru.in/images/logopng.png" style="width:150px;">
                            </center>
                        </div>
                    </div>
                </body>
            </html>
        ';

        $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type:text/html;charset=UTF-8' . "\r\n" .
            'From: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
            'Reply-To: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $htmlContent, $headers);

            return $user;
    }
}