@extends('layouts.user')


@section('content')
<a href="{{url('/Dashboard')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
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
			<a href="{{url('user/post')}}" style="color:black;">
			<div class="profile-box">
				<i class="fa fa-tasks"></i>
				<p>{{count($post)}} Listings</p>
			</div>
			</a>
		</div>
		<div class="col-md-2 text-center">
			<a href="{{url('/query')}}" style="color:black;">
			<div class="profile-box">
				<i class="fa fa-question-circle"></i>
				<p>{{count($query)}} Query</p>
			</div>
			</a>
		</div>
		<div class="col-md-2 text-center">
			<?php $id = base64_encode($user->id); ?>
			<a href="{{route('profile.edit', $id)}}">
			<div class="profile-box">
				<i class="fa fa-plus"></i>
				<p>Edit Profile</p>
			</div>
			</a>
		</div>
	</div>
</div>

@stop