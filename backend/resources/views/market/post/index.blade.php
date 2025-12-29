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
<title>{{$category->name}} | Address Guru</title>

    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">
    <meta name="robots" content="noindex">

@section('content')
<div class="container-fluid header_post">
  <div class="row">
    <div class="col-md-12 text-center ad" style="color:white;">
      <h2><b>
            <i class="{{$category->mcategory->icon}}"></i> {{$category->name}}
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
                        <span class="step-title">Ad Information</span>
                        <span class="step-info">Update your Ad details and info</span>
                    </li> 
                    <li class="rms-step">
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
    <div class="row form-new">  
        <div class="col-md-9">

          {!! Form::open(['action'=>'CoachingInsert@mstore']) !!}

          <input type="hidden" name="subcategory_id" value="{{$category->id}}" class="form-control">
          <?php
          switch ($category->id) 
          {
              case 1:
              ?>  @include('market.form.form1')<?php
              break;

              case 2:
              ?>  @include('market.form.form2')<?php
              break;

              case 3:
              ?>  @include('market.form.common')<?php
              break;

               case 4:
              ?>  @include('market.form.form4')<?php
              break;

              case 5:
              ?>  @include('market.form.common')<?php
              break;

              case 6:
              ?>  @include('market.form.common')<?php
              break;

              case 7:
              ?>  @include('market.form.form7')<?php
              break;

              case 8:
              ?>  @include('market.form.form8')<?php
              break;

              case 9:
              ?>  @include('market.form.common')<?php
              break;

              case 10:
              ?>  @include('market.form.form10')<?php
              break;

              case 11:
              ?>  @include('market.form.common')<?php
              break;

              case 12:
              ?>  @include('market.form.form12')<?php
              break;

              case 13:
              ?>  @include('market.form.common')<?php
              break;

              case 14:
              ?>  @include('market.form.form14')<?php
              break;

              case 15:
              ?>  @include('market.form.form15')<?php
              break;

              case 16:
              ?>  @include('market.form.form16')<?php
              break;

              case 17:
              ?>  @include('market.form.form17')<?php
              break;

              case 18:
              ?>  @include('market.form.form18')<?php
              break;

              case 19:
              ?>  @include('market.form.form19')<?php
              break;

              case 20:
              ?>  @include('market.form.common20')<?php
              break;

              case 21:
              ?>  @include('market.form.common20')<?php
              break;

              case 22:
              ?>  @include('market.form.common20')<?php
              break;

              case 23:
              ?>  @include('market.form.common20')<?php
              break;

              case 24:
              ?>  @include('market.form.form24')<?php
              break;

              case 25:
              ?>  @include('market.form.form25')<?php
              break;

              case 26:
              ?>  @include('market.form.form26')<?php
              break;

              case 27:
              ?>  @include('market.form.form27')<?php
              break;

              case 28:
              ?>  @include('market.form.form28')<?php
              break;

              case 29:
              ?>  @include('market.form.common20')<?php
              break;

              case 30:
              ?>  @include('market.form.form30')<?php
              break;

              case 31:
              ?>  @include('market.form.form31')<?php
              break;

              case 32:
              ?>  @include('market.form.common20')<?php
              break;

              case 33:
              ?>  @include('market.form.form33')<?php
              break;

              case 34:
              ?>  @include('market.form.form33')<?php
              break;

              case 35:
              ?>  @include('market.form.form33')<?php
              break;

              case 36:
              ?>  @include('market.form.form33')<?php
              break;

              case 37:
              ?>  @include('market.form.form33')<?php
              break;

              case 38:
              ?>  @include('market.form.form33')<?php
              break;

              case 39:
              ?>  @include('market.form.form33')<?php
              break;

              case 40:
              ?>  @include('market.form.common')<?php
              break;

              case 41:
              ?>  @include('market.form.common')<?php
              break;

              case 42:
              ?>  @include('market.form.form33')<?php
              break;

              case 43:
              ?>  @include('market.form.form33')<?php
              break;

              case 44:
              ?>  @include('market.form.form33')<?php
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
                <div class="col-md-12">
                  <div id="rms-wizard" class="rms-wizard">
                  <div class="rms-container">
                  <div class="rms-form-wizard">
                  <div class="rms-footer-section">
                <div class="button-section">
                    <span class="next">
                      <button class="btn">Next Step
                            <small>Add Photos</small>
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
@stop