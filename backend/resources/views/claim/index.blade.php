<!DOCTYPE html>
<html lang="en">
<head>
   
@extends('layouts.app')

<title>Claim #{{$post->business_name}} | Address Guru</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
@section('content')
<br/>
<div class="container">
  <div class="row">
    <div class="col-md-12">
        @if(Session::has('claimed'))

          <div class="alert alert-success">
            <strong> {{session('claimed')}}</strong>
          </div>

        @endif
    </div>
  </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-2">
	
		</div>
		<div class="col-md-8">
			<div style="background-color:#fff;padding:10px 20px 20px 20px;box-shadow:0px 0px 10px #ccc;">
				<h3>Claim - {{$post->business_name}}</h3>
			</div><br/>
			<div style="background-color:#fff;padding:20px 60px 10px 60px;box-shadow:0px 0px 10px #ccc;">
				{!! Form::open(['action'=>'Postclaim@store', 'method'=>'POST']) !!}
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label>Full Name <span>*</span></label>
						<input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" class="form-control">
						@if ($errors->has('name'))
                            <span class="help-block">
                          	    <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label>Email <span>*</span></label>
						<input type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com" class="form-control">
						@if ($errors->has('email'))
                            <span class="help-block">
                          	    <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
						<label>Mobile Number <span>*</span></label>
						<input type="number" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="Mobile Numner" class="form-control">
						@if ($errors->has('mobile_number'))
                            <span class="help-block">
                          	    <strong>{{ $errors->first('mobile_number') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
						<label>Reason for ownership claim <span>*</span></label>
						<textarea rows="4" class="form-control" placeholder="Type here..." name="message">{{ old('message') }}</textarea>
						@if ($errors->has('message'))
                            <span class="help-block">
                          	    <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                               <center> {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                               @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                                </center>
                            </div>
                        </div>
					<input type="hidden" name="post_id" value="{{$post->id}}">
					<input type="hidden" name="user_id" value="{{$user->id}}">
					<div class="form-group">
						<center><button class="btn btn-danger">Claim</button></center>
					</div>
				{!! Form::close() !!}
			</div><br/>
		</div>
		<div class="col-md-2">
			
		</div>
	</div>
</div>
@stop