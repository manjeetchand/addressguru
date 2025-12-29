<!DOCTYPE html>
<html lang="en">
<head>
@extends('layouts.admin')
@section('content')



    <h3>Admin - <a href="{{url('live-products')}}"><span style="color:#337AB7;"> <i class="fa fa-edit"></i> {{number_format($live)}}</span>  Live Products</a> | <a href="{{url('admin-market-payment')}}" style="color:#000;"><span style="color:#337AB7;"><i class="fa fa-credit-card fa-fw"></i> ${{number_format($amount)}}</span> Total Payment</a></h3><hr style="border-color:black;">

    <div class="row">

      <div class="col-md-3">

        <div class="panel panel-primary">

          <div class="panel-heading">Approval Request</div>

          <div class="panel-body" style="padding:6px;">

            <div class="col-md-6">

              <h2><b>{{number_format($pro)}}</b></h2>  

            </div>

            <div class="col-md-6" style="color:#428bca;font-size:60px;">

              <i class="fa fa-spinner pull-right"></i>  

            </div>

            <div class="clearfix"></div>

          </div>

          <div class="panel-footer text-center" style="padding:2px;"><a href="{{url('ads-approval-request')}}">View <i class="fa fa-arrow-right"></i></a></div>

      </div>

      </div> 

    	<div class="col-md-3">

        <div class="panel panel-primary">

          <div class="panel-heading">Deactivated Products</div>

          <div class="panel-body" style="padding:6px;">

            <div class="col-md-6">

              <h2><b>{{number_format($product)}}</b></h2>  

            </div>

            <div class="col-md-6" style="color:#428bca;font-size:60px;">

              <i class="fa fa-product-hunt pull-right"></i>  

            </div>

            <div class="clearfix"></div>

          </div>

          <div class="panel-footer text-center" style="padding:2px;"><a href="{{url('admin-market-deactive-product')}}">View <i class="fa fa-arrow-right"></i></a></div>

      </div>

      </div> 

 

      <div class="col-md-3">

        <div class="panel panel-primary">

          <div class="panel-heading">Reports</div>

          <div class="panel-body" style="padding:6px;">

            <div class="col-md-6">

              <h2><b>{{number_format($report)}}</b></h2>  

            </div>

            <div class="col-md-6" style="color:#428bca;font-size:60px;">

              <i class="fa fa-tasks pull-right"></i>  

            </div>

            <div class="clearfix"></div>

          </div>

          <div class="panel-footer text-center" style="padding:2px;"><a href="{{url('admin-market-report')}}">View <i class="fa fa-arrow-right"></i></a></div>

      </div>

      </div>





      <div class="col-md-3">

        <div class="panel panel-primary">

          <div class="panel-heading">All Query</div>

          <div class="panel-body" style="padding:6px;">

            <div class="col-md-6">

              <h2><b>{{number_format($q)}}</b></h2>  

            </div>

            <div class="col-md-6" style="color:#428bca;font-size:60px;">

              <i class="fa fa-question pull-right"></i>  

            </div>

            <div class="clearfix"></div>

          </div>

          <div class="panel-footer text-center" style="padding:2px;"><a href="{{url('admin-market-query')}}">View <i class="fa fa-arrow-right"></i></a></div>

      </div>

      </div>



               

    </div>

<hr/>

<div class="row">

    {!! Form::open(['action'=>'AdminMarketIndex@store']) !!}



        <div class="form-group">

            <center><label>Search Product</label></center>

            <input type="text" name="find" class="form-control" placeholder="Search Product" onchange="this.form.submit()">

        </div>

  

    {!! Form::close() !!}

</div>

<div class="row">



  <div class="col-md-6">

    <h3>Recent Approved Listings</h3><hr style="margin:6px;" />

    @foreach($recent as $views)



          <a href="{{url('marketplace-preview', $views->slug)}}">{{$views->title}} - ({{$views->updated_at->diffForHumans()}})</a><br/>



      @endforeach

  </div>



</div>







@stop