@extends('layouts.admin')


@section('content')
<?php 
    use Illuminate\Support\Facades\Crypt;
    ?>
  @if(Session::has('insert'))

          <div class="alert alert-success" style="margin-top:10px;">
            <strong> {{session('insert')}}</strong>
          </div>

        @endif
<br/>
<a href="{{url('admin-marketplace')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h3>Product</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
   
      <tr>
      	<th>Product Image</th>
        <th>User</th>
        <th>Title</th>
        <th>Category</th>      
        <th>Status</th>
        <th>Created at</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
    	@foreach($post as $posts)
      <tr>
      	<td>
          <img src="{{url('/')}}/images/{{$posts->medias[0]->name}}" alt="{{$posts->title}}" class="img-responsive" style="width:100px;height:100px;">
        </td>
        <td><a href="{{url('admin-marketplace', $posts->user_id)}}">{{$posts->user->name}}</a></td>
        <td><a href="{{url('marketplace-preview', $posts->slug)}}">{{$posts->title}}</a></td>
        <td>{{$posts->mcategory->name}} <small>({{$posts->msubcategory->name}})</small></td>
        <td>{{$posts->status ? 'Published' : 'Under-Review'}}</td>
         <td>{{date('d M, Y', strtotime($posts->created_at))}}</td>
        <td style="width:200px;">
          <a href="{{url('sell-step-one-edit', Crypt::encrypt($posts->id))}}" class="btn btn-success pull-left" style="padding:1px 4px 1px 4px;font-size:12px;"><i class="fa fa-edit"></i> Edit</a>
        	{!! Form::open(['method'=>'DELETE', 'action'=>['AdminMarketIndex@destroy', $posts->id], 'onsubmit'=>'return confirm("Are you sure?");']) !!}
        		<button class="btn btn-danger" style="padding:1px 4px 1px 4px;font-size:12px;margin-left:10px;"><i class="fa fa-trash"></i> Delete</button>
        	{!! Form::close() !!}
        </td>
      </tr>
      <?php $i++; ?>
       
      		@endforeach
    

    </tbody>
  </table>
</div>


@stop