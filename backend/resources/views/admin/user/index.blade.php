@extends('layouts.admin')


@section('content')

@if(Session::has('delete_user'))

  <div class="alert alert-danger">
    <strong> {{session('delete_user')}}</strong>
  </div>

  @elseif (Session::has('update'))
  <div class="alert alert-success">
    <strong>{{session('update')}} </strong>
  </div>

  @endif

<h4>All Users | Today User: {{number_format($todayuser)}}</h4><hr/>

{!! Form::open(['method'=>'POST', 'action'=>'AdminUser@store']) !!}
  
  <input type="text" name="name" list="name" placeholder="Enter User Name" class="form-control" onchange="this.form.submit()">
  <datalist id="name">
      @foreach($user as $users)
        <option value="{{$users->name}}">
      @endforeach
  </datalist>

{!! Form::close() !!}
<br/>
<div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Role</th>
        <th>Status</th>
        <th>Login</th>
        <th>Created</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
    	 
       <?php $i = 1; ?>

    		@foreach($user as $users)

      <tr>
        <td>{{$i}}</td>
        <td><a href="{{url('admin-listing/'. $users->id)}}">{{$users->name}}</a></td>
        <td>{{$users->email}}</td>
        <td>{{$users->mobile_number ? $users->mobile_number : 'Not Mentioned'}}</td>
        <td>{{$users->role->name}}</td>
        <td>{{$users->is_active == 1 ? 'Active' : 'Not Active'}}</td>
        <td><a href="{{route('admin-user.show', $users->id)}}" target="_blank"><i class="fa fa-sign-in"></i> Login</a></td>
        <td>{{date('d F, Y', strtotime($users->created_at))}}</td>
        <td style="width:200px;">

        	<a href="{{route('admin-user.edit', $users->id)}}" class="btn btn-success pull-left" style="padding:1px 4px 1px 4px;font-size:12px;"><i class="fa fa-edit"></i> Edit</a>

        	{!! Form::open(['method'=>'DELETE', 'action'=>['AdminUser@destroy', $users->id]]) !!}

        		<button class="btn btn-danger" style="padding:1px 4px 1px 4px;font-size:12px;margin-left:10px;"><i class="fa fa-trash"></i> Delete</button>

        	{!! Form::close() !!}
        </td>
      </tr>
      <?php $i++; ?>
      		@endforeach
    
    </tbody>
  </table>
</div>
{!! $user->render() !!}


@stop