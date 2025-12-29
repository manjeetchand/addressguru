@extends('layouts.agent')



@section('content')
<br/>
<a href="{{route('client.index')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<h1>Edit</h1><hr style="border-color:black;">
{!! Form::model($client, ['method'=>'PATCH', 'action'=>['PartnerClient@update', $client->id]]) !!}
	
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label>Name <span>*</span></label>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-info"></i></span>
				<input type="text" name="name" value="{{ $client->name }}" class="form-control">
				</div>
				 @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
			</div>
			</div>
			<div class="col-md-6">
				<div class="form-group{{ $errors->has('ph_number') ? ' has-error' : '' }}">
				<label>Mobile Number <span>*</span> (0-9)</label>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-phone"></i></span>
				<input type="number" value="{{ $client->ph_number }}" name="ph_number" class="form-control">
				</div>
				@if ($errors->has('ph_number'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ph_number') }}</strong>
                    </span>
                @endif
				<br/>
			</div>
			</div>
			<div class="col-md-12">
				<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
				<label>Locality <span>*</span></label>
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
				<input type="text" value="{{ $client->location }}" name="location" class="form-control">
				</div>
				@if ($errors->has('location'))
                    <span class="help-block">
                        <strong>{{ $errors->first('location') }}</strong>
                    </span>
                @endif
				<br/>
			</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<center><button class="btn btn-primary">Update</button></center>
			</div>
		</div>
		<br/><br/>
		<div class="alert alert-info">
			<strong>*Note</strong>: If you want to change email of the listing please mail us listing details at:
			<a href="mailto:contact@addressguru.in">contact@addressguru.in</a>
		</div>
	</div>

{!! Form::close() !!}
@stop