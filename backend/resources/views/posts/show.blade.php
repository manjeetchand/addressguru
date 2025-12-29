
@extends('layouts.app')

@section('head')
  <title>{{$post->business_name}} | Address Guru</title>
  @foreach($post->s_e_o_s as $seos)
      <meta name="description" content="{{$seos->s_description}}">
      <!-- <meta name="keywords" content="{{$seos->keywords}}"> -->
  @endforeach
    <!-- Seo By Vikash Sharma  -->  
  <link rel="canonical" href="{{url('/')}}/{{$post->slug}}">
  <meta property="og:type" content="website" />
  <meta property="og:title" content="{{$post->business_name}}" />
  <meta property="og:description" content="{{$post->ad_description}}" />
  <meta property="og:url" content="{{url('/')}}/{{$post->slug}}" />
  <meta property="og:site_name" content="Address Guru" />
  <meta property="og:image" content="{{url('/')}}/images/{{$post->photo}}" />
  <meta property="og:locale" content="en_US" />
  <meta name="twitter:text:title" content="{{$post->business_name}}" />
  <meta name="twitter:image" content="{{url('/')}}/images/{{$post->photo}}" />
  <meta name="twitter:card" content="{{$post->business_name}}" />
  <style type="text/css">h3{font-family:raleway!important;}.carousel-inner img{height:400px!important;}</style>
  <style>
       
        /* input {
            padding: 10px;
            width: 60%;
            font-size: 16px;
        }
        button {
            padding: 10px 20px;
            margin-top: 10px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
            font-size: 18px;
            color: green;
            display: none;
        } */
    </style>
  <style>
        label{
          font-size:16px;
        }
        .share-options {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
        
        .share-options a {
            margin: 10px; 
            text-decoration: none;
            /* border-bottom: 1px solid #ddd; */
        }
      
        .share-container {
            position: relative;
            display: inline-block;
        }
    </style>
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
  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@id": "#product", 
      "@type": "Product", 
      "url": "{{url('/', $post->slug)}}",
      "brand" : "AddressGuru",
      "description": "{{$post->s_e_o_s[0]->s_description}}",
      "name": "{{$post->business_name}}",
      "image": "{{url('/')}}/images/{{$post->photo}}",   
    <?php   

            $total = 0;
            $counts = count($post->ratings);

            foreach ($post->ratings as $check) 
            {
                $total+= $check->rating; 
            }

            if ($total == "") 
            {
              
            }
            else
            {
                if($total > 0 && $counts > 0)
                {
                  $review = $total/$counts;
                }
                else
                {
                    $review = 0;
                }

              echo  '"aggregateRating": {
                  "@type": "AggregateRating",
                  "ratingValue": "'.substr($review, 0,3).'",
                  "ratingCount": "'.$counts.'",
                  "bestRating":"5",
                  "worstRating":"0"
              },';

              echo '"review": [';

              $newaarry = [];
              foreach ($post->ratings as $check) 
              {
                  $newaarry[] =  '{
                      "@type": "Review",
                      "datePublished": "'.date('d F, Y', strtotime($check->created_at)).'",
                      "reviewBody": "'.$check->message.'",
                      "author": {
                          "@type": "Person",
                          "name": "'.$check->name.'"
                      }
                  }';
              }

              echo implode( ', ', $newaarry );

              echo '],';

            }


              ?>   
              "audience":
      { 
        "@type":"audience", 
        "description":"{{$post->s_e_o_s[0]->s_description}}", 
        "audienceType" : "{{$post->business_name}}" 
      }    
   }
  </script>
@endsection

@section('content')
<style>
  hr{
    border-color:#020202 !important;
  }

  .bi-hand-index-thumb::before{
    transform: rotate(90deg);
  }

  .container{

  }
  .rating {
    display: flex;
    width: 80%;
    justify-content: center;
    overflow: hidden;
    flex-direction: row-reverse;
    align-items: center;
    position: relative;
  }

  .rating-0 {
    filter: grayscale(100%);
  }

  .rating > input {
    display: none;
  }

  .rating > label {
    cursor: pointer;
    width: 40px;
    height: 40px;
    margin-top: auto;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 67%;
    transition: .3s;
  }

  .rating > input:checked ~ label,
  .rating > input:checked ~ label ~ label {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
  }


  .rating > input:not(:checked) ~ label:hover,
  .rating > input:not(:checked) ~ label:hover ~ label {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23d8b11e' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
  }
  .mobile-screen{
        display:none;
    }
</style>
<style>
    @media (min-width: 1200px) {
      .top-box-show {
          width: 1350px;
          background:#fff;
        
      }
      .top-box-show>.row{
        margin: 15px;
        padding:15px; 
      }
      .top-box-show>img{
      border-radius: 4px; 
      }
    }

    @media (max-width: 768px) {
      .desktop-screen{
        display:none;
      }
      .card{
        border-radius:0;
      }
      .mobile-screen{
        display:block;
    }
    }
</style>
  <?php 
  use App\Views;
  if ($post->status == 1) 
  {
    $cookie_name = $post->slug;
    $cookie_value = 0;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30));
    if (!isset($_COOKIE[$cookie_name])) 
    {
      foreach ($post->views as $key) 
      {
          $keys = $key->views;
      }
      $value = $keys + 1;
      Views::where('post_id', '=', $post->id)->update([
          'views' => $value,
      ]);
    }
  }
  ?>

@if($post->personals[0]->ph_number == '00')

@else

<!-- <div class="phone visible-xs">
   
  <a href="tel:{{$post->personals[0]->ph_number}}">
  
  <div class="phone-ticker">
    <i class="fa fa-phone"></i>
  </div>
  </a>
</div> -->
@endif  
@if(Auth::guest())


@elseif(Auth::user()->role->name == 'Admin')
<center>
<div class="edit">
    <a href="{{route('admin-listing.edit', $post->id)}}" title="Edit"><i class="fa fa-edit fa-fw"></i></a><br/><br/>
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
<div class="container">
  <div class="row"> 
    {{--
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
    --}}
  </div>
