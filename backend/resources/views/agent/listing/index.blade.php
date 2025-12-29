@extends('layouts.agent')

@section('content')
<?php 
use Illuminate\Support\Facades\Crypt;
?>
<br/>
<a href="{{route('client.index')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h1>Listings</h1><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Business Image</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <!-- <th>Queries</th> -->
        <th>Created at</th>
        <th>Packages</th>
         <th>Upgrade</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>       
    @foreach($post as $posts)

      <tr>
        <td>
          <img src="{{url('/')}}/images/{{$posts->photo}}" alt="{{$posts->business_name}}" class="img-responsive" style="width:100px;height:60px;">
          <?php $id = base64_encode($posts->id); ?>
        </td>
        <td>
           @if($posts->category->id == 52)

           <a href="{{url('/profile-preview', $posts->slug)}}">{{$posts->business_name}}</a>

           @else

          <a href="{{$posts->post_status ? url('/preview', $posts->slug) : route('post.edit', Crypt::encrypt($posts->id))}}">{{$posts->business_name ? $posts->business_name : 'Listing In-Complete'}}</a>

          @endif
        <td>{{$posts->category ? $posts->category->name : 'Uncategorized'}}</td>
        <td>{{$posts->status == 1 ? 'Published' : 'Under-Review'}}</td>
        <!-- <td><a href="{{url('/query', $id)}}">View Queries</a></td> -->
        <td>{{date('d F, Y', strtotime($posts->created_at))}}</td>
         <td class="text-center">
          @if($posts->category->id == 31 OR $posts->category->id == 32 OR $posts->category->id == 34 OR $posts->category->id == 39 OR $posts->category->id == 45)
          <a href="{{url('packagent', $id)}}" style="font-size:20px;"><i class="fa fa-plus"></i></a>
          <br/>Add Packages
           @else
            not eligible
          @endif
        </td>

         <td class="text-center">
            @if($posts->paid == 0)
          <a href="{{$posts->post_status ? url('checkout', $posts->slug) : route('post.edit', Crypt::encrypt($posts->id))}}" class="btn btn-{{$posts->post_status ? 'info' : 'danger'}}" style="padding:1px 4px 1px 4px;font-size:14px;"><b>{{$posts->post_status ? 'Pay' : 'In-Complete'}}</b></a>
           @else 
            <center><i class="fa fa-check" style="font-size:14px;color:green;"></i> Paid</center>
         @endif
         </td>
        <td style="width:200px;">
          <a href="{{route('post.edit', Crypt::encrypt($posts->id))}}" class="btn btn-success pull-left" style="padding:1px 4px 1px 4px;font-size:12px;"><i class="fa fa-edit"></i> Edit</a>

          {!! Form::open(['method'=>'DELETE', 'action'=>['PartnerListing@destroy', $id], 'onsubmit'=>'return confirm("Are you sure?");']) !!}

            <button class="btn btn-danger" style="padding:1px 4px 1px 4px;font-size:12px;margin-left:10px;"><i class="fa fa-trash"></i> Delete</button>

          {!! Form::close() !!}

        </td>
      </tr>
    
    @endforeach
     

    </tbody>
  </table>
</div>

@stop