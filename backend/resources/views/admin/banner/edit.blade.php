@extends('layouts.admin')


@section('content')
@if(Session::has('update'))

          <div class="alert alert-success" style="margin-top:10px;">
            <strong> {{session('update')}}</strong>
          </div>

        @endif
<h3 class="pull-left">Edit</h3>

<br/><br/><br/><br/>
{!! Form::model($ban, ['method'=>'PATCH', 'action'=>['AdminBanner@update', $ban->id]]) !!}
				
				<div class="row">
				<div class="{{ $errors->has('name') ? ' has-error' : '' }}">
					<div class="col-md-6">
						<label>Name <span>*</span></label>
						<input type="text" name="name" value="" class="form-control" placeholder="Name">
						@if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
				</div>
				<div class="col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">
						<label>Email <span>*</span></label>
						<input type="email" name="email" value="" class="form-control" placeholder="Email">
						@if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
					</div>
				
				
			</div>
			<div class="row">
				<div class="{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
					<div class="col-md-6">
						<label>Mobile Number <span>*</span></label>
						<input type="number" name="mobile_number" value="" class="form-control" placeholder="Mobile Number">
						@if ($errors->has('mobile_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mobile_number') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
				</div>
				<div class="col-md-6{{ $errors->has('password') ? ' has-error' : '' }}">
						<label>Password <span>*</span></label>
						<input type="password" name="password" class="form-control" placeholder="Password">
						@if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
					</div>
				
				
			</div>
			<div class="row">
				<div class="col-md-12">
					<label>Select Category</label>
             			
				</div>
			</div><br/>
		
	
		
		<div class="form-group">
			<center><button class="btn btn-primary">Update</button></center>
		</div>

	{!! Form::close() !!}


@stop