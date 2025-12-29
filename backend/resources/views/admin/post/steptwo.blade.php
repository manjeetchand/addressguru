<!DOCTYPE html>
<html lang="en">
<head>
   
@extends('layouts.app')
<title>{{$listing->category->name}} | Address Guru</title>

    <meta name="robots" content="noindex">
@section('content')
<div class="container-fluid header_post">
	<div class="row">
		<div class="col-md-12 text-center ad" style="color:white;">
			<h2><b>
         
            <i class="{{$listing->category->icon}} fa-fw"></i> {{$listing->category->name}} 
            @if($listing->subcategory_id != null)
              - <i class="fa fa-tag fa-fw"></i> {{$listing->subcategory->name}}
            @endif
        
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
                    <a href="{{route('post.edit', $id)}}">
                      <li class="rms-step rms-current-step active1">
                        
                          <span class="step-title">Business Information</span>
                          <span class="step-info">Update your business' details and info</span>
                        
                      </li> 
                      </a>
                      <li class="rms-step active">
                          
                          <span class="step-title">Social Details</span>
                          <span class="step-info">Add links of your social profiles</span>
                      </li>
                      <li class="rms-step">
                          
                          <span class="step-title">Business Contact Details</span>
                          <span class="step-info">Add your contact details for buyers to connect</span>
                      </li>
                      <!--<li class="rms-step">-->
                         
                      <!--    <span class="step-title">Search Engine Friendly</span>-->
                      <!--    <span class="step-info">Update SEO friendly keywords and description</span>-->
                      <!--</li>-->
                      <li class="rms-step">
                        <span class="step-icon"><i class="fa fa-file-text" aria-hidden="true"></i></span>
                        <span class="step-title">Upload Slider Images</span>
                        <span class="step-info">Upload relevant slider images of your business</span>
                    </li>
                    <li class="rms-step">
                        <span class="step-icon"><i class="fa fa-money" aria-hidden="true"></i></span>
                        <span class="step-title">Payment</span>
                        <span class="step-info">Proceed for payment</span>
                    </li>
                  </ul>
              </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="row form-new">  
        <div class="col-md-9">
          {!! Form::model($listing, ['action'=>['CoachingInsert@update', $id], 'method'=>'PATCH', 'files'=>true]) !!}
         
          @include('admin.forms.social')

          <div id="stop">
            
            <div class="row">
                <div class="col-md-12"><br/><br/>
                  <div id="rms-wizard" class="rms-wizard">
                  <div class="rms-container">
                  <div class="rms-form-wizard">
                  <div class="rms-footer-section">
                <div class="button-section">
                    <span class="next">
                      <button class="btn">Next Step
                            <small>Business Contact Details</small>
                      </button>
                    </span>
                    <span class="prev">
                        <a href="{{route('post.edit', $id)}}" class="btn">Previous Step
                             <small>Business Information</small>
                        </a>
                    </span>
                </div>
            </div>
          </div>
            </div>
          </div>   
                </div>
            </div>
      {!! Form::close() !!}
      <br/><br/>
        </div>
        </div>
         <div class="col-md-3">
          <div class="alert alert-info form-alert">
            <ul>
              <li><strong>Website Link</strong>: Mention the URL of your business' website. Enter NO if you don't have a website.  </li>
              <li><strong>Youtube Link</strong>: Mention your business' YouTube channel link .  Enter NO if you don't have a YouTube Channel.   </li>
              <li><strong>Featured Image</strong>: Upload the featured image of the business that buyers will see.   </li>
              <li><strong>Map Link</strong>: Update the Map location link of your business.  Enter NO if you don't have a map link.  </li>
            </ul>
          </div>
        </div>
    </div>
</div>
@stop