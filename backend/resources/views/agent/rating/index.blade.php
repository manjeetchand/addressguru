@extends('layouts.agent')


@section('content')
<?php 
use App\Rating;
?>

<h1>Reviews</h1>

<div class="row">
  <div class="col-xs-12">
     <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Post</th>
        <th class="text-center">Reviews (pending)</th>
      </tr>
    </thead>
    <tbody>      
   @foreach($rate as $posts)
    <?php $coun = Rating::where('post_id', '=', $posts->post_id)->where('status', '=', 0)->count(); ?>
      <tr>
        <td>{{$posts->coaching ? $posts->coaching->business_name : 'Ad Deleted!'}}</td>
        <?php $id = base64_encode($posts->post_id); ?>
        <td><a href="{{url('agent/rating', $id)}}"><center><i class="fa fa-eye"></i> view ({{$coun}})</center></a></td>
      </tr>
      @endforeach

 
     

    </tbody>
  </table>
</div>
  </div>
</div>




@stop