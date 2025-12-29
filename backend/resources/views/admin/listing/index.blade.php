@extends('layouts.admin')


@section('content')
<?php 
  use App\User;
  use Illuminate\Support\Facades\Crypt;
?>
<br/>
<a href="{{route('admin-user.index')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h2>Listing - {{$user->name}}</h2><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
   
      <tr>
        <th>S.No</th>
        <th>Business Image</th>
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
      <?php $i = 1; $c = 1; ?>
      @foreach($data as $key)
      
        
      <tr>
        <td>{{$c}}</td>
        <td>
          <img src="{{url('/')}}/images/{{$key->photo}}" alt="{{$key->business_name}}" class="img-responsive" width="100px">
        </td>
        <td>
           @if($key->category->id == 52)

           <a href="{{url('/profile-preview', $key->slug)}}">{{$key->business_name}}</a>

           @else

          <a href="{{url('/preview', $key->slug)}}">{{$key->business_name}}</a>

          @endif</td>
        <td>{{$key->category ? $key->category->name : 'Uncategorized'}}</td>
       <td><a href="{{url('/query', $key->id)}}">View Queries</a></td>
       <td><?php 

          $userid = $key->lapp->user_id;

          if ($userid == 0) 
          {
            echo "Not Approved";
          }
          else
          {
            $uname = User::find($userid); 

            if (isset($uname)) 
            {
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
        <p>Approved at: '.date('d F, Y', strtotime($key->updated_at)).'</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>';
            }

            
          }

          
        ?></td>
       <td>{{$key->paid ? 'Paid' : 'Not Paid'}}</td>
         <td>{{date('d F, Y', strtotime($key->created_at))}}</td>
       
        <td>
          @if($key->status == 0)
            {!! Form::model($key, ['method'=>'PATCH', 'action'=>['AdminQuery@update', $key->id]]) !!}
              <input type="hidden" name="status" value="1">
              <button class="btn btn-success" style="padding:1px 4px 1px 4px;font-size:12px;">Approve</button>
            {!! Form::close() !!}
          @else
            {!! Form::model($key, ['method'=>'PATCH', 'action'=>['AdminQuery@update', $key->id]]) !!}
              <input type="hidden" name="status" value="0">
              <button class="btn btn-primary" style="padding:1px 4px 1px 4px;font-size:12px;">Un-Approve</button>
            {!! Form::close() !!}
          @endif
        </td>
        <td style="width:200px;">
          <a href="{{route('post.edit', Crypt::encrypt($key->id))}}" class="btn btn-success pull-left" style="padding:1px 4px 1px 4px;font-size:12px;"><i class="fa fa-edit"></i> Edit</a>
          {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPost@destroy', $key->id]]) !!}
            <button class="btn btn-danger" style="padding:1px 4px 1px 4px;font-size:12px;margin-left:10px;"><i class="fa fa-trash"></i> Delete</button>
          {!! Form::close() !!}
        </td>
      </tr>
      <?php $i++; $c++;?>
          @endforeach
    

    </tbody>
  </table>
  {!! $data->render() !!}
</div>


@stop