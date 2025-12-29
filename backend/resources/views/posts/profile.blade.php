<!DOCTYPE html>
<html lang="en">
<head>
   
@extends('layouts.app')
	<title>{{$post->business_name}} | Address Guru</title>

	@foreach($seo as $seos)
    <meta name="description" content="{{$seos->s_description}}">
    <meta name="keywords" content="{{$seos->keywords}}">
    
	@endforeach

	<link rel="canonical" href="{{url('/')}}/profiles/{{$post->slug}}">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{$post->business_name}}" />
    <meta property="og:description" content="{{$post->ad_description}}" />
    <meta property="og:url" content="{{url('/')}}/profiles/{{$post->slug}}" />
    <meta property="og:site_name" content="AddressGuru.in" />
    <meta property="og:image" content="{{url('/')}}/images/{{$post->photo}}" />
    <meta property="og:locale" content="en_US" />
    <meta name="twitter:text:title" content="{{$post->business_name}}" />
    <meta name="twitter:image" content="{{url('/')}}/images/{{$post->photo}}" />
    <meta name="twitter:card" content="{{$post->business_name}}" />
    <style type="text/css">h3{font-family:raleway!important;}</style>
@section('content')
<br/>
	<div class="container">
    <div class="row profile">
		<div class="col-md-3 sticker">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="/images/{{$post->photo}}" class="img-responsive" alt="{{$post->business_name}}" style="width:200px;height:200px;">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{$post->business_name}}
					</div>
					<div class="profile-usertitle-job">
						{{$post->only_for}}
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<div>
					<p class="pro-p"><i class="fa fa-map-marker"></i> {{$post->business_address}}</p>
					
				</div><br/>
				
				
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
            	<h3>About Me</h3>
            	<p  class="pro-p" style="margin-top:10px;">
            		{{$post->ad_description}}
            	</p>
            	<br/>
			  <h3>Qulification</h3>
			   <ul class="contentul">
			   		<?php

            			$qu=json_decode($post->course);?>
          				@foreach ($qu as $key => $quli) 
          							
            				<li><i class="fa fa-check"></i> {{$quli}}</li>
            						
            			@endforeach
			   </ul>
			   <br/>
			   <h3>Work Experience</h3>
			   <ul class="contentul">
			   		<?php

            			$qu1=json_decode($post->facility);?>
          				@foreach ($qu1 as $key1 => $quli1) 
          							
            				<li><i class="fa fa-check"></i> {{$quli1}}</li>
            						
            			@endforeach
			   </ul>	
			 
			  
            </div>
		</div>
	</div>
</div>


@stop