@extends('layouts.admin')
@section('content')
<?php 
  use App\Category;
?>
<h3>Ads</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th style="width:140px;">User Name</th>
        <th style="width:140px;">Banner Image</th>
        <th>Image Name</th>
        <th>Listing Name</th>
        <th style="width:600px;">Category</th>
        <th style="width:100px;">Status</th>
        <th style="width:100px;">Created at</th>
        <th style="width:100px;">Active</th>
        <th style="width:120px;">Operation</th>
      </tr>
    </thead>
    <tbody>       
      @foreach($banner as $ban)
      <tr>
        <td>{{$ban->user->name}}</td>
        <td>
          <img src="{{url('/')}}/images/{{$ban->image}}" alt="{{$ban->name}}" class="img-responsive" style="width:200px;">
        </td>
        <td>{{$ban->name}}</td>
        <td><a href="{{url('preview', $ban->post ? $ban->post->slug : '#')}}">{{$ban->post ? $ban->post->business_name : 'Listing Deleted!'}}</a></td>
        <td>
            <?php $cat = json_decode($ban->category); ?>
            @foreach($cat as $ca)
              <?php $show = Category::find($ca);  ?> <span class="badge">{{$show->name}}</span> 
            @endforeach
        </td>
        <td>{{$ban->paid ? 'Paid' : 'Not-Paid'}}</td>
        <td>{{date('d F, Y', strtotime($ban->created_at))}}</td>
        <td>
          @if($ban->status == 0)
            {!! Form::model($ban, ['method'=>'PATCH', 'action'=>['AdminBanner@update', $ban->id]]) !!}
              <input type="hidden" name="status" value="1">
              <button class="btn btn-success" style="padding:1px 4px 1px 4px;font-size:12px;">Approve</button>
            {!! Form::close() !!}
          @else
            {!! Form::model($ban, ['method'=>'PATCH', 'action'=>['AdminBanner@update', $ban->id]]) !!}
              <input type="hidden" name="status" value="0">
              <button class="btn btn-primary" style="padding:1px 4px 1px 4px;font-size:12px;">Un-Approve</button>
            {!! Form::close() !!}
          @endif
        </td>
        <td>
          <!-- <a href="{{route('admin-banner.edit', $ban->id)}}" class="btn btn-success pull-left" style="padding:1px 4px 1px 4px;font-size:12px;"><i class="fa fa-edit"></i> Edit</a> -->
          {!! Form::open(['method'=>'DELETE', 'action'=>['AdminBanner@destroy', $ban->id]]) !!}
            <button class="btn btn-danger" style="padding:1px 4px 1px 4px;font-size:12px;margin-left:10px;"><i class="fa fa-trash" ></i> Delete</button>
          {!! Form::close() !!}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop