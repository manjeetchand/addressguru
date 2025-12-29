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
                    <li class="rms-step active">
                        <span class="step-icon ml10"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                        <span class="step-title">Contact Details</span>
                        <span class="step-info">Add your contact details for buyers to connect</span>
                    </li>
                    <li class="rms-step">
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
        <div class="col-md-9">
          <br/>

          {!! Form::model($listing, ['method'=>'PATCH', 'action'=>['CoachingInsert@mupdate', $id]]) !!}

          <input type="hidden" name="contact" value="0">
          @if(Auth::user()->role->name != "User")
          <div class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label>Contact Name</label>
                <input type="text" name="name" placeholder="Contact Name" required="required" value="{{$listing->name ? $listing->name : old('name')}}" class="form-control">
                @if ($errors->has('name'))
                   <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label>Email</label>
                <input type="email" name="email" placeholder="Contact Name" required="required" value="{{$listing->email ? $listing->email : old('email')}}" class="form-control">
                @if ($errors->has('email'))
                   <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                <label>Region</label>
                <select class="form-control" name="state" id="city1_c" required="required">
                  <option>{{$listing->state ? $listing->state : old('state')}}</option>
                </select>
                @if ($errors->has('state'))
                   <span class="help-block">
                        <strong>{{ $errors->first('state') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                <label>City</label>
                <select name="city" class="form-control cities2" id="city1_b" required="required">
                  <option>{{$listing->city ? $listing->city : old('city')}}</option>
                </select>
                @if ($errors->has('city'))
                   <span class="help-block">
                        <strong>{{ $errors->first('city') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('locality') ? ' has-error' : '' }}">
                <label>Locality</label>
                <input type="text" name="locality" class="form-control" placeholder="Locality" required="required" value="{{$listing->locality ? $listing->locality : old('locality')}}">
                @if ($errors->has('locality'))
                   <span class="help-block">
                        <strong>{{ $errors->first('locality') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label>Phone Number</label>
                <input type="number" name="phone" class="form-control" placeholder="Phone Number" required="required" value="{{$listing->phone ? $listing->phone : old('phone')}}">
                @if ($errors->has('phone'))
                   <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>
          @else
          <div class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label>Contact Name</label>
                <input type="text" name="name" placeholder="Contact Name" required="required" value="{{$listing->name ? $listing->name : Auth::user()->name}}" class="form-control">
                @if ($errors->has('name'))
                   <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label>Email</label>
                <input type="email" name="email" placeholder="Contact Name" required="required" readonly="readonly" value="{{$listing->email ? $listing->email : Auth::user()->email}}" class="form-control">
                @if ($errors->has('email'))
                   <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                <label>Region</label>
                <select class="form-control" name="state" id="city1_c" required="required">
                  <option>{{$listing->state ? $listing->state : old('state')}}</option>
                </select>
                @if ($errors->has('state'))
                   <span class="help-block">
                        <strong>{{ $errors->first('state') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                <label>City</label>
                <select name="city" class="form-control cities2" id="city1_b" required="required">
                  <option>{{$listing->city ? $listing->city : old('city')}}</option>
                </select>
                @if ($errors->has('city'))
                   <span class="help-block">
                        <strong>{{ $errors->first('city') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('locality') ? ' has-error' : '' }}">
                <label>Locality</label>
                <input type="text" name="locality" class="form-control" placeholder="Locality" required="required" value="{{$listing->locality ? $listing->locality : old('locality')}}">
                @if ($errors->has('locality'))
                   <span class="help-block">
                        <strong>{{ $errors->first('locality') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label>Phone Number</label>
                <input type="number" name="phone" class="form-control" placeholder="Phone Number" required="required" value="{{$listing->phone ? $listing->phone : Auth::user()->mobile_number}}">
                @if ($errors->has('phone'))
                   <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
              </div>
            </div>
          </div>
          @endif
          <div id="stop">
            <div class="row">
                <div class="col-md-12">
                  <div id="rms-wizard" class="rms-wizard">
                  <div class="rms-container">
                  <div class="rms-form-wizard">
                  <div class="rms-footer-section">
                <div class="button-section">
                    <span class="next">
                      <button class="btn">Next Step
                            <small>Final Step</small>
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
        <div class="col-md-3">
            <div class="alert alert-info form-alert">
              <h3><strong>Posting Tips</strong></h3><br/>
              <ul>
                  <li><strong>Contact Name</strong>: Enter your contact name.</li>
                  <li><strong>Email</strong>: Enter your email address.</li>
                  <li><strong>State</strong>: Enter your state.</li>
                  <li><strong>City</strong>: Enter your city.</li>
                  <li><strong>Locality</strong>: Enter your near buy locality.</li>
                  <li><strong>Phone Number</strong>: Enter your phone number.</li>
              </ul>
            </div>
        </div>
    </div>
</div>
@stop