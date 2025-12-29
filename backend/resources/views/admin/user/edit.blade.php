@extends('layouts.admin')


@section('content')
<br/>
<a href="{{route('admin-user.index')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<h1>Edit</h1>

{!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUser@update', $user->id]]) !!}
		<div class="form-group">
			<div class="col-md-6">
				<label>Name</label>
				{!! Form::text('name', null, ['class'=>'form-control']) !!}<br/>
			</div>
			<div class="col-md-6">
				<label>Email</label>
				{!! Form::email('email', null, ['class'=>'form-control']) !!}<br/>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-6">
				<label>Role</label>
				<select name="role_id" class="form-control">
					<option value="{{$user->role_id}}">{{$user->role->name}}</option>
					@foreach($role as $rols)
					<option value="{{$rols->id}}">{{$rols->name}}</option>
					@endforeach
				</select>
				<br/>
			</div>
			<div class="col-md-6">
				<label>Status</label>
				{!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'), null, ['class'=>'form-control']) !!}<br/>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<label>Password</label>
				{!! Form::password('password', ['class'=>'form-control']) !!}<br/>
			</div>
		</div>
		<div class="form-group">
			<center><button name="update" class="btn btn-primary">Update User</button></center>
		</div>

	{!! Form::close() !!}

@stop