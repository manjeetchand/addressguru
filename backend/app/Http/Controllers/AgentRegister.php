<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AgentRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
class AgentRegister extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('role_id', '=', 3)->get();
        return view('agent.register.index', compact('user'));
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
    public function store(AgentRequest $request){
        $input = $request->all();
        $user = User::create([
            'role_id' => 3,
            'name' => $input['name'],
            'email' => $input['email'],
            'mobile_number' => $input['mobile_number'],
            'password' => bcrypt($input['password']),
            'verify'=> rand(10, 1000000),
        ]);
        $to = $input['email'];
        $subject = "Verify OTP | AddressGuru";
        $htmlContent = '<!DOCTYPE html>
        <html>
        <head>
        </head>
        <body>
          <div style="margin:auto;width:1000px;">
            <div style="background-color:#FFE1CC;padding:40px 15px 40px 15px;">
              <h1 style="color:#FE6E04;font-size:30px;"><b>Welcome To Address Guru</b></h1><hr/>
              <h3 style="color:#282323;font-size:20px;">Thanks for being part of Address Guru</h3>
              <p>AddressGuru is online local business directory that provide information about your daily needs just one click away. We get your business listed on it and grow online by reaching everyone who search you online.</p>
              <h4 style="font-size:18px;">&#128273; Your one time password: '.$user->verify.'</h4>
              <br/>
              <center><img src="http://www.addressguru.in/images/logopng.png" style="width:150px;"></center>
            </div>
          </div>
        </body>
        </html>';
            $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type:text/html;charset=UTF-8' . "\r\n" .
            'From: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
            'Reply-To: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            mail($to, $subject, $htmlContent, $headers);
        Auth::login($user);
        return redirect()->route('partner.show',$user->id);
        // return redirect()->route('Partner Dashboard.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorFail($id);
       return view('agent.register.otp',compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        //
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

    public function verifyOTP(Request $request, $id) {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user && $user->verify == $request->otp) {
                $user->update(['verify' => null,'is_active' => 1]);
                $url = url('/login');
                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP verified successfully!',
                    'redirect_url' => $url,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid OTP'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong! Please try again.'], 500);
        }
    }

    function ResendOtp(Request $request,$user){
        try{
            $otp = rand(100000, 999999);
            $user = User::find($user);
            $user->update(['verify' => $otp]);
            $to = $user->email;
            $subject = "Verify OTP | AddressGuru";
            $htmlContent = '<!DOCTYPE html>
            <html>
            <head>
            </head>
            <body>
              <div style="margin:auto;width:1000px;">
                <div style="background-color:#FFE1CC;padding:40px 15px 40px 15px;">
                  <h1 style="color:#FE6E04;font-size:30px;"><b>Welcome To Address Guru</b></h1><hr/>
                  <h3 style="color:#282323;font-size:20px;">Thanks for being part of Address Guru</h3>
                  <p>AddressGuru is online local business directory that provide information about your daily needs just one click away. We get your business listed on it and grow online by reaching everyone who search you online.</p>
                  <h4 style="font-size:18px;">&#128273; Your one time password: '.$user->verify.'</h4>
                  <br/>
                  <center><img src="http://www.addressguru.in/images/logopng.png" style="width:150px;"></center>
                </div>
              </div>
            </body>
            </html>';
                $headers = 'MIME-Version: 1.0' . "\r\n" .
                'Content-type:text/html;charset=UTF-8' . "\r\n" .
                'From: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
                'Reply-To: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                mail($to, $subject, $htmlContent, $headers);
            return response()->json([
                'message' => 'OTP Send successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong! Please try again.'], 500);
        }
    }
}