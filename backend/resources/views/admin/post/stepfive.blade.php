<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icropper.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{$listing->category->name}} | Address Guru</title>

    <meta name="robots" content="noindex">
<style type="text/css">
  .croppie-container .cr-slider-wrap
  {
    margin-left:78%;
  }
</style>
@extends('layouts.app')

 

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
                    <a href="{{url('step-two', $id)}}">
                    <li class="rms-step rms-current-step active1">
                        
                        <span class="step-title">Social Details</span>
                        <span class="step-info">Add links of your social profiles</span>
                    </li>
                  </a>
                  <a href="{{url('step-three', $id)}}">
                    <li class="rms-step rms-current-step active1">
                        
                        <span class="step-title">Business Contact Details</span>
                       <span class="step-info">Add your contact details for buyers to connect</span>
                    </li>
                  </a>
                  <!--<a href="{{url('step-four', $id)}}">-->
                  <!--  <li class="rms-step rms-current-step active1">-->
                       
                  <!--      <span class="step-title">Search Engine Friendly</span>-->
                  <!--      <span class="step-info">Update SEO friendly keywords and description</span>-->
                  <!--  </li>-->
                  <!--</a>-->
                    <li class="rms-step rms-current-step active">
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
    <div class="row">  
        <div class="col-md-9">
         @if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div>
    
@endif
@if(Session::has('no'))
    <div class="alert alert-danger">
        <strong> {{session('no')}}</strong>
    </div>
    
@endif
@if(count($photo) != 0)
<div class="row">
  <h4>Uploaded Images</h4>
  <?php $i = 1; ?>
  @foreach($photo as $photos)
  <div class="col-md-2">
    <div class="thumbnail">
      <img src="{{url('/')}}/images/{{$photos->name}}" class="img-responsive" alt="{{$listing->business_name}}">
      <a href="{{route('post.show', $photos->id)}}" onclick="return confirm('Are you sure?`');" class="close_button"><i class="fa fa-close"></i></a>
    </div>
  </div>
  <?php $i++; ?>
  @endforeach
</div><br/><br/>
@endif
          {!! Form::model($listing, ['action'=>['CoachingInsert@update', $id], 'method'=>'PATCH', 'files'=>true]) !!}
         
          Note* Image size must be: width - 750 pixel and height - 400 pixel
          <div class="row">
  <div class="col-md-12">
    
    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label>Choose Image</label>
            <input type="file" name="image" id="upload">
            @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>
        <input type="hidden" name="khatam_karo" value="0">
        <div id="upload-section">
          <div class="form-group">
            <div id="upload-demo" style="width:350px;margin-left:2px;"></div>
          </div>
          <div class="form-group">
            <center><a class="btn btn-primary btn-sm upload-result"><i class="fa fa-upload"></i> Upload</a></center>
          </div>
    
        </div>
        <div id="result"></div>
        
  </div>
</div>

          <div id="stop">
            
                        <div class="row">
                <div class="col-md-12"><br/><br/>
                  <div id="rms-wizard" class="rms-wizard">
                  <div class="rms-container">
                  <div class="rms-form-wizard">
                  <div class="rms-footer-section">
                <div class="button-section">
                    <span class="next">
                      <button class="btn">Finish
                            <small>Make Payment</small>
                      </button>
                    </span>
                    <span class="prev">
                        <a href="{{url('step-four', $id)}}" class="btn">Previous Step
                             <small>Make It Search Engine Friendly</small>
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
              <li><strong>Upload Slider Images</strong>:These images will be seen by the visitor of your listing page. Add images related to your business, products or services dealing in.
                <br/><br/>
              Image size should be - 750px width & 400px height  </li>
            </ul>
          </div>
        </div>
    </div>
</div>

@stop
@section('footer')
<script src="{{ asset('js/corp.js') }}"></script>
<script src="{{ asset('js/cp.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 750,
        height: 400,
        type: 'square'
    },
    boundary: {
        width: 760,
        height: 410
    }
});
$('#upload').on('change', function () { 
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function(){
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
    document.getElementById('apbut').style.display = 'block';
});
$('.upload-result').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
        $.ajax({
            url: "{{url('/post-media')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "image":resp,"id":<?php echo $listing->id; ?>
            },
            beforeSend: function()
            {
                $('#upload-section').hide();
                $("#result").html('<center><img src="{{url("/")}}/images/uploading-gif-11.gif" width="400px"><br/><p>Uploading please wait..</p></center>');
            },
            success: function (data) {
              
              window.location.href = "{{url('/')}}/step-five/{{$id}}";
            },
            complete: function()
            {
                $("#result").hide();
                $("#upload-section").show();
            }
        });
    });
});
</script>
@stop