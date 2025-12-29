@extends('layouts.admin')


@section('content')
<?php 
  use App\User;
?>
<br/>
<a href="{{url('/admin')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h3>Listing</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
   
      <tr>
      	<th>Business Image</th>
        <th>User</th>
        <th>Title</th>
        <th>Category</th>      
        <th>Query</th>
        <th>Approved By</th>
        <th>Upgrade</th>
        <th>Created at</th>
        
        <th>Status</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
    	@foreach($post as $posts)
      
      
        
      <tr>
      	<td>
          <img src="{{url('/')}}/images/{{$posts->photo}}" alt="{{$posts->business_name}}" class="img-responsive" style="width:100px;height:100px;">
        </td>
        <td>{{$posts->user->name}}</td>
        <td>
           @if($posts->category->id == 52)

           <a href="{{url('/profile-preview', $posts->slug)}}">{{$posts->business_name}}</a>

           @else

          <a href="{{url('/preview', $posts->slug)}}">{{$posts->business_name}}</a>

          @endif</td>
        <td>{{$posts->category ? $posts->category->name : 'Uncategorized'}}</td>
       <td><a href="{{url('/query', $posts->id)}}">View Queries</a></td>
       <td><?php 

          $userid = $posts->lapp->user_id;

          if ($userid == 0) 
          {
            echo "Not Approved";
          }
          else
          {
            $uname = User::findOrFail($userid); 

            echo "<a href='' data-toggle='modal' data-target='#myModal".$i."'>".$uname->name."</a>";
            echo '<div id="myModal'.$i.'" class="modal fade text-center" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">'.$uname->role->name.' Details</h4>
      </div>
      <div class="modal-body">
        <p>Name: '.$uname->name.' </p>
        <p>Email: <a href="mailto:'.$uname->email.'">'.$uname->email.'</a></p>
        <p>Mobile Number: '.$uname->mobile_number.'</p>
        <p>Approved at: '.date('d F, Y', strtotime($posts->updated_at)).'</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>';
          }

          
        ?></td>
       <td>{{$posts->paid ? 'Paid' : 'Not Paid'}}</td>
         <td>{{date('d F, Y', strtotime($posts->created_at))}}</td>
       
        <td>
        	@if($posts->status == 0)
        		{!! Form::model($posts, ['method'=>'PATCH', 'action'=>['AdminQuery@update', $posts->id]]) !!}
        			<input type="hidden" name="status" value="1">
        			<button class="btn btn-success" style="padding:1px 4px 1px 4px;font-size:12px;">Approve</button>
        		{!! Form::close() !!}
        	@else
        		{!! Form::model($posts, ['method'=>'PATCH', 'action'=>['AdminQuery@update', $posts->id]]) !!}
        			<input type="hidden" name="status" value="0">
        			<button class="btn btn-primary" style="padding:1px 4px 1px 4px;font-size:12px;">Un-Approve</button>
        		{!! Form::close() !!}
        	@endif
        </td>
        <td style="width:200px;">
          <a href="{{route('admin-listing.edit', $posts->id)}}" class="btn btn-success pull-left" style="padding:1px 4px 1px 4px;font-size:12px;"><i class="fa fa-edit"></i> Edit</a>
        	{!! Form::open(['method'=>'DELETE', 'action'=>['AdminPost@destroy', $posts->id]]) !!}
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