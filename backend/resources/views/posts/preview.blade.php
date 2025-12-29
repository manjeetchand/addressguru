<!DOCTYPE html>
<html lang="en">
<head>
   
@extends('layouts.app')
<title>{{$post->business_name}} | Address Guru</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<style type="text/css">h3{font-family:raleway!important;}.carousel-inner img{height:400px!important;}</style>
@section('content')

@foreach($personal as $per)
@if($per->ph_number == '00')

@else

<div class="phone visible-xs">
   
  <a href="tel:{{$per->ph_number}}">
  
  <div class="phone-ticker">
    <i class="fa fa-phone"></i>
  </div>
  </a>
</div>
@endif
@endforeach<br/>
@if(Auth::user()->role->name == 'Admin')
<center>
<div class="edit">
    <a href="{{route('admin-listing.edit', $post->id)}}"><i class="fa fa-edit"></i></a><br/><br/>
    @if($post->status == 0)
      {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminQuery@update', $post->id]]) !!}
        <input type="hidden" name="status" value="1">
        <input type="hidden" name="is_active" value="1">
        <button style="border:none;background:transparent;" title="Approve"><i class="fa fa-check-circle fa-fw" style="font-size:30px;color:#337AB7;"></i></button>
      {!! Form::close() !!}
    @else
      {!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminQuery@update', $post->id]]) !!}
        <input type="hidden" name="status" value="0">
        <button style="border:none;background:transparent;" title="Un-Approve"><i class="fa fa-ban fa-fw" style="font-size:30px;color:#337AB7;"></i></button>
      {!! Form::close() !!}
    @endif
</div>
</center>
<a href="{{url('admin-listing', $post->user_id)}}">
<div class="user">
  <i class="fa fa-user fa-fw"></i> {{$post->user->name}} (<small>{{$post->user->role->name}}</small>)
</div>
</a>
@endif
<div class="container top-box-show">
<div class="row">
    <div class="col-md-12 heading-div">
      <h2 style="margin-top:10px;"><b>{{$post->business_name}}</b></h2>
      <p class="address">{{$post->business_address}}</p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 no-need-left">
     <div style="background-color:white;box-shadow:0px 0px 6px #ccc;padding:15px;">
      <div style="background-color:#eee;">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">

    <?php $i = 0; ?>
         @foreach($post->media as $photos)
         @if($i == 0)
         <li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>
         @else
         <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
         @endif
           <?php $i++; ?>
        @endforeach

  </ol>

  <!-- Wrapper for slides -->
  <center>
  <div class="carousel-inner">
        @if(count($post->media) == 0)
        <div class="item active">
          <img src="{{url('/')}}/images/add.png" alt="Address Guru" class="img-responsive">
          </div>
        @else
         <?php $i = 0; ?>
         @foreach($post->media as $photos)
         @if($i == 0)
         <div class="item active">
         @else
         <div class="item">
         @endif
            <img src="{{url('/')}}/images/{{$photos->name}}" alt="{{$post->business_name}}">
           </div>
           <?php $i++; ?>
        @endforeach

        @endif
    
  </div>
  </center>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
      </div>

     


  <div class="row">
    <div class="col-md-12" style="overflow:auto;">
      <h3><b>About Us</b></h3><hr style="margin:5px;">
        <p style="font-size:15px;text-align:justify;">
          {{$post->ad_description}}
        </p>
    </div>
  </div>
  @if($post->ifsc == "")

  @else
  <div class="row">
     <div class="col-md-12">
            <h4><b>IFSC Code</b></h4><hr style="margin:5px;">
            <p style="font-size:15px;">
               {{$post->ifsc}}
            </p>
          </div> 
  </div>
  @endif
  @if($post->r_type == "")


  @else

    @if($post->category_id == 9)
    <div class="row">
      <div class="col-md-12">
           <h4><b>Room Type</b></h4><hr style="margin:5px;">
           <p style="font-size:15px;">
               {{$post->r_type}}
            </p>
      </div>
    </div>
    @endif
  @endif

      @if($post->floor == "")


      @else
      <br/>
      <div class="row">
          <div class="col-md-4">
            <h4><b>Room Type</b></h4><hr style="margin:5px;">
            <p style="font-size:15px;">
               {{$post->r_type}}
            </p>
          </div> 
          <div class="col-md-4">
            <h4><b>Floor</b></h4><hr style="margin:5px;">
            <p style="font-size:15px;">
               {{$post->floor}}
            </p>
          </div> 
          <div class="col-md-4">
            <h4><b>Area</b></h4><hr style="margin:5px;">
            <p style="font-size:15px;">
               {{$post->area}}
            </p>
          </div>        
      </div><br/>
      <div class="row">
          <div class="col-md-4">
            <h4><b>Furnished</b></h4><hr style="margin:5px;">
            <p style="font-size:15px;">
               {{$post->furnished}}
            </p>
          </div> 
          <div class="col-md-4">
            <h4><b>Bathroom</b></h4><hr style="margin:5px;">
            <p style="font-size:15px;">
               {{$post->bathroom}}
            </p>
          </div> 
          <div class="col-md-4">
            <h4><b>Religion Belief</b></h4><hr style="margin:5px;">
            <p style="font-size:15px;">
               {{$post->religion_view}}
            </p>
          </div>        
      </div>
      @endif
      <div class="row">
        <div class="col-md-12">
      @if($post['service'] == '[""]' OR $post['service'] == '[null]')


      @else
      <br/>
      <div class="li">
      <h3><b>Services</b></h3><hr style="margin:5px;margin-bottom:12px;">
      <p style="font-size:13px;"> {{$post->business_name}} provides below services:</p>
      <ul>

       <?php

          $services=json_decode($post->service);?>
              @foreach ($services as $key => $service) 
              
                          
                 <li><i class='fa fa-check'></i> {{$service}}</li>
            
              @endforeach

        
      </ul>
        </div>
        @endif
      </div>
    </div>
    <div class="row">
    <div class="col-md-12">
      @if($post['facility'] == '[""]' OR $post['facility'] == '[null]')


      @else
      <br/>
      <div class="li">
      <h3><b>Facilities</b></h3><hr style="margin:5px;margin-bottom:12px;">
      <p style="font-size:13px;"> {{$post->business_name}} provides below facilities:</p>
      <ul>

       <?php

          $fac=json_decode($post->facility);?>
              @foreach ($fac as $keysss => $facs) 
              
                          
                  <li><i class='fa fa-check'></i> {{$facs}}</li>
            
              @endforeach

     
      </ul>
        </div>
        @endif
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
      @if($post->category->id == 31 OR $post->category->id == 32 OR $post->category->id == 34 OR $post->category->id == 39 OR $post->category->id == 45)
     <?php $i = 1; $v = 1; ?>
      @foreach($pack as $packs)
      
        <div class="col-md-6">
          <h3>Package {{$i}}</h3>
            <div style="box-shadow:0px 0px 10px #ccc;padding:10px;margin-bottom:20px;">
                <h4 style="min-height:40px;color:#337AB7;">{{$packs->name}}</h4>
                <p>{{substr($packs->about, 0, 200)}}... </p>
                <div class="row">
            <div class="col-md-6">
              <b>Price:</b> S$ {{$packs->price}}
            </div>
            <div class="col-md-6 text-right">
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#view{{$v}}" style="padding:2px 10px 2px 10px;">View Details</a>
            </div>
          </div>
            </div>
        </div>
         <!-- Modal -->
        <div class="modal fade" id="view{{$v}}" role="dialog">
          <div class="modal-dialog">
    
          <!-- Modal content-->
          <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{$packs->name}}</h4>
            </div>
          <div class="modal-body">
            <p>{{$packs->about}}</p><br/>
            <div class="row">
                <div class="col-md-6">
                    <b>Price</b>: {{$packs->price}}
                </div>
                <div class="col-md-6 text-right">
                    <b>Tour dates</b>: {{$packs->dates}}
                </div>
            </div>
          </div>
          <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
        </div>
      
        </div>
      </div>
        <?php $i++; $v++; ?>
        @endforeach
      @endif
      </div>
    </div>
      <div class="row">
    <div class="col-md-12">
      @if($post['course'] == '[""]' OR $post['course'] == '[null]')


      @else
      <br/><br/>
      <div class="li">
      <h3><b>Courses</b></h3><hr style="margin:5px;margin-bottom:12px;">
      <p style="font-size:13px;"> {{$post->business_name}} provides below courses:</p>
      <ul>

       <?php

          $course=json_decode($post->course);?>
              @foreach ($course as $keyss => $courses) 
              
                          
                  <li><i class='fa fa-check'></i> {{$courses}}</li>
            
              @endforeach

       
      </ul>
        </div>
        @endif
     </div>
   </div>
   <div class="row">
    <div class="col-md-12">
      @if($post['payment'] == '[""]' OR $post['payment'] == '[null]')


      @else
       <br/>
      <h3><b>Payment Mode</b></h3><hr style="margin:5px;margin-bottom:12px;">
      <p style="font-size:13px;"> {{$post->business_name}} acceptable payment modes:</p>
        <ul>
          <?php

          $pay=json_decode($post->payment);?>
              @foreach ($pay as $keysssss => $pays) 
              
                          
               <li>{{$pays}}</li>
            
              @endforeach

        
        </ul>
        @endif
      </div>
    </div><br/>
    <div class="row">
       @foreach($personal as $per)
        <div class="col-md-6">
           <h3><b>State</b></h3><hr style="margin:5px;">
            <p style="font-size:15px;padding-left:20px;">
               {{$per->state}}
            </p>
        </div>
        <div class="col-md-6">
            <h3><b>City</b></h3><hr style="margin:5px;">
            <p style="font-size:15px;padding-left:20px;">
               {{$per->city}}
            </p>
        </div>
        @endforeach
    </div>
      <br/>
      @if($post->map == 'no' OR $post->map == null)

      @else
<div class="row">
    <div class="col-md-12 map" style="margin-bottom:-11px;">
      <h3><b>Map</b></h3><hr style="margin:5px;">
      <?php 
        $map = $post->map;

        if (strpos($map, 'https://www.google.com/maps/embed') == false) 
        {
            echo " <div class='alert alert-danger'>
                <strong> It seems your link is not working! </strong>
          </div>";
        }
        else
        {
            echo $map;   
        }
      ?>
        
        
      </div>
    </div>
    @endif
        </div>
        <div style="background-color:white;box-shadow:0px 0px 6px #ccc;padding:15px;margin-top:10px;">
      <h4 style="margin-top:0px;">Overview - {{$post->business_name}}</h4><hr style="margin:8px;">
      <span>{{$post->business_name}} at {{$post->business_address}} is a {{$post->category->name}} in 
       @foreach($personal as $per)
        {{$per->city}}
      @endforeach. @if($post->course == '[""]' OR $post->course == '[null]') @else There courses are :-  @foreach ($course as $keyss => $courses) {{$courses}} @endforeach. @endif @if($post->facility == '[""]' OR $post->facility == '[null]') @else There facilities are :- @foreach ($fac as $keysss => $facs) {{$facs}} @endforeach @endif @if($post->service == '[""]' OR $post->service == '[null]') @else There services are :- @foreach ($services as $key => $service) {{$service}} @endforeach. @endif @if($post->payment == '[""]' OR $post->payment == '[null]') @else , their acceptable payment mode is @foreach ($pay as $keysssss => $pays) {{$pays}} @endforeach @endif</span><br/><br/>
      <span>Scroll to the top for more details of {{$post->business_name}}</span>
      <br/><br/>
      <span>Don't forget to tell, you found {{$post->business_name}} on <b>Address Guru</b></span>
  </div>
      </div>
      <div class="col-md-4 no-need-right yo">

      <div style="background-color:white;box-shadow:0px 0px 6px #ccc;padding:15px;">
      <div style="background-color:#eee;padding:20px;font-size:16px;">
        @foreach($personal as $per)
        @if($per->ph_number == '00')

        @else
        <i class="fa fa-phone fa-fw yoi"></i><a href="tel:{{$per->ph_number}}" style="font-size:16px!important;"> {{$per->ph_number}}</a><br/>
        @endif
        <i class="fa fa-envelope fa-fw yoi"></i> <a href="mailto:{{$per->email}}">{{$per->email}}</a><br/>
        @if($post->web_link == 'no')


        @else
        <i class="fa fa-globe fa-fw yoi"></i> <a href="{{$post->web_link}}" rel="nofollow" target="_blank" style="font-size:16px!important;">Visit Website</a><br/>

        @endif
        <i class="fa fa-tags fa-fw yoi"></i> {{$post->category->name}} <br/><br/>
          @if($post->h_star == "")

        
        @else

          <i class="fa fa-tag fa-fw yoi"></i> {{$post->h_star}}<br/>

        @endif

        @if($post->only_for == "")

        
        @else

          <i class="fa fa-tag fa-fw yoi"></i> {{$post->only_for}}<br/><br/>

        @endif

        @if($post['rent'] == "")

        @else
          @if($post->category->id != 19)
              Price: S$ <b>{{$post->rent}}</b><br/><br/>
           @else
            
           Salary: S$ <b>{{$post->rent}}</b><br/><br/>
           
           @endif
        @endif
        
         @foreach($views as $view)
          <div class="views">
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary butn1">
                  <i class="fa fa-eye"></i> Views
                </button>
                <button type="button" class="btn btn-warning butn2">
                  {{$view->views}}
                </button>
              </div>
          </div>
          

        @endforeach
       @if($post->category->id == 19)

        <br/>  Posted Date:{{date('d F, Y', strtotime($post->created_at))}}

        @endif
      
      </div>
       @endforeach
      <div>
       @if($post->video == 'no' OR $post->video == null)


        @else
            <h3><b>Video</b></h3><hr style="margin:5px;">
            <iframe width="100%" height="250" src="https://www.youtube.com/embed/{{$post->video}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        @endif
      </div>

        @if(Auth::user()->role->name == 'Admin')
          <center><a href="{{url('/admin', $post->id)}}" class="btn btn-danger" style="margin-top:8px;">Transfer Ownership</a> </center>
      @endif
          
          <div>
          
        
        </div>
        </div>
        
    </div>
  </div>
 
          
     
</div>
@stop
