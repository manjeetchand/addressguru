<!DOCTYPE html>


<html lang="en">


<head>


   


@extends('layouts.app')


<title>{{$post->title}} | Address Guru</title>


    <meta name="description" content="">


    <meta name="keywords" content="">





    <link rel="canonical" href="{{url('marketplace', $post->slug)}}">


    <meta property="og:type" content="website" />


    <meta property="og:title" content="{{$post->title}}" />


    <meta property="og:description" content="{{$post->description}}" />


    <meta property="og:url" content="{{url('marketplace', $post->slug)}}" />


    <meta property="og:site_name" content="Address Guru" />


    <meta property="og:image" content="{{url('/')}}/images/{{isset($post->medias[0]) ? $post->medias[0]->name : ''}}" />


    <meta property="og:locale" content="en_US" />


    <meta name="twitter:text:title" content="{{$post->title}}" />


    <meta name="twitter:image" content="{{url('/')}}/images/{{isset($post->medias[0]) ? $post->medias[0]->name : ''}}" />


    <meta name="twitter:card" content="{{$post->title}}" />


    <style type="text/css">h3{font-family:raleway!important;}.carousel-inner img{height:400px!important;}</style>


<script type="application/ld+json">


{


    "@context": "http://schema.org",


    "@type": "WebSite",


    "name": "AddressGuru",


    "url": "https://www.addressguru.in"


}


</script>


<script type="application/ld+json">


        {


          "@context": "http://schema.org",


          "@type": "Organization",


          "url": "https://www.addressguru.in",


          "logo": "https://www.addressguru.in/images/logopng.png",


            "sameAs" : [ "https://www.facebook.com/addressguru.in/",


            "https://www.youtube.com/channel/UC8WEXsO-s9N-ncxX4AVUH4Q",


            "https://twitter.com/AddressGuru",


            "https://www.instagram.com/addressguru/"]       


        }


</script>





@section('content')








@if(Auth::guest())








@elseif(Auth::user()->role->name == 'Admin')





<a href="{{url('admin-listing', $post->user_id)}}">


<div class="user">


  <i class="fa fa-user fa-fw"></i> {{$post->user->name}} (<small>{{$post->user->role->name}}</small>)


</div>


</a>


@endif


<div class="container">


  <div class="row">


    <div class="col-md-12">


      @include('include.error')


        @if(Session::has('created'))





          <div class="alert alert-success" style="margin-top:40px;">


            <strong> {{session('created')}}</strong>


          </div>


          <style type="text/css">#my{display:none!important;}.modal-backdrop{display:none!important;}</style>


        @endif


        @if(Session::has('danger'))





          <div class="alert alert-danger" style="margin-top:40px;">


            <strong> {{session('danger')}}</strong>


          </div>


          <style type="text/css">#my{display:none!important;}.modal-backdrop{display:none!important;}</style>


        @endif


    </div>


  </div>


</div>


<div class="container top-box-show">


  <div class="row">


    <div class="col-md-12 heading-div">


      <h2 style="margin-top:10px;"><b>{{$post->title}}</b></h2>


      <address class="address">{{$post->locality}} / {{$post->city}} / {{$post->state}}</address>


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


         @foreach($post->medias as $photos)


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


        @if(count($post->medias) == 0)


        <div class="item active">


          <img src="{{url('/')}}/images/add.png" alt="Address Guru" class="img-responsive">


          </div>


        @else


         <?php $i = 0; ?>


         @foreach($post->medias->take(1) as $photos)


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


    <div class="col-md-12 text-right ticker">


      <span>Posted Date: {{date('d F, Y', strtotime($post->created_at))}} @if($post->pro_by != null) | Posted By <b>{{$post->pro_by}}</b> @endif</span>


    </div>


    <div class="col-md-12" style="overflow:auto;">


      <h3>Ad Description</h3><hr>


        <p style="font-size:15px;text-align:justify;">


          {{$post->description}}


        </p>


    </div>


  </div>








