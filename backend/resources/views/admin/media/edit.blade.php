@extends('layouts.admin')


@section('content')
<br/>
<a href="{{url('admin/media', $photo->post_id)}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
	<h1>Edit</h1><br/>
@include('include.error')
	<div class="row">
		<div class="col-md-12">
			<div class="thumbnail">
				<img src="/images/{{$photo->name}}" alt="No Image" class="img-responsive" width="500">
			</div>
		</div>
	</div>
<hr/>
	{!! Form::model($photo, ['method'=>'PATCH', 'files'=>true, 'action'=>['AdminMedia@update', $photo->id]]) !!}
		<div class="row">
			<div class="col-md-12">
				<label>Edit Image</label>
				<input type="file" name="file" class="form-control" style="padding:0px;"><br/>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<center><button class="btn btn-primary"><i class="fa fa-refresh fa-spin"></i> Update</button></center>
			</div>
		</div>
	{!! Form::close() !!}
@stop