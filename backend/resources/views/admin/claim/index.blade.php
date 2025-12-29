@extends('layouts.admin')


@section('content')
@if(Session::has('insert'))

          <div class="alert alert-success" style="margin-top:10px;">
            <strong> {{session('insert')}}</strong>
          </div>

        @endif
<a href="{{url('/admin')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h1>Claims</h1><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
   
      <tr>
        <th style="width:80px;">S.No</th>
      	<th>User Name</th>
      	<th>Post Name</th>
        <th>Name</th>
        <th>Mobile Number</th>
        <th>Email</th>      
        <th style="width:500px;">Message</th>
        <th style="width:100px;">Created at</th>
        <th style="width:160px;">Operation</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
    @foreach($claim as $claims)

        
      <tr>
        <td>{{$i}}</td>
      	<td><a href="{{url('admin-listing', $claims->user_id)}}">{{isset($claims->user) ? $claims->user->name : 'User Deleted!'}}</a></td>
      	<td><a href="{{url('preview', isset($claims->post) ? $claims->post->slug : '#')}}">{{isset($claims->post) ? $claims->post->business_name : 'Listing Deleted!'}}</a></td>
        <td>{{$claims->name}}</td>
        <td>{{$claims->mobile_number}}</td>
       	<td>{{$claims->email}}</td>
        <td>{{$claims->message}}</td>
        <td>{{date('d M, Y', strtotime($claims->created_at))}}</td>
       	<td>
       		{!! Form::open(['method'=>'DELETE', 'action'=>['Postclaim@destroy', $claims->id], 'onsubmit'=>'return confirm("Are you sure?");']) !!}
        		<button class="btn btn-danger btn-sm pull-left"><i class="fa fa-trash"></i></button>
        	{!! Form::close() !!}
          <a href="" data-toggle="modal" data-target="#myModal{{$i}}" class="btn btn-success btn-sm pull-left" style="margin-left:10px;"><i class="fa fa-envelope fa-fw"></i> Send Mail</a>
       	</td>
      </tr>
<div id="myModal{{$i}}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mail to {{$claims->name}}</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(['method'=>'POST', 'action'=>'AdminPost@store']) !!}
          <div class="form-group">
            <label>Subject Line</label>
            <input type="text" name="subject" placeholder="Subject Line" class="form-control" value="{{old('')}}" required="required">
          </div>
          <div class="form-group">
            <label>Message</label>
            <textarea rows="4" name="message" class="form-control" required="required" placeholder="Message">{{old('old')}}</textarea>
          </div>
          <input type="hidden" name="claim" value="{{$claims->id}}">
          <div class="form-group">
            <center><button class="btn btn-success btn-sm"><i class="fa fa-envelope fa-fw"></i> Send Mail</button></center>
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


@stop