@if($post->subcategory_id == 27)





    <div class="row">


      <div class="col-md-6">


        <h4>Marker: <span>{{$post->only_for}}</span></h4>


      </div>


      <div class="col-md-6">


        <h4>Model: <span>{{$post->model}}</span></h4>


      </div>


      <div class="col-md-6">


        <h4>Body Type: <span>{{$post->job_type}}</span></h4>


      </div>


      


      <div class="col-md-6">


        <h4>Fuel Type: <span>{{$post->fuel_type}}</span></h4>


      </div>


      <div class="col-md-6">


        <h4>Year: <span>{{$post->year}}</span></h4>


      </div>


      <div class="col-md-6">


        <h4>Kilometers: <span>{{$post->km}}</span></h4>


      </div>


      <div class="col-md-6">


        <h4>Transmission: <span>{{$post->trans}}</span></h4>


      </div>


      <div class="col-md-6">


        <h4>Colour: <span>{{$post->color}}</span></h4>


      </div>


      <div class="col-md-6">


        <h4>Engine Displacement (cc): <span>{{$post->cc}}</span></h4>


      </div>


    </div>


    @elseif($post->subcategory_id == 28)


    <div class="row">


        <div class="col-md-6">


          <h4>Year: <span>{{$post->year}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Kilometers: <span>{{$post->km}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Transmission: <span>{{$post->trans}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Colour: <span>{{$post->color}}</span></h4>


        </div>


        


    </div>





    @elseif($post->subcategory_id == 31)





    <div class="row">


        <div class="col-md-6">


          <h4>Engine Displacement (cc): <span>{{$post->cc}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Year: <span>{{$post->year}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Kilometers: <span>{{$post->km}}</span></h4>


        </div>


    </div>


    @elseif($post->subcategory_id == 30)


    <div class="row">


        <div class="col-md-6">


          <h4>Engine Displacement (cc): <span>{{$post->cc}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Year: <span>{{$post->year}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Kilometers: <span>{{$post->km}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Transmission: <span>{{$post->trans}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Colour: <span>{{$post->color}}</span></h4>


        </div>


    </div>


      @elseif($post->subcategory_id == 25 OR $post->subcategory_id == 24)





      <div class="row">


        <div class="col-md-6">


          <h4>Job Category: <span>{{$post->only_for}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Job Type: <span>{{$post->job_type}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Education Level: <span>{{$post->edu_level}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Company Name: <span>{{$post->company_name}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>EA License Number: <span>{{$post->ea_number}}</span></h4>


        </div>


    </div>


    @elseif($post->subcategory_id == 26)


    <div class="row">


       <div class="col-md-6">


          <h4>Education Level: <span>{{$post->edu_level}}</span></h4>


        </div>


    </div>


    @elseif($post->subcategory_id == 16)





    <div class="row">


        <div class="col-md-6">


          <h4>Rent By: <span>{{$post->only_for}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Available: <span>{{$post->available}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Size (sqft): <span>{{$post->size}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>CEA Number: <span>{{$post->cea}}</span></h4>


        </div>





        </div>








    @elseif($post->subcategory_id == 18)





    <div class="row">


        <div class="col-md-6">


          <h4>Rent By: <span>{{$post->only_for}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Available: <span>{{$post->available}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Size (sqft): <span>{{$post->size}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>CEA Number: <span>{{$post->cea}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Parking: <span>{{$post->parking}}</span></h4>


        </div>


        </div>





    @elseif($post->subcategory_id == 19)





    <div class="row">


        


        <div class="col-md-6">


          <h4>Available: <span>{{$post->available}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Size (sqft): <span>{{$post->size}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>CEA Number: <span>{{$post->cea}}</span></h4>


        </div>


      </div>





      @elseif($post->subcategory_id == 15 OR $post->subcategory_id == 17 OR $post->subcategory_id == 14)





    <div class="row">


        <div class="col-md-6">


          <h4>Rent By: <span>{{$post->pro_by}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Bedrooms: <span>{{$post->bedroom}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Bathrooms: <span>{{$post->bathroom}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Dwelling Type: <span>{{$post->dwelling}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Available: <span>{{$post->available}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Size (sqft): <span>{{$post->size}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>CEA Number: <span>{{$post->cea}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Parking: <span>{{$post->parking}}</span></h4>


        </div>


        @if($post->smoking != null)


        <div class="col-md-6">


          <h4>Smoking: <span>{{$post->smoking}}</span></h4>


        </div>


        @endif


        @if($post->pet != null)


        <div class="col-md-6">


          <h4>Pet Friendly: <span>{{$post->pet}}</span></h4>


        </div>


        @endif


        @if($post->share != null)


        <div class="col-md-6">


          <h4>Share Basis: <span>{{$post->share}}</span></h4>


        </div>


        @endif


        @if($post->gender != null)


        <div class="col-md-6">


          <h4>Preferred Gender: <span>{{$post->gender}}</span></h4>


        </div>


        @endif


      </div>





      @elseif($post->subcategory_id == 33 OR $post->subcategory_id == 34 OR $post->subcategory_id == 35 OR $post->subcategory_id == 36 OR $post->subcategory_id == 37 OR $post->subcategory_id == 38 OR $post->subcategory_id == 39 OR $post->subcategory_id == 44 OR $post->subcategory_id == 42 OR $post->subcategory_id == 43)





      <div class="row">


        <div class="col-md-6">


          <h4>Available: <span>{{$post->available}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Date of Birth: <span>{{$post->dob}}</span></h4>


        </div>


        <div class="col-md-6">


          <h4>Offered By: <span>{{$post->only_for}}</span></h4>


        </div>


      </div>








    @else





    <div class="row">


      @if($post->condition != null)


        <div class="col-md-6">


          <h4>Condition: <span>{{$post->condition}}</span></h4>


        </div>


         @endif


        @if($post->only_for != null)


        <div class="col-md-6">


          <h4>Type: <span>{{$post->only_for}}</span></h4>


        </div>





        @endif


        @if($post->model != null)


        <div class="col-md-6">


          <h4>Model: <span>{{$post->model}}</span></h4>


        </div>


        @endif


    </div>





  @endif





    <div class="row">


        <div class="col-md-6">


           <h3>State</h3><hr>


            <p>


               {{$post->state}}


            </p>


        </div>


        <div class="col-md-6">


            <h3>City</h3><hr>


            <p>


               {{$post->city}}


            </p>


        </div>


    </div> 


        


 


  


  </div>





        </div>





    <div class="col-md-4 no-need-right yo">





      <div style="background-color:white;box-shadow:0px 0px 6px #ccc;padding:15px;margin-bottom:15px;">


      <div style="background-color:#eee;padding:20px;font-size:16px;">


        <i class="fa fa-phone fa-fw yoi"></i><a href="javascript:viod(0)" id="view_number" onclick="get_num()" style="font-size:16px!important;"> View Number</a><br/>


        <i class="fa fa-tags fa-fw yoi"></i> {{$post->mcategory->name}}<br/>


        <i class="fa fa-tag fa-fw yoi"></i> {{$post->msubcategory->name}}<br/><br/>


        


        <b style="font-size:20px;">


        @if($post->mcategory->id == 5)


          <i class="fa fa-dollar fa-fw yoi"></i> {{number_format($post->amount)}}


        @else


          @if($post->price == "Amount")


          <i class="fa fa-dollar fa-fw yoi"></i> {{number_format($post->amount)}}


          @else


          <i class="fa fa-info fa-fw yoi"></i> {{$post->price}}


          @endif


        @endif


        </b><br/>


         


          @if(strpos($_SERVER['REQUEST_URI'], "marketplace-preview") !== false)





        @else


        <br/>


        <div class="icon">


          <b>Share on:<b>


        <center>


                  <a href="whatsapp://send?text={{url('marketplace')}}/{{preg_replace('/[\s_]/', '-', $post->state)}}/{{preg_replace("/[\s_]/", "-", $post->mcategory->name)}}/{{preg_replace("/[\s_]/", "-", $post->msubcategory->name)}}/{{$post->slug}}" target="_blank" class="a">


                       <img src="{{url('/')}}/images/whatsapp.png" class="img-circle" width="34px">


                   </a>


                  <a onclick='window.open("https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&u={{ url('marketplace')}}/{{preg_replace('/[\s_]/', '-', $post->state)}}/{{preg_replace("/[\s_]/", "-", $post->mcategory->name)}}/{{preg_replace("/[\s_]/", "-", $post->msubcategory->name)}}/{{$post->slug}}&display=popup&ref=plugin&src=share_button","", "width=800,height=500");' href="#" class="a">


                <!--<a onclick='window.open("https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode(url()->current()) }}","", "width=800,height=500");' href="#" class="a">-->


 


                       <img src="{{url('/')}}/images/fb.png" class="img-circle" width="32px">


                   </a>


                   <a onclick='window.open("https://www.linkedin.com/shareArticle?mini=true&url={{url('marketplace')}}/{{preg_replace('/[\s_]/', '-', $post->state)}}/{{preg_replace("/[\s_]/", "-", $post->mcategory->name)}}/{{preg_replace("/[\s_]/", "-", $post->msubcategory->name)}}/{{$post->slug}}&title={{$post->business_name}}&summary={{$post->ad_description}}&source=AddressGuru","", "width=800,height=500");' href="#" class="a">


                       <img src="{{url('/')}}/images/linkedin.png" class="img-circle" width="32px">


                   </a>


                   <a onclick='window.open("https://twitter.com/intent/tweet?text={{$post->business_name}}&url={{url('marketplace')}}/{{preg_replace('/[\s_]/', '-', $post->state)}}/{{preg_replace("/[\s_]/", "-", $post->mcategory->name)}}/{{preg_replace("/[\s_]/", "-", $post->msubcategory->name)}}/{{$post->slug}}","", "width=800,height=500");' href="#" class="a">


                       <img src="{{url('/')}}/images/twitter.png" class="img-circle" width="32px">


                   </a>


                  


            </center><br/>


            </div>


            @endif


      </div>


      @if(strpos($_SERVER['REQUEST_URI'], "marketplace-preview") !== false)





        @else


     <span style="padding:1px;">


       <a href="" style="font-size:11px;color:red;" data-toggle="modal" data-target="#myModal1" class="pull-left"><i class="fa fa-exclamation-circle"></i> Report</a>


     </span>


     @endif


      


        </div>





        @if(strpos($_SERVER['REQUEST_URI'], "marketplace-preview") !== false)





        @else


       


        <div style="background-color:#fff;padding:20px;margin-bottom:15px;box-shadow:0px 0px 10px #ccc;margin-top:14px;">


          <div style="background-color:#FAFAFA;padding:20px;margin-bottom:15px;box-shadow:0px 0px 6px #ccc;">


            <h3><b> Send Enquiry</b></h3><hr/>


            {!! Form::open(['action'=>'QueryInsert@store']) !!}


              <div class="form-group">


                <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" class="form-control">


                <br/>


              </div>


              <div class="form-group">


                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control">


                <br/>


              </div>


              <div class="form-group">


                <input type="number" name="ph_number" value="{{ old('ph_number') }}" placeholder="Mobile Number" class="form-control">


                <br/>


              </div>


              <div class="form-group">


                <textarea rows="2" class="form-control" placeholder="Type your message..." name="message">{{ old('message') }}</textarea>


                <br/>


              </div>


              <div class="form-group">


                  <div class="col-md-12" style="margin-bottom:10px;margin-left:-15px;">


                    <center> {!! NoCaptcha::renderJs() !!}


                                {!! NoCaptcha::display(['data-theme' => 'dark']) !!}</center>


                  </div>


                </div>


                <input type="hidden" name="user_id" value="{{$post->user_id}}">


                <input type="hidden" name="product_id" value="{{$post->id}}">


                <center><button class="btn" style="background-color:red;color:white;">Submit</button></center>


            {!! Form::close() !!}


          </div>


          


          


         


        </div>


        @endif


        <div style="background-color:#fff;padding:20px;margin-bottom:15px;box-shadow:0px 0px 10px #ccc;">


            <h4 style="margin-top:0px;">Useful Information</h4><hr style="margin:8px;">     


            <ol class="consider">


              <li>Avoid any scams while paying directly in advance </li>


              <li>Make payment via Western Union etc at your own risk. </li>


              <li>You can accept and make payments from outside the country at your own risk. </li>


              <li>Address Guru is not responsible for any transation or payments, shipping guarantee, seller or buyer protections.</li>


            </ol>


        </div>


    </div>


  </div>


 


          


     


</div>


<style type="text/css">


  .repost label{font-size:15px;font-weight:bold;}


</style>


<div id="myModal1" class="modal fade" role="dialog">


  <div class="modal-dialog" style="width:500px;">





    <!-- Modal content-->


    <div class="modal-content">


      <div class="modal-header">


        <button type="button" class="close" data-dismiss="modal">&times;</button>


        <h4 class="modal-title text-center">Report: {{$post->business_name}}</h4>


      </div>


      <div class="modal-body repost" style="padding:10px 80px 10px 80px;">


          {!! Form::open(['method'=>'POST', 'action'=>'ReportSubmit@store']) !!}


            <label><input type="radio" name="report" onclick="reportclose()" value="Illegal/Fraudulent"> Illegal/Fraudulent</label><br/>


            <label><input type="radio" name="report" onclick="reportclose()" value="Spam Ad"> Spam Ad</label><br/>


            <label><input type="radio" name="report" onclick="reportclose()" value="Duplicate Ad"> Duplicate Ad</label><br/>


            <label><input type="radio" name="report" onclick="reportclose()" value="Ad is in the wrong category"> Ad is in the wrong category</label><br/>


            <label><input type="radio" name="report" onclick="reportclose()" value="Against Posting Rules"> Against Posting Rules</label><br/>


            <label><input type="radio" name="report" onclick="reportclose()" value="Adult Content"> Adult Content</label><br/>


            <label><input type="radio" name="report" onclick="reportshow()" value="Other"> Other</label><br/>


            <div id="divclose"><br/>


              <textarea rows="3" class="form-control" name="msg" placeholder="Type here..."></textarea><br/>


             <input type="hidden" name="product_id" value="{{$post->id}}">


             <input type="hidden" name="user_id" value="{{$post->user_id}}">


            </div><br/>


            <input type="email" name="email" class="form-control" placeholder="Enter your email address" required="required"><br/>


             <center><button class="btn btn-danger">Report</button></center>


        {!! Form::close() !!}


      </div>


    </div>





  </div>


</div>


<script type="text/javascript">


  function get_num() 


  {


      var a = document.getElementById('view_number');


      a.innerHTML = "{{$post->phone}}";


      a.removeAttribute('onclick');


      a.setAttribute('href', 'tel:{{$post->phone}}');





  } 





</script>


<script type="text/javascript">


  function reportshow() 


  {


    document.getElementById('divclose').style.display = 'block';


  }


  function reportclose() 


  {


    document.getElementById('divclose').style.display = 'none';


  }


</script>


@stop


