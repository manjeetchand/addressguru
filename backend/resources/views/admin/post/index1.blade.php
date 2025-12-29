<!DOCTYPE html>
<html lang="en">
<head>
   
@extends('layouts.app')
<title>Post Ad | Address Guru</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@section('content')
<div class="container-fluid header_post">
	<div class="row">
		<div class="col-md-4 text-right ad" style="color:white;">
			<h2><b>Post Ad</b></h2>
		</div>
		<div class="col-md-4" style="margin-top:15px;margin-left:20px;margin-bottom:15px;">
		
		@if(Auth::user()->role->name == 'User')

			@if(count($personal) > 2)

				<h3 style="color:white;margin:5px;"><b>Can't post more then 3 Ads</b></h3>

			@else

				{!! Form::select('Category', ['0'=>'Choose option'] + $category, null, ['class'=>'form-control', 'onchange'=>'form_show(this.value)']) !!}

			@endif
			
		@elseif(Auth::user()->role->name == 'Agent')

				{!! Form::select('Category', ['0'=>'Choose option'] + $category, null, ['class'=>'form-control', 'onchange'=>'form_show(this.value)']) !!}

		@endif	
			
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
  		
  			
  			<div id="result"></div>
		</div>
	</div>
</div>

 <script type="text/javascript">
	function form_show(get_val) 
	{
		

		$.ajax({
              url: 'testurl',
              type: "get",
              data: "id="+get_val,
               success: function(response)
               { 
        		
               	 $("#result").html(response);

        		}
            });



	}
	</script>
@stop