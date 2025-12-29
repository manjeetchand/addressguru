@extends('layouts.admin')





@section('content')

<br>

<a href="{{url('/admin')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h4>Reviews</h4>



 <div class="table-responsive">

 <table class="table table-striped table-bordered">

    <thead>

      <tr>

        <th>S.No</th>

        <th>Post Name</th>

        <th>Name</th>

      	<th>Email</th>

        <th>Message</th>

        <th style="width:150px;">Reviews</th>

        <th>Operation</th>

      </tr>

    </thead>

    <tbody>    	

    <?php $i = 1; ?>	

  @foreach($rating as $rates)

      <tr>

        <td>{{$i}}</td>

        <td>

            <a href="{{$rates->coaching->slug ?? '#0'}}" target="_blank">{{$rates->coaching->business_name ?? ''}}</a>

        </td>

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



            {!! Form::model($rates, ['method'=>'PATCH', 'action'=>['AdminRating@update', $rates->id]]) !!}



              <button class="btn btn-success btn-xs">Approve</button>

              <input type="hidden" name="status" value="1">

            {!! Form::close() !!}

            @else

            {!! Form::model($rates, ['method'=>'PATCH', 'action'=>['AdminRating@update', $rates->id]]) !!}

              <button class="btn btn-primary btn-xs">Un-Approve</button>

               <input type="hidden" name="status" value="0">

            {!! Form::close() !!}

            @endif

        </td>

      </tr>

      <?php $i++; ?>

     @endforeach



 

     



    </tbody>

  </table>

</div>

{!! $rating->render() !!}

@stop