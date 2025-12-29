<!DOCTYPE html>
<html lang="en">
<head>
   
@extends('layouts.app')
<style type="text/css">
  .rms-wizard .rms-multistep-progressbar li.rms-step
  {
    width:25%!important;
  }
</style>
<title>{{$listing->msubcategory->name}} | Address Guru</title>

    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">
    <meta name="robots" content="noindex">
@section('content')
<div class="container-fluid header_post">
  <div class="row">
    <div class="col-md-12 text-center ad" style="color:white;">
      <h2><b>
            <i class="{{$listing->mcategory->icon}}"></i> {{$listing->msubcategory->name}}
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
                    <a href="{{url('sell-step-one-edit', $id)}}">
                    <li class="rms-step rms-current-step active1">
                        <span class="step-icon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <span class="step-title">Ad Information</span>
                        <span class="step-info">Update your Ad details and info</span>
                    </li> 
                    </a>
                    <a href="{{url('sell-step-two', $id)}}">
                    <li class="rms-step active1">
                        <span class="step-icon ml10"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                        <span class="step-title">Add Photos</span>
                        <span class="step-info">Add your product images</span>
                    </li>
                    </a>
                    <a href="{{url('sell-step-three', $id)}}">
                    <li class="rms-step active1">
                        <span class="step-icon ml10"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                        <span class="step-title">Contact Details</span>
                        <span class="step-info">Add your contact details for buyers to connect</span>
                    </li>
                    </a>
                    <li class="rms-step active">
                        <span class="step-icon"><i class="fa fa-money" aria-hidden="true"></i></span>
                        <span class="step-title">Final Step</span>
                        <span class="step-info">Proceed for final step</span>
                    </li>
                </ul>
            </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  @if(Session::has('no'))
    <div class="alert alert-danger" style="margin-bottom:0px;">
        <strong> {{session('no')}}</strong>
    </div>
    
@endif
@if(Session::has('insert'))
    <div class="alert alert-success" style="margin-bottom:0px;">
        <strong> {{session('insert')}}</strong>
    </div>
    
@endif
    <div class="row form-new">  
        <div class="col-md-12">
          <br/>
          {!! Form::model($listing, ['method'=>'PATCH', 'action'=>['CoachingInsert@mupdate', $id]]) !!}

          <input type="hidden" name="payment" value="0">

          <div class="panel panel-primary payment-css">
            <div class="panel-heading">
              <h4 style="margin:0px;">Promote your Ad</h4>
            </div>
            <div class="panel-body">
              <h5><i class="fa fa-picture-o"></i> Highlighted Ads</h5>
              <p>Have your ad seen on the homepage by thousands of people</p>
              <label><input type="radio" name="amount" required="required" value="1"><span class="checkmark"></span> S${{env('first_price')}} for 7 days</label>
            </div>
            <div class="panel-footer">
              <h5><i class="fa fa-eye fa-fw"></i> Featured Ads</h5>
              <p>Highlight your ad to gain visibility and stand out from the crowd</p>
              <label><input type="radio" name="amount" required="required" value="2"><span class="checkmark"></span> S${{env('second_price')}} for 7 days</label><br/>
              <label><input type="radio" name="amount" required="required" value="3"><span class="checkmark"></span> S${{env('third_price')}} for 31 days</label> <span class="badge" style="background-color:#FF6E03;"><i class="fa fa-fire fa-fw"></i> Best Deal</span>

            </div>
            <div class="panel-body">
              <h5><i class="fa fa-newspaper-o"></i> Top Ad</h5>
              <p>Show your ads on rotation at the top of the category pages</p>
              <label><input type="radio" name="amount" required="required" value="4"><span class="checkmark"></span> S${{env('four_price')}} for 7 days</label><br/>
              <label><input type="radio" name="amount" required="required" value="5"><span class="checkmark"></span> S${{env('five_price')}} for 31 days</label> <span class="badge" style="background-color:#FF6E03;"><i class="fa fa-fire fa-fw"></i> Best Deal</span>
            </div>
            
            <div class="panel-footer">
              <h5><i class="fa fa-free-code-camp fa-fw"></i> Free</h5>
              <p>Show your ads on rotation at the top of the category pages</p>
              <label><input type="radio" name="amount" required="required" value="0"><span class="checkmark"></span> S$0</label>
            </div>
          </div>
          
          <div id="stop">
            <div class="row">
                <div class="col-md-12">
                  <div id="rms-wizard" class="rms-wizard">
                  <div class="rms-container">
                  <div class="rms-form-wizard">
                  <div class="rms-footer-section">
                <div class="button-section">
                    <span class="next">
                      <button class="btn">Finish
                            <small>Post Ad</small>
                      </button>
                    </span>
                </div>
            </div>
          </div>
            </div>
          </div>   
                </div>
            </div>
          {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>
@stop