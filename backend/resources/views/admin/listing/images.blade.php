@extends('layouts.admin')


@section('content')
<br/>
<a href="{{url('admin/listing/'.$image->user_id)}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<h1>Image</h1>

<div class="thumbnail">
	<img src="/images/{{$image->photo}}" class="img-responsive" alt="{{$image->business_name}}" style="width:400px;">
</div><br/>
{!! Form::model($image, ['url'=>['admin/change', $image->id], 'method'=>'PATCH', 'files'=>true]) !!}
	<div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
		<label>Featured Image</label>
		<input type="file" name="photo">
		@if ($errors->has('photo'))
            <span class="help-block">
                <strong>{{ $errors->first('photo') }}</strong>
            </span>
        @endif
	</div><br/><br/><br/>
	<div class="form-group">
		<center><button class="btn btn-primary">Update</button></center>
	</div>

{!! Form::close() !!}

@stop