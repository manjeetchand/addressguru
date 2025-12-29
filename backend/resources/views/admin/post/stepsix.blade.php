<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="robots" content="noindex">
@extends('layouts.app')
<title>{{$listing->category->name}} | Address Guru</title>
<style>
  .silver, .plat {
  float: left;
  width: 33%;
  background: rgba(255,255,255,1);
  text-align: center;
  padding: 0px 20px 20px 20px;
  border:1px solid #ccc;
}

.gold {
  float: left;
  position: relative;
  width: 33%;
  top: -50px;
  padding: 50px 10px 50px 10px;
  background: rgba(52, 152, 219,1.0);
  text-align: center;
  border-radius: 5px;

}

.h1 {
  margin: 20px 0 10px 0;
  font-size: 1.25em;
  color: rgba(0,0,0,0.8);
}

.h2 {
  font-size: .75em;
  color: rgba(0,0,0,.6);
  font-weight: 100;
  letter-spacing: 1px;
}

.p {
  color: rgba(0,0,0,.4);
  font-weight: 100;
  font-size: 16px;
  text-align:left;
  margin-left:20px;
}

.span {
  margin-bottom: 20px;
  padding-bottom: 10px;
  display: inline-block;
  width: 125px;
  font-size: 18px;
  font-weight: 700;
  letter-spacing: 1px;
  color: rgba(0,0,0,.5);
  border-bottom: 1px solid rgba(0,0,0,.1);
}

.price {
  height: 120px;
  width: 120px;
  text-align: center;
  background-color: #FF6E04;
  border-radius: 50%;
  line-height: 120px;
  color: #fff;
  font-size: 30px;
  font-weight: 100;

  margin: 20px auto;
}
.gold .h1
{
  color:#fff;
}
.gold .h2
{
  color:#fff;
}
.gold .p
{
  color:#fff;
}
.gold .span
{
  color:#fff;
}
.gold .p i
{
  color:#ffff;
}
.p i
{
  color:#FF6E04;
}
.gold .price{
  background-color: #fff;
  color: #333;
}
.icon .p
{
  color:#fff!important;
}
.button:hover
{
  background-color:#333;
}
.button {
  display: block;
  margin: 20px auto;
  width: 150px;
  height: 35px;
  border-bottom: 5px solid rgba(192, 57, 43,1.0);
  background: #FF6E04;
  border: none;
  border-radius: 5px;
  color: #FFF!important;
  font-size: .75em;
  font-weight: 100;
  transition: all ease-in-out .2s;
}
</style>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">


@section('content')
<div class="container-fluid header_post">
	<div class="row">
		<div class="col-md-12 text-center ad" style="color:white;">
			<h2><b>
         
            <i class="{{$listing->category->icon}} fa-fw"></i> {{$listing->category->name}} 
            @if($listing->subcategory_id != null)
              - <i class="fa fa-tag fa-fw"></i> {{$listing->subcategory->name}}
            @endif
        
      </b></h2>
		</div>
	</div>
</div>

<div class="container" style="background-color:#fff;padding:0px 40px 0px 40px;">
   <div class="row">
      <div class="col-md-12">
        <div id="rms-wizard" class="rms-wizard">
     <!--Wizard Container-->
       <div class="rms-container">
          <div class="rms-form-wizard">
          <div class="rms-step-section compeletedStepClickable" data-step-counter="true" data-step-image="false">
                <ul class="rms-multistep-progressbar"> 
                  <a href="{{route('post.edit', $id)}}">
                    <li class="rms-step rms-current-step active1">
                      
                        <span class="step-title">Business Information</span>
                        <span class="step-info">Update your business' details and info</span>
                      
                    </li> 
                    </a>
                    <a href="{{url('step-two', $id)}}">
                    <li class="rms-step rms-current-step active1">
                        
                        <span class="step-title">Social Details</span>
                        <span class="step-info">Add links of your social profiles</span>
                    </li>
                  </a>
                  <a href="{{url('step-three', $id)}}">
                    <li class="rms-step rms-current-step active1">
                        
                        <span class="step-title">Business Contact Details</span>
                        <span class="step-info">Add your contact details for buyers to connect</span>
                    </li>
                  </a>
                  <!--<a href="{{url('step-four', $id)}}">-->
                  <!--  <li class="rms-step rms-current-step active1">-->
                       
                  <!--      <span class="step-title">Search Engine Friendly</span>-->
                  <!--      <span class="step-info">Update SEO friendly keywords and description</span>-->
                  <!--  </li>-->
                  <!--</a>-->
                  <a href="{{url('step-five', $id)}}">
                    <li class="rms-step rms-current-step active1">
                        <span class="step-icon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                        <span class="step-title">Upload Slider Images</span>
                        <span class="step-info">Upload relevant slider images of your business</span>
                    </li>
                  </a>
                    <li class="rms-step active">
                        <span class="step-icon"><i class="fa fa-money" aria-hidden="true"></i></span>
                        <span class="step-title">Payment</span>
                        <span class="step-info">Proceed for payment</span>
                    </li>
                </ul>
            </div>
            </div>
          </div>
          </div>
      </div>

    </div>
 @if(count($errors) > 0)

  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>

