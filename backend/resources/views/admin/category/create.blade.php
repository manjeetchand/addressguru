@extends('layouts.admin')
@section('content')
<!-- Breadcrumb Navigation -->
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-12">
                <div class="page-header">
                   <div class="page-title d-flex justify-content-between align-items-center">
					   <ol class="breadcrumb mb-0">
							<a href="{{ url('admin-category') }}" style="font-size: 20px;"><i class="fa fa-arrow-left"></i></a>
							<li ><a href="#" style="float-right">Categories</a></li>
							<li class="active" style="float-right"><a href="#">Create</a></li>
						</ol>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card">
	<div class="card-header">
		<h2>Create Categories</h2>
	</div>
	<div class="card-body">
		<form id="category-form" action="{{route('admin-category.store')}}" method='POST' enctype= multipart/form-data>
			@csrf
			<div class="row">
			<div class="col-md-6">
				<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name">Name <span class="text-danger">*</span></label>
					<input type="text" name="name"  id="name" class="form-control" placeholder="Enter Category Name" value="{{ old('name') }}">
					@if ($errors->has('name'))
						<span class="help-block">{{ $errors->first('name') }}</span>
					@endif
				</div>
				{{-- <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
					<label for="description">Description</label>
					<textarea rows="2"  id="description" class="form-control" name="description" placeholder="Enter Description">{{ old('description') }}</textarea>
					@if($errors->has('description'))
						<span class="help-block">{{ $errors->first('description') }}</span>
					@endif
				</div>
				<div class="form-group {{ $errors->has('meta_title') ? ' has-error' : '' }}">
					<label for="meta_title">Meta Title </label>
					<input type="text" name="meta_title"  id="meta_title" class="form-control" placeholder="Enter Meta Title" value="{{ old('meta_title') }}">
					@if ($errors->has('meta_title'))
						<span class="help-block">{{ $errors->first('meta_title') }}</span>
					@endif
				</div>
				<div class="form-group {{ $errors->has('meta_description') ? ' has-error' : '' }}">
					<label for="meta_description">Meta Description</label>
					<textarea rows="2"  id="description" class="form-control" name="meta_description" placeholder="Enter Meta Description">{{ old('meta_description') }}</textarea>
					@if($errors->has('meta_description'))
						<span class="help-block">{{ $errors->first('meta_description') }}</span>
					@endif
				</div> --}}
				
				<div class="form-group {{ $errors->has('svg_code') ? ' has-error' : '' }}">
					<label for="svg_code">Svg Code</label>
					<textarea rows="2"  id="svg_code" class="form-control" name="svg_code" placeholder="Enter Svg Code">{{ old('svg_code') }}</textarea>
					@if($errors->has('svg_code'))
						<span class="help-block">{{ $errors->first('svg_code') }}</span>
					@endif
				</div>
				<div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
					<label for="status">Status <span class="text-danger">*</span></label>
					<select class="form-control" name="status" id="status">
						<option value="1" Selected>Active</option>
						<option value="0" >In Active</option>
					</select>
					@if ($errors->has('status'))
						<span class="help-block">{{ $errors->first('status') }}</span>
					@endif
				</div>
				<button class="btn btn-primary" type="submit">Create Category</button>
			</div>
			<div class="col-md-3">
				<div class="form-group {{ $errors->has('colors') ? ' has-error' : '' }}">
					<label id="colors">Color Code <span class="text-danger">*</span></label>
					<input type="text"  id="colors" name="colors" class="form-control" placeholder="Enter Hexa Color Code (Eg: #000) " value="{{ old('colors') }}">
					@if ($errors->has('colors'))
						<span class="help-block">{{ $errors->first('colors') }}</span>
					@endif
				</div>
				<div class="form-group {{ $errors->has('icon') ? ' has-error' : '' }}">
					<label for="icon">Image</label>
					<input type="file" id="icon" name="icon" class="form-control" accept="image/*" onchange="previewImage(event)">
					@if ($errors->has('icon'))
						<span class="help-block">{{ $errors->first('icon') }}</span>
					@endif
					<br/>
					<!-- Image Preview -->
					<img id="preview" src="#" alt="Image Preview" style="max-height: 150px; display: none; margin-top: 10px; border: 1px solid #ccc;border-radius: 4px; padding: 10px;" />
				</div>
			</div>
		</div>
		</form>
	</div>
</div>
 <!--  Validation -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview');
        output.src = reader.result;
        output.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
}



</script>
@stop