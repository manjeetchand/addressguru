@extends('layouts.user')


@section('content')
<a href="{{url('user/profile')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<br/><br/>
<div class="row">
		<div class="col-md-12">
			@if(Session::has('update'))
        		<div class="alert alert-success" style="margin-top:20px;">
           			<strong> {{session('update')}}</strong>
        		</div>
    		@endif
		</div>
	</div>
<div class="main-box-profile">
<div class="row">
	<div class="col-md-3">
		<div class="thumbnail">
			<img src="{{url('/')}}/images/{{$user->photo ? $user->photo : 'user.png'}}" class="img-responsive" alt="{{$user->name}}" style="width:100%;height:200px;">
		</div>
	</div>
	<div class="col-md-9" style="border-left:1px solid #ccc;">
		{!! Form::model($user, ['method'=>'PATCH', 'files'=>true, 'action'=>['UserProfile@update', $user->id]]) !!}
		<div class="row">
			<div class="col-xs-9">
				<h2 style="margin-top:0px;margin-bottom:0px;">Personal Details</h2>
			</div>
			<div class="col-xs-3">
				<?php $id = base64_encode($user->id); ?>
				<a href="{{url('user/profile', $id)}}"><i class="fa fa-lock"></i> Change Password</a>
			</div>
			<div class="col-md-12">
				<hr/>
			</div>
			<div class="col-md-6">
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label>Name</label>
					<input type="text" name="name" value="{{$user->name}}" class="form-control">
					@if ($errors->has('name'))
                    	<span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
					<label>Mobile Number</label>
					<input type="text" name="mobile_number" class="form-control" value="{{$user->mobile_number ? $user->mobile_number : 'Not Mentioned'}}">
					@if ($errors->has('mobile_number'))
                    	<span class="help-block">
                            <strong>{{ $errors->first('mobile_number') }}</strong>
                        </span>
                    @endif
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
					<label>Profile Image</label>
					<input type="file" name="photo">
					@if ($errors->has('photo'))
                    	<span class="help-block">
                            <strong>{{ $errors->first('photo') }}</strong>
                        </span>
                    @endif
                    <br/>
				</div>
			</div>
			<div class="col-md-12">
				<center><button class="btn btn-primary">Submit</button></center>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>
</div>
@stop