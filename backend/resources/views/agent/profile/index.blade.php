@extends('layouts.agent')


@section('content')
<a href="{{url('/Partner Dashboard')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<br/><br/>
<div class="main-box-profile">
	<div class="row">
		<div class="col-md-3">
			<div class="thumbnail">
				<img src="{{url('/')}}/images/{{$user->photo ? $user->photo : 'user.png'}}" class="img-responsive" alt="{{$user->name}}" style="width:100%;height:200px;">
			</div>
		</div>
		<div class="col-md-9">
			<h1 style="margin-top:0px;">{{$user->name}}</h1>
			<p style="font-size:18px;color:#5a5555;"><i class="fa fa-tags"></i> {{$user->role->name}} Account</p>
			<p style="font-size:18px;color:#5a5555;"><i class="fa fa-phone"></i> +91-{{$user->mobile_number ? $user->mobile_number : 'Not Mentioned'}}</p>
		</div>
	</div>
	<div class="row">
		<hr/>
		<div class="col-md-2 text-center">
			<a href="{{url('agent/client')}}" style="color:black;">
			<div class="profile-box">
				<i class="fa fa-tasks"></i>
				<p>{{count($post)}} Clients</p>
			</div>
			</a>
		</div>
		<div class="col-md-2 text-center">
			<a href="{{route('agent-payment.index')}}" style="color:black;">
			<div class="profile-box">
				<i class="fa fa-rupee"></i>
				<p>{{$total}}</p>
			</div>
			</a>
		</div>
		<div class="col-md-2 text-center">
			<?php $id = base64_encode($user->id); ?>
			<a href="{{route('agent-profile.edit', $id)}}">
			<div class="profile-box">
				<i class="fa fa-plus"></i>
				<p>Edit Profile</p>
			</div>
			</a>
		</div>
	</div>
</div>

@stop