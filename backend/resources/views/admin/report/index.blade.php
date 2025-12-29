@extends('layouts.admin')


@section('content')

<h3>Reports</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
   
      <tr>
      	<th>User Name</th>
      	<th>Post Name</th>
        <th>Report</th>
        <th>Message</th>
        <th>Email</th>
        <th>Created at</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
    @foreach($report as $reports)

        
      <tr>
      	<td><a href="{{url('admin-listing', $reports->user_id)}}">{{$reports->user->name}}</a></td>
      	<td><a href="{{url(isset($reports->post) ? '/' : 'marketplace', isset($reports->post) ? $reports->post->slug : $reports->product->slug)}}">{{isset($reports->post) ? $reports->post->business_name : isset($reports->product) ? $reports->product->title : 'Listing Deleted!'}}</a></td>
        <td>{{$reports->report}}</td>
        <td>{{$reports->msg ? $reports->msg : 'Not Mentioned'}}</td>
        <td>{{$reports->email ? $reports->email : 'Not Mentioned'}}</td>
        <td>{{date('d F, Y', strtotime($reports->created_at))}}</td>
       	<td>
       		
        		<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
        	
       	</td>
      </tr>
       
    @endforeach
   
    </tbody>
  </table>
</div>


@stop