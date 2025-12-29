@php
$cities = App\Personal::where('city', '!=', 'select')->where('status', '=', 1)->pluck('city'); 
$cities = collect($cities);
$cities = $cities->unique()->values()->all();
@endphp
<style>
    .m-0 {
        margin: 0 !important;
    }
    .w-100 {
        width: 100%;
    }
    .mb-5px {
        margin-bottom: 5px;
    }
    .ml-5px {
        margin-left: 5px !important;
    }
    .d-flex {
        display: flex;
    }
    .d-flex.aic {
        align-items: center;
    }
    .d-flex.jcsb {
        justify-content: space-between;
    }
    .d-flex.center {
        align-items: center;
        justify-content: center;
    }
    .flex-col {
        flex-direction: column;
    }
    .d-none {
        display: none;
    }
    nav.navm {
        top: 0;
        width: 100%;
        z-index: 1050;
        padding: 0 15px;
        position: fixed;
        background-color:ghostwhite;
    }
    nav.nav-desk {
        display: flex;
    }
    nav.nav-mob {
        display: none;
    }
    .mobile-city {
        top: 50px;
        width: 100%;
        height: 100%;
        padding: 20px;
        z-index: 1050;
        position: absolute;
        background: white;
    }
    .mobile-city input {
        border-radius: 20px;
    }
    .mobile-city ul {
        margin: 0px;
        padding: 20px 0px;
        overflow: auto;
        max-height: 100%;
    }
    .mobile-city ul li a {
        color: #363d43;
        font-size: 16px !important;
    }
    .sidenav {
        top: 0;
        left: 0;
        width: 0;
        height: 100%;
        position: fixed;
        overflow-x: hidden;
        margin-top: 65px;
        padding-top: 5px;
        background-color: whitesmoke;
    }
    .sidenav.open {
        width: 350px;
    }
    .img-sidebar {
        width: 60px;
    }
    .sidenav a {
        color: gray;
        display: block;
        padding: 10px 5px;
        font-size: 17px;
        transition: 0.3s;
        font-weight: 600;
        text-decoration: none;
    }
    .sidenav a:hover {
        color: black;
    }
    .sidenav .fa {
        padding-right: 5px;
    }
    .sidenav .closebtn {
        top: -14px;
        right: 25px;
        position: absolute;
        font-size: 36px !important;
        margin-left: 5px;
    }
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        margin: 0 0 1.5em 0 !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        box-shadow: 0px 0px 0px 0px #000;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
    }
    legend.scheduler-border {
        width: auto;
        padding: 0 10px;
        font-size: 1.2em !important;
        text-align: left !important;
        font-weight: bold !important;
        border-bottom: none;
    }
    .list-inline > li {
        display: inline-block;
        padding-top: 3px;
    }
    .list-inline-item {
        color: #286090;
        font-size: 25px;
    }
    .manjeet-city, .mobile-form1{
        display:none;
    }
    mobile-form1
    @media only screen and (max-width: 991px) {
        nav.nav-desk .btn-pfad > span {
            display: none;
        }
    }
    @media only screen and (max-width: 767px) {
        .top-main {
            margin-top: 82px !important;
        }
        nav.nav-desk {
            display: none !important;
        }
        nav.nav-mob {
            display: flex !important;
        }
        .sidenav {
            margin-top: 0;
        }
    }
</style>
<style>
    .logo{
        width: 200px;
    }
    .mobile-cities{
        display: none;
    }
   @media only screen and (max-width: 768px) {
        .desktop{
            display: none;
        }
        .navbar-toggler-icon {
            width: 1em;
            height: 1em;
        }
        .logo{
            width: 150px;
        }
        .mobile-cities{
            display: block;
        }
        .desktop-cities{
            display: none;
        }
        .mobile-form{
            padding:10px 0 ;
            width:100%;
        }
        .mobile-search{
            width:100%;
        }
        .mobile-form{
            display:none;
        }
        .manjeet-city,.mobile-form1{
            display:block;
        }
   }
  
