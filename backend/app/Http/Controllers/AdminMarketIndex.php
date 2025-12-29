<?php

namespace App\Http\Controllers;
use App\Product;
use App\Payment;
use App\Report;
use App\User;
use App\Query;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminMarketIndex extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $live = Product::where('status', '=', 1)->count();

        $pro = Product::where('status', '=', 0)->where('post_status', '=', 1)->count();

        $product = Product::onlyTrashed()->count();

        $report = Report::where('product_id', '!=', null)->count();

        $q = Query::where('product_id', '!=', null)->count();

        $pay = Payment::where('product_id', '!=', null)->pluck('amount');

        $recent = Product::where('status', '=', 1)->orderBy('updated_at', 'DESC')->limit(10)->get();

        $amount = 0;

        foreach ($pay as $key => $value) 
        {
            $amount += $value;
        }

        return view('admin.market.index', compact('live', 'amount', 'pro', 'report', 'q', 'recent', 'product'));
    }

    public function adsapprove()
    {
        $pro = Product::where('status', '=', 0)->with('medias')->where('post_status', '=', 1)->orderBy('id', 'DESC')->paginate(50);

        return view('admin.adsapprove', compact('pro'));
    }

    public function adapp(Request $request)
    {
        $input = $request->all();

        $pro = Product::findOrFail($input['wid']); 

        $pro->update(['status' => 1]);

        $to = $pro->user->email;
        $subject = "Great news! ".$pro->title." has Published with AddressGuru.";
        $htmlContent = "
           <div style='margin:auto;width:1000px;'>
            <div style='background-color:#FFE1CC;padding:40px 15px 40px 15px;'>
                <h1 style='color:#FE6E04;font-size:24px;'><b>Great news! <b>".$pro->title."</b> has Published with AddressGuru.</b></h1><hr/>
                <span style='font-family:arial;'>Link: <a href='https://www.addressguru.sg/".$pro->slug."' target='_blank'>https://www.addressguru.sg/".$pro->slug."</a> visit your listing!</span><br/>
                
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query = Query::where('product_id', '!=', null)->orderBy('id', 'DESC')->paginate(50);

        return view('admin.all', compact('query'));
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

        $post = Product::where('title', 'LIKE', '%' . $input['find'] . '%')->with('medias')->where('post_status', '=', 1)->get();

        return view('admin.market.search', compact('post'));
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

        $product = Product::where('post_status', '=', 1)->where('user_id', '=', $id)->with('medias')->orderBy('id', 'DESC')->paginate(50);

        return view('admin.market.user', compact('user', 'product'));
    }

    public function report()
    {
        $report = Report::where('product_id', '!=', null)->orderBy('id', 'DESC')->get();

        return view('admin.report.index', compact('report'));
    }

    public function paymnet()
    {
        $pay = Payment::where('product_id', '!=', null)->orderBy('id', 'DESC')->paginate(50);

        return view('admin.market.payment', compact('pay'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Product::findOrFail($id)->update(['status'=>0]);

        Session::flash('insert', 'Successfully Un-Approved');

        return redirect()->back();
    }

    public function depro()
    {
        $product = Product::with('medias')->onlyTrashed()->paginate(50);

        return view('admin.market.depro', compact('product'));
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
        Product::withTrashed()->where('id', '=', $id)->restore();

        Session::flash('active', 'Successfully Active!');

        return redirect()->back();
    }

    public function trash($id)
    {
        Product::onlyTrashed()->where('id', '=', $id)->forceDelete();

        Session::flash('active', 'Successfully Deleted!');

        return redirect()->back();
    }

    public function live()
    {
        $pro = Product::where('status', '=', 1)->orderBy('id', 'DESC')->paginate(50);

        return view('admin.market.live', compact('pro'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        Session::flash('insert', 'Successfully Deleted!');

        return redirect()->back();
    }
}
