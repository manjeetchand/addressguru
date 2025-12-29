@extends('layouts.user')


@section('content')

<h1>Reviews</h1>

 <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
      	<th>Post</th>
        <th class="text-center">Reviews</th>
      </tr>
    </thead>
    <tbody>    		
   @foreach($post as $posts)
      <tr>
        <td>{{$posts->business_name}}</td>
        <?php $id = base64_encode($posts->id); ?>
        <td><a href="{{url('/rating', $id)}}"><center><i class="fa fa-eye"></i></center></a></td>
      </tr>
      @endforeach

 
     

    </tbody>
  </table>
</div>
 
@stop