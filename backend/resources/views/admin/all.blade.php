@extends('layouts.admin')
@section('content')
<br/>
<h1>Query's</h1>
 <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Post Name</th>
      	<th>Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Message</th>
        <th>Query at</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>    		
    @foreach($query as $queries)
        <td>
              @if(isset($queries->post))
                <a href="{{url('/', $queries->post->slug)}}">{{$queries->post->business_name}}</a>
              @else
                <a href="{{url('marketplace-preview', $queries->product->slug ?? '')}}">{{$queries->product->title ?? ''}}</a>
              @endif
        </td>
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
{!! $query->render() !!}
@stop