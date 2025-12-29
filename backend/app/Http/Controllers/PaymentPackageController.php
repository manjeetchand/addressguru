<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coaching;
use App\Personal;
use App\Plan;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;


class PaymentPackageController extends Controller
{
    
    public function index()
    {
        $plans = Plan::all();
        return view('admin.payment-plan.index',compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment-plan.create');
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
            'type' => 'required',
            'name' => 'required',
            'sequence' => 'required|numeric',
            'price' => 'required|numeric',
            'days' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required|max:50',
        ]);
    
        $deal = $request->has('deal') ? 1 : "0";
        $status = $request->has('status') ? 1 : "0";
    
        Plan::create([
            'type' => $request->type,
            'name' => $request->name,
            'sequence' => $request->sequence,
            'price' => $request->price,
            'days' => $request->days,
            'discount' => $request->discount,
            'description' => $request->description,
            'deal' => $deal,
            'status' => $status,
        ]);
    
        return redirect()->back()->with('insert', 'Successfully Created!');
    }


    public function show($id)
    {
        
    }


    public function edit($id)
    {
        $plan = Plan::find($id);
        return view('admin.payment-plan.edit',compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
       $this->validate($request, [
            'type' => 'required',
            'name' => 'required',
            'sequence' => 'required|numeric',
            'price' => 'required|numeric',
            'days' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required|max:50',
        ]);
    
        $deal = $request->has('deal') ? 1 : 0;
        $status = $request->has('status') ? 1 : 0;
        
        $plan = Plan::findorfail($id);
        $plan->update([
            'type' => $request->type,
            'name' => $request->name,
            'sequence' => $request->sequence,
            'price' => $request->price,
            'days' => $request->days,
            'discount' => $request->discount,
            'description' => $request->description,
            'deal' => $deal,
            'status' => $status,
        ]);
    
        return redirect()->back()->with('insert', 'Successfully Update!');
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
