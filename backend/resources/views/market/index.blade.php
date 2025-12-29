<!DOCTYPE html>
<html lang="en">
<head>
@extends('layouts.app')
	@if(isset($su))
		<title>{{$su->name}} | {{$su->mcategory->name}} | Address Guru</title>
		<link rel="canonical" href="{{url('/')}}{{$_SERVER['REQUEST_URI']}}">
		<meta property="og:type" content="website" />
		<meta property="og:title" content="{{$su->name}} | {{$su->mcategory->name}} | Address Guru" />
		<meta property="og:url" content="{{url('/')}}{{$_SERVER['REQUEST_URI']}}" />
		<meta property="og:site_name" content="Address Guru" />
		<meta property="og:image" content="{{url('/')}}/images/{{$su->og}}" />
		<meta property="og:locale" content="en_US" />
		<meta name="twitter:text:title" content="{{$su->name}} | {{$su->mcategory->name}} | Address Guru" />
		<meta name="twitter:image" content="{{url('/')}}/images/{{$su->og}}" />
		<meta name="twitter:card" content="Marketplace | Address Guru" />
	@else
    <title>Marketplace | Address Guru</title>
    @endif
@section('content')
<style>
	.container-fluid {
		margin-top: 85px ! important;
		padding:0 ;
	}

		@media (max-width: 768px) {
			.container {
				margin-top: 107px ! important;
			}
		}
	</style>
	<style>
    .card{
        border: none;
        border-radius: 1rem;
        box-shadow: 0 6px 12px rgba(30, 10, 58, .04);
        /* transition: box-shadow .2slinear; */
    }
    .search-container {
      background: #ffffff;
      /* border-radius: 12px; */
      padding: 20px 25px;
      /* box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); */
	  display: flex;
    justify-content: center;
      /* transition: transform 0.3s ease; */
    }
    /* .search-container:hover {
      transform: scale(1.02);
    } */
    .form-control, .form-select {
      border-radius: 8px;
      height: 45px;
      font-size: 0.9rem;
    }
		/* .btn {
		border-radius: 8px;
		height: 45px;
		font-size: 0.9rem;
		} */
    .btn-primary {
		background:rgb(252, 102, 1);	
      border: none;
      transition: background-color 0.3s ease;
    }
   
    .btn-secondary {
      background-color: #6c757d;
      border: none;
      transition: background-color 0.3s ease;
    }
    .btn-secondary:hover {
      background-color: #5a6268;
    }
    h2{
        font-size: 1.25rem !important;
    }
    .mobile-about,.mobile-location{
        display:none;
    }
    .skill-span{
            background: #f2f2f2;
            /* padding: 2px 23px; */
            border: 1px solid #eaeaea;
            padding: 0 7px;
            margin: 4px 4px 0 0;
            color: #111;
            min-height: 23px;
            height: 22px;
            border-radius: 6px;
            font-size: 14px;
        }
        .skill-span {
            display: inline-block;
            max-width: 100%; /* Ensures it doesn't exceed the container */
            word-wrap: break-word; /* Breaks long words */
            white-space: normal; /* Allows text wrapping */
        }
		.image{
			width: 100%;
			height: 220px;
		}
		.desk-title{
			display: block;
			margin-bottom: 30px !important;
		}
		.mobile-title{
			display: none;
		}
    @media (max-width: 767px) {
      .search-container .row > div {
        margin-bottom: 10px;
      }
      .desk-about,.desk-location{
        display:none;
      }
      .mobile-about,.mobile-location{
        display:block;
      }
      small span{
        font-size:12px;
      }
      p,span{
        font-size:14px;
      }
	  .image{
			width: 100%;
			height: 130px;
		}
		.desk-title{
			display: none;
		}
		.mobile-title{
			display: block;
			margin-bottom: 30px !important;
		}
    }
