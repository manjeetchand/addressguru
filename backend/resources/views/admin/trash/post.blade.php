@extends('layouts.admin')


@section('content')
<br/>
<a href="{{url('/admin')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<h3>Deactivated Posts</h3>
<div class="row">
  <div class="col-md-12">
      @if(Session::has('active'))

  <div class="alert alert-success">
    <strong>{{session('active')}} </strong>
  </div>

  @endif
  </div>
</div>
 <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Image</th>
        <th>User Name</th>
      	<th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Post Status</th>
        <th>Type</th>
        <th>Deactivate At</th>
        <th style="width:140px;">Action</th>
      </tr>
    </thead>
    <tbody>    		
   @foreach($post as $posts)
   <tr>
        <td><img src="{{url('/')}}/images/{{$posts->photo ? $posts->photo : 'user.png'}}" alt="{{$posts->business_name}}" class="img-responsive" style="width:100px;height:80px;"></td>
        <td>@if(isset($posts->user->name)){{$posts->user->name}} @else AddressGuru User @endif</td>
      	<td>{{$posts->business_name}}</td>
        <td>{{$posts->category->name}}</td>
        <td>{{$posts->status == 1 ? 'Published' : 'Unpublished'}}</td>
        <td>{{$posts->post_status ? 'Compelete' : 'In-Compelete'}}</td>
        <td>{{$posts->paid ? 'Paid' : 'Not Paid'}}</td>
        <td>{{date('d F, Y', strtotime($posts->updated_at))}}</td>
        <td>
          {!! Form::open(['action'=>['AdminTrashPost@update', $posts->id], 'method'=>'PATCH', 'class'=>'pull-left', 'onsubmit'=>'return confirm("Are you sure?");']) !!}
          <button class="btn btn-warning btn-sm">Activate</button>
          {!! Form::close() !!}
          {!! Form::open(['action'=>['AdminTrashPost@destroy', $posts->id], 'method'=>'DELETE', 'class'=>'pull-left', 'onsubmit'=>'return confirm("Are you sure?");']) !!}
          <button class="btn btn-danger btn-sm" style="margin-left:10px;"><i class="fa fa-trash"></i></button>
          {!! Form::close() !!}
        </td>
      </tr>
     
    @endforeach
     

    </tbody>
  </table>
</div>
{!! $post->render() !!}
@stop