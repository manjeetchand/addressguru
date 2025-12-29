@extends('layouts.agent')

@section('content')
<?php 
  use App\Category;
?>
<h3>Ads</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th style="width:140px;">Banner Image</th>
        <th>Image Name</th>
        <th>Listing Name</th>
        <th style="width:600px;">Category</th>
        <th style="width:100px;">Status</th>
        <th style="width:100px;">Created at</th>
        <th style="width:120px;">Operation</th>
      </tr>
    </thead>
    <tbody>       
   
      @foreach($banner as $ban)
      <tr>
        <td>
          <img src="{{url('/')}}/images/{{$ban->image}}" alt="{{$ban->name}}" class="img-responsive" style="width:200px;">
        </td>
        <td>{{$ban->name}}</td>
        <td>{{$ban->post ? $ban->post->business_name : 'Listing Deleted!'}}</td>
        <td>
            <?php $cat = json_decode($ban->category); ?>
            @foreach($cat as $ca)

              <?php $show = Category::find($ca);  ?> <span class="badge">{{$show->name}}</span> 

            @endforeach

        </td>
        <td>{{$ban->status ? 'Live' : 'pending'}}</td>
        <td>{{date('d M, Y', strtotime($ban->created_at))}}</td>
       
        <td>
          

          {!! Form::open(['method'=>'DELETE', 'action'=>['AgentBanner@destroy', $ban->id]]) !!}

            <button class="btn btn-danger" style="padding:1px 4px 1px 4px;font-size:12px;margin-left:10px;"><i class="fa fa-trash" ></i> Delete</button>

          {!! Form::close() !!}

        </td>
      </tr>

      @endforeach
   
     

    </tbody>
  </table>
</div>

 

@stop