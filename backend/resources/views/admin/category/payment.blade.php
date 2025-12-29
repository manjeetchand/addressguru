@extends('layouts.admin')
<title>Category</title>

@section('content')
<br/>
<a href="{{url('/admin')}}" class="btn btn-success btn-sm"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
<a href="{{route('admin-category.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Create Category</a>
<a href="{{url('admin-category/payment')}}" class="btn btn-warning btn-sm"><i class="fa fa-plus fa-fw"></i>Payment Mode</a>

<h1>Payment</h1><hr/>
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
<a style="margin-bottom:10px;" href="#" class="btn btn-primary btn-sm" data-target="#myModal" data-toggle="modal"><i class="fa fa-plus fa-fw"></i>Add Payment Mode</a>
<div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
      	<th>ID</th>
        <th>Name</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($payments as $payment)
        <tr>
      	<td>{{$payment->id}}</td>
        <td>{{$payment->name}}</td>
        <td>
        	<a href="#" class="btn btn-warning pull-left" data-target="#myModal{{$payment->id}}" data-toggle="modal"><i class="fa fa-edit"></i></a>
        	{!! Form::open(['action'=>['CategoryControl@paymentDestroy', $payment->id], 'method'=>'DELETE']) !!}
        		<button class="btn btn-danger" style="margin-left:10px;"><i class="fa fa-trash"></i></button>
        	{!! Form::close() !!}
        </td>
      </tr>
              <!-- The Modal -->
        <div class="modal" id="myModal{{$payment->id}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Edit Payment Mode</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                {!! Form::open(['action'=>['CategoryControl@paymentEdit', $payment->id], 'method'=>'POST']) !!}
              <!-- Modal body -->
              <div class="modal-body">
                    <div class="col-12">
                        <label>Enter Payment Mode</label>
                        <input class="form-control" type="text" id="paymentMode" value="{{$payment->name}}" name="name" required>
                    </div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
              	{!! Form::close() !!}
            </div>
          </div>
        </div>
    	@endforeach
    </tbody>
  </table>
</div>

        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title">Add Payment Mode</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                {!! Form::open(['action'=>['CategoryControl@paymentCreate'], 'method'=>'POST']) !!}
              <!-- Modal body -->
              <div class="modal-body">
                    <div class="col-12">
                        <label>Enter Payment Mode</label>
                        <input class="form-control" type="text" id="paymentMode" name="name" required>
                    </div>
              </div>
              <!-- Modal footer -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
              	{!! Form::close() !!}
            </div>
          </div>
        </div>


@stop