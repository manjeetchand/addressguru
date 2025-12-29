@extends('layouts.editor')

@section('content')
<?php 
use Illuminate\Support\Facades\Crypt;
?>
@if(Session::has('transfer'))

          <div class="alert alert-success" style="margin-top:10px;">
            <strong> {{session('transfer')}}</strong>
          </div>

        @endif
<a href="{{route('editor-dashboard.index')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h3>Listings</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Business Image</th>
        <th>Listing By</th>
        <th>Title</th>
        <th>Category</th>
        <th>Action</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>       
    @foreach($post as $posts)

      <tr>
        <td>
          <img src="{{url('/')}}/images/{{$posts->photo ? $posts->photo : 'user.png'}}" alt="{{$posts->business_name}}" class="img-responsive" style="width:100px;height:100px;">
        </td>
        <td>{{$posts->user->name}}</td>
        <td><a href="{{url('/preview', $posts->slug)}}">{{$posts->business_name}}</a></td>
        <td>{{$posts->category ? $posts->category->name : 'Uncategorized'}}</td>
        <td style="width:180px;"> 
            {!! Form::model($posts, ['method'=>'PATCH', 'action'=>['EditorIndex@update', $posts->id], 'onsubmit'=>'return confirm("Are you sure?");']) !!}
              <input type="hidden" name="status" value="1">
              <button class="btn btn-success btn-sm pull-left"><i class="fa fa-check-circle fa-fw"></i> Approve</button>
            {!! Form::close() !!}
            {!! Form::open(['method'=>'POST', 'action'=>'EditorIndex@store', 'onsubmit'=>'return confirm("Are you sure?");']) !!}
              <input type="hidden" name="post_id" value="{{$posts->id}}">
              <button class="btn btn-danger btn-sm pull-left" style="margin-left:10px;"><i class="fa fa-ban fa-fw"></i> Rject</button>
            {!! Form::close() !!}
        </td>
        <td style="width:100px;">
          <a href="{{route('post.edit', Crypt::encrypt($posts->id))}}" class="btn btn-success pull-left btn-sm"><i class="fa fa-edit"></i> Edit</a>

        </td>
      </tr>
    
    @endforeach
     

    </tbody>
  </table>
</div>

@stop