@extends('layouts.agent')


@section('content')
<br>
<a href="{{url('agent/rating')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<h1>Reviews</h1>

 <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Name</th>
      	<th>Email</th>
        <th>Message</th>
        <th>Reviews</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>    		
  @foreach($rating as $rates)
      <tr>
        <td>{{$rates->name}}</td>
        <td>{{$rates->rating_email}}</td>
        <td>{{$rates->message}}</td>
        <td>
            @if($rates->rating == 1)

              <i class="fa fa-star"></i>

            @elseif($rates->rating == 2)

            <i class="fa fa-star"></i><i class="fa fa-star"></i>

            @elseif($rates->rating == 3)

            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>

            @elseif($rates->rating == 4)

            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>

            @elseif($rates->rating == 5)

            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>

            @endif
        </td>
        <td>
            @if($rates->status == 0)

            {!! Form::model($rates, ['method'=>'PATCH', 'action'=>['AgentRating@update', $rates->id]]) !!}

              <button class="btn btn-success">Approve</button>
              <input type="hidden" name="status" value="1">
            {!! Form::close() !!}
            @else
            {!! Form::model($rates, ['method'=>'PATCH', 'action'=>['AgentRating@update', $rates->id]]) !!}
              <button class="btn btn-primary">Un-Approve</button>
               <input type="hidden" name="status" value="0">
            {!! Form::close() !!}
            @endif
        </td>
      </tr>
     @endforeach

 
     

    </tbody>
  </table>
</div>
 
@stop