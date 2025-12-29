@extends('layouts.admin')





@section('content')

<br/>

<a href="{{url('/admin')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h1>Query's</h1>



 <div class="table-responsive">

 <table class="table table-striped table-bordered">

    <thead>

      <tr>

        <th>S.No</th>

      	<th>Name</th>

        <th>Email</th>

        <th>Mobile Number</th>

        <th>Message</th>

        <th style="width:160px;">Query at</th>

        <th style="width:160px;">Operation</th>

      </tr>

    </thead>

    <tbody>    	

    <?php $i =1; ?>	

    @forelse($query as $queries)

        

        <td>{{$i}}</td>

      	<td>{{$queries->name}}</td>

        <td>{{$queries->email}}</td>

        <td>{{$queries->ph_number}}</td>

        <td>{{$queries->message}}</td>

        <td>{{date('d M, Y', strtotime($queries->created_at))}}</td>

        <td>

        	{!! Form::open(['method'=>'DELETE', 'action'=>['QueryInsert@destroy', $queries->id]]) !!}



        		<button class="btn btn-danger btn-sm pull-left"><i class="fa fa-trash"></i></button>



        	{!! Form::close() !!}

          <a href="" data-toggle="modal" data-target="#myModal{{$i}}" class="btn btn-success btn-sm pull-left" style="margin-left:10px;"><i class="fa fa-envelope fa-fw"></i> Send Mail</a>

        </td>

      </tr>

<div id="myModal{{$i}}" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Mail to {{$queries->name}}</h4>

      </div>

      <div class="modal-body">

        {!! Form::open(['method'=>'POST', 'action'=>'AdminPost@store']) !!}

          <div class="form-group">

            <label>Subject Line</label>

            <input type="text" name="subject" placeholder="Subject Line" class="form-control" value="{{old('')}}" required="required">

          </div>

          <div class="form-group">

            <label>Message</label>

            <textarea rows="4" name="message" class="form-control" required="required" placeholder="Message">{{old('old')}}</textarea>

          </div>

          <input type="hidden" name="query" value="{{$queries->id}}">

          <div class="form-group">

            <center><button class="btn btn-success btn-sm"><i class="fa fa-envelope fa-fw"></i> Send Mail</button></center>

          </div>

        {!! Form::close() !!}

      </div>

    </div>



  </div>

</div>

     <?php $i++; ?>
    @empty 
    <tr>
      <td colspan="7"><center>No Query Found</center></td></tr>

  	@endforelse

     



    </tbody>

  </table>

</div>

{{$query->render()}}

@stop