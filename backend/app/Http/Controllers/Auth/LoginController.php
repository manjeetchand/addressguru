<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated(Request $request, $user)
    {
        if (Session::has('checklog')) 
        {
            Session::forget('checklog');
            return redirect('marketplace-post');    
        }
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
        $this->middleware('guest')->except('logout');
    }



}