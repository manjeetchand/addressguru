<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Role;
use App\Payment;
use App\Personal;
use App\Coaching;
use App\Product;
use App\Banner;
use App\Category;
use App\Report;
use App\Rating;
use App\Query;
use App\Views;
USE App\SEO;
use App\Claim;
use App\Http\Requests;
class AdminIndex extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::onlyTrashed()->count();
        $post = Coaching::onlyTrashed()->count();
        $claim = Claim::count();
        $report = 0;
        $query = 0;
        $app = Coaching::where('status', '=', 0)->where('user_id', '!=', 67)->where('post_status', '=', 1)->count();
        $banner = Banner::where('status', '=', 0)->count();
        $live = Coaching::where('status', '=', 1)->count();
        $active = User::where('is_active', '=', 1)->where('role_id', '=', 2)->count();
        $active1 = User::where('is_active', '=', 1)->where('role_id', '=', 3)->count();
        $q = 0;
        $view = Views::where('views', '!=', 0)->orderBy('views', 'DESC')->limit(10)->get();
        $recent = Coaching::where('status', '=', 1)->orderBy('updated_at', 'DESC')->limit(10)->get();
        $pay = Payment::where('product_id', '=', null)->pluck('amount');
        $amount = 0;
        foreach ($pay as $key => $value) 
        {
            $amount += $value;
        }
        return view('admin.index', compact('claim', 'post', 'user', 'query', 'report', 'app', 'banner', 'live', 'active', 'active1', 'q', 'view', 'recent', 'amount'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pay = Payment::where('product_id', '=', 1)->orderBy('id', 'DESC')->paginate(50);
        return view('admin.payment', compact('pay'));
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
        $post = Coaching::where('business_name', 'LIKE', '%' . $input['find'] . '%')->where('post_status', '=', 1)->get();
        return view('admin.search', compact('post'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Coaching::findOrFail($id);
        $user = User::all();
        return view('admin.view', compact('post', 'user'));
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
        $this->validate($request, [
            'transfer'=>'required',
        ]);
        $input = $request->all();
        $post = Coaching::findOrFail($id);
        $user = User::findOrFail($input['transfer']);
        Personal::where('post_id', '=', $id)->update([
            'user_id'  => $input['transfer'],
            'name'     => $user->name,
            'email'    => $user->email,
        ]);
        Claim::where('user_id', '=', $post->user_id)->update(['user_id'=>$input['transfer']]);
        Query::where('post_id', '=', $id)->update(['user_id'=>$input['transfer']]);
        Rating::where('post_id', '=', $id)->update(['user_id'=>$input['transfer']]);
        SEO::where('post_id', '=', $id)->update(['user_id'=>$input['transfer']]);
        Report::where('user_id', '=', $post->user_id)->update(['user_id'=>$input['transfer']]);
        $post->update(['user_id'=>$input['transfer']]);
         Session::flash('transfer', 'Successfully Transfered !');
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
    }
    public function pay($id)
    {
        $pay = Payment::findOrFail($id);
        Coaching::findOrFail($pay->post_id)->update(['paid'=>0]);
        Personal::where('post_id', '=', $pay->post_id)->update(['paid'=>0]);
        Session::flash('transfer', 'Successfully Un-Approved!');
        return redirect()->back();
    }
}