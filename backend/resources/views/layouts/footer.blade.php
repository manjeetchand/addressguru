<Style>
    .important-links{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .quick-links{
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .footer-mobile-copyright{
            display:none;
        }
    .footer-desktop-copyright{
        display: flex;
        justify-content: space-between;
        align-items:center;
    }
    .footerxs{
        display:none;
    }
    @media (max-width: 768px) {
        .important-links{
        display: block;
        }
        .quick-links{
            display: block;
        }
        footer .partone .ulfooter {
            margin:0;
            padding-left:0;
            display: flex;
            justify-content: center;
        }
        .footer-payment-img{
            display: flex;
            justify-content: center;
            align-items:center;
        }
        .footer-desktop-copyright{
            display:none;
        }
        .footer-mobile-copyright{
            display:block;
            text-align: center;
        }
        .footer-option{
            padding-left:22px;
            margin:5px 0;
        }
        .footerxs{
            display:block;
        }
        .plus i{
        font-size: 35px !important;
        margin-top: -35px !important;
        color: black !important;
        margin-bottom: 5px;
        border-radius: 80%;
        padding: 8px 10px;
            background-color: orange !important;
        }
        .borders i {
            font-size: 24px;
            /* color: #828282; */
            color: rgba(20, 20, 20, 0.6);
        }
    }
</Style>
<footer>
    {{-- footer  --}}
    <div class="container-fluid partone">
        {{-- footer links  --}}
        <div class="row">
           <div class="col-md-2"></div>
            <div class="col-12 col-md-3">
              <center><img src="{{url('/')}}/images/logopng.png" class="img-responsive" alt="AddressGuru"></center>
              <p>Address Guru Is Online Local Business Directory That Provide Information About Your Daily Needs Just One Click Away. We Get Your Business Listed On It And Grow Online By Reaching Everyone Who Search You Online.</p>
              <ul class="ulfooter">
                <a href="https://www.facebook.com/addressgurusg" target="_blank"><li><i class="fa fa-facebook fa-fw"></i></li></a>
                <a href="https://www.youtube.com/channel/UC8WEXsO-s9N-ncxX4AVUH4Q" target="_blank"><li><i class="fa fa-youtube-play fa-fw"></i></li></a>
                <a href="#" target="_blank"><li><i class="fa fa-linkedin fa-fw"></i></li></a>
                <a href="#" target="_blank"><li><i class="fa fa-twitter fa-fw"></i></li></a>
                <a href="https://www.instagram.com/addressguru_singapore/" target="_blank"><li><i class="fa fa-instagram fa-fw"></i></li></a>
              </ul>
            </div>
            <div class="col-12 col-md-3 category_part important-links" >
                <!-- <div class="col-md-12">
                  <h3>Popular Category</h3>
                </div> -->
                <p><i class="fa fa-info fa-fw"></i> Important Links</p>
                <ul>
                    <li><i class="fa fa-chevron-right fa-fw"></i> <a href="{{url('About-Us')}}">About Us</a></li>
                    <li><i class="fa fa-chevron-right fa-fw"></i> <a href="{{url('Contact-Us')}}">Contact Us</a></li>
                    @if (Auth::guest())
                    <li><i class="fa fa-chevron-right fa-fw"></i> <a href="{{url('partner')}}">Become a Partner</a></li>
                    @endif
                    <li><i class="fa fa-chevron-right fa-fw"></i> <a href="{{url('posting-rules')}}">Posting Rules</a></li>
                </ul>
                <!-- <div class="col-md-4">
                  <p><i class="fa fa-cutlery fa-fw"></i> Cafe & Restaurants</p>
                  <ul>
                  </ul>
                </div> -->
            </div>
            <div class="col-12 col-md-3 category_part quick-links">
                <p><i class="fa fa-search fa-fw"></i> Quick Links</p>
                <ul>
                  <li><i class="fa fa-chevron-right fa-fw"></i> <a href="{{url('marketplace-post')}}">Post Ad</a></li>
                  <li><i class="fa fa-chevron-right fa-fw"></i> <a href="{{url('Pricing-Table')}}">Our Plans</a></li>
                  <li><i class="fa fa-chevron-right fa-fw"></i> <a href="{{url('infringement-policy')}}">Infringement Policy</a></li>
                  <li><i class="fa fa-chevron-right fa-fw"></i> <a href="{{url('Privacy-Policy')}}">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-3"></div>
                @if(isset($unique))
                    <div class="col-md-12 category_footer"><br/>
                        <strong>How Address Guru helps you in finding {{$category->name}} in {{$city}}?</strong>
                        <p style="margin-bottom:8px;">You can search {{$category->name}} in {{$city}} on the basis of your location, popularity, ratings & reviews on Address Guru. To get the best results, you can send message to the businesses through our website and they will contact you. You can also negotiate with them directly from the chat option.</p> <hr style="border-color:#ccc;margin-bottom:8px;" />
                    </div>
                    <div class="col-md-12 category_footer"><br/>
                    <strong>{{$category->name}} also in:</strong>
                    <?php 
                        $myArray = array();
                        foreach ($unique as $key){
                            $cats = preg_replace("/[\s_]/", "-", $category->name);
                            $myArray[] = "<a href='".url('/')."/".$cats."/".$key."/".base64_encode($category->id)."' title='".$category->name." in ".$key."'>".$category->name." in ".$key."</a>";
                        }
                        echo implode( ' | ', $myArray ).".";
                    ?>
                </div>
                @endif
                {{--
                @if(isset($footer_category))
                <div class="col-md-12 category_footer"><br/>
                    <strong>See more:</strong>
                    <?php 
                        $myArray = array();
                        foreach ($footer_category as $value){
                            $cat = Category::findOrFail($value);
                            $cats = preg_replace("/[\s_]/", "-", $cat->name);
                            $myArray[] = "<a href='".url('/')."/".$cats."/".$city."/".base64_encode($value)."' title='".$cat->name." in ".$city."'>".$cat->name."</a>";
                        }
                        echo implode( ' | ', $myArray ).".";
                    ?>
                </div>
                @endif--}}
            </div>
        </div>
        {{-- footer information  --}}
        <div class="container-sm">
            <div class="row my-3">
                <div class="col-md-3" style=" display: flex;flex-direction: column;justify-content: center;align-items: flex-start;">
                    <h6 class="m-0"><i class="fa fa-phone fa-fw"></i> Contact by Phone</h6>
                    <div class="footer-option">
                        <a href="tel:9410102425">94-1010-2425</a><br>
                        <small>Booking time: 0800 - 2000 hrs</small>
                    </div>          
                </div>
                <div class="col-md-3" style=" display: flex;flex-direction: column;justify-content: center;align-items: flex-start;">
                    <h6 class="m-0"><i class="fa fa-envelope fa-fw"></i> Give your Feedback</h6>
                    <div class="footer-option">
                        <a href="mailto:contact@addressguru.sg">contact@addressguru.sg</a><br>
                        <small>Help us improve!</small>
                    </div>
                </div>
                <div class="col-md-3" style="display: flex;flex-direction: column;justify-content: center;align-items: flex-start;">
                    <h6 class="m-0"><i class="fa fa-headphones fa-fw"></i> Services and Support</h6>
                    <div class="footer-option">
                        <a href="#">Support Centre</a><br>
                        <small>83 Punggol Central Waterway Point Mall Singapore 828761 </small>
                    </div>
                </div>
                <div class="col-md-3" style="  display: flex;flex-direction: column;justify-content: center;align-items: flex-start;">
                    <h6 class="m-0"><i class="bi bi-people-fill"></i> Our Partners</h6>
                    <div class="footer-option">
                    <img src="{{url('/')}}/images/adxventure_logo.png" class="img-responsive" alt="Partners">
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <p style="font-size:12px;color:#8B8B8B;"><strong>Disclaimer:</strong> 
                    The information provided on AddressGuru is submitted by users and businesses and is for general informational purposes only. All trademarks, logos, and brand names mentioned belong to their respective owners. AddressGuru is not responsible for any losses, damages, or disputes arising from user interactions, including but not limited to financial transactions or service agreements.
                    <br/><br/>
                    You are free to use our platform for commercial purposes but any other kind of use is strictly prohibited. We are free to ban any type of content or Ad which is not complying to our policies. <br><br>
                    Before posting anything or becoming a partner of Address Guru, read carefully all the posting policies.
                </p>
                </div>
                <div class="col-md-3 mb-2 footer-payment-img">
                    <img src="{{url('/')}}/images/payment.png" class="img-responsive" style="width:250px;" alt="locker">
                </div>
            </div>
        </div>  
    </div>
    {{-- copyright footer  --}}
    <div class="text-light px-4 py-2 footer-desktop-copyright" style="background:black">
        <p class="m-0"><b>{{number_format($livefooter)}}</b> Live Ads</span> | <span><b>{{number_format($agentfooter)}}+</b> Agents</p>
        <p class="m-0"> © {{Date('Y')}} AddressGuru | by: <a href="https://adxventure.com/" target="_blank"><b>AdxVenture</b></a></p>
    </div>
    <div class=" text-light px-2 py-2 footer-mobile-copyright" style="background:black">
        <small class="m-0"><b>1,453</b> Live Ads | <span><b>79+</b> Agents</span></small><br>
        <small class="m-0"> © 2024 AddressGuru | by: <a href="https://adxventure.com/" target="_blank"><b>AdxVenture</b></a></small>
    </div>
</footer>
    {{-- footer option  --}}
    <div class="container-fluid footerxs visible-xs">
        <div class="row text-center align-items-center justify-content-evenly">
            <div class="col-2 px-1 borders1">
                <a href="{{url('/')}}" class="text-dark fw-bold">
                    <i class="fa fa-home fs-6"></i><br>
                    <span>Home</span>
                </a>
            </div>
            @if(!auth()->check())
            <div class="col-2 px-1 borders1" >
                <a href="{{url('/login')}}" class="text-dark fw-bold">
                <i class="fa fa-sign-out fs-6"></i>
                <br>
                <span>Login</span>
                </a>
            </div>
            @else
            <div class="col-2 px-1 borders1" >
                <a href="{{url('/admin')}}" class="text-dark fw-bold">
                    <i class="fa fa-dashboard fs-6"></i>
                    <br>
                    <span>Dashboard</span>
                </a>
            </div>
            @endif 
            <div class="col-2 px-1 borders1">
                <a href="{{url('/marketplace')}}" class="text-dark fw-bold">
                    <i class="fa fa-shopping-cart fs-6"></i>
                    <br>
                    <span>Marketplace</span>
                </a>
            </div>
            <div class="col-2 px-1 borders1">
                <a href="{{url('/jobs')}}" class="text-dark fw-bold">
                    <i class="fa fa-search fs-6"></i>
                    <br>
                    <span>Jobs</span>
                    </a>
            </div>
            <div class="col-2 px-1 borders1">
                <a href="{{url('/properties')}}" class="text-dark fw-bold" > 
                    <i class="fa fa-home fs-6"></i>
                    <br>
                    <span>Properties</span>
                </a>    
            </div>
            <div class="col-2 px-1 plus borders1">
                <a href="{{url('/marketplace-post')}}" class="text-dark fw-bold" >  
                    <i class="fa fa-plus fs-6"></i>
                    <br>
                    <span>Post Ad</span>
                </a>
            </div>
        </div>
    </div>
   <!--  <div class="container-fluid hidden-xs" style="background-color:#111111;color:white;padding:40px 0px 0px 0px;">
    <div class="container">
        <div class="row">
            <div class="col-md-4 icon" style="text-align:justify;">
                <h3><b>About </b></h3><hr/>
                <div style="padding:0px 0px 0px 20px;">
                <p>Address Guru Is Online Local Business Directory That Provide Information About Your Daily Needs Just One Click Away. We Get Your Business Listed On It And Grow Online By Reaching Everyone Who Search You Online.</p>
                </div>
            </div>
            <div class="col-md-4 icon">
                <h3><b>Quick Links </b></h3><hr/>
                <ul>
                    <li>
                        <i class="fa fa-edit"></i>
                        <a href="{{url('/post')}}"> &nbsp;Post Ad</a>
                    </li>
                     <li>
                        <i class="fa fa-rupee"></i>
                        <a href="{{url('/Pricing-Table')}}"> &nbsp;&nbsp;&nbsp;Price Tables</a>
                    </li>
                    <li>
                        <i class="fa fa-address-book"></i>
                        <a href="{{url('/Contact-Us')}}"> &nbsp;Contact Us</a>
                    </li>
                    <li>
                        <i class="fa fa-info"></i>
                        <a href="{{url('/About-Us')}}"> &nbsp;&nbsp;&nbsp;&nbsp;About Us</a>
                    </li>
                    <li>
                        <i class="fa fa-lock"></i>
                        <a href="{{url('/Privacy-Policy')}}"> &nbsp;&nbsp;&nbsp;Privacy Policy</a>
                    </li>
                     @if (Auth::guest())
                    <li>
                        <i class="fa fa-sign-in"></i>
                        <a href="{{url('/partner')}}"> &nbsp;&nbsp;Become a Partner</a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="col-md-4 icon">
                <h3><b>Follow Us </b></h3><hr/>
                <center>
                   <a href="https://www.facebook.com/Address-Guru-1638707256426228" target="_blank" class="a">
                       <img src="/images/fb.png" class="img-responsive" width="30px">
                   </a>
                   <a href="https://www.youtube.com/channel/UC8WEXsO-s9N-ncxX4AVUH4Q" target="_blank" class="a">
                       <img src="/images/you.png" class="img-responsive" width="44px">
                   </a>
                   <a href="https://plus.google.com/u/0/100372782577197445649" target="_blank" class="a">
                       <img src="/images/google.png" class="img-responsive" width="30px">
                   </a>
                   <a href="" target="_blank" class="a">
                       <img src="/images/linkedin.png" class="img-responsive" width="32px">
                   </a>
                   <a href="" target="_blank" class="a">
                       <img src="/images/twitter.png" class="img-responsive" width="32px">
                   </a>
                </center>
            </div>
        </div>
    </div>
    <center><img src="/images/bg.png" class="img-responsive" alt="addressguru.in"></center>
</div>
<div class="container-fluid hidden-xs text-center" style="padding:8px;background-color:#000000;">
    <div class="container">
        <p style="margin-bottom:0px;font-size:12px;color:#fff;">
            Designed & Developed By: <a href="http://universalwebsolutions.in/" target="_blank" title="Universal Web Solutions"><b>Universal Web Solution</b></a>
            Promoted By: <a href="https://adxventure.com/" target="_blank" title="Adx Venture"><b>Adx Venture</b></a>
        </p>
    </div>
</div> -->
    <!-- JavaScripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> -->
    <script src="{{asset('js/libs.js')}}"></script>
    <script>
        $('.ctydd').selectpicker();
        $('nav.nav-mob .mob-cityna').on('click', function() {
            $('.mobile-city').toggleClass('d-none');
        });
        $('.btn-snav').on('click', function() {
            $('#main-sidenav').toggleClass('open');
        })
        $('#main-sidenav .closebtn').on('click', function() {
            $(this).closest('#main-sidenav').removeClass('open');
        })
        function filterList() {
            var input, filter, ul, li, a, i, txtValue;
            input  = document.getElementById('mctyflin');
            filter = input.value.toUpperCase();
            ul     = document.getElementById("mctyl");
            li     = ul.getElementsByTagName('li');
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                }else {
                    li[i].style.display = "none";
                }
            }
        }
        function setCity(ctyn) {
            document.getElementById('mctyflin').value = ctyn;
            $.ajax({
                url: "{{ url('/change-city') }}",
                type: "POST",
                data: { city: ctyn, _token: '{{ csrf_token() }}' },
                success: function (resp) {
                    console.log(resp);
                    if(Number(resp.ok)) {
                        location.reload();
                    }
                },
            });
        }
    </script>
    <script type="text/javascript">
        function toggle_visibility(id) {
            var e = document.getElementById(id);
            if(e.style.display == 'block')
                e.style.display = 'none';
            else
                e.style.display = 'block';
        }
        $(document).ready(function() {
            for(var i=0;i<42;i++) {
                if(states[i]) {
                    var option = $('<option />');
                    option.attr('value',states[i]).text(states[i]);
                    $('#city1_c').append(option);
                }
            }
            var choosed1="";
            $("#city1_c").on("change", function() {
                var period=this.value;
                if(0) {
                    choosed1=period;
                }else {
                    //alert(choosed1+period);
                    choosed1=period;
                    var j;
                    for(j=0;j<50;j++) {
                        if(period==states[j])
                        break;
                    }
                    $('.cities2').find('option').remove().end();
                    var option = $('<option />');
                        option.attr('value',"select").text("");
                    $('.cities2').append(option);
                    for(var i=0;i<(cities[j]).length;i++) {
                        if(cities[j][i]) {
                            var option = $('<option />');
                                option.attr('value',cities[j][i]).text(cities[j][i]);
                            $('.cities2').append(option);
                            //console.log(cities[c][i]);
                        }
                    }
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('.toggler').click(function() {
            var path = $(this).attr('path');
            $('#popupEdit').css('display','block');
            $('.pathinput').val(path);
            $('.path').text(path);
        });
    </script>
</div>
<?php $name_co = "AddressGuruHimani";
  if (!isset($_COOKIE[$name_co])) {
  setcookie('AddressGuruHimani', $name_co, time()+3600*24*30);
?>
<!-- <div class="modal fade aara" id="cookieModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="notice d-flex justify-content-between align-items-center">
          <div class="cookie-text pull-left" style="margin-top:8px;">This website uses cookies to personalize content and analyse traffic in order to offer you a better experience.</div>
          <div class="buttons pull-right">
            <a href="#a" class="btn btn-primary btn-sm" data-dismiss="modal" style="color:#fff!important;">I accept</a>
            <a href="#a" class="btn btn-default btn-sm" data-dismiss="modal">Ignore</a>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>   -->
<script>
    $(document).ready(function() {  
        $('#cookieModal').modal('show');
    });
</script>
<?php  } ?>
 @yield('footer')
</body>
</html>
<?php ob_end_flush(); ?>