<!DOCTYPE html>
<html lang="en">
<head>
   
@extends('layouts.app')
<title>Post Ad | Address Guru</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">

@section('content')
<?php 
use Illuminate\Support\Facades\Crypt;
?>
<div class="container-fluid header_post">
	<div class="row">
		<div class="col-md-12 text-center ad" style="color:white;">
			<h2><b>Choose Category</b></h2>
		</div>		
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if(Session::has('created'))

  				<div class="alert alert-success" style="margin-top:20px;">
    				<strong> {{session('created')}}</strong>
  				</div>


  			@elseif(Session::has('new'))
  				<div class="alert alert-danger" style="margin-top:20px;">
    				<strong> {{session('new')}}</strong>
  				</div>

  			@endif
  			@if(Auth::user()->role->name == 'User')

			@if($personal > 3)
				<br/><br/><br/><br/>
				<center><img src="{{url('/')}}/images/stop.png" class="img-responisve">
					<h2>Can't post more Ads</h2>
				</center>

				<style type="text/css">
					.na{display:none;}
				</style>
				

			@endif
			
		@elseif(Auth::user()->role->name == 'Agent')

				

		@endif	
  			
  			
		</div>
	</div>
</div>
<div class="container post_bg na">
    <div class="row">
        <div class="col-md-8">
            <div class="left_box_post">
                <ul>
                    @foreach($cat as $cate)
                            @if(count($cate->sub_categories) == 0)
                            <a href="{{url('/category-post', Crypt::encrypt($cate->id))}}"><li><i class="{{$cate->icon}} fa-fw" style="color:{{$cate->colors}}"></i> {{$cate->name}}
                            @else
                            <a href="javascript:void(0)"><li><i class="{{$cate->icon}} fa-fw" style="color:{{$cate->colors}}"></i> {{$cate->name}}
                            <i class="fa fa-angle-right ici"></i>
                            <ul class="drop">
                                @foreach($cate->sub_categories as $sub)
                                <a href="{{url('/subcategory-post', Crypt::encrypt($sub->id))}}"><li> {{$sub->name}}</li></a>
                                @endforeach
                            </ul>
                            @endif
                        </li></a>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="right_box_post">
                <a href="{{url('Contact-Us')}}" target="_blank" rel="nofollow"><img src="{{url('/')}}/images/banner_new.jpg" alt="banner" class="img-responsive"></a>
            </div>
        </div>
    </div>
</div>
@stop