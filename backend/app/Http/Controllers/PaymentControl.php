<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coaching;
use App\Personal;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use URL;

class PaymentControl extends Controller
{
    private $_api_context;

    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('errors.404');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $post = Coaching::where('slug', '=', $slug)->first();

        $personal = Personal::where('post_id', '=', $post->id)->get();

        return view('payment.create', compact('post', 'personal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        $input = $request->all();

        if (request()->has('banner_id')) 
        {
            $description = $input['name']." Banner Ad with AddressGuru";

            Session::put('banner_id', $input['banner_id']);
        }
        else
        {
            $description = $input['name']." Listed with AddressGuru";
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('SGD')
            ->setQuantity(1)
            ->setPrice($input['amount']); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('SGD')
            ->setTotal($input['amount']);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($description);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('success1')) /** Specify return URL **/
            ->setCancelUrl(URL::to('success1'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('no', 'Connection timeout');
                return Redirect::to('failed');

            } else {

                \Session::put('no', 'Some error occur, sorry for inconvenient');
                return Redirect::to('failed');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        Session::put('paypal_amount', $input['amount']);

        Session::put('paypal_post_id', $input['post_id']);

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        \Session::put('no', 'Unknown error occurred');
        return Redirect::to('failed');
    }

    public function success1()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        $amount = Session::get('paypal_amount');

        $post_id = Session::get('paypal_post_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            \Session::put('no', 'Payment failed');
            return Redirect::to('failed');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {

            \Session::put('success', 'Payment success');

            if (!Session::get('banner_id')) 
            {
                DB::insert('insert into payments (user_id, post_id, banner_id, amount, payment_id, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [Auth::user()->id, $post_id, Session::get('banner_id'), $amount, $payment_id, NOW(), NOW()]);  

                if ($amount == '499') 
                {
                    Banner::where('id', '=', Session::get('banner_id'))->update(['paid' => 1]);
                }
            }
            else
            {
                DB::insert('insert into payments (user_id, post_id, amount, payment_id, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [Auth::user()->id, $post_id, $amount, $payment_id, NOW(), NOW()]);  

                if ($amount == '9') 
                {
                    Personal::where('post_id', '=', $post_id)->update(['paid' => 3]);
                    Coaching::where('id', '=', $post_id)->update(['paid' => 3]);
                }
                elseif ($amount == '49') 
                {
                    Personal::where('post_id', '=', $post_id)->update(['paid' => 4]);
                    Coaching::where('id', '=', $post_id)->update(['paid' => 4]);
                }
            }

            Session::forget('paypal_amount');

            Session::forget('paypal_post_id');

            return Redirect::to('success');

        }

        \Session::put('no', 'Payment failed');
        return Redirect::to('failed');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

    public function redirect(Request $request)
    {
        
    }
}
