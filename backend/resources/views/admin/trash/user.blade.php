@extends('layouts.admin')


@section('content')
<br/>
<a href="{{url('/admin')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<h3>Deactivated User</h3>
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
      	<th>Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Role</th>
        <th>Deactivate At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>    		
    @foreach($user as $users)
     
      	<td>{{$users->name}}</td>
        <td>{{$users->email}}</td>
        <td>{{$users->mobile_number ? $users->mobile_number : 'Not Mentioned'}}</td>
        <td>{{$users->role->name}}</td>
        <td>{{date('d F, Y', strtotime($users->updated_at))}}</td>
        <td>
        	{!! Form::open(['action'=>['AdminTrashUser@update', $users->id], 'method'=>'PATCH']) !!}
          <button class="btn btn-warning">Activate</button>
          {!! Form::close() !!}
        </td>
      </tr>
     
  	@endforeach
     

    </tbody>
  </table>
</div>
@stop