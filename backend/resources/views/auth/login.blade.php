<!DOCTYPE html>
<html lang="en">
<head>
   
@extends('layouts.app')
    <title>Log In | Address Guru</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">
    
@section('content')
<style type="text/css">
    label{font-size:14px;}
    .panel-body{
        padding:40px 20px 20px 20px;
    }
    
    @media (max-width: 768px) {
        footer{
            display:none;
        }
        .manjeet{
            display:flex;
            flex-direction: column-reverse;

        }
       
        .panel-body{
            padding:10px ;
        }

    }
</style>
<div class="container">
    @if(Session::has('no'))
        <div class="alert alert-danger">
            <strong> {{session('no')}}</strong>
        </div>
    @endif
    <div class="row manjeet mb-3">
        <div class="col-md-7 login_style" style="padding:60px 40px 60px 40px;">
            <h2 style="color:#337AB7;"><b>Listing Benefits With Address Guru</b></h2><hr/>
            <p><i class="fa fa-check-square-o"></i> 1000 <span>Free</span> Messages.</p>
            <p><i class="fa fa-check-square-o"></i> 1 Video <span>Promotion</span>.</p>
            <p><i class="fa fa-check-square-o"></i> Free <span>SEO</span> Optimization.</p>
            <p><i class="fa fa-check-square-o"></i> 5 to 10 Photos for <span>Free</span>.</p>
            <p><i class="fa fa-check-square-o"></i> <span>Social</span> sharing links.</p>
        </div>
        <div class="col-md-5 style">
            <div class="card">
                <div class="card-header">
                    <div class="panel-heading"><span style="font-size:30px;color:#337AB7;"><b>Login</b></span></div>
                </div>
                <div class="card-body">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} mb-3">
                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
    
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} mb-3">
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group mb-3">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-key"></i> Login
                                    </button>
    
                                    <a class="btn btn-link pull-right" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                </div>
                            </div>
                        </form>
                        <center class="mt-2"><a href="{{url('auth/google')}}"><img src="{{url('/')}}/images/googlebutton.png" class="img-responsive" alt="Sign in with Google" title="Sign in with Google" style="width:220px;"></a></center>
                        <center>Don't have account?<br/><br/>
                            <a href="{{url('/register')}}" class="btn btn-success"><i class="fa fa-sign-in"></i> Create Account</a>
    
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