</style>
<header>
    {{-- navbar  --}}
    <nav class="navbar bg-light fixed-top p-1">
        <div class="col-12 px-3">
            <div class="row align-items-center">
                <div class="col-xl-2 col-8 d-flex align-items-center gap-3">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" fdprocessedid="k01nyl" style="background:#FF6E04;">
                    <box-icon name='menu-alt-left' class="p-0 text-light"></box-icon>
                    </button>
                    <a href="{{url('/')}}">
                        <img src="https://www.addressguru.in/images/logopng.png" class="img-responsive logo" alt="Address Guru" style="width:150px"/>
                    </a>       
                 </div>  
                <div class="col-xl-1 col-4 manjeet-city ">
                    <!-- Dropdown for selecting the city -->
                    <select id="cityDropdown" class="form-control ctydd p-1" data-live-search="true"> 
                        <option value="">Choose City</option>
                        <option value="Singapore" selected>Singapore</option>
                        @foreach($cities as $city)
                            @if($city != null)
                            <option value="{{ $city }}">{{ $city }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-5 mobile-form">
                    <div class="header-form">
                        <form class="d-flex ">
                            <div class="desktop-cities ">
                                <!-- Dropdown for selecting the city -->
                                <select id="cityDropdown" class="form-select ctydd" data-live-search="true" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;"> 
                                    <option value="">Choose City</option>
                                    <option value="Singapore" selected>Singapore</option>
                                    @foreach($cities as $city)
                                        @if($city != null)
                                        <option value="{{ $city }}">{{ $city }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;">
                                <input class="form-control border-0" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success border-0" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
                <div class="col-xl-5" style="text-align:end">
                    <div class="desktop">
                        <ul class="list-inline m-0">
                            <li>
                                <a href="#">
                                <span class="btn btn-md" style="text-decoration: none;">
                                    <i class="fa fa-home" style="font-size: 26px;padding-top: 6px;"></i>
                                    <br>
                                    <span style="font-size:11px;text-decoration: none;letter-spacing: 2px;"> To Let</span>
                                </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('jobs')}}">
                                <span class="btn  btn-md" style="text-decoration: none;">
                                    <i class="fa fa-briefcase" style="font-size: 26px;padding-top: 6px;"></i>
                                    <br>
                                    <span style="font-size:11px;text-decoration: none;letter-spacing: 2px;"> Jobs</span>
                                </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('marketplace')}}" style="display: inline-block;">
                                    <span class="btn  btn-md icon" style="text-decoration: none;text-align: center;border-right: 1px solid lightgray;margin-bottom: -3px;">
                                        <i class="fa fa-shopping-cart" style="font-size: 26px;"></i>
                                        <br />
                                        <span style="font-size:11px;text-decoration: none;letter-spacing: 2px;">Marketplace</span>
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('marketplace-post') }}" class="btn btn-pfad" style="background:#FF6E04">
                                    <span>Post Free Ad</span>
                                    <i class="fa fa-plus fa-fw"></i>
                                </a>
                            </li>
                            @auth
                            <li>
                                <a href="{{ url('/admin') }}" class="btn btn-primary">
                                    <i class="fa fa-sign-out"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            @else
                            <li>
                                <a href="{{ url('/login') }}" class="btn btn-primary">
                                    <i class="fa fa-sign-in"></i>
                                    <span>Login</span>
                                </a>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    {{-- Sidebar  --}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <a href="{{url('/')}}">
                <img src="https://www.addressguru.in/images/logopng.png" class="img-responsive" alt="Address Guru" width="200px" />
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" fdprocessedid="zfcbss"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-4 col-xs-3">
                                <div style="padding: 8px 8px 8px 32px;">
                                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="img-circle img-sidebar" width="100%"  />
                                    @if(!auth()->check())
                                        <a class="btn btn-link" href="{{ url('login') }}" style="padding-left: 5px;text-align:left !important;">Login</a>
                                    @elseif(auth()->user()->id != 1)
                                        <a class="btn btn-link" href="{{ url('/user/profile/'.base64_encode(auth()->user()->id).'/edit') }}" style="padding-left: 5px;text-align:left !important;">View Profile</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8 col-xs-9" style="vertical-align: middle;horizontal-align:center;">
                                <h4 style="padding: 9px 22px;">Hi, {{ auth()->user()->name ?? "Guest" }}</h4>
                            </div>      
                        </div>
                    </div>
                    @if(auth()->user() && !auth()->user()->mobile_number)
                        <div class="col-md-12">
                            <div class="alert alert-success" role="alert">Please update your profile!</div>
                        </div>
                    @endif
                    <div class="col-md-12 sidenav1">
                        <br />
                        <ul class="cityhola" style="list-style-type: none;">
                            @guest()
                                <li><a href="{{url('login')}}"> <i class="fa fa-sign-out"></i> &nbsp; Login </a></li>
                            @elseif(Auth::user()->role->name == "Admin")
                                <li><a href="{{ route('admin.index') }}"><i class="fa fa-sign-out"></i> &nbsp; Dashboard </a> </li>
                            @elseif(Auth::user()->role->name == "User")
                                <li><a href="{{ route('Dashboard.index') }}"><i class="fa fa-sign-out"></i> &nbsp; Dashboard</span></a> </li>
                            @elseif(Auth::user()->role->name == "Agent")
                                <li><a href="{{ route('Partner Dashboard.index') }}"><i class="fa fa-sign-out"></i> &nbsp; Dashboard</span></a> </li>
                            @else
                                <li><a href="{{ route('editor-dashboard.index') }}"><i class="fa fa-sign-out"></i> &nbsp; Dashboard</span></a> </li>
                            @endif
                            <li class="nav-item"> 
                                <a class="nav-link" href="{{url('About-Us')}}"><i class="fa fa-info fa-fw" style="padding-right:5px;"></i> &nbsp; About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"  href="{{url('Contact-Us')}}"><i class="fa fa-phone fa-fw"></i> &nbsp; Contact Us</a>
                            </li>
                            <li class="nav-item" >
                                <a class="nav-link" href="{{url('posting-rules')}}"><i class="fa fa-gavel fa-fw"></i>&nbsp;  Posting Rules</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('Pricing-Table')}}"><i class="fa fa-credit-card fa-fw"></i>&nbsp;  Our Plans</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" href="{{url('infringement-policy')}}"><i class="fa fa-cogs fa-fw"></i>&nbsp; Infringement Policy</a>
                            </li>
                            <li class="nav-item">
                                <a  class="nav-link" href="{{url('Privacy-Policy')}}"><i class="fa fa-gear fa-fw"></i>&nbsp;  Privacy Policy</a>
                            </li>
                            @if(auth()->user())
                                <li class="nav-item">
                                    <a  class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="text-decoration: none; font-size: 17px; color: gray; transition: 0.3s; font-weight: 600;">
                                        <i class="fa fa-sign-out"></i> &nbsp; Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div style="padding: 30px;">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Follow us on:</legend>
                        <div class="control-group">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="https://www.facebook.com/addressguru.in/">
                                        <i style="font-size:25px;color:blue;" class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://instagram.com/addressguru?igshid=YmM0MjE2YWMzOA==">
                                        <i style="font-size:25px;color:blue;" class="fa fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="">
                                        <i style="font-size:25px;color:blue;" class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://youtube.com/@AddressGuru">
                                        <i style="font-size:25px;color:blue;" class="fa fa-youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </fieldset>
                </div>   
            </ul>
        </div>
    </div>      
</header>