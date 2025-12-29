@extends('layouts.agent')

@section('content')

<h3>Listings</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Business Image</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Queries</th>
        <th>Created at</th>
        <th>Packages</th>
         <th class="text-center"><i class="fa fa-upload"></i> Slider Images</th>
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
          <a href="{{url('agent/client', $id)}}" class="change-img"><i class="fa fa-upload"></i> Change Image</a>
        </td>
        <td>
           @if($posts->category->id == 52)

           <a href="{{url('/profile-preview', $posts->slug)}}">{{$posts->business_name}}</a>

           @else

          <a href="{{url('/preview', $posts->slug)}}">{{$posts->business_name}}</a>

          @endif
        <td>{{$posts->category ? $posts->category->name : 'Uncategorized'}}</td>
        <td>{{$posts->status == 1 ? 'Published' : 'Unpublished'}}</td>
        <td><a href="{{url('/query', $id)}}">View Queries</a></td>
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
           @if($posts->category->id == 52)
            not eligible
          @else
           <a href="{{route('agent.media.show', $id)}}" class="btn btn-warning" style="padding:1px 4px 1px 4px;font-size:14px;"><i class="fa fa-upload"></i> upload</a>
          @endif
            
        </td>
         <td class="text-center">
            @if($posts->paid == 0)
          <a href="{{url('checkout', $posts->slug)}}" class="btn btn-info" style="padding:1px 4px 1px 4px;font-size:14px;"><i class="fa fa-rupee"></i> Pay</a>
           @else 
            <center><i class="fa fa-check" style="font-size:14px;color:green;"></i> Paid</center>
         @endif
         </td>
        <td style="width:200px;">
          <a href="{{route('agent.listing.edit', $id)}}" class="btn btn-success pull-left" style="padding:1px 4px 1px 4px;font-size:12px;"><i class="fa fa-edit"></i> Edit</a>

          {!! Form::open(['method'=>'DELETE', 'action'=>['PartnerListing@destroy', $id]]) !!}

            <button class="btn btn-danger" style="padding:1px 4px 1px 4px;font-size:12px;margin-left:10px;"><i class="fa fa-trash"></i> Delete</button>

          {!! Form::close() !!}

        </td>
      </tr>
    
    @endforeach
     

    </tbody>
  </table>
</div>

@stop