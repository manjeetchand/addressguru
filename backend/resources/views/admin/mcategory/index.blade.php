@extends('layouts.admin')
<title>Market Category</title>

@section('content')
<br/>
<a href="{{url('admin')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-left"></i> Go Back</a>
<a href="" data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Add Category</a>
<br/><br/>
@if(Session::has('insert'))
                    <div class="alert alert-success">
                        <strong> {{session('insert')}}</strong>
                    </div>
                @endif
<h1>Market Category</h1><hr/>
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
        	 
           <a href="{{url('admin-market-subcategory', $cat->id)}}" class="btn btn-success pull-left" title="Add Sub-Category"><i class="fa fa-plus"></i></a>

        	 <a href="#" data-toggle="modal" data-target="#edit{{$i}}" style="margin-left:10px;" class="btn btn-warning pull-left"><i class="fa fa-edit"></i></a>

        	{!! Form::open(['action'=>['AdminMarket@destroy', $cat->id], 'method'=>'DELETE', 'onsubmit'=>'return confirm("Are you sure?");']) !!}

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
        <h4 class="modal-title">Edit Category</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['method'=>'PATCH', 'action'=>['AdminMarket@update', $cat->id]]) !!}
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
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminMarket@store']) !!}
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
            <center><button class="btn btn-success btn-sm">Submit</button></center>
          </div>
        {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>
@stop