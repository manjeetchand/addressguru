@extends('layouts.agent')


@section('content')
<h1>Listing Query</h1>

 <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Mobile Number</th>
        <th>Message</th>
         <th>Created at</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>       
   @foreach($query as $querys)
      <tr>
        <td>{{$querys->name}}</td>
        <td>{{$querys->email}}</td>
        <td>{{$querys->ph_number}}</td>
        <td>{{$querys->message}}</td>
         <td>{{date('d F, Y', strtotime($querys->created_at))}}</td>
        <td>
          {!! Form::open(['method'=>'DELETE', 'action'=>['QueryInsert@destroy', $querys->id]]) !!}

            <button class="btn btn-danger"><i class="fa fa-trash"></i></button>

          {!! Form::close() !!}
        </td>
      </tr>
    
     @endforeach

    </tbody>
  </table>
</div>

@stop