@extends('layouts.admin')


@section('content')

<br/>
@if(Session::has('transfer'))

          <div class="alert alert-success">
            <strong> {{session('transfer')}}</strong>
          </div>

        @endif
<a href="/admin" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>

<h3>Payments</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
   
      <tr>
        <th>S.No</th>
        <th>Listing Name</th>
      	<th>Payment By</th>
        <th>Amount</th> 
        <th>Banner</th>
        <th>Payment at</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    	<?php $tot = 0; $i = 1;?>
      @foreach($pay as $pays)
      
        
      <tr>
        <td>{{$i}}</td>
        <td><a href="{{url('/', $pays->post->slug)}}">{{$pays->post->business_name}}</a></td>
        <td><a href="{{url('admin/listing', $pays->user_id)}}">{{$pays->user->name}}</a></td>
        <td>{{$pays->amount}}</td>
        <td>{{$pays->banner_id ? 'Banner Payment' : '-'}}</td>
        <td>{{date('d F, Y', strtotime($pays->created_at))}} - {{$pays->created_at->diffForHumans()}}</td>
        <td>
          @if($pays->post->paid == 0)
            <a href="#" class="btn btn-danger btn-sm"><i class="fa fa-warning fa-fw"></i> Expired</a>
          @else
            <a href="{{url('admin-pay-check', $pays->id)}}" onclick="return confirm('Are you sure?');" class="btn btn-success btn-sm"><i class="fa fa-times fa-fw"></i> Un-Approve</a>
          @endif
        </td>
      </tr>
      <?php $tot += $pays->amount; $i++; ?>
       @endforeach
       <tr>
        <td></td>
         <td><b>Total</b></td>
         <td></td>
         <td><b>{{number_format($tot)}}</b></td>
         <td></td>
         <td></td>
       </tr>
    </tbody>
  </table>
</div>
{!! $pay->render() !!}

@stop