@endif
    <br/><br/><br/><br/>
    <div class="row">
      <div class="col-md-12">
       
        <div class="silver">
        <h1 class="h1"><i class="fa fa-free-code-camp fa-fw"></i> Free</h1>
        <!-- <h2>Basic No-Frills Package</h2> -->
        <div class="price"> $0</div>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Limited Leads</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Limited Reach</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Limited Email</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Website Active Link</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Ad Lisitng Support</p>
        <!-- <p class="p">Forums</p>
        <span class="span">Courses Only</span> -->
        {!! Form::model($listing, ['method'=>'PATCH', 'action'=>['CoachingInsert@update', $id]]) !!}
        <input type="hidden" name="payment" value="0">
        <center><button class="button">Select Plan</button></center>
        {!! Form::close() !!}
      </div>
      <div class="gold">
        <h1 class="h1"><i class="fa fa-diamond fa-fw"></i> Professional Plan</h1>
        <!-- <h2>Basic No-Frills Package</h2> -->
        <div class="price"> $49/y</div>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> List in Featured Category</p>
<!--         <span class="span">4 </span> -->
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Get More Leads</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Maximum Reach</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Unlimited Email</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Website Active Link</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Ad Lisitng Support</p>
       <!--  <p class="p">Forums</p>
        <span class="span">Courses Only</span> -->
        <center><button data-toggle="modal" class="toggler button" path="49" data-target="#myModal">Select Plan</button></center>
      </div>
      <div class="plat">
        <h1 class="h1"><i class="fa fa-flash fa-fw"></i> Basic Plan</h1>
       <!--  <h2>Basic No-Frills Package</h2> -->
        <div class="price"> $9/m</div>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> List in Featured Category</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Get More Leads</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Maximum Reach</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> 200 Emails Monthly</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Website Active Link</p>
        <p class="p"><i class="fa-fw fa fa-check-circle"></i> Ad Lisitng Support</p>
        <center><button data-toggle="modal" class="toggler button" path="9" data-target="#myModal">Select Plan</button></center>
      </div>
      </div>
    </div>
         
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" style="color:#333!important;width:10px;height:0px;">&times;</button>
        <h4 class="modal-title"><i class="fa fa-money fa-fw"></i> Pay Now</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <img src="{{url('/')}}/images/pay.png" class="img-responsive">
          </div>
          <div class="col-md-6">
            {!! Form::open(['action'=>'PaymentControl@store']) !!}
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" placeholder="Full Name" class="form-control" required="required" value="{{$per->name}}">
              </div>
              <div class="form-group">
                <label>Mobile Number</label>
                <input type="number" name="phone" placeholder="Mobile Number" class="form-control" required="required" value="{{$per->ph_number}}">
              </div>
              <div class="form-group">
                <label>Amount</label>
                <input type="number"  name="amount" readonly="readonly" value="PATHHERE" placeholder="Amount" class="form-control pathinput" required="required">
              </div>
              <input type="hidden" name="email" value="{{$per->email}}">
              <input type="hidden" name="user_id" value="{{$listing->user_id}}">
              <input type="hidden" name="post_id" value="{{$listing->id}}">
              <input type="hidden" name="agree" value="1">
              <div class="form-group">
                <center><button class="btn btn-success btn-sm"><i class="fa fa-money fa-fw"></i> Pay Now</button></center>
              </div>
              
            {!! Form::close() !!}<br/>
            <p class="text-success text-center" style="font-size:20px;">Best Price Guaranteed | Fast Response</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

@stop