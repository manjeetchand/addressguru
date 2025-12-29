@extends('layouts.app')
@php
$cities = App\Personal::where('city', '!=', 'select')->where('status', '=', 1)->pluck('city'); 
$cities = collect($cities);
$cities = $cities->unique()->values()->all();
@endphp
  @section('head')
    <title>List of Top {{$category->name}} in {{$city}} | Address Guru</title>
    <meta name="description" content="List of top best {{$category->name}} in {{$city}} {{$category->des}} in {{$city}}">
    <meta name="keywords" content="List of {{count($data)}} {{$category->name}} in {{$city}}, {{count($data)}} best {{$category->name}} in {{$city}}, top {{count($data)}} {{$category->name}} in {{$city}}, Get contact details of {{count($data)}} {{$category->name}} in {{$city}}">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="List of Top {{$category->name}} in {{$city}} | Address Guru" />
    <meta property="og:description" content="List of top best {{$category->name}} in {{$city}} {{$category->des}} in {{$city}}" />
    <meta property="og:site_name" content="Address Guru" />
    <meta property="og:image" content="/images/address.png" />
    <meta property="og:locale" content="en_US" />
    <meta name="twitter:text:title" content="List of Top {{$category->name}} in {{$city}} | Address Guru" />
    <meta name="twitter:image" content="/images/address.png" />
    <meta name="twitter:card" content="List of Top {{$category->name}} in {{$city}} | Address Guru" />
    <link rel="canonical" href="{{url('/')}}/{{$category->name}}/{{$city}}/{{base64_encode($category_id)}}">
    <script type="application/ld+json">
      {
        "@context": "http://schema.org",
        "@type": "WebSite",
        "name": "Address Guru",
        "url": "https://www.addressguru.in"
      }
    </script>
    <script type="application/ld+json">
      {   
        "@context": "http://schema.org",
        "@type": "ItemList",
        "itemListElement" : 
          [
            <?php $co = 1; $myArray = array(); ?>
            @foreach($data as $key => $value)
              @if(isset($value[0]))
              <?php 
                if($value[0]->category->id == 52){
                  $myArray[] = '{
                  "@type":"ListItem",
                  "position":'.$co.',
                  "url":"http://addressguru.in/profiles/'.$value[0]->slug.'"
                  }';
                }else{
                  $myArray[] = '{
                  "@type":"ListItem",
                  "position":'.$co.',
                  "url":"http://addressguru.in/profiles/'.$value[0]->slug.'"
                  }';
                }
                ?>
              @endif
              <?php $co++; ?>
            @endforeach
            <?php echo implode( ', ', $myArray ); ?>
          ]     
      }
    </script>
    <script type="application/ld+json">
      [
        {
          "@context":"http://schema.org"
          "@type":"Organization",
          "name":"addressguru.in",
          "url":"https://www.addressgugu.in/",
          "logo":"https://www.addressguru.in/images/logopng.png",
            "sameAs":
          [ "https://www.facebook.com/addressguru.in/",
                  "https://www.youtube.com/channel/UC8WEXsO-s9N-ncxX4AVUH4Q",
                  "https://twitter.com/AddressGuru",
                  "https://www.instagram.com/addressguru/"]
        }
      ]
    </script>
    <style>
      .mobile-screen{
        display:none;
      }
      .rating{
        margin:0;
      }
      .container{
        max-width:1440px ;
        margin-top:25px ! important;
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
        .img-landpage{
          height:120px;
        }
        .container{
          padding:0;
        }
        .manjeet{
          margin: 0 0px;
        }
        .container{
          margin-top:50px ! important;
        }
      }
    </style>
  @endsection
  @section('content')
  <?php 
	use App\Coaching;
	use App\Rating;
  ?>
    <div class="desktop-screen">
      @include('posts.new')
    </div>
  </div>
</div>
<div class="mobile-screen">
  <section class="section mt-3 ">
    <div class="row">
      <div class="col-lg-12 p-0">
        <div class="card rounded-0" style="border: none;background: #f8f9fa;" >
          <div class="card-body px-3">
            <div class="row align-items-center">
              <div class="col-xl-4 col-9">
                  <div class="mobile-form1">
                      <form class="d-flex">
                          <div class="d-flex mobile-search" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 5px 0px, rgba(0, 0, 0, 0.1) 0px 0px 1px 0px;border-radius:10px;">
                              <button class="btn btn-outline-success border-0">
                                  <i class="fa fa-search" aria-hidden="true"></i>
                              </button>
                              <input class="form-control border-0" type="search" placeholder="Search By AddressGuru.." aria-label="Search By AddressGuru">
                          </div>
                      </form>
                  </div>
               </div>
               <div class="col-3">
               <i class="bi bi-funnel-fill"></i> Filter
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <center class="fw-bold"><small style="font-size: .775em;">Found total 15 Listings for {{$category->name}} in {{$city}}</small></center>
  <div class="container-sm px-1">
    <section class="section">
      <div class="row manjeet">
        <div class="card">
          <div class="card-body px-0 py-1">
            <div class="col-lg-12">
              <div class="row d-flex align-items-top justify-content-evenly">
                @forelse($data as $key => $value)
                  <div class="col-12 border-bottom border-secondary-subtle py-1">
                      @if(isset($value[0]) && $value[0]->paid <= 1)
                        <?php $rating = Rating::where('post_id', '=', $value[0]->id)->where('status', '=', 1)->get();?>
                        <a href="{{url('/', $value[0]->slug)}}">
                          <div class="row">
                            <div class="col-4">
                              @if($value[0]->category->id == 52)
                                <a href="{{url('/profiles', $value[0]->slug)}}">
                                  <img src="{{url('/')}}/images/{{$value[0]->photo}}" alt="{{$value[0]->business_name}}" class="img-fluid img-landpage">
                                  @if($value[0]->paid != 0)
                                    <span class="verified-circle">
                                      <img src="{{url('/')}}/images/verify.png" class="verifyicon" alt="{{$value[0]->business_name}}">
                                    </span>
                                  @endif
                                </a>
                              @else
                                <a href="{{url('/', $value[0]->slug)}}">
                                  <img src="{{url('/')}}/images/{{$value[0]->photo}}" alt="{{$value[0]->business_name}}" class="img-fluid img-landpage">
                                  @if($value[0]->paid != 0)
                                    <span class="verified-circle">
                                      <img src="{{url('/')}}/images/verify.png" class="verifyicon" alt="{{$value[0]->business_name}}">
                                    </span>
                                  @endif
                                </a>
                              @endif
                            </div>
                            <div class="col-8 py-1" style="padding-left:0;">
                              @if($value[0]->category->id == 52)
                                <a href="{{url('/profiles', $value[0]->slug)}}" class="search-heading">
                                  <h6 class="fw-bold text-dark mb-1" style="font-size: 14px">{{$value[0]->business_name}}</h6>
                                </a>
                              @else
                                <a href="{{url('/', $value[0]->slug)}}" class="search-heading">
                                  @php
                                  $businessName = $value[0]->business_name;
                                  $words = explode(' ', $businessName);
                                  $substring = '';
                                  foreach ($words as $word) {
                                      if (strlen($substring . ' ' . $word) <= 30) {
                                          $substring .= ($substring ? ' ' : '') . $word;
                                      } else {
                                          break;
                                      }
                                    }
                                  $address = $value[0]->business_address;
                                  $words1 = explode(' ', $address);
                                  $substring1 = '';
                                  foreach ($words1 as $word2) {
                                      if (strlen($substring1 . ' ' . $word2) <= 30) {
                                          $substring1 .= ($substring1 ? ' ' : '') . $word2;
                                      } else {
                                          break;
                                      }
                                    }
                                  @endphp
                                  <h6 class="fw-bold text-dark mb-1" style="font-size: 14px">{{$substring}}</h6>
                                </a>
                              @endif
                              <small style="font-size: 12px"><i class="bi bi-geo-alt-fill" style="color:orange"></i> {{$substring1}}</small>
                              @if($value[0]->category->id == 19)
                                <span class="d-md-none" style="font-size:11px;font-family:arial;">
                                  <i class="fa fa-calendar fa-fw" ></i> {{date('d F, Y', strtotime($value[0]->created_at))}}
                                </span>
                              @endif
                              @php
                              $ratingsSum = $value[0]->ratings->sum('rating'); 
                              $ratingsCount = $value[0]->ratings->count();
                              $rating = $ratingsCount > 0 ? $ratingsSum / $ratingsCount : 0; 
                            @endphp
                            @if($ratingsCount > 0)
                            <div class="rating ">	
                              @for($i = 0; $i < 5; $i++)
                                <i class="fa fa-star{{ $i < round($rating) ? '' : '-o' }}"></i>
                              @endfor
                              <b> {{ number_format($rating, 1) }} </b>
                              <small>({{ $ratingsCount > 0 ? $ratingsCount : 'No' }} Review{{ $ratingsCount != 1 ? 's' : '' }})</small>
                            </div>  
                            @else
                            <br><br>
                            @endif  
                              <div class="d-flex justify-content-flex-start gap-3 mt-2">
                                @if(isset($value[0]->personals[0]->ph_number1))
                                  <button type="button" class="btn btn-success btn-sm fw-medium" onclick="PhoneNmmber('{{$value[0]->business_name}}',{{$value[0]->personals[0]->ph_number}},{{$value[0]->personals[0]->ph_number1 }})">
                                    <i class="bi bi-telephone-fill" ></i><span style="font-size: 12px"> Call Now</span>
                                  </button>
                                  @else
                                  <button type="button" class="btn btn-success btn-sm fw-medium">
                                    <a href="tel:{{ $value[0]->personals[0]->ph_number }}" class="text-light">
                                    <i class="bi bi-telephone-fill" ></i><span class="buttonText" style="font-size: 12px"> Call Now</span>
                                    </a>
                                  </button>
                                  @endif
                                  <button type="button" class="btn btn-primary btn-sm	fw-medium" onclick="Enquire({{$value[0]->user_id}},{{$value[0]->id}},'{{$value[0]->business_name}}')">
                                    <i class="bi bi-chat-quote-fill"></i> <span style="font-size: 12px" > Enquire Now</span>
                                  </button>
                              </div>
                            </div>
                          </div>  
                        </a> 
                      @endif
                      </div>
                @empty
                  <p>No Data Found</p>
                @endforelse
              </div>
            </div>
            <center class="mb-1 mt-2">
                <button class="btn btn-outline-success btn-sm" style="width:90%">View More</button>
            </center>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<div class="col-md-12 listing-down">
									<div style="background-color:#fff;padding:15px;margin-bottom:15px;box-shadow:0px 0px 4px #ccc;">
										<strong style="font-size:15px;">Here's the list of top 20  {{$category->name}} in {{$city}} </strong>
										<br>
										<br>
							{{--		@forelse($data as $key => $value)			
											<strong style="color:#000302;">{{$key+1}}. <a style="color:#000302;" href="https://www.addressguru.in/noodle-house-restaurant-n-cafe">{{$value[0]->business_name}}</a></strong>
											<p style="color:#000302;font-size:12px;">{{substr($value[0]->ad_description,0, 400)}}...</p>
										@empty
										@endforelse --}}
										</div>
								</div>
    <!-- Enquire Modal -->
    <div class="modal fade" id="enquireModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h6 class="modal-title">Enquire: <strong><span id="EnquireName"></span></strong></h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          {!! Form::open(['action'=>'QueryInsert@store', 'id'=>'enquiryForm']) !!}
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
            <button class="btn btn-primary btn-md fw-bold mt-1 send-enquiry">Send Enquiry</button>
          {!! Form::close() !!}							
          </div>
        </div>
        </div>
    </div>
    <!-- Phone Modal -->
    <div class="modal fade" id="numberModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header p-2">
            <h6 class="modal-title">Contact <strong><span id="PhoneName"></span></strong></h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <table>
              <thead>
                <tr>
                  <th>Sr No.</th>
                  <th>Phone no. </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td id="phone_no"></td>
                  <td id="phone_no_call">
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td id="phone_no1"></td>
                  <td id="phone_no_call1">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      var myIndex = 0;
      carousel();
      function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";  
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}    
        x[myIndex-1].style.display = "block";  
        setTimeout(carousel, 14000); // Change image every 2 seconds
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
function PhoneNmmber(name, phone, phone1) {
    // Update text content
    $('#phone_no').text(phone);
    $('#phone_no1').text(phone1);
    $('#PhoneName').text(name);
    // Replace content instead of appending to avoid duplicates
    $('#phone_no_call1').html(`<a href="tel:${phone1}" class="btn btn-success btn-sm">Call Now</a>`);
    $('#phone_no_call').html(`<a href="tel:${phone}" class="btn btn-success btn-sm">Call Now</a>`);
    // Show the modal
    $('#numberModel').modal('show');
}
</script>
@stop