<!DOCTYPE html>
<html lang="en">
<head> 
@extends('layouts.app')
    <title>Contact Us | Address Guru</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="{{url('/')}}/Contact-Us">
@section('content')
<center><img src="images/contact.png" class="img-responsive" alt="Contact Us | Address Guru"></center>
<div class="container">
	 @include('include.error')
   @if(Session::has('created'))

  <div class="alert alert-success">
    <strong>{{session('created')}} </strong>
  </div>

  @endif
</div>
<div class="container" style="padding:40px;">
	<div class="row">
		<div class="col-md-6">
			
		</div>
		<div class="col-md-6">
			{!! Form::open(['method'=>'POST', 'action'=>'QueryInsert@store']) !!}
				<div class="row" style="box-shadow:0px 0px 10px #ccc;">
					<div class="col-md-12" style="background-color:#fff;padding:40px 20px 20px 20px;">
						<div class="form-group">
                			<input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" class="form-control">
               			 	<br/>
              			</div>
              			<div class="form-group">
                			<input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
                			<br/>
              			</div>
              			<div class="form-group">
                			<input type="number" name="ph_number" value="{{ old('ph_number') }}" placeholder="Mobile Number" class="form-control">
                			<br/>
              			</div>
              			<div class="form-group">
                			<textarea rows="4" class="form-control" placeholder="Type your message..." name="message">{{ old('message') }}</textarea>
                			<br/>
              			</div>
              			<input type="hidden" name="post_id" value="0">
              			<input type="hidden" name="user_id" value="0">
              			<div class="form-group">
                  			<center> {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display(['data-theme' => 'dark']) !!}</center>
                		</div>
                    <center><button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button></center>
					</div>

				</div>
			{!! Form::close() !!}
		</div>
		
	</div>
</div>


@stop