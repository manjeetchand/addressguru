<!DOCTYPE html>
<html lang="en">
<head>
@extends('layouts.app')

<title>Payment Success</title>
@section('content')
<br/><br/><br/><br/><br/><br/><br/>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-2">
			<i class="fa fa-smile-o" style="font-size:150px;color:green;"></i>
		</div>
		<div class="col-md-7">
			<h2 style="color:#428BCA;"><b>Thankyou! <span style="color:green;">Payment Successful</span></b></h2>
			<br/>
			<a href="{{url('/')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go to Homepage</a>
		</div>
	</div>
</div>
@stop