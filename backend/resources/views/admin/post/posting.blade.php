<!DOCTYPE html>
<html lang="en">
<head>
   
@extends('layouts.app')

<title>{{isset($category) ? $category->name : $subcategory->category->name.' - '.$subcategory->name}} | Address Guru</title>

<style>
  #map-canvas{
    width: 100%;
    height: 350px;
  }
</style>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">
    <meta name="robots" content="noindex">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAiC8iNVTm_YlZZmd6UFg6C2y3Y5ARk6QY&libraries=places" -->
  type="text/javascript"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')
<div class="container-fluid header_post">
	<div class="row">
		<div class="col-md-12 text-center ad" style="color:white;">
			<h2><b>
         
            <i class="{{isset($category) ? $category->icon : $subcategory->category->icon}}"></i> {{isset($category) ? $category->name : $subcategory->category->name.' - '.$subcategory->name}}

        
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
                    <li class="rms-step rms-current-step active">
                        <span class="step-icon"><i class="fa fa-lock" aria-hidden="true"></i></span>
                        <span class="step-title">Business Information</span>
                        <span class="step-info">Update your business' details and info</span>
                    </li> 
                    <li class="rms-step">
                        <span class="step-icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <span class="step-title">Social Details</span>
                        <span class="step-info">Add links of your social profiles</span>
                    </li>
                    <li class="rms-step">
                        <span class="step-icon ml10"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                        <span class="step-title">Business Contact Details</span>
                        <span class="step-info">Add your contact details for buyers to connect</span>
                    </li>
                    <!--<li class="rms-step">-->
                    <!--    <span class="step-icon"><i class="fa fa-file-text" aria-hidden="true"></i></span>-->
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

          {!! Form::open(['action'=>'CoachingInsert@store']) !!}

          @if(isset($category))
            <input type="hidden" name="category_id" value="{{$category->id}}" class="form-control">
          @else
            <input type="hidden" name="subcategory_id" value="{{$subcategory->id}}" class="form-control">
          @endif
          <?php

          switch (isset($category) ? $category->id : $subcategory->category->id) 
          {
            case 1:
              ?>  @include('admin.forms.form1')<?php
              break;

              case 2:
              ?>  @include('admin.forms.form5')<?php
              break;

              case 3:
              ?>  @include('admin.forms.form3')<?php
              break;

               case 4:
              ?>  @include('admin.forms.form4')<?php
              break;

              case 5:
              ?>  @include('admin.forms.form2')<?php
              break;

              case 6:
              ?>  @include('admin.forms.form6')<?php
              break;

              case 7:
              ?>  @include('admin.forms.form7')<?php
              break;

              case 8:
              ?>  @include('admin.forms.form8')<?php
              break;

              case 9:
              ?>  @include('admin.forms.form9')<?php
              break;

              case 10:
              ?>  @include('admin.forms.form10')<?php
              break;

              case 11:
              ?>  @include('admin.forms.form11')<?php
              break;

              case 12:
              ?>  @include('admin.forms.form12')<?php
              break;

              case 13:
              ?>  @include('admin.forms.form13')<?php
              break;

              case 14:
              ?>  @include('admin.forms.form14')<?php
              break;

              case 15:
              ?>  @include('admin.forms.form15')<?php
              break;

              case 16:
              ?>  @include('admin.forms.form16')<?php
              break;

              case 17:
              ?>  @include('admin.forms.form17')<?php
              break;

              case 18:
              ?>  @include('admin.forms.form18')<?php
              break;

              case 19:
              ?>  @include('admin.forms.form19')<?php
              break;

              case 20:
              ?>  @include('admin.forms.form20')<?php
              break;

              case 21:
              ?>  @include('admin.forms.form21')<?php
              break;

              case 22:
              ?>  @include('admin.forms.form22')<?php
              break;

              case 23:
              ?>  @include('admin.forms.form23')<?php
              break;

              case 24:
              ?>  @include('admin.forms.form24')<?php
              break;

              case 25:
              ?>  @include('admin.forms.form25')<?php
              break;

              case 26:
              ?>  @include('admin.forms.form26')<?php
              break;

              case 27:
              ?>  @include('admin.forms.form27')<?php
              break;

              case 28:
              ?>  @include('admin.forms.form28')<?php
              break;

              case 29:
              ?>  @include('admin.forms.form29')<?php
              break;

              case 30:
                
              ?>  @include('admin.forms.form30')<?php
              break;

              case 31:
              ?>  @include('admin.forms.form31')<?php
              break;

              case 32:
              ?>  @include('admin.forms.form32')<?php
              break;

              case 33:
              ?>  @include('admin.forms.form33')<?php
              break;

              case 34:
              ?>  @include('admin.forms.form34')<?php
              break;

              case 35:
              ?>  @include('admin.forms.form35')<?php
              break;

              case 36:
              ?>  @include('admin.forms.form36')<?php
              break;

              case 37:
              ?>  @include('admin.forms.form37')<?php
              break;

              case 38:
              ?>  @include('admin.forms.form38')<?php
              break;

              case 39:
              ?>  @include('admin.forms.form39')<?php
              break;

              case 40:
              ?>  @include('admin.forms.form40')<?php
              break;

              case 41:
              ?>  @include('admin.forms.form41')<?php
              break;

              case 42:
              ?>  @include('admin.forms.form42')<?php
              break;

              case 43:
              ?>  @include('admin.forms.form43')<?php
              break;

              case 44:
              ?>  @include('admin.forms.form44')<?php
              break;

              case 45:
              ?>  @include('admin.forms.form45')<?php
              break;

              case 46:
              ?>  @include('admin.forms.form46')<?php
              break;

              case 47:
              ?>  @include('admin.forms.form47')<?php
              break;

              case 48:
              ?>  @include('admin.forms.form48')<?php
              break;

              case 49:
              ?>  @include('admin.forms.form49')<?php
              break;

              case 50:
              ?>  @include('admin.forms.form50')<?php
              break;

              case 51:
              ?>  @include('admin.forms.form51')<?php
              break;

              case 52:
              ?>  @include('admin.forms.form52')<?php
              break;

              case 53:
              ?>  @include('admin.forms.form53')<?php
              break;

              case 54:
              ?>  @include('admin.forms.form54')<?php
              break;

              case 55:
              ?>  @include('admin.forms.form55')<?php
              break;
            
            default:
              echo '<center><img src="'.url('/').'/images/work.png" class="img-responsive"></center>
            <style type="text/css">
              #stop
              {
                display:none;
              }
            </style>';
              break;
          }



          ?>
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
                            <small>Social Details</small>
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
        @yield('right_col')
    </div>
</div>
<script>
function countChar(val) {
  var str = val.value;
  var n = str.length;
  document.getElementById("charNum").innerHTML = n;
}
</script>
<!-- <script>
  var map = new google.maps.Map(document.getElementById('map-canvas'),{
    center:{
      lat: 24.489139437501642,
          lng: 77.33692343749999
    },
    zoom:5
  });
  var marker = new google.maps.Marker({
    position: {
      lat: 24.489139437501642,
          lng: 77.33692343749999
    },
    map: map,
    draggable: true
  });
  var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));
  google.maps.event.addListener(searchBox,'places_changed',function(){
    var places = searchBox.getPlaces();
    var bounds = new google.maps.LatLngBounds();
    var i, place;
    for(i=0; place=places[i];i++){
        bounds.extend(place.geometry.location);
        marker.setPosition(place.geometry.location); //set marker position new...
      }
      map.fitBounds(bounds);
      map.setZoom(15);
  });
  google.maps.event.addListener(marker,'position_changed',function(){
    var lat = marker.getPosition().lat();
    var lng = marker.getPosition().lng();
    $('#lat').val(lat);
    $('#lng').val(lng);
  });
</script> -->
@stop