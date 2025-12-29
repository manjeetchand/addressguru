<!DOCTYPE html>
<html lang="en">
<head> 
@extends('layouts.app')
<title>Payment</title>
@section('content')
<style type="text/css">
	label{font-size:16px;}
</style>
<br/><br/>
<div class="container">
	<div class="row">
		<div class="col-md-3">
			<div class="thumbnail leftsides">
				<img src="{{url('/')}}/images/{{$post->photo}}" class="img-responsive" alt="{{$post->business_name}}" style="height:200px;width:100%;">
			</div>
			<div style="background-color:#fff;padding:10px 20px 10px 20px;box-shadow:0px 0px 10px #ccc;">
				<address><i class="fa fa-map-marker"></i> {{$post->business_address}}</address>
				<span><i class="fa fa-info"></i> {{substr($post->ad_description, 0, 200)}}...</span>
			</div>
			<br/>
		</div>
		<div class="col-md-9">
			<div style="background-color:#fff;padding:1px 20px 10px 20px;box-shadow:0px 0px 10px #ccc;">
				<h3 class="chota">Banner for - {{$post->business_name}}</h3><hr/>
				{!! Form::open(['action'=>'PaymentControl@store']) !!}
				@foreach($personal as $per)
				<div style="padding:10px 50px 0px 50px;" class="kaam">
				<div class="row">
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label class="col-md-3">Name:</label>	
						<div class="col-md-9">
							<input type="text" name="name" class="form-control" placeholder="Name" value="{{$per->name}}">
							@if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
						</div>
					</div>	
				</div><br/>
				<div class="row">
					<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
						<label class="col-md-3">Mobile Number:</label>
						<div class="col-md-9">
							<input type="number" name="phone" class="form-control" placeholder="Mobile Number" value="{{$per->ph_number}}">
							@if ($errors->has('phone'))
                          	    <span class="help-block">
                           		    <strong>{{ $errors->first('phone') }}</strong>
                               	</span>
                           	@endif
                        </div>
					</div>
				</div><br/>
				<div class="row">
					<div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
						<label class="col-md-3">Banner Ad Plans:</label>
						<div class="col-md-9">
						<select class="form-control" name="amount">
							<option value="499">₹ 499 (1 Month)</option>
						</select>
						@if ($errors->has('amount'))
                            <span class="help-block">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                        @endif
                        </div>
					</div>
				</div>
				<br/>
				<div class="form-group">
					<center>
						<span class="{{ $errors->has('agree') ? ' has-error' : '' }}">
						<input type="checkbox" name="agree"> I agree with the Terms&Conditions by using this service.
						</span>
						@if ($errors->has('agree'))
                            <span class="help-block">
                                <strong>{{ $errors->first('agree') }}</strong>
                            </span>
                        @endif
						<br/><br/>
						<button class="btn btn-info btn-lg"><i class="fa fa-shopping-cart"></i> Checkout</button><br/><br/>
						<span>Best Price Guaranteed | Safe and Secure</span>
					</center>
				</div>
				<div class="form-group">
					<input type="hidden" name="email" value="{{$per->email}}">
					<input type="hidden" name="user_id" value="{{$per->user_id}}">
					<input type="hidden" name="post_id" value="{{$post->id}}">
					<input type="hidden" name="banner_id" value="{{$banner->id}}">
					@endforeach
				</div>
				{!! Form::close() !!}
			</div>
			</div>
		</div>
	</div>
</div>
@stop