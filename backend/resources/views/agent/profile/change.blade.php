@extends('layouts.agent')


@section('content')
<a href="{{url('agent-profile')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<br/><br/>
<div class="row">
		<div class="col-md-12">
			@if(Session::has('change'))
        		<div class="alert alert-success" style="margin-top:10px;">
           			<strong> {{session('change')}}</strong>
        		</div>
    		@endif
    		@if(Session::has('nochange'))
        		<div class="alert alert-danger" style="margin-top:10px;">
           			<strong> {{session('nochange')}}</strong>
        		</div>
    		@endif
		</div>
	</div>
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
	<div class="col-md-12">
		{!! Form::open(['method'=>'POST', 'url'=>'agent/password']) !!}
		<div class="row">
			<div class="col-md-12">
				<h2 style="margin-top:0px;margin-bottom:0px;">{{$user->name}}</h2>
			</div>
			<div class="col-md-12">
				<hr/>
			</div>
			<div class="col-md-12" style="padding:0px 140px 0px 140px;">
				<center><span><i class="fa fa-lock"></i> Change Password</span></center>
				<div class="form-group{{ $errors->has('oldpass') ? ' has-error' : '' }}">
					<label>Current Password</label>
					<input type="password" name="oldpass" value="{{ old('oldpass') }}" class="form-control" placeholder="Current Password">
					@if ($errors->has('oldpass'))
                    	<span class="help-block">
                            <strong>{{ $errors->first('oldpass') }}</strong>
                        </span>
                    @endif
				</div>
				<div class="form-group{{ $errors->has('newpass') ? ' has-error' : '' }}">
					<label>New Password</label>
					<input type="password" name="newpass" value="{{ old('newpass') }}" class="form-control" placeholder="New Password">
					@if ($errors->has('newpass'))
                    	<span class="help-block">
                            <strong>{{ $errors->first('newpass') }}</strong>
                        </span>
                    @endif
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