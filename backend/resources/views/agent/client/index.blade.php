@extends('layouts.agent')


@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if(Session::has('clientupdate'))
        		<div class="alert alert-success" style="margin-top:20px;">
           			<strong> {{session('clientupdate')}}</strong>
        		</div>
    		@endif

            @if(Session::has('visible'))
                <div class="alert alert-success" style="margin-top:20px;">
                    <strong> {{session('visible')}}</strong>
                </div>
            @endif
            @if(Session::has('stop'))
                <div class="alert alert-danger" style="margin-top:20px;">
                    <strong> {{session('stop')}}</strong>
                </div>
            @endif
		</div>
	</div>
</div>
<h1>Clients</h1><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
      	<th>Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Status</th>
        <th>Created at</th>
        <th>Operation</th>
      </tr>
    </thead>
    
    	@foreach($personal as $clients)
    		<tbody>
               
    			<td style="width:150px;">
                    <?php $id = base64_encode($clients->post_id); ?>
                    <a href="{{url('agent/listing/'. $id)}}">{{$clients->name ? $clients->name : 'In-Complete'}}</a>
                </td>
              
    			<td>{{$clients->email ? $clients->email : 'In-Complete'}}</td>
                <td>{{$clients->ph_number ? $clients->ph_number : 'In-Complete'}}</td>
                <td>{{$clients->is_active == 1 ? 'Verified' : 'Not Verified'}}</td>
    			<td>{{date('d F, Y', strtotime($clients->created_at))}}</td>
                @if($clients->is_active == 0)
    			<td style="width:200;">
                    <strong class="text-danger">Not Verified!</strong>
                    <!-- {!! Form::model($clients, ['method'=>'PATCH', 'action'=>['PartnerClient@update', $clients->id]]) !!}
                        <div class="form-group" style="margin-bottom:0px;">
                            <input type="text" name="verify" placeholder="Verify Code" class="form-control pull-left" style="width:60%;">
                            <button class="btn btn-primary pull-left" style="margin-left:20px;"><i class="fa fa-arrow-right"></i></button>
                        </div>
                    {!! Form::close() !!} -->
                </td>
                @else
                <td style="width:200px;">
                    <a href="{{route('client.edit', $clients->id)}}" class="btn btn-success pull-left" style="padding:1px 4px 1px 4px;font-size:12px;"><i class="fa fa-edit"></i> Edit</a>

                    {!! Form::open(['method'=>'DELETE', 'action'=>['PartnerClient@destroy', $clients->id], 'onsubmit'=>'return confirm("Are you sure?");']) !!}

                        <button class="btn btn-danger"  style="padding:1px 4px 1px 4px;font-size:12px;margin-left:10px;"><i class="fa fa-trash"></i> Delete</button>
                    {!! Form::close() !!}
                    
                </td>
                @endif
    			 </tbody>
    	@endforeach
   
  </table>
</div>
{!! $personal->render() !!}



@stop