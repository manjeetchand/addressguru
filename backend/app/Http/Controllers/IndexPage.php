<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\SEO;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Packages;
use App\Coaching;
use App\Report;
use App\Query;
use App\Claim;
use App\Personal;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Views;
use App\Media;
use App\Rating;
use App\Role;
use App\Http\Requests;
class IndexPage extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('auth.login');
        $user = Auth::user();
        $cat = Coaching::where('status', '=', 1)->pluck('category_id'); 
        $check = collect($cat);   
        $cate = $check->unique()->values()->all();
        $category = Category::findOrFail($cate);
        $check = Personal::where('city','!=','select')->where('status', '=', 1)->pluck('city'); 
        $check1 = collect($check);   
        $uniques = $check1->unique()->values()->all();
        $ads = Coaching::where('status', '=', 1)->orderBy('id', 'DESC')->take(8)->get();
        return view('welcome', compact('user', 'category', 'uniques', 'ads'));
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
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        if($slug == "welcome"){
            $user = Auth::user();
            $cat = Coaching::where('status', '=', 1)->pluck('category_id'); 
            $check = collect($cat);   
            $cate = $check->unique()->values()->all();
            $category = Category::findOrFail($cate);
            $check = Personal::where('city','!=','select')->where('status', '=', 1)->pluck('city'); 
            $check1 = collect($check);   
            $uniques = $check1->unique()->values()->all();
            $ads = Coaching::where('status', '=', 1)->orderBy('id', 'DESC')->take(8)->get();
            return view('welcome-2', compact('user', 'category', 'uniques', 'ads'));
        }
        $post = Coaching::with(['ratings' => function ($r) {$r->where('status', '=', 1);}])->where('slug', '=', $slug)->first();
        if (isset($post)){
            if ($post->status == 0){
                abort(404);
            }
        }else{
            abort(404);
        }
        $category = Category::all();
        return view('posts.show', compact('post', 'category'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    /**
     * 
     */
    public function changeCity(Request $request)
    {
        $return = ['ok'=> 0, 'msg'=> NULL];
        if($request->filled('city'))
        {
            setcookie('cityname', $request->city);
            $return['ok']  = 1;
            $return['msg'] = 'The city is changed successfully!';
        }
        else
        {
            $return['msg'] = 'An invalid request is detected.';
        }
        return $return;
    }
    public function approve($name)
    {
        Personal::where('post_id', '=', base64_decode($name))->update(['is_active'=>1]);
        Session::flash('send', 'Successfully Approved!');
        return redirect('/');
    }
    public function disapprove($name)
    {
        $post = Coaching::findOrFail(base64_decode($name));
        $to = $post->user->email;
        $subject = "Rejection email for ".$post->business_name." by your client | AddressGuru.";
        $htmlContent = "
               <div style='margin:auto;width:1000px;'>
                <div style='background-color:#F3F3F3;padding:40px 15px 40px 15px;'>
                    <h1 style='color:red;font-size:24px;'><b>Rejection email <b>for ".$post->business_name."</b> by your client | AddressGuru.</b></h1><hr/><br/>
                    <span style='font-family:arial;color:#645d5d;'>
                        Hi, ".$post->user->name."<br/><br/>
                        Thank you so much for your interest in Internship with AddressGuru. We appreciate you taking the time for data entry job.<br/><br/>
We found your listing not up to the mark. However, we were impressed with your technical knowledge.<br/><br/>
We will be posting a few more data entry jobs in the coming weeks, and hope you’ll consider applying again. Otherwise, we wish you the best of luck in your career endeavors.
 <br/><br/>
Thank you!<br/>
<b>AddressGuru</b>
                    </span><br/><br/>
                    <center><img src='https://www.addressguru.sg/images/logopng.png' style='width:150px;'></center>
                </div>
            </div>
              ";
        $headers = 'MIME-Version: 1.0' . "\r\n" .
            'Content-type:text/html;charset=UTF-8' . "\r\n" .
            'From: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
              'Reply-To: "AddressGuru" <'.env('EMAIL').'>' . "\r\n" .
              'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $htmlContent, $headers);
        $user = User::findOrFail(67);
        Personal::where('post_id', '=', $post->id)->update([
            'user_id'  => $user->id,
        ]);
        Claim::where('user_id', '=', $post->user_id)->update(['user_id'=>$user->id]);
        Query::where('post_id', '=', $post->id)->update(['user_id'=>$user->id]);
        Rating::where('post_id', '=', $post->id)->update(['user_id'=>$user->id]);
        SEO::where('post_id', '=', $post->id)->update(['user_id'=>$user->id]);
        Report::where('user_id', '=', $post->user_id)->update(['user_id'=>$user->id]);
        $post->update(['user_id'=>$user->id]);
        Session::flash('send', 'Successfully Dis-Approved!');
        return redirect('/');
    }
}