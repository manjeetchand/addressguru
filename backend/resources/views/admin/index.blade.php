<!DOCTYPE html>

<html lang="en">

<head>

   

@extends('layouts.admin')









@section('content')

<?php 

use App\Coaching;

?>

    <h3>Admin - <span style="color:#337AB7;"> <i class="fa fa-edit"></i> {{number_format($live)}}</span>  Live Listings | <span style="color:#337AB7;"> <i class="fa fa-users"></i> {{number_format($active)}}</span>  Active Users | <span style="color:#337AB7;"> <i class="fa fa-user"></i> {{number_format($active1)}}</span>  Active Agents | <a href="{{url('admin/create')}}" style="color:#000;"><span style="color:#337AB7;"><i class="fa fa-credit-card fa-fw"></i> ${{number_format($amount)}}</span> Total Payment</a></h3><hr style="border-color:black;">

    <div class="row">

      <div class="col-md-3">

        <div class="panel panel-primary">

          <div class="panel-heading">Approval Request</div>

          <div class="panel-body" style="padding:6px;">

            <div class="col-md-6">

              <h2><b>{{number_format($app)}}</b></h2>  

            </div>

            <div class="col-md-6" style="color:#428bca;font-size:60px;">

              <i class="fa fa-spinner pull-right"></i>  

            </div>

            <div class="clearfix"></div>

          </div>

          <div class="panel-footer text-center" style="padding:2px;"><a href="{{route('admin-user.create')}}">View <i class="fa fa-arrow-right"></i></a></div>

      </div>

      </div> 

    	<div class="col-md-3">

    		<div class="panel panel-primary">

    			<div class="panel-heading">Deactivated Users</div>

  				<div class="panel-body" style="padding:6px;">

  					<div class="col-md-6">

  						<h2><b>{{number_format($user)}}</b></h2>	

  					</div>

  					<div class="col-md-6" style="color:#428bca;font-size:60px;">

  						<i class="fa fa-ban pull-right"></i>	

  					</div>

  					<div class="clearfix"></div>

  				</div>

  				<div class="panel-footer text-center" style="padding:2px;"><a href="{{url('admin/trash/user')}}">View <i class="fa fa-arrow-right"></i></a></div>

			</div>

    	</div> 

    	<div class="col-md-3">

    		<div class="panel panel-primary">

    			<div class="panel-heading">Deactivated Listings</div>

  				<div class="panel-body" style="padding:6px;">

  					<div class="col-md-6">

  						<h2><b>{{number_format($post)}}</b></h2>	

  					</div>

  					<div class="col-md-6" style="color:#428bca;font-size:60px;">

  						<i class="fa fa-ban pull-right"></i>	

  					</div>

  					<div class="clearfix"></div>

  				</div>

  				<div class="panel-footer text-center" style="padding:2px;"><a href="{{url('admin-trash-post')}}">View <i class="fa fa-arrow-right"></i></a></div>

			</div>

    	</div> 

      <div class="col-md-3">

        <div class="panel panel-primary">

          <div class="panel-heading">Claimed Listings</div>

          <div class="panel-body" style="padding:6px;">

            <div class="col-md-6">

              <h2><b>{{number_format($claim)}}</b></h2>  

            </div>

            <div class="col-md-6" style="color:#428bca;font-size:60px;">

              <i class="fa fa-bar-chart pull-right"></i>  

            </div>

            <div class="clearfix"></div>

          </div>

          <div class="panel-footer text-center" style="padding:2px;"><a href="{{url('/claim')}}">View <i class="fa fa-arrow-right"></i></a></div>

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

          <div class="panel-footer text-center" style="padding:2px;"><a href="{{url('/report')}}">View <i class="fa fa-arrow-right"></i></a></div>

      </div>

      </div>

      <div class="col-md-3">

        <div class="panel panel-primary">

          <div class="panel-heading">Approve Ads</div>

          <div class="panel-body" style="padding:6px;">

            <div class="col-md-6">

              <h2><b>{{number_format($banner)}}</b></h2>  

            </div>

            <div class="col-md-6" style="color:#428bca;font-size:60px;">

              <i class="fa fa-edit pull-right"></i>  

            </div>

            <div class="clearfix"></div>

          </div>

          <div class="panel-footer text-center" style="padding:2px;"><a href="{{route('admin-banner.index')}}">View <i class="fa fa-arrow-right"></i></a></div>

      </div>

      </div>

      <div class="col-md-3">

        <div class="panel panel-primary">

          <div class="panel-heading">Query</div>

          <div class="panel-body" style="padding:6px;">

            <div class="col-md-6">

              <h2><b>{{number_format($query)}}</b></h2>  

            </div>

            <div class="col-md-6" style="color:#428bca;font-size:60px;">

              <i class="fa fa-question pull-right"></i>  

            </div>

            <div class="clearfix"></div>

          </div>

          <div class="panel-footer text-center" style="padding:2px;"><a href="{{route('admin-query.index')}}">View <i class="fa fa-arrow-right"></i></a></div>

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

          <div class="panel-footer text-center" style="padding:2px;"><a href="{{route('admin-banner.create')}}">View <i class="fa fa-arrow-right"></i></a></div>

      </div>

      </div>               

    </div>

<hr/>

<div class="row">

    {!! Form::open(['action'=>'AdminIndex@store']) !!}



        <div class="form-group">

            <center><label>Search Listing</label></center>

            <input type="text" name="find" class="form-control" placeholder="Search Listing" onchange="this.form.submit()">

        </div>

  

    {!! Form::close() !!}

</div>

<div class="row">

  <div class="col-md-6">

    <h3>Most Viewed Listings</h3><hr style="margin:6px;" />

     @foreach($view as $views)

        <?php $ve = Coaching::find($views->post_id); ?>

        @if(isset($ve))

          <a href="{{$ve->slug}}">{{$ve->business_name}} - ({{$views->views}} views)</a><br/>

        @endif

      @endforeach

  </div>

  <div class="col-md-6">

    <h3>Recent Approved Listings</h3><hr style="margin:6px;" />

    @foreach($recent as $views)



          <a href="{{$views->slug}}">{{$views->business_name}} - ({{$views->updated_at->diffForHumans()}})</a><br/>



      @endforeach

  </div>



</div>







@stop