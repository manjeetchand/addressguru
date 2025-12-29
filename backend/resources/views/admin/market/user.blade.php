@extends('layouts.admin')


@section('content')
<?php 
  use Illuminate\Support\Facades\Crypt;
?>
@if(Session::has('insert'))

          <div class="alert alert-success" style="margin-top:10px;">
            <strong> {{session('insert')}}</strong>
          </div>

        @endif
<br/>
<a href="{{url('ads-approval-request')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h2>Products - {{$user->name}}</h2><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
   
      <tr>
        <th>S.No</th>
        <th>Product Image</th>
        <th>Title</th>
        <th>Category</th>      
        <th>Status</th>
        <th>Created at</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1; ?>
      @foreach($product as $key)
      
        
      <tr>
        <td>{{$i}}</td>
        <td>
          <img src="{{url('/')}}/images/{{$key->medias[0]->name}}" alt="{{$key->title}}" class="img-responsive" width="100px">
        </td>
        <td><a href="{{url('marketplace-preview', $key->slug)}}">{{$key->title}}</a></td>
        <td>{{$key->mcategory->name}} <small>({{$key->msubcategory->name}})</small></td>
       <td>{{$key->status ? 'Published' : 'Under-Review'}}</td>
         <td>{{date('d M, Y', strtotime($key->created_at))}}</td>
        <td style="width:200px;">
          <a href="{{url('sell-step-one-edit', Crypt::encrypt($key->id))}}" class="btn btn-success pull-left" style="padding:1px 4px 1px 4px;font-size:12px;"><i class="fa fa-edit"></i> Edit</a>
          {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMarketIndex@destroy', $key->id], 'onsubmit'=>'return confirm("Are you sure?");']) !!}
            <button class="btn btn-danger" style="padding:1px 4px 1px 4px;font-size:12px;margin-left:10px;"><i class="fa fa-trash"></i> Delete</button>
          {!! Form::close() !!}
        </td>
      </tr>
      <?php $i++;?>
          @endforeach
    

    </tbody>
  </table>
  {!! $product->render() !!}
</div>


@stop