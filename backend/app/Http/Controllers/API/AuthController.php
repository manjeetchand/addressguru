<?php
/**
 * Address Guru's Authentication API's Controller
 *
 * Handles API requests for Address Guru's User's Authentication
 *
 * PHP version 7.4
 *
 * LICENSE: This source file is private software of Address Guru. No one
 * is allowed to copy, delete, change, distribute this file or data without 
 * a written permission from the Director of Address Guru.
 *
 * @category   Application Route Controller
 * @package    MarketController
 * @author     Robin Tomar <robintomr@icloud.com>
 * @author     Jatin Jangra <jatinjangra10@rediffmail.com>
 * @copyright  2020-2024 Address Guru
 */
namespace App\Http\Controllers\API;
use App\User; 
use App\Query;
use App\PushToken;
use App\Mail\EMail;
use App\Http\Controllers\Controller; 
use Laravel\Passport\Token;
use Laravel\Passport\RefreshToken;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;
use Illuminate\Mail\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    public $successStatus = 200;
    /** 
     * Method to Authenticate the User
     * 
     * @param Illuminate\Http\Request $request The incoming request
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */ 
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validation->errors(),
            ], 400);
        }

        // Attempt login
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'status' => 401,
                'error'  => 'Invalid credentials!',
            ], 401);
        }

    
        $user = Auth::user();

        // Check if user is active
        if ($user->is_active != 1) {
            $this->sendOTP($user);
            Auth::logout();
            return response()->json([
                'status'  => 403,
                'error'   => 'Your account is not verified. Please verify your account.',
                'user_id' => $user->id,
            ], 403);
        }

        // Generate token if you are using Laravel Passport or Sanctum
        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([
            'status'       => 200,
            'message'      => 'Login successful!',
            'access_token' => $accessToken,
            'user'         => $user,
        ]);
        

        // $pushToken = null;

        // if ($request->filled('push_notification_token')) {
        //     $pushToken = $this->getPushNotificationToken($user, $request->push_notification_token);
        // }
        
        // Ensure only one active token if needed
        // DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
        // $accessToken = $user->createToken('authToken')->accessToken;
        // return response()->json([
        //     'status'       => 200,
        //     'access_token' => $accessToken,
        //     'user'         => $user,
        //     'pushToken'    => $pushToken
        // ]);
    }
        
    /**
     * Method to Authenticate User with OAuth (Google)
     * 
     * @param Illuminate\Http\Request $request The incoming request
     * @author Robin Tomar <robintomr@icloud.com>
     */
    public function socialLogin(Request $request)
    {
        $return      = ['status'=> 400];
        $provider    = 'google';
        $accessToken = NULL;

        if($request->filled('auth_code'))
        {
            $socialiteDriver = Socialite::buildProvider(
                GoogleProvider::class, config('services.google_app')
            );

            try {
                if($request->filled('g_token'))
                {
                    $accessToken = $request->auth_code;
                }
                else
                {
                    try {
                        $payload = $socialiteDriver->getAccessTokenResponse(urldecode($request->auth_code));

                        Log::debug('Access Token Response', ['payload' => $payload]);

                        if (!is_array($payload) || !isset($payload['access_token']))
                        {
                            return response(['error' => 'Invalid payload or missing access token'], 400);
                        }

                        $accessToken = $payload['access_token'];
                    } catch (\Exception $e) {
                        Log::error('Error fetching access token', ['exception' => $e->getMessage()]);
                        return response(['error' => 'Unable to fetch access token'], 500);
                    }
                }

                if($accessToken)
                {
                    try {
                        $socialUser = $socialiteDriver->stateless()->userFromToken($accessToken);

                        // Check if the user already exists in your application
                        $localUser = User::where('email', $socialUser->getEmail())->first();

                        if($localUser)
                        {
                            if(!$localUser->provider_id)
                            {
                                $localUser->provider    = strtoupper($provider);
                                $localUser->provider_id = $socialUser->user['id'];
                                $localUser->save();
                            }
                        }
                        else {
                            $localUser = User::create([
                                'name'       => $socialUser->getName(),
                                'email'      => $socialUser->getEmail(),
                                'role_id'    => 2,
                                'provider'   => strtoupper($provider),
                                'is_active'  => 1,
                                'provider_id'=> $socialUser->user['id'],
                            ]);

                            $localUser->save();
                        }

                        // Generate an API token for the user
                        $authToken = $localUser->createToken('authToken')->accessToken;

                        Log::debug($request->all());

                        // Get Push Notification token for the user
                        if($request->filled('push_notification_token'))
                        {
                            $pushToken = $this->getPushNotificationToken($localUser, $request->push_notification_token);
                        }

                        $return['user']         = $localUser;
                        $return['status']       = 200;
                        $return['pushToken']    = $pushToken ?? NULL;
                        $return['access_token'] = $authToken;
                    }catch(\Exception $e) {
                        $return['error']  = 'A Bad Request Detected!';
                        Log::debug($e->getMessage());
                    }
                }
            }catch(\Exception $e) {
                $return['error'] = $e->getMessage();
                // $return['error'] = 'Bad Request!';
                Log::debug($e->getMessage());
            }
        }
        else
        {
            $return['error'] = 'An invalid request is detected!';
        }
        return response($return, $return['status']);
    }
    /**
     * Method to Get/Create Push Notification Token
     * 
     * @param String $request The push notification token (if any)
     * @param App\User $user  The user for which push notification needed
     * @author Robin Tomar <robintomr@icloud.com>
     */
    private function getPushNotificationToken($user, $token)
    {
        $pushToken = PushToken::where([
            'token'  => $token,
            'status' => 1,
            'user_id'=> $user->id,
        ])->first();
        if(!$pushToken)
        {
            $pushToken = PushToken::create([
                'token'  => $token,
                'user_id'=> $user->id
            ]);
        }
        return $pushToken;
    }
    /** 
     * Method to Register a User in our system
     * 
     * @param  Illuminate\Http\Request $request The incoming request
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */ 
    public function register(Request $request)
    {
     
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|min:2|max:100',
            'phone'   => 'required|numeric|digits_between:8,15|unique:users,mobile_number',
            'email'   => 'required|email:filter|unique:users',
            'password'=> 'required|confirmed',
        ], [
            'phone.unique'=> 'This phone no. has already been used.'
        ]);
        if(! $validator->fails())
        {
            $userData                  = $validator->validated();
            $userData['verify']        = rand(10, 1000000);
            $userData['password']      = Hash::make($request->password);
            $userData['mobile_number'] = $validator->safe()->only('phone')['phone'];
            if($request->type === "agent"){
                $userData['role_id '] = 3;
            }
            
            $user                 = User::create($userData);
            $pushToken            = NULL;
            $accessToken          = $user->createToken('authToken')->accessToken;
            // Send the Email Verification OTP
            $this->sendOTP($user);
            if(isset($request->push_notification_token))
            {
               $pushToken = PushToken::create([
                    'user_id' => $user->id,
                    'token' => $request->push_notification_token
                ]);
            }
            return response(['user'=> $user, 'access_token'=> $accessToken, 'pushToken' => $pushToken], 200);
        }
        return response(['message'=> $validator->messages()], 422);
    }
    /**
     * Method to Logout User from requested Device
     * 
     * @param NULL
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function logout(Request $request)
    {
        PushToken::where('user_id', auth()->id())->where('token', $request->push_notification_token)->forceDelete();
        auth()->user()->token()->revoke();
        return response()->json(['msg'=> 'You\'ve been logged out successfully!'], 200);
    }
    /**
     * Method to send the password reset mail
     * 
     * @param  Illuminate\Http\Request $request The incoming request
     * @author Robin Tomar                      <robintomr@icloud.com>
     * @return array
     */
    public function forgot(Request $request)
    {
        $return    = ['status'=> 400, 'message'=> ''];
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email:filter',
        ]);
        if(!$validator->fails())
        {
            try {
                $response = Password::sendResetLink(
                    $request->only('email')
                );
                switch ($response) {
                    case Password::RESET_LINK_SENT:
                        return response()->json([
                            'status' => 'success',
                            'message' => trans($response) // e.g. "We have emailed your password reset link!"
                        ], 200);

                    case Password::RESET_THROTTLED:
                        return response()->json([
                            'status' => 'error',
                            'message' => trans($response) // e.g. "Please wait before retrying."
                        ], 429); // better to return 429 Too Many Requests

                    default:
                        return response()->json([
                            'status' => 'error',
                            'message' => trans($response) // e.g. "We can't find a user with that email address."
                        ], 400);
                }
            }
            catch (\Swift_TransportException $ex)
            {
                $return['message'] = $ex->getMessage();
            }
            catch (Exception $ex)
            {
                $return['message'] = $ex->getMessage();
            }
        }
        else
        {
            $return['message'] = $validator->errors()->first();
        }
        return response($return, $return['status']);
    }
    /**
     * Method to Update the Password got through email Link
     **/
    public function reset(Request $request)
    {   
        $this->validate($request,[
            'old_password'    => 'required',
            'new_password'    => 'required|min:6',
            'confirm_password'=> 'required|same:new_password',
        ]);
        $input  = $request->all();
        $userid = Auth::guard('api')->user()->id;
            try
            {
                if((Hash::check(request('old_password'), Auth::user()->password)) == false)
                {
                    $arr = array( "message" => "Check your old password.",'errors' => array('old_password' => ["Check your old password"]));
                       return \Response::json($arr ?? 'Error',Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                elseif((Hash::check(request('new_password'), Auth::user()->password)) == true)
                {
                    // $arr = array("status" => 400, "message" => "Please enter a password which is not similar then current password.", "data" => array());
                    $arr = array( "message" => "Please enter a password which is not similar then current password",'errors' => array('old_password' => 
                    ["Please enter a password which is not similar then current password"]));
                            return \Response::json($arr ?? 'Error',Response::HTTP_UNPROCESSABLE_ENTITY);
                }
                else
                {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Password updated successfully.", "data" => array());
                }
            }
            catch (\Exception $ex)
            {
                if(isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                }
                else
                {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg, "data" => array());
            }
        return \Response::json($arr ?? 'Error');
    }
    /**
     * Method to send the Email Verification OTP
     * 
     * @param Illuminate\Http\Request $request The incoming request
     * @author Robin Tomar            <robintomr@icloud.com>
     */

    public function sendEmailOTP(Request $request,$id)
    {
        $user = User::find($id);
        $return = ['status'=> 400, 'message'=> 'An invalid request is detected'];
        if(!$user->is_active)
        {
            $otpSentAt        = Carbon::parse($user->updated_at);
            $timeLapsed       = now()->diffInMinutes($otpSentAt);
            $return['status'] = 200;
            if($timeLapsed > 5)
            {
                $user->verify = rand(10, 1000000);
                if($user->save())
                {
                    $this->sendOTP($user);
                    $return['message'] = 'A fresh OTP is sent to your registered email address.';
                }
                else
                {
                    $return['status']  = 422;
                    $return['message'] = 'Unable to complete your request at this time. Please try again!';
                }
            }
            else
            {
                $after = 5 - $timeLapsed;
                $after = $after ?: 1;
                $return['message'] = 'An otp is already sent to your registered email. Please try after ' . ($after) . ' minutes.';
            }
        }
        else
        {
            $return['message'] = 'Your email is already verified!';
        }
        return response($return, $return['status']);
    }

    /**
     * Method to verify Email OTP
     * 
     * @param Illuminate\Http\Request $request
     * @author Robin Tomar            <robintomr@icloud.com>
     * @
     */
    public function verifyEmailOTP(Request $request,$id)
    {
        $return = ['status'=> 400, 'message'=> 'An invalid request is detected'];
        $validator = Validator::make($request->all(), [
            'otp'  => 'required|digits:6|max:100',
        ]);

        if(! $validator->fails()){
            if($request->filled('otp'))
            {
                $user = User::find($id);
                if(!$user->is_active)
                {
                    if($user->verify == $request->otp)
                    {
                        $user->verify    = NULL;
                        $user->is_active = 1;
                        if($user->save())
                        {
                            $return['user']  = $user;
                            $return['status']  = 200;
                            $return['message'] = 'Your email is now verified!';
                        }
                        else
                        {
                            $return['status']  = 422;
                            $return['message'] = 'Unable to complete your request at this time. Please try again!';
                        }
                    }
                    else
                    {
                        $return['message'] = 'This verification code is invalid!';
                    }
                }
                else
                {
                    $return['status']  = 422;
                    $return['message'] = 'Your email is already verified!';
                }
            }
                
        }else{
            return response(['message'=> $validator->errors()->first()], 422);
        }
        return response($return, $return['status']);
    }
    /**
     * Method to show method not allowed message
     * 
     * @param NULL
     * @author Robin Tomar <robintomr@icloud.com>
     * @return array
     */
    public function MNA()
    {
        return response()->json(['msg'=> 'This method is not allowed.'], 405);
    }
    /**
     * 
     */

    public function testMail() {
        $subject  = config('app.name');
        $subject .= ': OTP for Email Verification';
        $details     = (object) [
            'otp'  => 42563
        ];
        
        try {
            dd(
            Mail::to('digitarttech@gmail.com')
                ->send(new EMail($details, $subject, 'mails.notification.user.mailotp'))
            );
        }
        catch(\Exception $e)
        {
            dd($e);
            Log::error($e);
        }
    }

    private function sendOTP($user)
    {
        $subject  = config('app.name');
        $subject .= ': OTP for Email Verification';
        $details     = (object) [
            'otp'  => $user->verify
        ];
        try {
            Mail::to($user->email)->send(new EMail($details, $subject, 'mails.notification.user.mailotp'));
        }catch(\Exception $e)
        {
            Log::error($e);
        }
    }

    public function profileUpdate(Request $request)
    {
        $data = $this->validate($request, [
            'profileImage' => 'required|image|mimes:jpeg,png,jpg|max:2000',
            'name'         => 'required|string|min:2|max:50',
            'mobile_number'=> 'required|numeric|digits:10',
            'dob'          => 'required|date|date_format:Y-m-d',
        ], [
            'profileImage.max' => 'The profile image size must not exceed 2MB.',
        ]);
        try
        {
            $data['name'] = $request->name;
            if($request->has('profileImage'))
            {
                $file          = $request->file('profileImage');
                $data['photo'] = rand() . '.' . $file->getClientOriginalExtension();
                $file->move('images', $data['photo']);
            }
            $res = auth()->user()->update($data);
            if($res)
            {
                return response()->json(['status' => 'success','message' => "Profile Updated Successfully."]);
            }
            return response()->json(['status' => 'failed','message' => "An Error Occured! Please Try Again After Sometime."]);
        }
        catch(\Exception $e)
        {
            return response()->json(['status' => 'failed','message' => "An Error Occured! Please Try Again After Sometime."]);
            Log::error($e);
            return $e->getMessage();
        }
    }

    public function getProfileDetails(Request $request){
       try{ 
        $id = auth()->user()->id;
        $data = User::with('state','city')->select('name','email','dob','mobile_number','photo','state_id','city_id','created_at')->find($id);
        if(!empty($data->photo) ){
            $data['photo'] = url('images/'.$data->photo);
        }else{
            $data['photo'] = url('images/user.png');
        }
            return response()->json(['status' => '200','data' => $data]);
        }catch(\Exception $e){
            return $e->getMessage();
            return response()->json(['status' => 'failed','message' => "An Error Occured! Please Try Again After Sometime."]);
        }
    }

    public function goggleLogin(Request $request){
        $request->validate([
            'token' => 'required|string',
        ]);

        $googleUser = Socialite::driver('google')->stateless()->userFromToken($request->input('token'));
        // Check if the user already exists in your application
        $user = User::where('email', $googleUser->getEmail())->first();
        if (!$user) {
            // Create a new user
            $user = new User();
            $user->name = $googleUser->getName();
            $user->email = $googleUser->getEmail();
            // Set other user properties as needed
            $user->save();
        }
        // Generate an API token for the user
        $token = $accessToken = $user->createToken('authToken')->accessToken;
        // Push Notification Code
        if(isset($request->push_notification_token)){
            $uu = PushToken::where('user_id',$user->id)->where('token',$request->push_notification_token)->where('status','1')->first();
                if($uu){
                        if($request->push_notification_token  != $uu->token){
                            $uu->update(['token' => $request->push_notification_token]);
                        }    
                    }else{
                        PushToken::create([
                            'user_id' => auth()->user()->id,
                            'token' => $request->push_notification_token
                        ]);
                    }
                    $uu = PushToken::where('token',$request->push_notification_token)->first();
                }
        $user = User::find($user->id);
        $accessToken = $user->createToken('authToken')->accessToken;
        Log::debug( $request->all());
        // Return the API token as the response
        return response(['status'=> 200, 'access_token'=> $accessToken, 'user'=> $user,'pushToken' => $uu ?? 'NULL']);
        // $token = $user->createToken('GoogleToken')->plainTextToken;
    }


    public function redirect()
    {
        // Return Google OAuth URL to frontend
        $url = Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        return response()->json(['url' => $url]);
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        return $googleUser;

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
            ]
        );

        $token = $user->createToken('google-token')->plainTextToken;

        // Optional: redirect back to frontend with token
        return redirect('https://www.addressguru.sg/auth/success?token=' . $token);
    }
}