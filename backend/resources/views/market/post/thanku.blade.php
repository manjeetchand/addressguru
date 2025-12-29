<!DOCTYPE html>
<html lang="en">
<head>

    <meta name="robots" content="noindex">
@extends('layouts.app')
<title>{{$pro->title}} | Address Guru</title>


<style type="text/css">
.checkmark__circle {
  stroke-dasharray: 166;
  stroke-dashoffset: 166;
  stroke-width: 2;
  stroke-miterlimit: 10;
  stroke: #7ac142;
  fill: none;
  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.checkmark {
  width: 150px!important;
  height: 150px!important;
  position:relative!important;
  border-radius: 50%;
  display: block;
  stroke-width: 2;
  stroke: #fff;
  stroke-miterlimit: 10;
  box-shadow: inset 0px 0px 0px #7ac142;
  animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
}

.checkmark__check {
  transform-origin: 50% 50%;
  stroke-dasharray: 48;
  stroke-dashoffset: 48;
  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
  100% {
    stroke-dashoffset: 0;
  }
}
@keyframes scale {
  0%, 100% {
    transform: none;
  }
  50% {
    transform: scale3d(1.1, 1.1, 1);
  }
}
@keyframes fill {
  100% {
    box-shadow: inset 0px 0px 0px 100px #7ac142;
  }
}
.h21
{
  margin:0px!important;
}



</style>
@section('content')

<div class="container-fluid header_post">
	<div class="row">
		<div class="col-md-12 text-center ad" style="color:white;">
			<h2><b>
         
            <i class="{{$pro->mcategory->icon}} fa-fw"></i> {{$pro->mcategory->name}} 
              - <i class="fa fa-tag fa-fw"></i> {{$pro->msubcategory->name}}
        
      </b></h2>
		</div>
	</div>
</div>

<div class="container" style="background-color:#fff;padding:0px 40px 0px 40px;">
  
    <div class="row">  
        <div class="col-md-12">
         @if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div>
@endif
      <center style="padding:50px;"><svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg></center>

      <div class="alert alert-success">
        <h3 class="h21">{{$pro->title}}</h3><br/>
        <p><strong>Thank you for listing with us.</strong> <br/>
        The listing has been submitted for review, will be made live within 24 hours. If you have any queries, let us know at <a href="mailto:contact@addressguru.sg">contact@addressguru.sg</a>
        <br/><br/>
        <center><a href="{{url('marketplace-preview', $pro->slug)}}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-file fa-fw"></i> Generate Preview </a></center>
      </p>
      </div>
     
        </div>
        </div>
       
      
    </div>
</div>


@stop
