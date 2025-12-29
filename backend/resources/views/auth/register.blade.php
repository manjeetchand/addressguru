<!DOCTYPE html>
<html lang="en">
<head>
   
@extends('layouts.app')
    <title>Register | Address Guru</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">
    
    
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 login_style" style="padding:60px 40px 60px 40px;">
            <h2 style="color:#337AB7;"><b>Listing Benefits With Address Guru</b></h2><hr/>
            <p><i class="fa fa-check-square-o"></i> 1000 <span>Free</span> Messages.</p>
            <p><i class="fa fa-check-square-o"></i> 1 Video <span>Promotion</span>.</p>
            <p><i class="fa fa-check-square-o"></i> Free <span>SEO</span> Optimization.</p>
            <p><i class="fa fa-check-square-o"></i> 5 to 10 Photos for <span>Free</span>.</p>
            <p><i class="fa fa-check-square-o"></i> <span>Social</span> sharing links.</p>
        </div>
        <div class="col-md-5 style">
            <div class="panel panel-default">
                <div class="panel-heading"><span style="font-size:30px;color:#337AB7;"><b>Register</b></span></div>
                <div class="panel-body" style="padding:40px 20px 20px 20px;">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        
                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full Name">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter Email">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input type="number" class="form-control" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="Enter Mobile Number">

                                @if ($errors->has('mobile_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Create Password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                               <center>  {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                               @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                                </center>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                    <center><a href="{{url('auth/google')}}"><img src="{{url('/')}}/images/googlebutton.png" class="img-responsive" alt="Sign in with Google" title="Sign in with Google" style="width:220px;"></a></center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
