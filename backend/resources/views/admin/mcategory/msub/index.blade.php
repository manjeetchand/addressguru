@extends('layouts.admin')
<title>Market Category</title>

@section('content')
<br/>
<a href="{{url('admin-market-category')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-left"></i> Go Back</a>
<a href="" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Add Sub Category</a>
<br/><br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div>
@endif
                @if(count($errors) > 0)

  <div class="alert alert-danger">
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>

@endif
<h1>{{$cat_name->name}}</h1><hr/>
<div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
   
      <tr>
      	<th>ID</th>
        <th>Name</th>
        <th>Icon</th>
        <th>Color</th>
        <th>Created at</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
    	<?php $i = 1; ?>
    	@foreach($category as $cat)
        
      <tr>
      	<td>{{$cat->id}}</td>
        <td>{{$cat->name}}</td>
        <td><i class="{{$cat->icon}}" style="font-size:20px;"></i></td>
        <td><span style="background-color:{{$cat->colors}};padding:10px 20px 10px 20px;box-shadow:0px 0px 4px;"></span></td>
        <td>{{date('d F, Y', strtotime($cat->created_at))}}</td>
       
        <td>
        	 <a href="{{route('admin.sub.category.dropdown',$cat->id)}}"   style="margin-left:10px;" class="btn btn-primary pull-left"><i class="fa fa-plus"></i> Dropdown</a>
        	 <a href="#" data-toggle="modal" data-target="#edit{{$i}}" style="margin-left:10px;" class="btn btn-warning pull-left"><i class="fa fa-edit"></i></a>

        	{!! Form::open(['action'=>['AdminMsub@destroy', $cat->id], 'method'=>'DELETE', 'onsubmit'=>'return confirm("Are you sure?");']) !!}

        		<button class="btn btn-danger" style="margin-left:10px;"><i class="fa fa-trash"></i></button>

        	{!! Form::close() !!}
        </td>
      </tr>
       <div id="edit{{$i}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Sub Category</h4>
      </div>
      <div class="modal-body">
        {!! Form::model($cat, ['method'=>'PATCH', 'action'=>['AdminMsub@update', $cat->id], 'files'=>true]) !!}
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" required="required" value="{{$cat->name}}">
          </div>
          <div class="form-group">
            <label>Icon</label>
            <input type="text" name="icon" class="form-control" placeholder="Icon" required="required" value="{{$cat->icon}}">
          </div>
          <div class="form-group">
            <label>Color</label>
            <input type="text" name="color" class="form-control" placeholder="Color" required="required" value="{{$cat->colors}}">
          </div>
          @if($cat->og != null)
          <div class="form-group">
            <label>Upload Image</label><br/>
            <img src="{{url('/')}}/images/{{$cat->og}}" style="width:200px;height:200px;">
          </div>
          @endif
          <div class="form-group">
            <label>OG Image</label>
            <input type="file" name="og_image" class="form-control">
          </div>
          <div class="form-group">
            <center><button class="btn btn-success btn-sm">Update</button></center>
          </div>
        {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>
<?php $i++; ?>
    	@endforeach

    </tbody>
  </table>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Sub Category</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminMsub@store', 'files'=>true]) !!}
          <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" required="required" value="{{old('name')}}">
          </div>
          <div class="form-group">
            <label>Icon</label>
            <input type="text" name="icon" class="form-control" placeholder="Icon" required="required" value="{{old('icon')}}">
          </div>
          <div class="form-group">
            <label>Color</label>
            <input type="text" name="color" class="form-control" placeholder="Color" required="required" value="{{old('color')}}">
          </div>
          <div class="form-group">
            <label>OG Image</label>
            <input type="file" name="og_image" class="form-control" required="required">
          </div>
          <input type="hidden" name="category_id" value="{{$cat_name->id}}">
          <div class="form-group">
            <center><button class="btn btn-success btn-sm">Submit</button></center>
          </div>
        {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>
@stop