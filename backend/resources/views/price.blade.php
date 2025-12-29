<!DOCTYPE html>
<html lang="en">
<head>
@extends('layouts.app')
 	<title>Pricing Table | Address Guru</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="{{url('/')}}/Pricing-Table">
    <style type="text/css">
      .tickblue
      {
        font-size:16px;
      }
    </style>
@section('content')
<div class="container" style="background-color:#fff;">
<div class="comparison">

  <table class="table-striped">
    <thead>
      
      <tr>
        <th class="tl">
        	
        </th>
        <!-- <th class="compare-heading">
          <i class="fa fa-gears"></i> Basic
        </th> -->
        <th class="compare-heading">
         	<i class="fa fa-flash"></i> Basic
        </th>
        <th class="compare-heading">
          <i class="fa fa-diamond"></i> Professional
        </th>
      </tr>
      <tr>
        <th class="new-heading">
        	<i class="fa fa-rupee"></i> Pricing Table
        </th>
       <!--  <th class="price-info">
          <br/>
          <div class="price-now"><span>₹499<span class="price-small">.00</span> </span> /yearly</div>
         <div><a href="#" class="price-buy">Buy <span class="hide-mobile">Now</span></a></div> 
          <br/>
        </th> -->
        <th class="price-info">
          <br/>
          <div class="price-now"><span>$9<span class="price-small">.00</span></span> /monthly</div>
          <!-- <div><a href="#" class="price-buy">Buy <span class="hide-mobile">Now</span></a></div> -->
           <br/>
        </th>
        <th class="price-info">
          <br/>
          <div class="price-now"><span>$49<span class="price-small">.00</span></span> /lifetime</div>
          <!-- <div><a href="#" class="price-buy">Buy <span class="hide-mobile">Now</span></a></div> -->
           <br/>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td></td>
        <td colspan="2">Google My Business</td>
      </tr>
      <tr class="compare-row">
        <td>Google My Business</td>
       
        <td><span class="tickblue">Yes</span></td>
        <td><span class="tickblue">Yes</span></td>
       
      </tr>
      <!-- <tr>
        <td>&nbsp;</td>
        <td colspan="2">SMS Leads</td>
      </tr>
      <tr>
        <td>SMS Leads</td>
        
        <td><span class="tickblue">3000</span></td>
        <td><span class="tickblue">Unlimited</span></td>
      
      </tr> -->
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Video</td>
      </tr>
      <tr class="compare-row">
        <td>Video</td>
        <td><span class="tickblue">1 minute</span></td>
        <td><span class="tickblue">5 minute</span></td>
        
     
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Promotional Banner</td>
      </tr>
      <tr>
        <td>Promotional Banner</td>
        <td><span class="tickblue">2 to 4</span></td>
        <td><span class="tickblue">4 to 8</span></td>
        
       
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Email Leads</td>
      </tr>
      <tr class="compare-row">
        <td>Email Leads</td>
        <td><span class="tickblue">5000</span></td>
        <td><span class="tickblue">Unlimited</span></td>
       
      
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Fb Page Optimization</td>
      </tr>
      <tr>
        <td>Fb Page Optimization</td>
        <td><span class="tickblue">Yes</span></td>
        <td><span class="tickblue">Yes</span></td>
       
       
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Fb Page Reach</td>
      </tr>
      <tr class="compare-row">
        <td>Fb Page Reach</td>
        <td><span class="tickblue">2000</span></td>
        <td><span class="tickblue">5000</span></td>
       
       
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Fb Page Promotion</td>
      </tr>
      <tr>
        <td>Fb Page Promotion</td>
        <td><span class="tickblue">Yes</span></td>
        <td><span class="tickblue">Yes</span></td>
       
       
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Photoshoot</td>
      </tr>
      <tr class="compare-row">
        <td>Photoshoot</td>
       <td><span class="tickblue">Yes</span></td>
        <td><span class="tickblue">Yes</span></td>
       
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Website Audit</td>
      </tr>
      <tr>
        <td>Website Audit</td>
        <td><span class="tickblue">Only home page</span></td>
        <td><span class="tickblue">Complete</span></td>
       
        
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">Premium Listing</td>
      </tr>
      <tr class="compare-row">
        <td>Premium Listing</td>
        <td><span class="tickblue">1 Year top category</span></td>
        <td><span class="tickblue">5 Year top category</span></td>
       
       
      </tr>
    </tbody>
  </table>

</div>

</div>


@stop