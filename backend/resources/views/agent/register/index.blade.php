<!DOCTYPE html>
<html lang="en">
<head>
@extends('layouts.app')
     <title>Partner Register | Address Guru</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">
@section('content')
<div class="container">
     @if(Session::has('register'))
        <div class="alert alert-success" style="margin-top:20px;margin-bottom:20px;">
            <strong> {{session('register')}} <a href="{{url('/login')}}">Login</a></strong>
        </div>
    @endif
</div>
<div class="container-fluid" style="margin:0px;padding:0px;">
     <img src="{{url('/')}}/images/patner.jpg" class="img-responsive" alt="Address Guru">
</div>
    <div class="container">
        <div class="card mt-5">
            <div class="row ">
                <div class="col-md-6 style" style="border-right: 1px solid #ccc;">
                        <div class="panel-heading" style="padding:20px;">
                            <h3 style="margin:8px;color:#fff;" class="text-dark">More than <b>{{count($user)}}</b> Partners Registered</h3>
                        </div>
                
                    <div class="col-md-12 login_style px-4">
                        <h2 style="color:#337AB7;margin:8px;"><b>Listing Benefits As Partner</b></h2><hr/>
                        <p><i class="fa fa-check-square-o"></i> First listing <span>Free.</span></p>
                        <p><i class="fa fa-check-square-o"></i> Earn <span>Online</span> upto <span>30%</span> on listing done by you.</p>
                        <p><i class="fa fa-check-square-o"></i> Every month <span>benefits</span></p>
                        <p><i class="fa fa-check-square-o"></i> 5 to 10 Photos for <span>Free</span>.</p>
                        <p><i class="fa fa-check-square-o"></i> <span>Social</span> sharing links.</p>
                    </div>
                </div>
                <div class="col-md-6 px-5 style text-center">
                        <div class="card-header">
                            <div class="panel-heading"><span style="font-size:30px;color:#337AB7;"><b>Partner Registration</b></span></div>
                        </div>
                        <div class="card-body">
                            <div class="panel-body">
                                {!! Form::open(['class'=>'form-horizontal', 'method'=>'POST', 'action'=>'AgentRegister@store']) !!}
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <div class="col-md-12 mb-3">
                                            <input id="name" type="text" required="required" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full Name">
                                            @if ($errors->has('name'))
                                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="col-md-12 mb-3">
                                            <input id="email" type="email" required="required" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                            @if ($errors->has('email'))
                                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                                        <div class="col-md-12 mb-3">
                                            <input type="number" class="form-control" required="required" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="Enter Mobile Number">
                                            @if ($errors->has('mobile_number'))
                                                <small class="text-danger">{{ $errors->first('mobile_number') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class="col-md-12 mb-3">
                                            <input id="password" type="password" required="required" class="form-control" name="password" placeholder="Create Password">
                                            @if ($errors->has('password'))
                                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <div class="col-md-12 mb-3">
                                            <input id="password-confirm" type="password" required="required" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                                            @if ($errors->has('password_confirmation'))
                                                <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <center>
                                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        <div class="col-md-12 mb-3">
                                    {!! NoCaptcha::renderJs() !!}
                                            {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                                    <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                                            @endif
                                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-btn fa-sign-in"></i> Register
                                            </button>
                                        </div>
                                    </div>
                                    </center>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection