@extends('layouts.app')
@section('head')
    <title>Address Guru</title>
    <meta name="description" content="Address Guru Is Online Local Business Directory That Provide Information About Your Daily Needs Just One Click Away. We Get Your Business Listed On It And Grow Online By Reaching Everyone Who Search You Online. You Can Post Your Advertisement, Create Enquiry Online About Any Business List, Share Your Thoughts About Your City. We Also Provide Services In Website Designing And Development To Promote Your Business And Services Through Internet And Make Your Online Presence. ">
    <meta name="keywords" content="">
    <link rel="canonical" href="https://www.addressguru.sg/">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Address Guru" />
    <meta property="og:description" content="Address Guru Is Online Local Business Directory That Provide Information About Your Daily Needs Just One Click Away. We Get Your Business Listed On It And Grow Online By Reaching Everyone Who Search You Online. You Can Post Your Advertisement, Create Enquiry Online About Any Business List, Share Your Thoughts About Your City. We Also Provide Services In Website Designing And Development To Promote Your Business And Services Through Internet And Make Your Online Presence. " />
    <meta property="og:url" content="https://www.addressguru.sg/" />
    <meta property="og:site_name" content="Address Guru" />
    <meta property="og:image" content="https://www.addressguru.sg/images/og.jpeg" />
    <meta property="og:locale" content="en_US" />
    <meta name="twitter:text:title" content="Address Guru" />
    <meta name="twitter:image" content="https://www.addressguru.sg/images/og.jpeg" />
    <meta name="twitter:card" content="Address Guru" />
    <script type="application/ld+json">
        {wE:<Tl
        "@context": "http://schema.org",
          "@type": "Organization",
          "url": "https://www.addressguru.sg",
          "logo": "https://www.addressguru.sg/images/logopng.png",
          "contactPoint" : [
            { "@type" : "ContactPoint",
              "telephone" : "+91-941-010-2425",
              "contactType" : "customer service"
            } ],
            "sameAs" : [ "https://www.facebook.com/addressguru.sg/",
            "https://www.youtube.com/channel/UC8WEXsO-s9N-ncxX4AVUH4Q",
            "https://twitter.com/AddressGuru",
            "https://www.instagram.com/addressguru/"]       
        }
    </script>
    <style>
        .container-fluid{
            width:75%;
        }
        .recent_box .inner_box{
            padding:10px 15px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- Demo styles -->
<style>
  .swiper {
    width: 100%;
    height: 100%;
    border-radius:10px;

  }

  .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  .static-category-icon{
    font-size:30px;
  }
  .static-category{
    text-align:center;
    box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;
  }
  .popular-category small{
    font-size: .675em;
  }
  .popular-category .card{
    width: 50px;
    height: 50px;
    border: none;
    border-radius: 12px;
  }
/* Swiper Container */
.categorySwiper {
    width: 100%;
    height: auto; /* Adjust based on your design */
    position: relative; /* Required for Swiper to position elements */
}

/* Scrollbar Track */
.swiper-scrollbar {
    height: 8px; /* Adjust scrollbar height */
    background-color: #e0e0e0; /* Track background */
    border-radius: 4px; /* Rounded edges */
    margin-top: 10px; /* Add space below the slider */
}

/* Scrollbar Drag Handle */
.swiper-scrollbar-drag {
    background-color: #007bff; /* Draggable handle color */
    border-radius: 4px; /* Rounded handle */
}

.mobile-screen{
    display:none
}

.desktop-screen{
        display:block
    }

  @media (max-width: 768px) {
    .container {
        margin-top: 30px ! important;
        padding: 0px 7px;
    }
    .mobile-screen{
        display:block
    }
    .desktop-screen{
        display:none
    }
    footer{
        display:none;
    }
}
</style>

<style>
        .search-section {
            background-color: #0052cc;
            color: white;
            padding: 40px 0;
            height:300px;
            text-align: center;
            position: relative;
        }
        .search-box {
            display: flex;
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 5px;
            overflow: hidden;
        }
        .search-box select,
        .search-box input {
            border: none;
            padding: 10px;
            outline: none;
        }
        .search-box select {
            flex: 1;
        }
        .search-box input {
            flex: 2;
        }
        .search-box button {
            background: #ff6600;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }
        .stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 20px;
        }
        .stats div {
            text-align: center;
        }
        .woman-image {
            position: absolute;
            top: 33px;
            right: 360px;
            transform: translateY(-50%);
            max-width: 400px;
        }
        @media (max-width: 768px) {
            .woman-image {
                position: static;
                transform: none;
                display: block;
                margin: 20px auto 0;
            }
        }
    </style>
@endsection


@section('content')
@php
$cities = App\Personal::where('city', '!=', 'select')->where('status', '=', 1)->pluck('city'); 
$cities = collect($cities);
$cities = $cities->unique()->values()->all();
@endphp
<div class="row">
    @if(Session::has('send'))
        <div class="alert alert-success">
            <strong> {{session('send')}}</strong>
        </div>
    @endif
    @if(Session::has('no'))
        <div class="alert alert-danger">
            <strong> {{session('no')}}</strong>
        </div>
    @endif
</div>

<section class="section mt-3 ">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="card rounded-0" >
                <div class="card-body p-0">
                    <div class="mobile-screen px-3">
                        <!-- SEARCH bAR  -->
                        <div class="col-xl-4">
                            <div class="mobile-form1 mb-2">
                                <form class="d-flex">
                                    <div class="d-flex mobile-search" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;border-radius:10px;">
                                        <input class="form-control border-0" type="search" placeholder="Search By AddressGuru.." aria-label="Search By AddressGuru">
                                        <button class="btn btn-outline-success border-0" type="submit">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    
                        <!-- Banner section  -->
                        <div class="swiper mySwiper mb-2" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" style=" height:150px;"><img src="https://static.vecteezy.com/system/resources/thumbnails/040/940/567/small/songkran-water-festival-travel-thailand-flowers-in-a-water-bowl-water-splashing-thailand-tourism-architecture-banner-design-on-cloud-and-sky-blue-background-eps-10-illustration-vector.jpg" alt=""></div>
                                <div class="swiper-slide"  style=" height:150px;"><img src="https://images.freecreatives.com/wp-content/uploads/2016/09/travel-banners.jpg" alt=""></div>
                            </div>
                        </div>

                        <!-- Popular Category  -->
                        <div class="col-12 my-4 popular-category">
                            <div class="d-flex justify-content-between">
                                <h2 class="heading text-dark" ><b>Popular Category</b></h2>
                                <p class="text-warning fw-medium">See all > </pack>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3 ">
                                    <center>
                                        <a href="{{url('/jobs')}}">
                                    <div class="card py-1 static-category text-danger" style="background: #f9b1b1;">
                                        <i class="bi bi-person static-category-icon"></i>
                                    </div>
                                    </a>
                                <small class="fw-bold">Jobs</small></center>
                                </div>
                                <div class="col-3">
                                <center>
                                    <a href="{{url('/marketplace')}}">
                                    <div class="card py-1  static-category" style="background: #ffe491bf;color: #f5a20a;">
                                    <i class="bi bi-cart3 static-category-icon"></i>
                                    </div>
                                    </a>
                                <small class="fw-bold">Marketplace</small></center>
                                </div>
                                <div class="col-3">
                                <center>
                                    <a href="{{url('/property')}}">
                                    <div class="card py-1 static-category text-primary" style="background: #b4b4ff;">
                                        <i class="bi bi-person static-category-icon"></i>
                                    </div>
                                    </a>
                                <small class="fw-bold">To Let</small></center>
                                </div>
                                <div class="col-3">
                                <center>
                                    <a href="javascript:void(0);" class="category-link" data-category="Hotel" data-category-id="9">
                                    <div class="card py-1  static-category" style="color: #ff8399;background: #ffc6d0;">
                                        <i class="bi bi-person static-category-icon"></i>
                                    </div>
                                    </a>
                                <small class="fw-bold">Hotel</small></center>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3">
                                <center>
                                    <a href="javascript:void(0);" class="category-link" data-category="Taxi Service" data-category-id="8">
                                    <div class="card py-1 static-category" style="color: #00a7eb;background: #a3d9efd1;">
                                        <i class="bi bi-taxi-front-fill  static-category-icon"></i>
                                    </div>
                                    </a>
                                    <small class="fw-bold">Taxi Service</small></center>
                                </div>
                                <div class="col-3">
                                <center>
                                    <a href="javascript:void(0);" class="category-link" data-category="Schools" data-category-id="20">
                                    <div class="card py-1 static-category" style="color: teal;background: #57e1c15c;">
                                        <i class="bi bi-person static-category-icon"></i>
                                    </div>
                                    </a>
                                    <small class="fw-bold">Schools</small></center>
                                </div>
                                <div class="col-3">
                                <center>
                                    <a href="javascript:void(0);" class="category-link" data-category="Home Services" data-category-id="42">
                                    <div class="card py-1 static-category" style="background: #ffe491bf;color: #f5a20a;">
                                        <i class="bi bi-house-heart-fill static-category-icon"></i>
                                    </div>
                                    </a>
                                    <small class="fw-bold">Home Services</small></center>
                                </div>
                                <div class="col-3">
                                <center>
                                    <a href="javascript:void(0);" class="category-link" data-category="Cafe & Restaurants" data-category-id="13">
                                    <div class="card py-1 static-category" style="background: #cbcac7bf;color: #020202;">
                                        <i class="bi bi-person static-category-icon"></i>
                                    </div>
                                    </a>
                                    <small class="fw-bold">Restaurant</small></center>
                                </div>
                            </div>
                        </div>

                        <!-- category section  -->
                        <div class="swiper categorySwiper">
                            <div class="d-flex justify-content-between p-2 my-2 align-items-center">
                                <h2 class="heading text-dark m-0"><b>Looking for</b></h2>
                                <p class="text-warning fw-medium m-0">See all ></p>
                            </div>
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                @foreach($category->chunk(20) as $chunk)
                                <div class="swiper-slide">
                                    <div class="row p-2">
                                        @foreach($chunk as $cate)
                                        <div class="col-md-2 col-3 px-2 main-box">
                                            <a href="javascript:void(0);" class="category-link" data-category="{{ $cate->name }}" data-category-id="{{ $cate->id }}">
                                                <div class="p_box"> 
                                                    <span style="font-size:25px;color:{{ $cate->colors }};"><i class="{{ $cate->icon }}"></i></span>
                                                    <p>{{ $cate->name }}</p>
                                                </div>
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-scrollbar"></div>
                        </div>

                        <!-- post banner  -->
                        <div class="swiper mySwiper my-2">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" style=" height:150px;">
                                    <a href="#">
                                     <img src="images/home/business-banner.png" alt="business-banner">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- listing section  -->
                        <div class="col-12 my-4 recent-listing">
                            <div class="d-flex justify-content-between">
                                <h2 class="heading text-dark" ><b>Recent Listings</b></h2>
                            </div>
                            <div class="row mt-2">
                                @foreach($ads as $ad)
                                    <div class="col-6 my-1 px-2">  
                                        <div class="card" style="width: 100%;height: 228px;box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;">
                                            <a href="{{url('/', $ad->slug)}}" class="text-dark">
                                                <div class="div" style="width: 100%;height: 150px;background: #ccc;">
                                                    <img src="{{url('/')}}/images/{{$ad->photo}}"  class="card-img-top img-responsive" alt="{{$ad->business_name}}" style="height: 100%;object-fit:cover">
                                                </div>
                                                <div class="card-body p-2">
                                                    <h6 class="card-title fw-bold mb-0  style="font-size:15px">{{substr($ad->business_name, 0, 15    )}}..</h6>
                                                    <p class="card-text my-1 mx-0" style="color:{{$ad->category->colors}};"><i class="fa-fw {{$ad->category->icon}}"></i>  {{$ad->category->name}}</p>
                                                    <p class=" m-0 d-flex justify-content-between align-items-center">
                                                    <small><i class="bi bi-geo-alt-fill" style="color:orange"></i>{{$ad->personals[0]->city}}</small>
                                                    <small>{{$ad->updated_at->diffForHumans()}}</small>
                                                    </p>
                                                    </p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>   

                          <!-- MArketplace banner  -->
                        <div class="swiper mySwiper my-2">
                            <div class="swiper-wrapper">
                            <div class="swiper-slide"  style="height:100px;"><img src="images/home/market-banner.png" alt="market-banner" style="object-fit: contain;"></div>
                            </div>
                        </div>

                        <div class="mb-5">
                            <h2 class="heading text-dark" ><b>Most View Listings</b></h2>
                            <a href="{{url('/jobs')}}">
                                <img src="images/home/job-banner.jpg" alt="market-banner" style="object-fit:cover;width:100%;border-radius:10px;">
                            </a>
                        </div>
                    </div>
                

                    <div class="desktop-screen">
                    <section class="search-section position-relative">
                        <div class="container mt-5 pt-4">
                            <div class="row">
                                <div class="col-6">
                                    <div class="search-box">
                                        <select id="cityDropdown" class="ctydd" data-live-search="true">
                                        <option value="Singapore" selected>Singapore</option>
                                        @foreach($cities as $city)
                                            @if($city != null)
                                            <option value="{{ $city }}">{{ $city }}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                        <input type="text" placeholder="Taxi Service in Singapore">
                                        <button><span>&#128269;</span></button>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <img src="/images/woman-pointing.webp" alt="Woman Pointing" class="woman-image" style="    transform: scale(-1, 1);">
                                </div>
                                <div class="col-4">
                                    <h2 style="font-size:2.5rem; font-weight:800">1.5 LAKH +</h2>
                                    <p>REGISTERED BUSINESS</p>
                                </div>      
                            </div>            
                        </div>
                    </section>
                   
                
                        <!-- category section  -->
                        <section class="section">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card rounded-0">
                                        <div class="card-body p-4">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="row text-center"> 
                                                    @foreach($category as $cate)
                                                    <div class="col-md-2 col-4 main-box" style="padding:0px;">
                                                        <a href="javascript:void(0);" class="category-link" data-category="{{ $cate->name }}" data-category-id ="{{$cate->id}}">
                                                            <div class="p_box"> 
                                                                <span style="font-size:50px;color:{{$cate->colors}};"><i class="{{$cate->icon}}"></i></span>
                                                                <br/>
                                                                <p>{{$cate->name}}</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-3 left-border">
                                                <div class="row">
                                                    <!-- <div class="col-md-12">
                                                        <a href="{{url('marketplace-post')}}" class="border-a">
                                                        <div class="border" style="background-color:yellow;border:1px solid yellow;">
                                                        <i class="fa fa-edit"></i> Post Free Ad
                                                        </div>
                                                        </a>
                                                    </div> -->
                                                    <div class="col-md-12">
                                                        <a href="https://www.addressguru.in/jobs/city/Dehradun" class="border-a">
                                                            <div class="border" style="background-color:yellow;border:1px solid yellow;">
                                                            <i class="fa fa-search fa-fw"></i> Find Jobs
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <a href="{{route('banner-ad.index')}}" class="border-a">
                                                        <div class="border" style="background-color:orange;border:1px solid orange;">
                                                        <i class="fa fa-buysellads"></i> Post Banner Ad
                                                        </div>
                                                        </a>
                                                    </div>
                                                </div><br/>
                                                <div class="thumbnail index-page">
                                                    <a href="#" rel="nofollow"><img src="{{url('/')}}/images/newbanner.jpeg" alt="Dehradun School Of Online Marketing" class="img-responsive"></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                         <!-- Recent listing section   -->
                        <section class="section mt-3 ">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card rounded-0" >
                                        <div class="card-body">
                                            <div class="row">
                                            <div class="col-md-12">
                                                <h2 class="heading" style="margin:0px;"><b>Recent Listings</b></h2><hr/>
                                            </div>
                                            @foreach($ads as $ad)
                                            <div class="col-md-4">  
                                                <a href="{{url('/', $ad->slug)}}" class="recent_box">
                                                    <div class="inner_box">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <center><img src="{{url('/')}}/images/{{$ad->photo}}" class="img-responsive" alt="{{$ad->business_name}}"></center>
                                                            </div>
                                                            <div class="col-1"></div>
                                                            <div class="col-8">
                                                                <h6 class="text-dark">{{substr($ad->business_name, 0, 50)}}</h6>
                                                                <p style="color:{{$ad->category->colors}};"><i class="fa-fw {{$ad->category->icon}}"></i> {{$ad->category->name}}</p>
                                                                <small>{{$ad->updated_at->diffForHumans()}}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                                <!-- service section start  -->
                                <section class="section mt-3">
                                    <div class="row">
                                        <div class="col-lg-12 text-center">
                                            <h2 class="heading"><b></span></b></h2>
                                        </div>
                                        <!-- <div class="col-lg-12 mt-3">
                                            <div class="card">
                                                <div class="card-body p-4">
                                                    <div class="row">
                                                        <div class="col-sm-4 mt-3">
                                                            <div class="card text-center">
                                                            <div class="card-body">
                                                            <img src="images/seo.png" class="img-responsive" alt="SEO Services" width="200px">
                                                                <h5 class="card-title text-center"><a href="https://www.universalwebsolutions.in/digital.php" rel="nofollow" target="_blank">SEO Services</a></h5>
                                                                <p class="card-text">Our Digital Marketing experts will assist you with the best social media marketing strategy for your business to get connected to the people, our experts with the digital marketing tools will also help you out to get the optimum your website.</p>
                                                                <a href="http://www.universalwebsolutions.in/digital.php" class="btn btn-primary">View Details</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 mt-3">
                                                            <div class="card text-center">
                                                            <div class="card-body">
                                                            <img src="images/development.png" class="img-responsive" alt="Web Designing & Development" >
                                                                <h5 class="card-title text-center"><a href="https://www.universalwebsolutions.in/web.php" rel="nofollow" target="_blank">Web Designing & Development</a></h5>
                                                                <p class="card-text">We provide the best place to grow with your website. Our company provide the best web developer and web design services, our services include creative web designing, small business website design, corporate website design etc..</p>
                                                                <a href="http://www.universalwebsolutions.in/web.php" class="btn btn-primary">View Details</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 mt-3">
                                                            <div class="card text-center">
                                                            <div class="card-body text-center">
                                                            <img src="images/hosting.png" class="img-responsive" alt="Web Hosting" width="200px">
                                                                <h5 class="card-title"><a href="https://www.universalwebsolutions.in/hosting.php" rel="nofollow" target="_blank">Web Hosting</a></h5>
                                                                <p class="card-text">If you're thinking for a platfrom for web hosting, We are the best web hosting services. We provide VPS hosting, Email hosting, Reseller hosting, cheap web hosting, Domain hosting and Server Hosting. Visit us and grab some amazing delas.</p>
                                                                <a href="http://www.universalwebsolutions.in/hosting.php" class="btn btn-primary">View Details</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </section>
                                <!-- service section end  -->
        
                                <!-- Service 7 - Bootstrap Brain Component -->
                                <section class="section mt-3">
                                    <div class="row justify-content-md-center">
                                    <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                                        <h3 class="fs-5 mb-2 text-secondary text-center text-uppercase">Services</h3>
                                        <h2 class="display-5 mb-5 mb-xl-9 text-center">Trusted By 1,000 Web Hosts For Domains & Hosting.</h2>
                                    </div>
                                    </div>
        
                                    <div class="row">
                                    <div class="col-12 overflow-hidden mt-3">
                                            <div class="row gy-4">
                                            <div class="col-12 col-sm-4">
                                                <div class="card border-0 border-bottom border-primary shadow-sm">
                                                <div class="card-body text-center p-4 p-xxl-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-heart-pulse text-primary mb-4" viewBox="0 0 16 16">
                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053.918 3.995.78 5.323 1.508 7H.43c-2.128-5.697 4.165-8.83 7.394-5.857.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17c3.23-2.974 9.522.159 7.394 5.856h-1.078c.728-1.677.59-3.005.108-3.947C13.486.878 10.4.28 8.717 2.01L8 2.748ZM2.212 10h1.315C4.593 11.183 6.05 12.458 8 13.795c1.949-1.337 3.407-2.612 4.473-3.795h1.315c-1.265 1.566-3.14 3.25-5.788 5-2.648-1.75-4.523-3.434-5.788-5Z" />
                                            <path d="M10.464 3.314a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.5a.5.5 0 0 0 0 1H4a.5.5 0 0 0 .416-.223l1.473-2.209 1.647 4.118a.5.5 0 0 0 .945-.049l1.598-5.593 1.457 3.642A.5.5 0 0 0 12 9h3.5a.5.5 0 0 0 0-1h-3.162l-1.874-4.686Z" />
                                            </svg>
                                                    <h4 class="mb-4">SEO Services</h4>
                                                    <p class="mb-4 text-secondary">Our Digital Marketing experts will assist you with the best social media marketing strategy for your business to get connected to the people, our experts with the digital marketing tools will also help you out to get the optimum your website.</p>
                                                    <a href="#!" class="fw-bold text-decoration-none link-primary">
                                                    Learn More
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                                    </svg>
                                                    </a>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="card border-0 border-bottom border-primary shadow-sm">
                                                <div class="card-body text-center p-4 p-xxl-5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-laptop text-primary mb-4" viewBox="0 0 16 16">
                                                    <path d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z" />
                                                    <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                                    </svg>
                                                    <h4 class="mb-4">Web Designing & Development</h4>
                                                    <p class="mb-4 text-secondary">We provide the best place to grow with your website. Our company provide the best web developer and web design services, our services include creative web designing, small business website design, corporate website design etc..</p>
                                                    <a href="#!" class="fw-bold text-decoration-none link-primary">
                                                    Learn More
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                                    </svg>
                                                    </a>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="card border-0 border-bottom border-primary shadow-sm">
                                                <div class="card-body text-center p-4 p-xxl-5">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="56" height="56" fill="currentColor" class="bi bi-shield-check text-primary mb-4" viewBox="0 0 16 16">
                                                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z" />
                                                <path d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                </svg>
                                                    <h4 class="mb-4">Web Hosting</h4>
                                                    <p class="mb-4 text-secondary">If you're thinking for a platfrom for web hosting, We are the best web hosting services. We provide VPS hosting, Email hosting, Reseller hosting, cheap web hosting, Domain hosting and Server Hosting. Visit us and grab some amazing delas.</p>
                                                    <a href="#!" class="fw-bold text-decoration-none link-primary">
                                                    Learn More
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                                    </svg>
                                                    </a>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                    </div>
                                    </div>
                                </section>
        
                                <!-- testimonial section start  -->
                                <section class="section mt-5 mb-3">
        
                                    <div class="row justify-content-md-center">
                                    <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                                        <h3 class="fs-5 mb-2 text-secondary text-center text-uppercase">Testimonial's</h3>
                                        <h2 class="display-5 mb-5 mb-xl-9 text-center">Trusted By 1,000 Web Hosts For Domains & Hosting.</h2>
                                    </div>
                                    </div>
        
                                    <div class="row">
                                    <div class="col-12 overflow-hidden mt-3">
                                            <div class="row gy-4">
                                            <div class="col-12 col-sm-4">
                                                <div class="card border-0 border-bottom border-primary shadow-sm">
                                                    <div class="card-body text-center p-4 p-xxl-5">
                                                        <h4 class="mb-4">Testimonial's</h4>
                                                        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                                                            <!-- Wrapper for slides -->
                                                            <div class="carousel-inner">
                                                                <div class="carousel-item active">
                                                                    <p>Best website for business promotion. We can promote our video, photo, google map and about our self also & best best part is there's no ad's in our land page. Best classified website for business.</p>
                                                                    <center><span>-Nabh Joshi</span></center>
                                                                </div>
        
                                                                <div class="carousel-item">
                                                                    <p>Best website for business promotion. We can promote our video, photo, google map and about our self also & best best part is there's no ad's in our land page. Best classified website for business.</p>
                                                                    <center><span>-Vishal Bhat</span></center>
                                                                </div>
        
                                                                <div class="carousel-item">
                                                                    <p>Best website for business promotion. We can promote our video, photo, google map and about our self also & best best part is there's no ad's in our land page. Best classified website for business.</p>
                                                                    <center><span>-Atul Singh</span></center>
                                                                </div>
                                                            </div>
        
                                                            <!-- Optional: Add controls -->
                                                            <a class="carousel-control-prev" href="#myCarousel" role="button" data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </a>
                                                            <a class="carousel-control-next" href="#myCarousel" role="button" data-bs-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </a>
                                                        </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="card border-0 border-bottom border-primary shadow-sm">
                                                <div class="card-body text-center p-4 p-xxl-5">
                                                    <h4 class="mb-4">Contact Us</h4>
                                                    <h5 class="card-title text-center" style="color:#428BCA;"></h5>
                                                    <p class="mb-4 text-secondary"><i class="fa fa-address-book fa-fw"></i> 83 PUNGGOL CENTRAL WATERWAY POINT MALL SINGAPORE 828761 </p>
                                                        <i class="fa fa-envelope fa-fw"></i> contact@addressguru.sg<br/>
                                                        <i class="fa fa-globe fa-fw"></i> www.addressguru.sg
                                                    </a>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="card border-0 border-bottom border-primary shadow-sm">
                                                <div class="card-body text-center p-2">
                                                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FAddress-Guru-1638707256426228%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=107982439853561"  height="228" style="border:none;overflow:hidden;" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
        
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                    </div>
                                    </div>
                                </section>
                                <!-- testimonial section end  -->
                    </div>
                </div>                  
            </div>        
        </div>
    </div>
</section>
<!-- js section  -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    document.querySelectorAll('.category-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            var selectedCity = document.getElementById('cityDropdown').value;
            var city = selectedCity.replace(/\s+/g, '-'); 
            if (selectedCity === "") {
                e.preventDefault();
                swal("Please select a city before proceeding.");
            } else {
                var categoryName = link.getAttribute('data-category').toLowerCase().replace(/\s+/g, '-'); // Replaces spaces with hyphens
                var categoryId = link.getAttribute('data-category-id').toLowerCase();
                var updatedUrl = "{{ url('') }}/" + categoryName + "/" + encodeURIComponent(city.toLowerCase());
                window.location.href = updatedUrl;
            }
        });
    });
</script>
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {});
  </script>

</div>


<script>
  var swiper = new Swiper(".mySwiper", {
    loop: true, // Enables continuous loop mode
    autoplay: {
      delay: 3000, // Delay between slides in milliseconds
      disableOnInteraction: false, // Keep autoplay running even after user interaction
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true, // Allow clicking on pagination dots
    },
  });
</script>

<script>
    const swiper = new Swiper('.categorySwiper', {
        slidesPerView: 1, // Adjust based on your layout
        spaceBetween: 10, // Space between slides
        scrollbar: {
            el: '.swiper-scrollbar',
            draggable: true, // Make the scrollbar draggable
        },
        grabCursor: true, // Optional: improves UX
    });
</script>

@endsection
