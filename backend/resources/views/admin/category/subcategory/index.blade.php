@extends('layouts.admin')
<title>Sub Category</title>

@section('content')
<br/>
<a href="{{url('admin-category')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Go Back</a>
<a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-fw"></i> Add New</a>
@if($subcategory->count() <= 1)
    <a href="{{route('category.form',['category_id'=>$category->id])}}" class="btn btn-primary btn-sm">
        <i class="fa fa-plus fa-fw"></i>Form
    </a>
@endif
<h3><i class="{{$category->icon}}"></i> {{$category->name}}</h3><hr/>
@if(Session::has('insert'))
  <div class="alert alert-success">
    <strong> {{session('insert')}}</strong>
  </div>
@endif
<div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
      	<th>S.No</th>
        <th>Name</th>
        <th>Created at</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
    	<?php $i = 1; ?>
    	@foreach($subcategory as $cat)
      <tr>
      	<td>{{$i}}</td>
        <td>{{$cat->name}}</td>
        <td>{{date('d F, Y', strtotime($cat->created_at))}}</td>
        <td>
            <a href="{{route('childSubCategoryList',$cat->id)}}" class="btn btn-primary btn-sm  pull-left" style="margin-right:10px;">Dropdown</a>
            <a href="{{route('admin-sub-category.edit',['admin_sub_category'=>$cat->id])}}" class="btn btn-primary btn-sm  pull-left" style="margin-right:10px;"><i class="fa fa-plus fa-fw"></i></a>
        	<a href="#" class="btn btn-warning pull-left" data-toggle="modal" data-target="#edit{{$i}}"><i class="fa fa-edit"></i></a>
        	{!! Form::open(['action'=>['AdminSubCategory@destroy', $cat->id], 'onsubmit'=>'return confirm("Are You Sure?")', 'method'=>'DELETE']) !!}
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
        {!! Form::open(['method'=>'PATCH', 'action'=>['AdminSubCategory@update', $cat->id]]) !!}
          <div class="form-group">
            <label>Edit Sub Category Name</label>
            <input type="text" name="name" placeholder="Edit Sub Category Name" class="form-control" required="required" value="{{$cat->name}}">
          </div>
          <div class="form-group">

            <center><button class="btn btn-primary btn-sm">Edit</button></center>
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminSubCategory@store']) !!}
          <div class="form-group">
            <label>Sub Category Name</label>
            <input type="text" name="name" placeholder="Sub Category Name" class="form-control" required="required" value="{{old('name')}}">
            <input type="hidden" name="category" value="{{$category->id}}">
          </div>
          <div class="form-group">
            <center><button class="btn btn-primary btn-sm">Submit</button></center>
          </div>
        {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>

@stop