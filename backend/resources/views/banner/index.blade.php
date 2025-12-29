<!DOCTYPE html>
<html lang="en">
<head>
@extends('layouts.app')

<title>Post Banner Ad</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
@section('content')
<br/>
<div class="container">
  <div class="row">
    <div class="col-md-12">
        @if(Session::has('comp'))

          <div class="alert alert-success">
            <strong> {{session('comp')}}</strong>
          </div>

        @endif
    </div>
  </div>
</div>
<div class="container">
	<div class="row">
		
		<div class="col-md-12">
			<div style="background-color:#fff;padding:10px 20px 20px 20px;box-shadow:0px 0px 10px #ccc;">
				<h3 class="text-center"><i class="fa fa-buysellads"></i> Create Banner Ad</h3>
			</div><br/>
			<div style="background-color:#fff;padding:20px 60px 10px 60px;box-shadow:0px 0px 10px #ccc;">
				<div class="row">
					<div class="col-md-8">
						{!! Form::open(['method'=>'POST', 'action'=>'Bannerad@store', 'files'=>true]) !!}
					<div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
						<label>Banner Image <span style="font-weight:normal;font-size:14px;color:#000;">( Image Dimensions must be : - <b>width: 1200 pixel</b> & <b> height: 110 pixel</b> )</span><span>*</span></label>
						<input type="file" name="image" placeholder="Banner Image">
						@if ($errors->has('image'))
                            <span class="help-block">
                          	    <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
						<label>Image Name <span>*</span></label>
						<input type="text" name="name" value="{{ old('name') }}" placeholder="Image Name" class="form-control">
						@if ($errors->has('name'))
                            <span class="help-block">
                          	    <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
						<label>Select listing <span>*</span></label>
						
						
						<select class="form-control" name="business_name">
								<option></option>
							@foreach($post as $posts)

									<option value="{{$posts->id}}">{{$posts->business_name}}</option>
									
							@endforeach
						</select>

						
						@if ($errors->has('business_name'))
                            <span class="help-block">
                          	    <strong>{{ $errors->first('business_name') }}</strong>
                            </span>
                        @endif
					</div>
					<div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
						<label>Select Category <span>*</span></label>
						<br/>
						<input type="checkbox" onclick="toggle(this);"/> Select All
						<br/>
						<br/>
						<ul class="newlii">
						@foreach($category as $cat)
						<li><input type="checkbox" name="category[]" value="{{$cat->id}}" @if(is_array(old('category')) && in_array($cat->id, old('category'))) checked @endif> {{$cat->name}}</li>
						@endforeach
						</ul>
						<div class="clearfix"></div>
						@if ($errors->has('category'))
                            <span class="help-block">
                          	    <strong>{{ $errors->first('category') }}</strong>
                            </span>
                        @endif
					</div>
					
					<div class="form-group">
						<center><button class="btn btn-success">Submit</button></center>
					</div>
				{!! Form::close() !!}
					</div>
					<div class="col-md-4">
						<div class="alert alert-info">
					<ul class="ul">
						<li><strong>Banner Image:</strong> Image Dimensions must be - width: <strong>1200 pixel</strong> & height: <strong>110 pixel</strong>. Image size must not be more then <strong>50 KB</strong></li>
						<li><strong>Image Name:</strong> Alternative text for your banner Ad.</li>
						<li><strong>Select Listing:</strong> Select listing for which Ad has been made. If listing box is empty, please make listing first for uploading Ad. <a href="{{url('/post')}}"><strong>Post here</strong></a></li>
						<li><strong>Select Category:</strong> Select category in which you want to show your Ad. </li>
					</ul>
				</div>
					</div>
				</div>
				
				
			</div><br/>
			
		</div>
	</div>
</div>

<script type="text/javascript">
function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
</script>
@stop