</style>
<style>
    .tabs-upper {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        /* justify-content: center; */
        margin: 20px 0;
    }

    .tabs-upper a {
        text-decoration: none;
    }

    .tabs-upper .badge {
        display: inline-block;
        padding: 8px 10px;
        font-size: 15px;
        font-weight: 600;
        color: #fff;
        background: #007BFF; /* Simple and Attractive Blue */
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .tabs-upper .badge:hover {
        background: #0056b3; /* Slightly Darker Blue on Hover */
    }
</style>


<div class="col-md-12">
	<img src="{{url('/')}}/images/new-add.png" class="img-responsive" width="100%">
	<div class="col-md-12 col-12">
		{!! Form::open(['action'=>'Marketplace@store', 'method'=> 'POST']) !!}
		<div class="search-container">
				<div class="row g-2" style="width: 1335px;">
				<!-- Job Title -->
				<div class="col-md-9">
				<input type="text" class="form-control" id="jobTitle" name="search" placeholder="Search by product name car, elecltronics, phone, etc" value="{{request('search')}}" >
				{{-- <input type="hidden" name="city"> --}}
				</div>
				<!-- Location -->
				<!-- <div class="col-md-3">
				<input type="text" class="form-control" id="location" placeholder="Chosse City">
				</div> -->

				<div class="col-md-3 d-flex">
					<button class="btn btn-primary w-100 mx-2" type="submit">Search</button>
					<a class="btn btn-secondary w-100"  href="{{url('marketplace')}}" style="padding-top:12px;">Refresh</a>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
	
	<div class="container-sm market">
	<div class="col-md-12">
		<div class="row align-items-center">
			<div class="col-12">
				<div class="tabs-upper">
					<a href="">
						<span class="badge">All</span>
					</a>
					@foreach($category as $row)
					<a href="{{url('/')}}/marketplace-category/{{preg_replace("/[\s_]/", "-", $row->name)}}/{{base64_encode($row->id)}}">
						<span class="badge">{{$row->name}} {{number_format(count($row->products))}}</span>
					</a>
					@endforeach
				</div>
			</div>
			<div class="col-12">
			<div class="search-box-buy-sell">
				<div class="row">
						<div class="col-md-8 col-xs-8">
						@if(isset($_COOKIE['cityname']))
							<span class="se">Search in <b>"{{$_COOKIE['cityname']}}"</b></span>
						@else
							<span class="se">Search in <b>"Singapore"</b></span>
						@endif
						{{-- <span class="badge mx-2" style="float:none;">{{number_format($pro->total())}} Ads</span> --}}
					</div> 
					<div class="col-md-4 col-xs-4 text-end">
						<div class="sea dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Sort By
							<span class="fa fa-sort fa-fw"></span></a>
							<ul class="dropdown-menu">
								<a href="javascript:void(0)" onclick="document.getElementById('highlow').submit();">
								<li>
									{!! Form::open(['action'=>'Marketplace@store', 'id'=>'highlow']) !!}
									<input type="hidden" value="DESC" name="price">
									High to Low
									{!! Form::close() !!}
								</li>
								</a>
								<a href="javascript:void(0)" onclick="document.getElementById('lowhigh').submit();">
								<li>
									{!! Form::open(['action'=>'Marketplace@store', 'id'=>'lowhigh']) !!}
									<input type="hidden" value="ASC" name="price">
									Low to High
									{!! Form::close() !!}
								</li>
								</a>
							</ul>
							</div>
					</div>
				</div>
			</div>
			</div>
		</div>
	</div>
		<div class="row">
			
		
			{!! Form::open(['method'=>'POST', 'action'=>'Marketplace@store']) !!}
					<!-- <div class="col-md-3" style="padding-left:8px;padding-right:0px;">
						<div class="main meme">
							<div class="form-group has-feedback has-search">
								<span class="fa fa-list form-control-feedback"></span>
								<input type="text" id="myInput" name="city" onclick="toggle_visibility('result-card');toggle_visibility('result-card-right');" autocomplete="off" value="<?php if(isset($_COOKIE['cityname'])){echo $_COOKIE['cityname'];} ?>" class="form-control" required="required" placeholder="Enter City">
								<div class="result-card" id="result-card">
									<ul id="myTable">
										<a href="javascript:void(0)" onclick="placevalue('All')"><li id="All">All</li></a>
										<a href="javascript:void(0)" onclick="getcity('Central')"><li>Central</li></a>
										<a href="javascript:void(0)" onclick="getcity('East Region')"><li>East Region</li></a>
										<a href="javascript:void(0)" onclick="getcity('North Region')"><li>North Region</li></a>
										<a href="javascript:void(0)" onclick="getcity('North-East Region')"><li>North-East Region</li></a>
										<a href="javascript:void(0)" onclick="getcity('West Region')"><li>West Region</li></a>
										<a href="javascript:void(0)" onclick="getcity('Singapore')"><li>Singapore</li></a>
									</ul>
								</div>
							</div>
						</div>
					</div> -->
			<!-- <div class="col-md-8" style="padding-left:0px;padding-right:0px;">
				<div class="main">
					<div class="form-group has-feedback has-search">
					    <span class="fa fa-search form-control-feedback"></span>
					    <input type="text" name="search" value="{{old('search')}}" class="form-control" placeholder="Search by product name car, elecltronics, phone, etc">
					    <div class="result-card" id="result-card-right">
					    	<div id="result-table">
					    		<h3>Popular City</h3>
					    		<ul>
					    			<?php $i = 1; ?>
										@foreach($cityunique as $key => $value)
										<a href="javascript:void(0)" onclick="placevalue('cit{{$i}}')"><li id="cit{{$i}}">{{$value}}</li></a>
										<?php $i++; ?>
										@endforeach
					    		</ul>
					    		<div class="clearfix"></div>
					    	</div>
					    	<div class="alert alert-info text-center">
				    			<strong>Ad Banner</strong>
				    		</div>
					    </div>
					</div>
				</div>
			</div>
			<div class="col-md-1 col-xs-12" style="padding-left:0px;padding-right:0px;">
				<div class="main">
					<button class="btn btn-primary"><i class="fa fa-search fa-fw"></i> Search</button>
				</div>
			</div> -->
	
			{!! Form::close() !!}
			<div class="col-md-12 hiha">
				<!-- @if(count($pro) == 0)
					<br/><br/>
					<center><img src="{{url('/')}}/images/not-found.PNG" class="img-responsive" alt="Not Found"></center>
					@else -->
				<div class="row">
					<div class="col-md-12" style="padding:0px 8px 12px 8px;">
					
					</div>

					@foreach($pro as $pros)
					<div class="col-md-3 col-6 mb-3">
						<a href="{{url('marketplace')}}/{{preg_replace("/[\s_]/", "-", $pros->state)}}/{{preg_replace("/[\s_]/", "-", $pros->mcategory->name ?? '' )}}/{{preg_replace("/[\s_]/", "-", $pros->msubcategory->name ?? 0 )}}/{{$pros->slug}}" class="h-100">
							<div class="marketplace-box p-2 h-100 m-0">
								@if($pros->package != 0)
								<div class="featured-ticker">
									Featured
								</div>
								@endif
								<div class="image">
									<img src="{{url('/')}}/images/{{$pros->medias[0]->name}}" class="" alt="AddressGuru" style="object-fit:cover;width:100% !important; height:100%!important; padding:0px;">
								</div>
									
								{{-- @if($pros->package != 0)
								<div class="marketplace-inner-box featured">
								@else --}}
								<div class="marketplace-inner-box border-0">
								{{-- @endif --}}
									<h4 title="{{$pros->title}}" style="font-size:15px" class="text-dark desk-title">{{substr($pros->title, 0, 50)}}</h4>
									<h4 title="{{$pros->title}}" style="font-size:15px" class="text-dark mobile-title">{{substr($pros->title, 0, 20)}}..</h4>
									@if($pros->price == 'Amount')
									<h5 class="">$ {{number_format($pros->amount)}}</h5>
									@else
									<h5 class="">{{$pros->price}}</h5>
									@endif
								<div class="d-flex flex-wrap justify-content-between gap-1">
									<span class="pull-left" style="font-size:13px"><i class="fa fa-map-marker"></i> {{$pros->city}}, {{$pros->state}}</span>
									<span class="pull-right" style="font-size:13px"><i class="fa fa-calendar fa-fw"></i> {{$pros->created_at->diffForHumans()}}</span>
								</div>
								<div class="clearfix"></div>
								</div>
							</div>
						</a>
					</div>
					@endforeach
				</div>
{{--
				{{$pro->render()}}
				--}}
				@endif
			</div>
			<!-- <div class="col-md-2 market-col">
				<div class="filter-stop">
					<div class="filter-search-top">
						Search Filters <i class="fa fa-filter"></i>
					</div>
				</div>
				<div class="panel-group" style="margin-top:12px;">
	    			 <div class="panel panel-info">
	      				<div class="panel-heading">S$ Price Filter</div>
	      				<div class="panel-body">
	      					{!! Form::open(['action'=>'Marketplace@store']) !!}
								<ul class="topul">
									<li><label><input type="radio" name="price" value="DESC" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" title="High to Low"> High to Low</span></label></li>
									<li><label><input type="radio" name="price" value="ASC" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" title="Low to High"> Low to High</span></label></li>
								</ul>
							{!! Form::close() !!}
	      				</div>
	    			</div>
	    			<div class="panel panel-warning">
	      				<div class="panel-heading"><i class="fa fa-tags fa-fw"></i> Categories</div>
	      				<div class="panel-body" style="overflow:auto;max-height:400px;">
	      					{!! Form::open(['action'=>'Marketplace@store']) !!}
								<ul class="topul ">
									@foreach($category as $row)
									<li><label><input type="radio" name="category_id" value="{{$row->id}}" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" style="font-weight:bold;" title="{{$row->name}}"> {{$row->name}} <hr/></span> </label> ({{number_format(count($row->products))}})	
										<ul style="margin-left:-34px;overflow:auto;max-height:150px;">
											@foreach($row->msubcategory as $value)
											<li><label><input type="radio" name="subcategory_id" value="{{$value->id}}" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" title="{{$value->name}}"> {{$value->name}}</span> </label> ({{number_format(count($value->products))}})</li>
											@endforeach
										</ul>
									</li><hr/>
									@endforeach
								</ul>
							{!! Form::close() !!}
	      				</div>
	    			</div>
	    			<div class="panel panel-danger">
	      				<div class="panel-heading"><i class="fa fa-map-marker fa-fw"></i> Location</div>
	      				<div class="panel-body" style="overflow:auto;max-height:250px;">
	      					{!! Form::open(['action'=>'Marketplace@store']) !!}
								<ul class="topul">
									@foreach($cityunique as $row => $value)
									<li><label><input type="radio" name="city" value="{{$value}}" onclick="this.form.submit()"><span data-toggle="tooltip" data-placement="top" title="{{$value}}"> {{$value}}</span></label></li>
									@endforeach
								</ul>
							{!! Form::close() !!}
	      				</div>
	    			</div>
	    		</div>
			</div> -->
		</div>
	</div>
<script type="text/javascript">
	function placevalue(a) 
	{
		var myVar = document.getElementById(a).innerHTML;
		document.getElementById('myInput').value = myVar;
		document.getElementById('result-card').style.display = "none";
		document.getElementById('result-card-right').style.display = "none";
	}
	function getcity(b) 
	{
		var a = document.getElementById('result-table');
		if (b == "Central") 
		{
			a.innerHTML = "<h3>"+b+"</h3><ul class='ullll'><a href='javascript:void(0)' onclick=placevalue('cit1')><li id='cit1'>Bisan</li></a><a href='javascript:void(0)' onclick=placevalue('cit2')><li id='cit2'>Bukit Merah</li></a><a href='javascript:void(0)' onclick=placevalue('cit3')><li id='cit3'>Bukit Timah</li></a><a href='javascript:void(0)' onclick=placevalue('cit4')><li id='cit4'>Downtown Core</li></a><a href='javascript:void(0)' onclick=placevalue('cit5')><li id='cit5'>Geylang</li></a><a href='javascript:void(0)' onclick=placevalue('cit6')><li id='cit6'>Kallang</li></a><a href='javascript:void(0)' onclick=placevalue('cit7')><li id='cit7'>Marina East</li></a><a href='javascript:void(0)' onclick=placevalue('cit8')><li id='cit8'>Marina South</li></a><a href='javascript:void(0)' onclick=placevalue('cit9')><li id='cit9'>Marine Parade</li></a><a href='javascript:void(0)' onclick=placevalue('cit10')><li id='cit10'>Museum</li></a><a href='javascript:void(0)' onclick=placevalue('cit11')><li id='cit11'>Newton</li></a><a href='javascript:void(0)' onclick=placevalue('cit12')><li id='cit12'>Novena</li></a><a href='javascript:void(0)' onclick=placevalue('cit13')><li id='cit13'>Orchard</li></a><a href='javascript:void(0)' onclick=placevalue('cit14')><li id='cit14'>Outram</li></a><a href='javascript:void(0)' onclick=placevalue('cit15')><li id='cit15'>Queenstown</li></a><a href='javascript:void(0)' onclick=placevalue('cit16')><li id='cit16'>River Valley</li></a><a href='javascript:void(0)' onclick=placevalue('cit17')><li id='cit17'>Rochor</li></a><a href='javascript:void(0)' onclick=placevalue('cit18')><li id='cit18'>Singapore River</li></a><a href='javascript:void(0)' onclick=placevalue('cit19')><li id='cit19'>Southern Islands</li></a><a href='javascript:void(0)' onclick=placevalue('cit20')><li id='cit20'>Straits View</li></a><a href='javascript:void(0)' onclick=placevalue('cit21')><li id='cit21'>Tanglin</li></a><a href='javascript:void(0)' onclick=placevalue('cit22')><li id='cit22'>Toa Payoh</li></a></ul><div class='clearfix'></div>";
		}
		else if(b == "East Region")
		{
			a.innerHTML = "<h3>"+b+"</h3><ul><a href='javascript:void(0)' onclick=placevalue('cit1')><li id='cit1'>Bedok</li></a><a href='javascript:void(0)' onclick=placevalue('cit2')><li id='cit2'>Changi</li></a><a href='javascript:void(0)' onclick=placevalue('cit3')><li id='cit3'>Changi Bay</li></a><a href='javascript:void(0)' onclick=placevalue('cit4')><li id='cit4'>Pasir Ris</li></a><a href='javascript:void(0)' onclick=placevalue('cit5')><li id='cit5'>Tampines</li></a></ul><div class='clearfix'></div>";
		}
		else if(b == "North Region")
		{
			a.innerHTML = "<h3>"+b+"</h3><ul><a href='javascript:void(0)' onclick=placevalue('cit1')><li id='cit1'>Central Water Catchment</li></a><a href='javascript:void(0)' onclick=placevalue('cit2')><li id='cit2'>Lim Chu Kang</li></a><a href='javascript:void(0)' onclick=placevalue('cit3')><li id='cit3'>Mandai</li></a><a href='javascript:void(0)' onclick=placevalue('cit4')><li id='cit4'>Sembawang</li></a><a href='javascript:void(0)' onclick=placevalue('cit5')><li id='cit5'>Simpang</li></a><a href='javascript:void(0)' onclick=placevalue('cit6')><li id='cit6'>Sungei Kadut</li></a><a href='javascript:void(0)' onclick=placevalue('cit7')><li id='cit7'>Woodlands</li></a><a href='javascript:void(0)' onclick=placevalue('cit8')><li id='cit8'>Yishun</li></a></ul><div class='clearfix'></div>";
		}
		else if(b == "North-East Region")
		{
			a.innerHTML = "<h3>"+b+"</h3><ul><a href='javascript:void(0)' onclick=placevalue('cit1')><li id='cit1'>Ang Mo Kio</li></a><a href='javascript:void(0)' onclick=placevalue('cit2')><li id='cit2'>Hougang</li></a><a href='javascript:void(0)' onclick=placevalue('cit3')><li id='cit3'>North-Eastern Islands</li></a><a href='javascript:void(0)' onclick=placevalue('cit4')><li id='cit4'>Punggol</li></a><a href='javascript:void(0)' onclick=placevalue('cit5')><li id='cit5'>Seletar</li></a><a href='javascript:void(0)' onclick=placevalue('cit6')><li id='cit6'>Sengkang</li></a><a href='javascript:void(0)' onclick=placevalue('cit7')><li id='cit7'>Serangoon</li></a></ul><div class='clearfix'></div>";
		}
		else if(b == "West Region")
		{
			a.innerHTML = "<h3>"+b+"</h3><ul><a href='javascript:void(0)' onclick=placevalue('cit1')><li id='cit1'>Boon Lay</li></a><a href='javascript:void(0)' onclick=placevalue('cit2')><li id='cit2'>Bukit Batok</li></a><a href='javascript:void(0)' onclick=placevalue('cit3')><li id='cit3'>Bukit Panjang</li></a><a href='javascript:void(0)' onclick=placevalue('cit4')><li id='cit4'>Choa Chu Kang</li></a><a href='javascript:void(0)' onclick=placevalue('cit5')><li id='cit5'>Clementi</li></a><a href='javascript:void(0)' onclick=placevalue('cit6')><li id='cit6'>Jurong East</li></a><a href='javascript:void(0)' onclick=placevalue('cit7')><li id='cit7'>Jurong West</li></a><a href='javascript:void(0)' onclick=placevalue('cit8')><li id='cit8'>Pioneer</li></a><a href='javascript:void(0)' onclick=placevalue('cit9')><li id='cit9'>Tengah</li></a><a href='javascript:void(0)' onclick=placevalue('cit10')><li id='cit10'>Tuas</li></a><a href='javascript:void(0)' onclick=placevalue('cit11')><li id='cit11'>Western Islands</li></a><a href='javascript:void(0)' onclick=placevalue('cit12')><li id='cit12'>Western Water Catchment</li></a></ul><div class='clearfix'></div>";
		}
		else if(b == "Singapore")
		{
			a.innerHTML = "<h3>"+b+"</h3><ul><a href='javascript:void(0)' onclick=placevalue('cit1')><li id='cit1'>Singapore</li></a></ul><div class='clearfix'></div>";
		}
		else
		{
			a.innerHTML = "<center>No Record Found</center>";
		}
	}
</script>
<script>
	$('body').click(function() {
		if($(event.target).closest('.meme').get(0)) {
			return;
		}
		$('#result-card, #result-card-right').hide();
	})
</script>
@stop