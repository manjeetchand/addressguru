@extends('layouts.user')


@section('content')
<br/>
<a href="{{url('/Dashboard')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<h1>Listing Query</h1>

 <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Post</th>
      	<th>Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Message</th>
        <th>Queried At</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>    		
    @foreach($query as $queries)
      <tr>
        <td><a href="{{url(isset($queries->post) ? '/' : 'marketplace', isset($queries->post) ? $queries->post->slug : $queries->product->slug)}}">{{isset($queries->post) ? $queries->post->business_name : $queries->product->title}}</a></td>
      	<td>{{$queries->name}}</td>
        <td>{{$queries->email}}</td>
        <td>{{$queries->ph_number}}</td>
        <td>{{$queries->message}}</td>
        <td>{{date('d M, Y', strtotime($queries->created_at))}}</td>
        <td>
        	{!! Form::open(['method'=>'DELETE', 'action'=>['QueryInsert@destroy', $queries->id]]) !!}

        		<button class="btn btn-danger"><i class="fa fa-trash"></i></button>

        	{!! Form::close() !!}
        </td>
      </tr>
  	@endforeach
     

    </tbody>
  </table>
</div>
 <div class="row">
      <div class="col-md-12">
          <br/>
          <center>{{$query->render()}}</center>
      </div>
  </div>
@stop