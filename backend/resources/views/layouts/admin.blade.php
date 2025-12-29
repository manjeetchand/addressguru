<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>
    <link rel="icon" href="{{url('/')}}/images/icon.png">
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/libs.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>

<body id="admin-page">

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('admin')}}" style="font-size:30px;text-align:center;"><b>Address Guru</b></a>
        </div>
        <!-- /.navbar-header -->



        <ul class="nav navbar-top-links navbar-right" style="margin-right:0px;">


            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>{{ Auth::user() ? Auth::user()->name : 'Guest' }} <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user" style="min-height:110px;">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                    </li>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->


        </ul>






        {{--<ul class="nav navbar-nav navbar-right">--}}
        {{--@if(auth()->guest())--}}
        {{--@if(!Request::is('auth/login'))--}}
        {{--<li><a href="{{ url('/auth/login') }}">Login</a></li>--}}
        {{--@endif--}}
        {{--@if(!Request::is('auth/register'))--}}
        {{--<li><a href="{{ url('/auth/register') }}">Register</a></li>--}}
        {{--@endif--}}
        {{--@else--}}
        {{--<li class="dropdown">--}}
        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>--}}
        {{--<ul class="dropdown-menu" role="menu">--}}
        {{--<li><a href="{{ url('/auth/logout') }}">Logout</a></li>--}}

        {{--<li><a href="{{ url('/admin/profile') }}/{{auth()->user()->id}}">Profile</a></li>--}}
        {{--</ul>--}}
        {{--</li>--}}
        {{--@endif--}}
        {{--</ul>--}}





        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="{{url('/')}}" target="_blank"><i class="fa fa-globe fa-fw"></i> View Website</a>
                    </li>
                    <li>
                        <a href="{{url('admin')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="{{route('admin-user.index')}}"><i class="fa fa-user fa-fw"></i> Users</a>
                    </li>
                    <li><a href="{{url('admin-business')}}"><i class="fa fa-shopping-cart fa-fw"></i> Business</a></li>
                    <li><a href="{{url('admin-marketplace')}}"><i class="fa fa-shopping-cart fa-fw"></i> Marketplace</a></li>
                    <li>
                        <a href="{{route('admin-jobs.index')}}"><i class="fa fa-rupee fa-fw"></i>Jobs</a>
                    </li>
                    <li>
                        <a href="{{route('admin-property.index')}}"><i class="fa fa-rupee fa-fw"></i>Property</a>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-wrench fa-fw"></i>Categories<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{route('admin-category.index')}}">Listing Categories</a></li>
                            <li><a href="{{route('admin-market-category.index')}}">Buy & Sell Category</a></li>
                        </ul>
                    </li>
                   



                    
                    <li>
                        <a href="{{route('admin.create')}}"><i class="fa fa-rupee fa-fw"></i> Payments</a>
                    </li>
                
                    <li>
                        <a href="{{route('admin-verify.index')}}"><i class="fa fa-edit fa-fw"></i> Verify Listing</a>
                    </li>
                    <li>
                        <a href="{{route('admin-search.index')}}"><i class="fa fa-search fa-fw"></i> Searches</a>
                    </li>
                    <li>
                        <a href="{{route('admin-editor.index')}}"><i class="fa fa-user-circle-o fa-fw"></i> Editor Management</a>
                    </li>

                    <li>
                        <a href="{{route('admin-message.index')}}"><i class="fa fa-envelope fa-fw"></i> Message</a>
                    </li>  
                    <li>
                        <a href="{{route('admin-rating.index')}}"><i class="fa fa-star fa-fw"></i> Ratings</a>
                    </li>                   
                    <li>
                        <a href="{{route('admin-template.index')}}"><i class="fa fa-star fa-fw"></i> Templates</a>
                    </li>                   
                   <li>
                        <a href="{{route('payment-package.index')}}"><i class="fa fa-file fa-fw"></i>Payment Packages</a>
                    </li>               
                </ul>


            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

</div>






<!-- Page Content -->
<div id="page-wrapper">
  
      

                @yield('content')
          
      
   
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!-- jQuery -->
<script src="{{asset('js/libs.js')}}"></script>
<script src="{{asset('js/metisMenu.js')}}"></script>
<script src="{{asset('js/sb-admin-2.js')}}"></script>
<script src="{{asset('js/scripts.js')}}"></script>
 <!-- JavaScripts -->
  
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.js"></script>
@yield('footer')





</body>

</html>
