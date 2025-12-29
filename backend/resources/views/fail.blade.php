<!DOCTYPE html>
<html lang="en">
<head>
@extends('layouts.app')

<title>Payment Failed</title>
@section('content')

<div class="container">
	<div class="row"><br/><br/><br/><br/><br/><br/>
		<div class="col-md-3"></div>
		<div class="col-md-2 text-center">
			<i class="fa fa-frown-o" style="font-size:150px;color:red;"></i>
		</div>
		<div class="col-md-7">
			<h2 style="color:#428BCA;"><b>Payment Transction Failed!</b></h2>
			<p style="font-size:18px;">Must try again</p>
			<a href="{{url('/')}}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go to Homepage</a>
		</div>
	</div>
</div>

@stop