</div>
<div class="container desktop-screen">
  <p class="m-0 text-dark"><a href="{{ url($post->category->name . '/' . $post->personals[0]->city) }}"> {{$post->personals[0]->city}}</a>><a href="{{ url($post->category->name . '/' . $post->personals[0]->city) }}"> {{$post->category->name}} </a>> {{$post->business_name}}</p>
  <section class="section">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <div class="col-lg-12 my-3 ">
            <div class="row">
              <div class="col-md-10 d-flex justify-content-start gap-3">
                <div class="col-2 d-flex align-items-center" style="width:125px;height:125px;background:#ededed">
                  <div  style="border: 1px solid #cccc;padding: 2px;border-radius:4px;" > 
                       @if($post->category->id == 52)
																<img src="{{url('/')}}/images/{{$post->photo}}" alt="{{$post->business_name}}" width="100%" style="border-radius:4px">
																@if($value[0]->paid != 0)
																	<span class="verified-circle">
																		<img src="{{url('/')}}/images/verify.png" class="verifyicon" alt="{{$post->business_name}}" >
																	</span>
																@endif
														@else
																<img src="{{url('/')}}/images/{{$post->photo}}" alt="{{$post->business_name}}"  width="100%" style="border-radius:4px">
																@if($post->paid != 0)
																	<span class="verified-circle">
																		<img src="{{url('/')}}/images/verify.png" class="verifyicon" alt="{{$post->business_name}}">
																	</span>
																@endif
														
														@endif
                  </div>
                </div>
                <div class="col-10">
                  <h2 class="fw-bold" style="font-size:22px">{{$post->business_name}}</h2>
                  <div class="search-down">
                  @php
                    $ratingsSum = $post->ratings->sum('rating'); 
                    $ratingsCount = $post->ratings->count();
                    $rating = $ratingsCount > 0 ? $ratingsSum / $ratingsCount : 0; 
                  @endphp
                  <div class="mb-2">	
                    <b class="badge bg-success"> {{ number_format($rating, 1) }} </b>  
                    @for($i = 0; $i < 5; $i++)
                    <i class="fa fa-star{{ $i < round($rating) ? '' : '-o' }}"></i>
                    @endfor
                    <small>({{ $ratingsCount > 0 ? $ratingsCount : 'No' }} Review{{ $ratingsCount != 1 ? 's' : '' }})</small>
                  </div>
                  </div>
                 

                  <address class="address" style="font-size: 15px;">{{$post->business_address}} .. <a href="https://www.google.com/maps?q={{ urlencode($post->business_name . ' ' . $post->address) }}" target="_blank">
                      View Map
                  </a></address>

                  <button type="button" class="btn btn-sm btn-primary px-3 fw-bold" id="toggleNumberBtn" style="width:150px">
                    <i class="bi bi-telephone-fill"></i> &nbsp;<span id="buttonText">Show Number</span>
                </button>

                  <button type="button" class="btn btn-sm btn-success px-3 fw-bold" style="border: 1px solid;" onclick="Enquire({{$post->user_id}},{{$post->id}},'{{$post->business_name}}')" ><i class="bi bi-chat-quote-fill"></i>  &nbsp Enquire Now</button>
                  <button  type="button" class="share-btn btn btn-sm btn-default px-3" style="border: 1px solid;"  data-bs-toggle="modal" data-bs-target="#shareModel"><i class="bi bi-share-fill"></i> &nbsp Share</button>
                  <button type="button" class="btn btn-sm btn-default px-3 " style="border: 1px solid blue;" onclick="Rating({{$post->user_id}},{{$post->id}},'{{$post->business_name}}')"> <i class='fa fa-star' style="color:orange"></i> &nbsp Write a Review
                  <button type="button" class="btn btn-sm btn-default px-3 mx-1" style="border: 1px solid;"><i class="bi bi-eye"></i> {{count($post->views) }}</button>
                  <!-- <button type="button" class="btn  btn-sm  btn-default px-3" style="border: 1px solid;"><i class="bi bi-images"></i> &nbsp  Add Photo </button> -->
                  <!-- <div class="share-container">
                    <button  type="button" class="share-btn btn  btn-sm btn-default px-3" style="border: 1px solid;" onclick="toggleShareOptions()"><i class="bi bi-share-fill"></i> &nbsp Share</button>
                    <div class="share-options" id="shareOptions">
                    <a href="" class="btn btn-outline-primary"><i class="bi bi-facebook"></i></a>
                    <a class="btn btn-outline-success"><i class="bi bi-whatsapp"></i></a> 
                    <a href="" class="btn btn-outline-primary"><i class="bi bi-facebook"></i></a>
                    <a class="btn btn-outline-success"><i class="bi bi-whatsapp"></i></a>
                    <a class="btn btn-outline-secondary" onclick="copyLink()"><i class="bi bi-link-45deg"></i></a>
                    <p id="copyMessage" class="message">Link copied to clipboard!</p> -->

                        <!-- <a href="https://www.instagram.com/?url=YOUR_URL_HERE" target="_blank">Instagram</a>
                        <a href="https://wa.me/" target="_blank">WhatsApp</a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=YOUR_URL_HERE" target="_blank">Facebook</a>
                        <a href="https://x.com/intent/tweet?url=YOUR_URL_HERE&text=YOUR_TEXT_HERE" target="_blank">X (Twitter)</a> -->
                    <!-- </div> 
                </div>   -->


              
                  <!-- <button type="button"   id="shareButton" class="btn  btn-sm btn-default px-3" style="border: 1px solid;"><i class="bi bi-share-fill"></i> &nbsp Share</button> -->
                </div>
              </div>
              {{-- <div class="col-md-4 ">
                <div class="d-flex justify-content-center">
                  <div class="rating" style="padding:18px;box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;">
                    <input type="radio" name="rating" id="rating-5">
                    <label for="rating-5"></label>
                    <input type="radio" name="rating" id="rating-4">
                    <label for="rating-4"></label>
                    <input type="radio" name="rating" id="rating-3">
                    <label for="rating-3"></label>
                    <input type="radio" name="rating" id="rating-2">
                    <label for="rating-2"></label>
                    <input type="radio" name="rating" id="rating-1">
                    <label for="rating-1"></label>
                  </div>
                </div>
              </div>   --}}
            </div>
          </div>
    
        <!-- Summery Section start  -->
        <div class="row mt-3">
          <div class="col-lg-8">
            <!-- carousel -->
            <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0">
              <div class="carousel-indicators">
                @foreach($post->media as $index => $photos)
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : '' }}"></button>
                @endforeach
              </div>
              <div class="carousel-inner">
                @if($post->media->isEmpty())
                <div class="carousel-item active">
                  <img src="{{url('/')}}/images/add.png" alt="Address Guru" class="img-fluid" style="width:100%;">
                </div>
                @else
                @foreach($post->media as $index => $photos)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                  <img src="{{url('/')}}/images/{{$photos->name}}" alt="{{$post->business_name}}" class="img-fluid" style="width:100%;border-radius:4px" >
                </div>
                @endforeach
                @endif
              </div>
              <!-- Left and right controls -->
              {{-- <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button> --}}
            </div>

            <!-- About Us  -->
            <div class="mt-3">
              <h2 class="fw-bold" style="font-size:22px">About Us</h2>  
              <hr class="my-2">
              <p class="fs-8 text-justify">
                {{$post->ad_description}}
              </p>
            </div>

            <!-- inforamtion -->
            <div class="mt-5">
              @if($post->ifsc)
                <div class="col-md-12">
                  <h4><b>IFSC Code</b></h4><hr class="my-2">
                  <p style="font-size:15px;">{{$post->ifsc}}</p>
                </div> 
              @endif

              @if($post->r_type)
                @if($post->category_id == 9)
                  <div class="col-md-12">
                      <h4><b>Room Type</b></h4><hr style="margin:5px;">
                      <p style="font-size:15px;">{{$post->r_type}}</p>
                  </div>
                @endif
              @endif

              @if($post->floor)
                <div class="row">
                  <div class="col-md-4">
                    <h4><b>Room Type</b></h4><hr style="margin:5px;">
                    <p style="font-size:15px;">{{$post->r_type}}</p>
                  </div> 
                  <div class="col-md-4">
                    <h4><b>Floor</b></h4><hr style="margin:5px;">
                    <p style="font-size:15px;">{{$post->floor}}</p>
                  </div> 
                  <div class="col-md-4">
                    <h4><b>Area</b></h4><hr style="margin:5px;">
                    <p style="font-size:15px;">{{$post->area}}</p>
                  </div>  
                </div> 
                <div class="row">
                    <div class="col-md-4">
                      <h4><b>Furnished</b></h4><hr style="margin:5px;">
                      <p style="font-size:15px;">{{$post->furnished}}</p>
                    </div> 
                    <div class="col-md-4">
                      <h4><b>Bathroom</b></h4><hr style="margin:5px;">
                      <p style="font-size:15px;">{{$post->bathroom}}</p>
                    </div> 
                    <div class="col-md-4">
                      <h4><b>Religion Belief</b></h4><hr style="margin:5px;">
                      <p style="font-size:15px;">{{$post->religion_view}}</p>
                    </div>        
                </div>
              @endif
            <?php 
            $services = json_decode($post->service); 
            $payments = json_decode($post->payment); 
            $facilities = json_decode($post->facility); 
            $courses = json_decode($post->course); 
            ?>

            <!-- Services Section -->
            @if (!empty($services) && !empty($services[0]))
                <div class="col-md-12"> 
                    <h2 class="fw-bold" style="font-size:22px">Services</h2>
                    <hr class="my-2">
                    <p class="fs-8 text-justify">{{$post->business_name}} provides the following services:</p>
                    <ul>
                        @foreach ($services as $service)
                            <li class="fs-8 text-justify fw-bold" style="list-style:none"><i class='fa fa-check text-success'></i> {{$service}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Facilities Section -->
            @if (!empty($facilities) && !empty($facilities[0]))
                <div class="col-md-12 ">
                    <h3><b>Facilities</b></h3><hr style="margin:5px;margin-bottom:12px;">
                    <p style="font-size:13px;">{{$post->business_name}} provides the following facilities:</p>
                    <ul>
                        @foreach ($facilities as $facility)
                            <li><i class='fa fa-check'></i> {{$facility}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

          <!-- Packages Section -->
          @if (in_array($post->category->id, [31, 32, 34, 39, 45]))
              <?php $i = 1; $v = 1; ?>
              @foreach($post->packages as $pack)
                  <div class="col-md-6">
                      <h3>Package {{$i}}</h3>
                      <div style="box-shadow:0px 0px 10px #ccc;padding:10px;margin-bottom:20px;">
                          <h4 style="min-height:40px;color:#337AB7;">{{$pack->name}}</h4>
                          <p>{{substr($pack->about, 0, 200)}}... </p>
                          <div class="row">
                              <div class="col-md-6"><b>Price:</b> S$ {{$pack->price}}</div>
                              <div class="col-md-6 text-right">
                                  <a href="" class="btn btn-primary" data-toggle="modal" data-target="#view{{$v}}" style="padding:2px 10px;">View Details</a>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="view{{$v}}" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title">{{$pack->name}}</h4>
                              </div>
                              <div class="modal-body">
                                  <p>{{$pack->about}}</p><br/>
                                  <div class="row">
                                      <div class="col-md-6"><b>Price:</b> {{$pack->price}}</div>
                                      <div class="col-md-6 text-right"><b>Tour dates:</b> {{$pack->dates}}</div>
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

          <!-- Courses Section -->
          @if (!empty($courses) && !empty($courses[0]))
              <div class="col-md-12 li">
                  <h3><b>Courses</b></h3><hr style="margin:5px;margin-bottom:12px;">
                  <p style="font-size:13px;">{{$post->business_name}} provides the following courses:</p>
                  <ul>
                      @foreach ($courses as $course)
                          <li><i class='fa fa-check'></i> {{$course}}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <!-- Payment Modes Section -->
          @if (!empty($payments) && !empty($payments[0]))
              <div class="col-md-12 mt-4">
                  <h2 class="fw-bold" style="font-size:22px">Payment Mode</h2>
                  <hr class="my-2">
                  <p class="fs-8 text-justify">{{$post->business_name}} accepts the following payment modes:</p>
                  <ul>
                      @foreach ($payments as $payment)
                          <li class="fs-8 text-justify">{{$payment}}</li>
                      @endforeach
                  </ul>
              </div>
          @endif

          <!-- State and City Section -->
          <div class="row mt-4">
              <div class="col-md-4">
                  <h2 class="fw-bold" style="font-size:22px">State</h2>
                  <hr class="my-2">
                  <p class="fs-8 text-justify">{{$post->personals[0]->state}}</p>
              </div>
              <div class="col-md-4"></div>
              <div class="col-md-4">
                  <h2 class="fw-bold" style="font-size:22px">City</h2>
                  <hr class="my-2">
                  <p class="fs-8 text-justify">{{$post->personals[0]->city}}</p>
              </div>
          </div>

                  <!-- Overview Section Start -->
          <div class="row mt-4">
            <h2 class="fw-bold" style="font-size:22px">Overview - {{$post->business_name}}</h2>
            <hr class="my-2">
    
        <span class="fs-8 text-justify">
        {{$post->business_name}} at {{$post->business_address}} is a {{$post->category->name}} in {{$post->personals[0]->city}}.
        
        @if (!empty($courses) && !empty($courses[0]))
            Their courses are:
            
                @foreach ($courses as $course)
                    <span class="fs-8 text-justify">{{$course}},</span>
                @endforeach
           
        @endif

        @if (!empty($facilities) && !empty($facilities[0]))
            Their facilities are:
            <ul>
                @foreach ($facilities as $facility)
                    <li class="fs-8 text-justify">{{$facility}}</li>
                @endforeach
            </ul>
        @endif

        @if (!empty($services) && !empty($services[0]))
            Their services are:<span> @foreach ($services as $service)
                    {{$service}},

                    @endforeach
        @endif

        @if (!empty($payments) && !empty($payments[0]))
            Their acceptable payment modes are:
            <span>
                @foreach ($payments as $payment)
                  {{$payment}},
                @endforeach
              </span>
        @endif
    </span>
    <br/>
    <span class="fs-8 text-justify">Scroll to the top for more details of {{$post->business_name}}</span>
    <br/>
    <span class="fs-8 text-justify">Don't forget to mention that you found {{$post->business_name}} on <b>Address Guru</b></span>
</div>
<!-- Overview Section End -->
</div>

</div>

<!-- Summery Section End  -->

<!-- Form Section start  -->
<div class="col-lg-4  desktop-screen">
  <div class="p-4 mb-3 bg-light rounded" style="box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;background-color: rgb(235 236 237 / 72%) !important;">
    <h2 class="fw-bold" style="font-size:22px">Quick Information</h2>
    <hr class="my-2">
    <p class="fs-8 text-justify">Category : {{$post->category->name}}</p> <hr class="my-2">

    <!-- <p class="fs-8 text-justify">Estiblashment Year : {{$post->category->name}}</p> <hr class="my-2"> -->
    <ul style="list-style:none" class="p-0">
      <li class="fs-8 text-justify mt-2"><i class="bi bi-calendar-week" ></i></b>&nbsp Open on: Mon, Tue, Web, Thu, Fri,Sat</li><hr class="my-2">
      <li class="fs-8 text-justify mt-2"> <i class="bi bi-clock" ></i></b> Working Hours: 9:00 AM to 9:00 PM</li><hr class="my-2">
      <li class="fs-8 text-justify mt-2"><i class="bi bi-person-fill" ></i></b> Contact : {{$post->personals[0]->name}}</li><hr class="my-2">
    </ul>
        <p class="fs-8 text-justify">Tax No. : {{$post->tin_no ?? ''}}</p> <hr class="my-2">
    <p class="fs-8 text-justify">Postal Code : {{$post->postal_code ?? ''}}</p> <hr class="my-2">
   <a  href="{{$post->web_link}}"  target="_blank" class="text-dark">Visit Website</a>
              </div>
  <div class="d-flex justify-content-between m-2  ">
    <small class="m-0" style="color:red;cursor:pointer" data-bs-toggle="modal" data-bs-target="#reportModel"><i class="bi bi-x-square-fill"></i> Report</small>
    <small class="m-0" style="color:blue;cursor:pointer" data-bs-toggle="modal" data-bs-target="#claimModel"><i class="bi bi-hand-index-thumb" ></i> Claim - This Business</small>
</div>
  <div style="background-color:#f0f9f9;padding:20px;margin-bottom:15px;box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;">
    <h2  style="font-size:17px; font-weight:600">Get More Information From <br><span style="font-size:19px">{{$post->business_name}}</span></h2>
    <hr/>
    {!! Form::open(['action'=>'QueryInsert@store', 'class'=>'enquiryForm form-1']) !!}
                        <div class="form-group mb-2">
                          <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" class="form-control">
                          @if ($errors->has('name'))
                            <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="form-group mb-2">
                          <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
                          @if ($errors->has('email'))
                            <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="form-group mb-2">
                          <input type="number" name="ph_number" value="{{ old('ph_number') }}" placeholder="Mobile Number" class="form-control">
                          @if ($errors->has('ph_number'))
                            <span class="help-block">
                              <strong>{{ $errors->first('ph_number') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="form-group mb-2">
                          <textarea rows="2" class="form-control" placeholder="Type your message..." name="message">{{ old('message') }}</textarea>
                          @if ($errors->has('message'))
                            <span class="help-block">
                              <strong>{{ $errors->first('message') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <center>
                              {!! NoCaptcha::renderJs() !!}
                              {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                            </center>
                          </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{$post->user_id}}">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <button class="btn btn-primary btn-md fw-bold mt-1 send-enquiry">Send Enquiry</button>
                      {!! Form::close() !!}		
  </div>
  <div style="background-color:#fff;margin-bottom:15px;box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px; ">
      <div  style="border: 1px solid #cccc;padding: 2px;border-radius: 4px;"> 
        <img src="https://plus.unsplash.com/premium_photo-1723632256277-b34f59e30179?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" width="100%" style="border-radius:4px">
        </div>
  </div>
  <div style="background-color:#fff;padding:20px;margin-bottom:15px;box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;">
      <h2 class="fw-bold" style="font-size:22px">Useful Information</h2>
      <hr style="my-2">     
      <ol class="consider">
        <li class="fs-8 text-justify">Avoid any scams while paying directly in advance </li>
        <li class="fs-8 text-justify">Make payment via Western Union etc at your own risk. </li>
        <li class="fs-8 text-justify">You can accept and make payments from outside the country at your own risk. </li>
        <li class="fs-8 text-justify">Address Guru is not responsible for any transation or payments, shipping guarantee, seller or buyer protections.</li>
      </ol>
  </div>
  
</div>
<!-- Form Section End  -->


        </div>
      </div>
    </div>
  </section>
</div>

  {{--<div class="col-md-8 no-need-left">


    <div class="col-md-4 no-need-right yo">

      <div style="background-color:white;box-shadow:0px 0px 6px #ccc;padding:15px;">
      <div style="background-color:#eee;padding:20px;font-size:16px;">
        @if($post->personals[0]->ph_number == '00')

        @else
        <i class="fa fa-phone fa-fw yoi"></i><a href="tel:{{$post->personals[0]->ph_number}}" style="font-size:16px!important;"> +65- {{$post->personals[0]->ph_number}}</a><br/>
        @endif
        @if($post->web_link == 'no')


        @else
        <i class="fa fa-globe fa-fw yoi"></i> <a href="{{$post->web_link}}" rel="nofollow" target="_blank" style="font-size:16px!important;">Visit Website</a><br/>

        @endif
        <i class="fa fa-tags fa-fw yoi"></i> {{$post->category->name}} <br/>
          @if($post->h_star == "")

        
        @else

          <i class="fa fa-tag fa-fw yoi"></i> {{$post->h_star}}<br/>

        @endif

        @if($post->only_for == "")

        
        @else

          <i class="fa fa-tag fa-fw yoi"></i> {{$post->only_for}}<br/>

        @endif
        <br/>
         
        <br/>

        @if($post['rent'] == "")

        @else
          @if($post->category->id != 19)
              Starting Price: S$ <b>{{$post->rent}}</b><br/><br/>
           @else
            
            Salary: S$ <b>{{$post->rent}}</b><br/><br/>
           
           @endif
        @endif
        
          <div class="views">
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary butn1">
                  <i class="fa fa-eye"></i> Views
                </button>
                <button type="button" class="btn btn-warning butn2">
                  {{isset($post->views[0]) ? number_format($post->views[0]->views) : 0}}
                </button>
              </div>
          </div>
          
       @if($post->category->id == 19)

        <br/>  Posted Date:{{date('d F, Y', strtotime($post->created_at))}}

        @endif
      
        <br/> <br/>
         
        <div class="visible-xs">
          <span style="font-size:14px;">Chat on Whatsapp - <a href="https://api.whatsapp.com/send?phone=91{{$post->personals[0]->ph_number}}&text=Hi,%20 {{$post->personals[0]->name}}"><img src="{{url('/')}}/images/whatsapp.png" class="img-circle" width="20px"></a></span>
        <br/>
        </div>
        <div class="icon">
          <b>Share on:<b>
        <center>
                  <a href="whatsapp://send?text=https://www.addressguru.sg/{{$post->slug}}" target="_blank" class="a">
                       <img src="{{url('/')}}/images/whatsapp.png" class="img-circle" width="34px">
                   </a>
                 <a onclick='window.open("https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&u=https%3A%2F%2Fwww.addressguru.sg/{{$post->slug}}%2F&display=popup&ref=plugin&src=share_button","", "width=800,height=500");' href="#" class="a">
                       <img src="{{url('/')}}/images/fb.png" class="img-circle" width="32px">
                   </a>
                   <a onclick='window.open("https://www.linkedin.com/shareArticle?mini=true&url=www.addressguru.sg/{{$post->slug}}&title={{$post->business_name}}&summary={{$post->ad_description}}&source=AddressGuru","", "width=800,height=500");' href="#" class="a">
                       <img src="{{url('/')}}/images/linkedin.png" class="img-circle" width="32px">
                   </a>
                   <a onclick='window.open("https://twitter.com/intent/tweet?text={{$post->business_name}}&url=https%3A%2F%2Fwww.addressguru.sg/{{$post->slug}}%2F","", "width=800,height=500");' href="#" class="a">
                       <img src="{{url('/')}}/images/twitter.png" class="img-circle" width="32px">
                   </a>
                  
            </center><br/>
            </div>
           
      </div>
     <span style="padding:1px;">
       <a href="{{url('/claim', $post->slug)}}" class="claim pull-right"><b>Claim - This Business</b></a>
       <a href="" style="font-size:11px;color:red;" data-toggle="modal" data-target="#myModal1" class="pull-left"><i class="fa fa-exclamation-circle"></i> Report</a>
     </span>
      <div>
        @if($post->video == 'no' OR $post->video == null)


        @else
       
            <h3><b>Video</b></h3><hr style="margin:5px;">
            <iframe width="100%" height="250" src="https://www.youtube.com/embed/{{$post->video}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        @endif
      </div>
      
            <?php 

          $total = 0;
          $counts = count($post->ratings);

          foreach ($post->ratings as $check) 
          {
              $total+= $check->rating; 
          }

          if ($total == "") 
          {
            
          }
          else
          {
              if($total > 0 && $counts > 0)
              {
                    $review = $total/$counts;
              }
              else
              {
                  $review = 0;
              }

              echo '<br/><div style="border:1px solid #ccc;padding:10px 15px 10px 15px;min-height:200px;border-radius:10px;">';
         
             echo ' <span style="color:green;font-size:28px;">'.substr($review, 0,3).'</span> <span style="color:#e7711b;font-size:20px;">';

             if ($review < 2) 
             {
                echo '<i class="fa fa-star"></i>';
             }
             elseif ($review < 3) 
             {
                echo '<i class="fa fa-star"></i><i class="fa fa-star"></i>';
             }
             elseif ($review < 4) 
             {
                echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
             }
             elseif ($review < 5) 
             {
                echo ' <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
             }
             elseif ($review < 6) 
             {
                echo '  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
             }

             echo ' 
              </span><span style="color:#878787;"> ( '.$counts.' Reviews )</span><hr style="margin:auto;"/>';

              
              
          

            echo ' <marquee direction="up" scrollamount="2" class="marquee" onmouseover="stop()" onmouseout="start()">';
               foreach ($post->ratings as $check) 
              {
            echo '
                  <h5><b>'.$check->name.'</b></h5>
                  <span style="color:#e7711b;">';

                       if ($check->rating == 1) 
             {
                echo '<i class="fa fa-star"></i>';
             }
             elseif ($check->rating == 2) 
             {
                echo '<i class="fa fa-star"></i><i class="fa fa-star"></i>';
             }
             elseif ($check->rating == 3) 
             {
                echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
             }
             elseif ($check->rating == 4) 
             {
                echo ' <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
             }
             elseif ($check->rating == 5) 
             {
                echo '  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
             }



                  echo '</span> <span style="color:#878787;font-size:12px;">'.$check->updated_at->diffForHumans().'</span>
                  <p>'.$check->message.'</p>
                  <hr style="margin:5px;">';
                }
                 echo '</marquee>';

                 echo "</div>";

          }
         

       ?>
          <div>
          
        
        </div>
        </div>

         <div style="background-color:#fff;padding:20px;margin-bottom:10px;box-shadow:0px 0px 10px #ccc;margin-top:10px;">
          
               <center><a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-star"></i> Submit Review</a></center>
        
         
        </div>
       
       
      
    </div>
  </div> --}}
 
          
     
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Rate: {{$post->business_name}}</h4>
        </div>
        <div class="modal-body" style="padding:10px 30px 10px 30px;">
      
        </div>
      </div>
      
    </div>
  </div>
 
@if($post->paid != 0)
  <!-- Modal -->
<div id="my" class="modal fade" role="dialog" style="top:60px!important;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-button" data-dismiss="modal">&times;</button>
        <h5 class="modal-title"><b>Get details on your mobile of - <span style="color:#FF6E04;">"{{$post->business_name}}"</span></b></h5>
      </div>
      <div class="modal-body" style="padding:10px 60px 10px 60px;">
        <div class="row">
          {!! Form::open(['onsubmit'=>'return formcheck()', 'name'=>'smsform', 'action'=>'smsquery@store']) !!}
        <div class="form-group">
          <label class="col-md-3 labels">Full Name <span>*</span></label>
          <div class="col-md-9">
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Full Name"><br/>
          </div>
        </div>
        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
          <label class="col-md-3 labels">Mobile Number <span>*</span></label>
          <div class="col-md-9">
            <input type="number" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Mobile Number">
            @if ($errors->has('phone'))
              <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
              </span>
            @endif<br/>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 labels">Email (optional)</label>
          <div class="col-md-9">
            <input type="email" name="email" class="form-control" placeholder="Email"><br/>
            <input type="hidden" name="post_id" value="{{$post->id}}">
          </div>
        </div>
         <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
            <div class="col-md-12">
                <center> {!! NoCaptcha::renderJs() !!}
                {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                @if ($errors->has('g-recaptcha-response'))
                    <span class="help-block">
                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                    </span>
                @endif
                </center>
            </div>
        </div>
        <div class="form-group">
            <center><button class="btn btn-primary" style="margin-top:10px;">Submit</button></center>
        </div>
        {!! Form::close() !!}
        </div>
        <div class="row">
          <div class="col-md-12">
              <ul class="ulli">
                <li><i class="fa fa-check-circle"></i> We will send your details to business Owners</li>
                <li><i class="fa fa-check-circle"></i> Details we be sent by SMS/Email.</li>
              </ul>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endif
<!-- <script type="text/javascript">
  var map = new google.maps.Map(document.getElementById('map-canvas'),{
    center:{
      lat: <?php echo $post->lat; ?>,
          lng: <?php echo $post->lng; ?>
    },
    zoom:15
  });
  var marker = new google.maps.Marker({
    position: {
      lat: <?php echo $post->lat; ?>,
          lng: <?php echo $post->lng; ?>
    },
    map: map,
    draggable: false
  });
</script> -->
<script type="text/javascript">
  function formcheck() {
    var x = document.forms["smsform"]["name"].value;
    if (x == "") 
    {
        alert("Name must be filled out");
        return false;
    }
    var y = document.forms["smsform"]["phone"].value;
    if (y == "") 
    {
        alert("Mobile Number must be filled out");
        return false;
    }
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


<div class="mobile-screen">
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      @foreach($post->media as $index => $photos)
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="{{ $loop->first ? 'true' : '' }}"></button>
      @endforeach
    </div>
    <div class="carousel-inner">
      @if($post->media->isEmpty())
      <div class="carousel-item active">
        <img src="{{url('/')}}/images/add.png" alt="Address Guru" class="img-fluid" style="width:100%;height:250px!important;;">
      </div>
      @else
      @foreach($post->media as $index => $photos)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
        <img src="{{url('/')}}/images/{{$photos->name}}" alt="{{$post->business_name}}" class="img-fluid" style="width:100%;height:250px!important;" >
      </div>
      @endforeach
      @endif
    </div>
    <!-- Left and right controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <div class="container-sm">
  <section class="section">
      <div class="row">
          <div class="card">
            <div class="card-body p-0">
                <div class="col-lg-12 mb-3 ">
                        <div class="border-bottom mt-2">
                          <h1 class="fw-bold text-dark" style="font-size:20px;" >{{$post->business_name ?? ''}}</h1>
                            <div class="row m-0 p-0 align-items-center">
                              <div class="col-1  m-0 p-0">
                               
                              </div>
                              <div class="col-12 m-0 p-0">
                              @php
                                  $businessName = $post->business_address;
                                  $words = explode(' ', $businessName);
                                  $substring = '';
                                  foreach ($words as $word) {
                                      if (strlen($substring . ' ' . $word) <= 40) {
                                          $substring .= ($substring ? ' ' : '') . $word;
                                      } else {
                                          break;
                                      }
                                    }
                              @endphp
                                <small style="font-size:12px">  <i class="bi bi-geo-alt-fill"></i> {{$substring ?? ''}} <a style="font-size:12px;text-align:left;color:blue;" data-bs-toggle="modal" data-bs-target="#viewMoreModal">View More</a></small>
                              </div>
                            </div>
                          </div>
                        <div>
                          <p  style="margin:5px"><i class="{{$post->category->icon}}" style="color:{{$post->category->colors}}"> </i> {{$post->category->name}}</p>
                          <p style="margin:5px"><i class="bi bi-geo-alt-fill" style="color:orange"></i>{{$post->personals[0]->state}} / {{$post->personals[0]->city}}</p>
                    
                          <p style="margin:5px"><i class="bi bi-eye" ></i> {{count($post->ratings) ?? 'No'}} Review  <span class="badge text-bg-primary" onclick="Rating({{$post->user_id}},{{$post->id}},'{{$post->business_name}}')"><i class="fa fa-star" style="color:orange"></i> Write a Review</span> </p>

                          <div class="d-flex justify-content-around my-4">
                            <button class="btn btn-primary"><a href="tel:{{$post->personals[0]->ph_number}}" class="text-light" style="font-size:16px!important"> <i class="bi bi-telephone"></i>&nbsp; &nbsp; Call</a></button>
                            <button class="btn btn-success"><a href="https://wa.me/{{ $post->personals[0]->ph_number }}" target="_blank"
                              class="text-light" style="font-size:16px!important"><i class="bi bi-whatsapp"></i>  Whatsapp</a></button>
                            <button class="btn btn-outline-secondary"><a href="{{ $post->web_link ?? '#' }}" target="_blank" style="font-size:16px!important"><i class="bi bi-browser-chrome"></i></a></button>
                            <button class="btn btn-outline-secondary"><i class="bi bi-chat-left-dots-fill"></i></button>
                          </div>
                          <div class="d-flex justify-content-between m-2  ">
                              <small class="m-0" style="color:red;" data-bs-toggle="modal" data-bs-target="#reportModel"><i class="bi bi-x-square-fill"></i> Report</small>
                              <small class="m-0" data-bs-toggle="modal" data-bs-target="#claimModel"><i class="bi bi-hand-index-thumb" style="color:blue;"></i> Claim - This Business</small>
                          </div>
                        </div>
                </div>
            </div>
         </div> 
      </div>  
  </section>
  </div>

  <div class="container-sm mt-2">
    <section class="section">
      <div class="row">
          <div class="card">
            <div class="card-body p-0">
                <div class="col-lg-12 mb-3 ">
                  <!-- About us  -->
                  <div class="mt-3">
                    <h2 class="fw-bold" style="font-size:18px;">About Us</h2>  
                    <hr class="my-2">
                    <p class="fs-6 text-justify">
                      {{$post->ad_description}}
                    </p>
                  </div>
                    <!-- Service  -->
                    @if (!empty($services) && !empty($services[0]))
                      <div class="mt-3">
                        <h2 class="fw-bold" style="font-size: 18px;">Services</h2>  
                        <hr class="my-2">
                        <p class="fs-6 text-justify">{{$post->business_name}} provides the following services:</p>  
                        <ul class="row p-0">
                          @foreach ($services as $service)
                          <div class="col-12">
                            <li class="text-justify" style="list-style:none;font-weight:600"><i class='fa fa-check text-success'></i> {{$service}}</li>
                          </div>
                          @endforeach
                      </ul>
                      </div>
                    @endif
                    <!-- Facilities Section -->
                    @if (!empty($facilities) && !empty($facilities[0]))
                        <div class="col-md-12">
                        <h2 class="fw-bold" style="font-size: 18px;">Facilities</h2>  
                            <hr style="margin:5px;margin-bottom:12px;">
                            <p class="fs-6 text-justify">{{$post->business_name}} provides the following facilities:</p>
                            <ul class="row p-0" style="list-style:none;">
                            
                                @foreach ($facilities as $facility)
                                <div class="col-6">
                                    <li><i class='fa fa-check'></i> {{$facility}}</li>
                                  </div>
                                @endforeach
                            
                            </ul>
                        </div>
                    @endif
                    <!-- Courses Section -->
                    @if (!empty($courses) && !empty($courses[0]))
                        <div class="col-md-12">
                            <h2 class="fw-bold" style="font-size: 18px;" >Courses</h2>  
                            <hr style="margin:5px;margin-bottom:12px;">

                            <p class="fs-6 text-justify">{{$post->business_name}} provides the following courses:</p>
                            <ul class="p-0" style="list-style:none;">
                                @foreach ($courses as $course)
                                    <li><i class='fa fa-check'></i> {{$course}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- Payment Modes Section -->
                    @if (!empty($payments) && !empty($payments[0]))
                        <div class="col-md-12">
                            <h2 class="fw-bold" style="font-size: 18px;">Payment Mode</h2>  
                            <hr class="my-2">
                            <p class="fs-6 text-justify">{{$post->business_name}} accepts the following payment modes:</p>
                            <ul >
                                @foreach ($payments as $payment)
                                    <li class="fs-8 text-justify">{{$payment}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- State and City Section -->
                    <div class="row mt-4">
                        <div class="col-4">
                            <h2 class="fw-bold" style="font-size: 18px;">State</h2>  
                            <hr class="my-2">
                            <p class="fs-8 text-justify">{{$post->personals[0]->state}}</p>
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4">
                            <h2 class="fw-bold" style="font-size: 18px;">City</h2>  
                            <hr class="my-2">
                            <p class="fs-6 text-justify">{{$post->personals[0]->city}}</p>
                        </div>
                    </div>
                    <div style="background-color:#f0f9f9;padding:20px;margin-bottom:15px;box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;">
                      <h2  style="font-size:17px; font-weight:600">Get More Information From <br><span style="font-size:19px">{{$post->business_name}}</span></h2>
                      <hr/>
                      {!! Form::open(['action'=>'QueryInsert@store', 'class'=>'enquiryForm form-1']) !!}
                        <div class="form-group mb-2">
                          <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" class="form-control">
                          @if ($errors->has('name'))
                            <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="form-group mb-2">
                          <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
                          @if ($errors->has('email'))
                            <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="form-group mb-2">
                          <input type="number" name="ph_number" value="{{ old('ph_number') }}" placeholder="Mobile Number" class="form-control">
                          @if ($errors->has('ph_number'))
                            <span class="help-block">
                              <strong>{{ $errors->first('ph_number') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="form-group mb-2">
                          <textarea rows="2" class="form-control" placeholder="Type your message..." name="message">{{ old('message') }}</textarea>
                          @if ($errors->has('message'))
                            <span class="help-block">
                              <strong>{{ $errors->first('message') }}</strong>
                            </span>
                          @endif
                        </div>
                        <div class="form-group">
                          <div class="col-md-12">
                            <center>
                              {!! NoCaptcha::renderJs() !!}
                              {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                            </center>
                          </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{$post->user_id}}">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <button class="btn btn-primary btn-md fw-bold mt-1 send-enquiry">Send Enquiry</button>
                      {!! Form::close() !!}		
                    </div>
                    <div style="background-color:#fff;padding:20px;margin-bottom:15px;box-shadow: rgba(0, 0, 0, 0.05) 0px 0px 0px 1px;">
                        <h2 class="fw-bold" style="font-size:18px">Useful Information</h2>
                        <hr style="my-2">     
                        <ol class="consider">
                          <li class="fs-6 text-justify">Avoid any scams while paying directly in advance </li>
                          <li class="fs-6 text-justify">Make payment via Western Union etc at your own risk. </li>
                          <li class="fs-6 text-justify">You can accept and make payments from outside the country at your own risk. </li>
                          <li class="fs-6 text-justify">Address Guru is not responsible for any transation or payments, shipping guarantee, seller or buyer protections.</li>
                        </ol>
                    </div>
                </div>
              </div>
          </div>
      </div>
    </section>
  

  </div>
</div>


<!-- View More Modal -->
<div class="modal fade" id="viewMoreModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h6 class="modal-title">Report: <strong>{{$post->business_name}}</strong></h6> -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <center><i class="bi bi-geo-alt-fill"></i> {{$post->business_address ?? ''}}  <br>
            <a href="https://www.google.com/maps?q={{ urlencode($post->business_name . ' ' . $post->address) }}" target="_blank"  class="btn btn-danger mt-2">
              View Map
            </a>
          </center>
      </div>
    </div>
  </div>
</div>


<!-- Roport Modal -->
<div class="modal fade" id="reportModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Report: <strong>{{$post->business_name}}</strong></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {!! Form::open(['method'=>'POST', 'action'=>'ReportSubmit@store','id'=>'reportForm']) !!}
          <input type="radio" name="report" onclick="reportclose()" value="Illegal/Fraudulent"> Illegal/Fraudulent<br>
          <input type="radio" name="report" onclick="reportclose()" value="Spam Ad"> Spam Ad<br>
          <input type="radio" name="report" onclick="reportclose()" value="Duplicate Ad"> Duplicate Ad<br>
          <input type="radio" name="report" onclick="reportclose()" value="Ad is in the wrong category"> Ad is in the wrong category<br>
          <input type="radio" name="report" onclick="reportclose()" value="Against Posting Rules"> Against Posting Rules<br>
          <input type="radio" name="report" onclick="reportclose()" value="Adult Content"> Adult Content<br>
          <input type="radio" name="report" onclick="reportshow()" value="Other"> Other<br/> 
          @if ($errors->has('report'))
            <span class="help-block">
              <strong>{{ $errors->first('report') }}</strong>
            </span>
          @endif  
          <div id="divclose"><br/>
            <textarea rows="3" class="form-control" name="msg" placeholder="Type here..."></textarea><br/>
              @if ($errors->has('msg'))
                <span class="help-block">
                  <strong>{{ $errors->first('msg') }}</strong>
                </span>
              @endif
           <input type="hidden" name="post_id" value="{{$post->id}}">
           <input type="hidden" name="user_id" value="{{$post->user_id}}">
          </div><br/>
          <div class="col-4">
            <input type="email" name="email" class="form-control" placeholder="Enter your email address" required="required"><br/>
              @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
              @endif
          </div>
          <div class="col-3">
            <button class="btn btn-danger send-report" style="width: 100%;"> Report</button>
          </div>
      {!! Form::close() !!}
    </div>
    </div>
  </div>
</div>

<!-- claim Modal -->
<div class="modal fade" id="claimModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content ">
      <div class="modal-header">
        <h6 class="modal-title">Claim: <strong>{{$post->business_name}}</strong></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action'=>'Postclaim@store', 'method'=>'POST','id'=>'claimForm']) !!}
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} mb-3">
            <label>Full Name <span>*</span></label>
            <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" class="form-control">
            @if ($errors->has('name'))
                <span class="help-block1">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}  mb-3">
            <label>Email <span>*</span></label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com" class="form-control">
            @if ($errors->has('email'))
                <span class="help-block1">
                  <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}  mb-3">
            <label>Mobile Number <span>*</span></label>
            <input type="number" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="Mobile Numner" class="form-control">
            @if ($errors->has('mobile_number'))
              <span class="help-block1">
                  <strong>{{ $errors->first('mobile_number') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}  mb-3">
            <label>Reason for ownership claim <span>*</span></label>
            <textarea rows="4" class="form-control" placeholder="Type here..." name="message">{{ old('message') }}</textarea>
            @if ($errors->has('message'))
                <span class="help-block1">
                    <strong>{{ $errors->first('message') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}  mb-3">
              <div class="col-md-12  mb-3">
              {!! NoCaptcha::renderJs() !!}
                  {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                  @if ($errors->has('g-recaptcha-response'))
                      <span class="help-block1">
                          <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                      </span>
                  @endif
          
              </div>
          </div>
          <input type="hidden" name="post_id" value="{{$post->id}}">
          <input type="hidden" name="user_id" value="{{$post->user_id}}">
          <div class="col-3">
            <button class="btn btn-danger claimForm" style="width:100%">Claim</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>  
</div>

<!-- Review Modal -->
<div class="modal fade" id="reviewModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Review: <strong><span id="RatingName"></span></strong></h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {!! Form::open(['action'=>'PostRating@store', 'id'=>'reviewForm']) !!}
          <input type="hidden" name="post_id"  id="rating_post_id">
          <input type="hidden" name="user_id" id="rating_user_id">
          <div class="form-group stars d-flex justify-content-center">
            <input class="star star-1" id="star-1" type="radio" value="1" name="rating"/>
            <label class="star star-1" for="star-1" style="margin-right: 38px;"></label>
            <input class="star star-2" id="star-2" type="radio" value="2" name="rating"/>
            <label class="star star-2" for="star-2" style="margin-right: 38px;"></label>
            <input class="star star-3" id="star-3" type="radio" value="3" name="rating"/>
            <label class="star star-3" for="star-3" style="margin-right: 38px;"></label>
            <input class="star star-4" id="star-4" type="radio" value="4" name="rating"/>
            <label class="star star-4" for="star-4" style="margin-right: 38px;"></label>
            <input class="star star-5" id="star-5" type="radio" value="5" name="rating"/>
            <label class="star star-5" for="star-5" style="margin-right: 38px;"></label>
          </div>
          <br>
          <p>   
            @if ($errors->has('rating'))
              <span class="help-block">
                <strong>{{ $errors->first('rating') }}</strong>
              </span>
            @endif  
          </p>  
          <div class="form-group mb-3">
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" class="form-control">
              @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group  mb-3">
            <input type="email" name="rating_email" value="{{ old('rating_email') }}" placeholder="Email ID" class="form-control">
            @if ($errors->has('rating_email'))
              <span class="help-block">
                <strong>{{ $errors->first('rating_email') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group  mb-3">
            <textarea rows="3" class="form-control" name="message" placeholder="Type here">{{ old('message') }}</textarea>
            @if ($errors->has('message'))
						<span class="help-block">
							<strong>{{ $errors->first('message') }}</strong>
						</span>
					  @endif
          </div>
          <div class="form-group">
            <button class="btn btn-primary send-review" ><i class="fa fa-star fa-spin"></i> Rate</button>
          </div>
          {!! Form::close() !!}
     </div>
    </div>
  </div>
</div>

<!-- Enquire Modal -->
<div class="modal fade" id="enquireModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Enquire: <strong style="color: orange;"><span id="EnquireName"></span></strong></h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
      {!! Form::open(['action'=>'QueryInsert@store', 'class'=>'enquiryForm form-2']) !!}
				<div class="form-group mb-3">
					<input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" class="form-control">
					@if ($errors->has('name'))
						<span class="help-block">
							<strong>{{ $errors->first('name') }}</strong>
						</span>
					@endif
				</div>
				<div class="form-group mb-3">
					<input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control">
					@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
				</div>
				<div class="form-group mb-3">
					<input type="number" name="ph_number" value="{{ old('ph_number') }}" placeholder="Mobile Number" class="form-control">
					@if ($errors->has('ph_number'))
						<span class="help-block">
							<strong>{{ $errors->first('ph_number') }}</strong>
						</span>
					@endif
				</div>
				<div class="form-group mb-3">
					<textarea rows="2" class="form-control" placeholder="Type your message..." name="message">{{ old('message') }}</textarea>
					@if ($errors->has('message'))
						<span class="help-block">
							<strong>{{ $errors->first('message') }}</strong>
						</span>
					@endif
				</div>
				<div class="form-group mb-3">
					<div class="col-md-12">
							{!! NoCaptcha::renderJs() !!}
							{!! NoCaptcha::display(['data-theme' => 'dark']) !!}
					</div>
				</div>
				<input type="hidden" name="user_id">
				<input type="hidden" name="post_id">
				<button class="btn btn-primary btn-md fw-bold mt-1 send-enquiry">Send Enquiry</button>
			{!! Form::close() !!}							
			</div>
		</div>
  	</div>
</div>


<!-- Share Modal -->
<div class="modal fade" id="shareModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-SM">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title">Share</h6>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
        <!-- <p id="copyMessage" class="message">Link copied to clipboard!</p> -->
        <!-- <input type="text" value="" id="linkToCopy" readonly> -->
        <div class="d-flex align-items-center justify-content-evenly">
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" class="btn btn-outline-primary" target="_blank">
              <i class="bi bi-facebook"></i>
          </a>
          <a href="https://wa.me/?text={{ urlencode(url()->current()) }}" class="btn btn-outline-success" target="_blank">
              <i class="bi bi-whatsapp"></i>
          </a>
          <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" class="btn btn-outline-dark" target="_blank">
              <i class="bi bi-twitter-x"></i>
          </a>
          <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" class="btn btn-outline-primary" target="_blank">
              <i class="bi bi-linkedin"></i>
          </a>
          <!-- <a class="btn btn-outline-secondary" onclick="copyLink()"><i class="bi bi-link-45deg"></i></a>   -->
        </div>
			</div>
		</div>
  	</div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  function Rating(userId, id, name){
		$('#rating_user_id').val(userId);
		$('#rating_post_id').val(id);
		$('#RatingName').text(name);
		$('#reviewModel').modal('show');
  }
</script>

<script>
	function Enquire(userId, id, name) {
		$('input[name="user_id"]').val(userId);
		$('input[name="post_id"]').val(id);
		$('#EnquireName').text(name);
		$('#enquireModel').modal('show');
	}
</script>

<script>
  $(document).ready(function() {
      $('#toggleNumberBtn').click(function() {
          // Get the span element with id 'buttonText'
          var buttonTextElement = $('#buttonText');
          
          // Check the current text and toggle it
          if (buttonTextElement.text() === 'Show Number') {
              // Replace with the actual phone number
              buttonTextElement.text('{{$post->personals[0]->ph_number}}');
          } else {
              // Revert to 'Show Number'
              buttonTextElement.text('Show Number');
          }
      });
  });
</script>
<script>
  // Check if the Share API is supported
  if (navigator.share) {
    document.getElementById('shareButton').addEventListener('click', () => {
      // Data to share
      const shareData = {
        title: '{{$post->business_name}}',
        text: 'Check out this amazing website!',
        url: '{{ url($post->slug) }}'
      };
      navigator.share(shareData)
        .then(() => {
          console.log('Shared successfully!');
        })
        .catch((error) => {
          console.error('Error sharing:', error);
        });
    });
  } else {
    console.log('Share API not supported');
  }
</script>

<script>
  $(document).ready(function () {
      // Bind form submission for all forms with the class 'enquiryForm'
      $('.enquiryForm').on('submit', function (e) {
          e.preventDefault(); // Prevent the default form submission

          // Prepare form data
          let formData = $(this).serialize();

          // Identify the current form and its submit button
          let form = $(this);
          let submitButton = form.find('.send-enquiry');
          submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Submitting...');

          // Send AJAX request
          $.ajax({
              url: form.attr('action'), // Form's action attribute
              type: 'POST',
              data: formData,
              success: function (response) {
                  // Handle success response with SweetAlert
                  swal("Success!", "Query submitted successfully!", "success");

                  // Reset the form and remove any previous errors
                  form[0].reset();
                  form.find('.help-block').remove(); // Clear previous error messages
                  
                  // Re-enable the submit button
                  submitButton.prop('disabled', false).text('Send Enquiry');
              },
              error: function (xhr) {
                  // Handle error response
                  if (xhr.status === 422) { // Validation error
                      let errors = xhr.responseJSON.errors;

                      // Clear previous errors in the current form
                      form.find('.help-block').remove();

                      // Display validation errors next to the form fields
                      $.each(errors, function (key, message) {
                          let inputField = form.find(`[name="${key}"]`);
                          inputField.closest('.form-group')
                              .append(`<span class="help-block"><small style="color:red;">${message}</small></span>`);
                      });

                      // Show SweetAlert for validation errors
                      swal("Validation Error!", "Please correct the highlighted fields and try again.", "error");
                  } else {
                      // General error
                      swal("Error!", "Something went wrong. Please try again.", "error");
                  }

                  // Re-enable the submit button
                  submitButton.prop('disabled', false).text('Send Enquiry');
              }
          });
      });
  });
</script>
<script>
  $(document).ready(function () {
      $('#reviewForm').on('submit', function (e) {
          e.preventDefault(); // Prevent the default form submission
          // Prepare form data
          let formData = $(this).serialize();
          // Send AJAX request
          $.ajax({
              url: $(this).attr('action'), // Form's action attribute
              type: 'POST',
              data: formData,
              beforeSend: function () {
                  // Optional: Show a loader or disable the button
                  $('.send-review').prop('disabled', true).text('Submitting...');	
              },
              success: function (response) {
                  // Handle success response with SweetAlert
                  swal("Success!", response.message, "success");
                  $('#reviewForm')[0].reset(); // Reset the form
                  $('.send-review').prop('disabled', false).text('Send Review');
              },
              error: function (xhr) {
                  // Handle error response
                  if (xhr.status === 422) { // Validation error
                      let errors = xhr.responseJSON.errors;
                      $('.help-block').remove(); // Clear previous errors
                      $.each(errors, function (key, message) {
                          $(`[name="${key}"]`)
                              .closest('.form-group')
                              .append(`<span class="help-block"><small style="color:red;">${message}</small></span>`);
                      });

                      // Show SweetAlert for validation errors
                      swal("Validation Error!", "Please correct the highlighted fields and try again.", "error");
                  } else {
                      // Show SweetAlert for general errors
                      swal("Error!", "Something went wrong. Please try again.", "error");
                  }
                  $('.send-review').prop('disabled', false).text('Send Review');
              }
          });
      });
  }); 
</script>
<script>
  $(document).ready(function () {
      $('#reportForm').on('submit', function (e) {
          e.preventDefault(); // Prevent the default form submission
          // Prepare form data
          let formData = $(this).serialize();
          // Send AJAX request
          $.ajax({
              url: $(this).attr('action'), // Form's action attribute
              type: 'POST',
              data: formData,
              beforeSend: function () {
                  // Optional: Show a loader or disable the button
                  $('.send-report').prop('disabled', true).text('Submitting...');	
              },
              success: function (response) {
                  // Handle success response with SweetAlert
                  swal("Success!", response.message, "success");
                  $('#reportForm')[0].reset(); // Reset the form
                  $('.send-report').prop('disabled', false).text('Send Report');
              },
              error: function (xhr) {
                  // Handle error response
                  if (xhr.status === 422) { // Validation error
                      let errors = xhr.responseJSON.errors;
                      $('.help-block').remove(); // Clear previous errors
                      $.each(errors, function (key, message) {
                          $(`[name="${key}"]`)
                              .closest('.form-group')
                              .append(`<span class="help-block"><small style="color:red;">${message}</small></span>`);
                      });

                      // Show SweetAlert for validation errors
                      swal("Validation Error!", "Please correct the highlighted fields and try again.", "error");
                  } else {
                      // Show SweetAlert for general errors
                      swal("Error!", "Something went wrong. Please try again.", "error");
                  }
                  $('.send-report').prop('disabled', false).text('Send Report');
              }
          });
      });
  }); 
</script>
<script>
  $(document).ready(function () {
      $('#claimForm').on('submit', function (e) {
          e.preventDefault(); // Prevent the default form submission
          // Prepare form data
          let formData = $(this).serialize();
          // Send AJAX request
          $.ajax({
              url: $(this).attr('action'), // Form's action attribute
              type: 'POST',
              data: formData,
              beforeSend: function () {
                  // Optional: Show a loader or disable the button
                  $('.send-claim').prop('disabled', true).text('Submitting...');    
              },
              success: function (response) {
                  // Handle success response with SweetAlert
                  swal("Success!", response.message, "success");
                  $('#claimForm')[0].reset(); // Reset the form
                  $('.send-claim').prop('disabled', false).text('Send Claim');
              },
              error: function (xhr) {
                  // Handle error response
                  if (xhr.status === 422) { // Validation error
                      let errors = xhr.responseJSON.errors;
                      $('.help-block1').remove(); // Clear only the help-block1 elements
                      $.each(errors, function (key, message) {
                          $(`[name="${key}"]`)
                              .closest('.form-group')
                              .append(`<span class="help-block1"><small style="color:red;">${message}</small></span>`);
                      });

                      // Show SweetAlert for validation errors
                      swal("Validation Error!", "Please correct the highlighted fields and try again.", "error");
                  } else {
                      // Show SweetAlert for general errors
                      swal("Error!", "Something went wrong. Please try again.", "error");
                  }
                  $('.send-claim').prop('disabled', false).text('Send Claim');
              }
          });
      });
  });
</script>

<script>
        function toggleShareOptions() {
            var options = document.getElementById("shareOptions");
            options.style.display = options.style.display === "block" ? "none" : "block";
        }
    </script>
<script>
    function copyLink() {
        var copyText = document.getElementById("linkToCopy");
        copyText.select();
        copyText.setSelectionRange(0, 99999); 
        document.execCommand("copy");
        var message = document.getElementById("copyMessage");
        message.style.display = "block";

        setTimeout(function() {
            message.style.display = "none";
        }, 2000);
    }
</script>
@stop

{{--
  <?php 
                    $total = 0;
                    $counts = count($post->ratings);
                    foreach ($post->ratings as $check) 
                    {
                        $total+= $check->rating; 
                    }
                    if ($total == "") 
                    {
                      echo "<span style='font-size:15px!important;'> ( ".$counts." Reviews )</span>";
                    }
                    else
                    {
                        if($total > 0 && $counts > 0)
                        {
                          $review = $total/$counts;
                        }
                        else
                        {
                            $review = 0;
                        }
                  
                    if ($review < 2) 
                    {
                      echo "<span style='font-size:15px!important;' ><b class='btn btn-sm btn-success'>4.3</b> <i class='fa fa-star'></i> ( 180 Reviews )</span>";
                    }
                    elseif ($review < 3) 
                    {
                        echo "<span style='font-size:15px!important;'><b>".substr($review, 0,3)."</b> <i class='fa fa-star'></i><i class='fa fa-star'></i> ( ".$counts." Reviews )</span>";
                    }
                    elseif ($review < 4) 
                    {
                        echo "<span style='font-size:15px!important;'><b>".substr($review, 0,3)."</b> <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> ( ".$counts." Reviews )</span>";
                    }
                    elseif ($review < 5) 
                    {
                        echo "<span style='font-size:15px!important;'><b>".substr($review, 0,3)."</b> <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> ( ".$counts." Reviews )</span>";
                    }
                    elseif ($review < 6) 
                    {
                        echo "<span style='font-size:15px!important;'><b>".substr($review, 0,3)."</b> <i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i> ( ".$counts." Reviews )</span>";
                    }

                    }
              
                    ?>
  
  
  --}}
