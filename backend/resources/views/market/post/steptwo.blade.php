<!DOCTYPE html>
<html lang="en">
<head>
   
@extends('layouts.app')
<style type="text/css">
  .rms-wizard .rms-multistep-progressbar li.rms-step
  {
    width:25%!important;
  }
</style>
<title>{{$listing->msubcategory->name}} | Address Guru</title>

    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">
    <meta name="robots" content="noindex">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.css">
@section('content')
<div class="container-fluid header_post">
  <div class="row">
    <div class="col-md-12 text-center ad" style="color:white;">
      <h2><b>
            <i class="{{$listing->mcategory->icon}}"></i> {{$listing->msubcategory->name}}
      </b></h2>
    </div>
  </div>
</div>

<div class="container" style="background-color:#fff;padding:0px 40px 0px 40px;">
  <div class="row">
    <div class="col-md-12">
      <div id="rms-wizard" class="rms-wizard">
   <!--Wizard Container-->
    <div class="rms-container">
          <div class="rms-form-wizard">
          <div class="rms-step-section compeletedStepClickable" data-step-counter="true" data-step-image="false">
                <ul class="rms-multistep-progressbar"> 
                    <a href="{{url('sell-step-one-edit', $id)}}">
                    <li class="rms-step rms-current-step active1">
                        <span class="step-icon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <span class="step-title">Ad Information</span>
                        <span class="step-info">Update your Ad details and info</span>
                    </li> 
                    </a>
                    <li class="rms-step active">
                        <span class="step-icon ml10"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                        <span class="step-title">Add Photos</span>
                        <span class="step-info">Add your product images</span>
                    </li>
                    <li class="rms-step">
                        <span class="step-icon ml10"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                        <span class="step-title">Contact Details</span>
                        <span class="step-info">Add your contact details for buyers to connect</span>
                    </li>
                    <li class="rms-step">
                        <span class="step-icon"><i class="fa fa-money" aria-hidden="true"></i></span>
                        <span class="step-title">Final Step</span>
                        <span class="step-info">Proceed for final step</span>
                    </li>
                </ul>
            </div>
            </div>
          </div>
        </div>
    </div>
  </div>
  @if(Session::has('no'))
    <div class="alert alert-danger" style="margin-bottom:0px;">
        <strong> {{session('no')}}</strong>
    </div>
    
@endif
@if(Session::has('insert'))
    <div class="alert alert-success" style="margin-bottom:0px;">
        <strong> {{session('insert')}}</strong>
    </div>
    
@endif
    <div class="row form-new">  
        <div class="col-md-9">
          <br/>
          {!! Form::model($listing, ['method'=>'PATCH', 'action'=>['CoachingInsert@mupdate', $id], 'files'=>true, 'class'=>'dropzone']) !!}
          <input type="hidden" name="product_id" value="0">
          {!! Form::close() !!}

          @if(count($listing->medias) == 0)
          <br/>
          <a href="javascript::void(0)" onclick="location.reload();"><i class="fa fa-spinner fa-fw"></i> Refresh to load Iamges</a>
          @else
          <br/><div class="row">
            <h4>Uploaded Images</h4>
            <?php $i = 1; ?>
            @foreach($listing->medias as $photos)
            <div class="col-md-2">
              <div class="thumbnail">
                <img src="{{url('/')}}/images/{{$photos->name}}" class="img-responsive" alt="{{$listing->title}}">
                <a href="{{route('post.show', $photos->id)}}" onclick="return confirm('Are you sure?`');" class="close_button"><i class="fa fa-close" style="margin-top:-80px;"></i></a>
              </div>
            </div>
            <?php $i++; ?>
            @endforeach
          </div><br/><br/>
          @endif

          {!! Form::model($listing, ['method'=>'PATCH', 'action'=>['CoachingInsert@mupdate', $id]]) !!}


          <input type="hidden" name="media" value="0">

          
          <div id="stop">
            <div class="row">
                <div class="col-md-12">
                  <div id="rms-wizard" class="rms-wizard">
                  <div class="rms-container">
                  <div class="rms-form-wizard">
                  <div class="rms-footer-section">
                <div class="button-section">
                    <span class="next">
                      <button class="btn">Next Step
                            <small>Contact Details</small>
                      </button>
                    </span>
                </div>
            </div>
          </div>
            </div>
          </div>   
                </div>
            </div>
      {!! Form::close() !!}
        </div>
        </div>
        <div class="col-md-3">
            <div class="alert alert-info form-alert">
              <h3><strong>Posting Tips</strong></h3><br/>
              <ul>
                  <li><strong>Photos</strong>: Add your product images.</li>
              </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
@stop