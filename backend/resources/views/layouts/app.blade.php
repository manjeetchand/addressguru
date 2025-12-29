<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    ob_start();
    use App\User;
    use App\Coaching;
    use App\Category;
    $livefooter = Coaching::where('status', '=', 1)->count();
    $agentfooter = User::where('role_id', '=', 3)->count();
    ?>
    <link rel="icon" href="{{url('/')}}/images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <!-- icon  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/animations.min.css"/>
    <!-- Bootstrap only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- css  -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/libs.css')}}" rel="stylesheet">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-160874981-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-160874981-1');
    </script>
    <!-- Google Analytics second tag -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-20Z9CD68NF"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-20Z9CD68NF');
    </script>
    <style>
        .container-fluid{
            margin-top:45px ! important; 
        }
        @media (max-width: 768px) { 
            .container-fluid{
            /* margin-top:75px ! important;  */
            width:100%! important;
            }
        }
    </style>
      <!-- Section to be yielded in child views -->
      @yield('head')
</head>
<body id="app-layout" style="background-color:#eee;" onload="lo()">
    <!-- Header  -->
    @include('layouts.header')
    <!-- Section  -->
        <div class="container-fluid">
            @yield('content')   
        </div>
    <!-- Footer -->
  @include('layouts.footer')  
</body>
</html>