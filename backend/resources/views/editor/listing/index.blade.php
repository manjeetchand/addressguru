@extends('layouts.editor')


@section('content')
<?php 
use Illuminate\Support\Facades\Crypt;
?>
<br/>
<a href="{{route('editor-dashboard.index')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h3>Listings</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Business Image</th>
        <th>Listing By</th>
        <th>Title</th>
        <th>Category</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>       
    @foreach($data as $key => $value)
      @if(isset($value[0]))

      <tr>
        <td>
          <img src="{{url('/')}}/images/{{$value[0]->photo ? $value[0]->photo : 'user.png'}}" alt="{{$value[0]->business_name}}" class="img-responsive" style="width:100px;height:100px;">
         
        </td>
        <td>{{$value[0]->user->name}}</td>
        <td><a href="{{url('/preview', $value[0]->slug)}}">{{$value[0]->business_name}}</a></td>
        <td>{{$value[0]->category ? $value[0]->category->name : 'Uncategorized'}}</td>
        <td style="width:200px;">
          <a href="{{route('post.edit', Crypt::encrypt($value[0]->id))}}" class="btn btn-success pull-left btn-sm"><i class="fa fa-edit"></i> Edit</a>

        </td>
      </tr>
    @endif
    @endforeach
     

    </tbody>
  </table>
</div>



@stop