<?php 
use Illuminate\Support\Facades\Crypt;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Marketplace | AddressGuru</title>
        <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/market.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @extends('layouts.app')
        
        @section('content')
        <div class="container-fluid header_post">
            <div class="row">
                <div class="col-md-12 text-center ad" style="color:white;">
                    <h2><b>Choose Category</b></h2>
                </div>      
            </div>
        </div>
        <div class="container" id="move" style="padding:40px 20px 20px 20px;">
            <div class="row featureBoxes alterText">
                <div class="col-md-12">
                    <a href="{{url('marketplace')}}"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a><br/><br/>
                    <div class="row">
                        <div class="col-md-4 col-xs-6">
                            <div class="featureBoxItem animated pulse mb20">
                                <i class="fa fa-list"></i>
                                <div class="caption">Business Listing</div>
                                <a href="{{url('post')}}"><div class="altCaption">Post Free Ad</div></a>
                            </div>
                        </div>
                        <?php $i = 1; ?>
                        @foreach($cat as $cats)
                        <div class="col-md-4 col-xs-6">
                            <div class="featureBoxItem animated pulse mb20" style="background-color:{{$cats->colors}};">
                                <i class="{{$cats->icon}}"></i>
                                <div class="caption">{{$cats->name}}</div>
                                <a href="javascript::void(0)" id="moving{{$i}}"><div class="altCaption">Post Free Ad</div></a>
                            </div>
                        </div>
                        <script>
                            $("#moving{{$i}}").click(function() 
                            {
                                $("#move").animate({marginRight: "800"}, 1000, function() 
                                    {
                                        $("#move").hide();
                                        var v = <?php echo $cats->id; ?>;
                                        $("#subcategory").show();

                                        $.ajax({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            url: '{{url("get_subcategory")}}',
                                            type: 'POST',
                                            data: {id: v},
                                            beforeSend: function()
                                            {
                                                $("#result").html('<center><img src="{{url("/")}}/images/Spinner-1s-200px.gif" id="loader" width="400px"></center>');
                                            },
                                            success: function(datalink)
                                            {
                                                $("#result").html(datalink);
                                            },
                                            complete: function()
                                            {
                                                $("#loader").hide();
                                            }
                                        });
                                    }
                                );
                              });
                        </script>
                        <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
            var equalheight = function (container) {
            
                var currentTallest = 0,
                    currentRowStart = 0,
                    rowDivs = new Array(),
                    $el,
                    topPosition = 0;
                $(container).each(function () {
            
                    $el = $(this);
                    $($el).height('auto')
                    topPostion = $el.position().top;
            
                    if (currentRowStart != topPostion) {
                        for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                            rowDivs[currentDiv].height(currentTallest);
                        }
                        rowDivs.length = 0;
                        currentRowStart = topPostion;
                        currentTallest = $el.height();
                        rowDivs.push($el);
                    } else {
                        rowDivs.push($el);
                        currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
                    }
                    for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                        rowDivs[currentDiv].height(currentTallest);
                    }
                });
            }
            
            $(window).load(function () {
                equalheight('.equalHeightPerent .equalHeightChild');
            });
            
            
            $(window).resize(function () {
                equalheight('.equalHeightPerent .equalHeightChild');
            });
            
        </script>
        <div class="container post_bg na" id="subcategory" style="display:none;">
            <div class="row">
                <a href="javascript::void(0)" onclick="location.reload();"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a><br/><br/>
                <div class="col-md-8">
                    <div class="left_box_post" id="result">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="right_box_post">
                        <a href="{{url('Contact-Us')}}" target="_blank" rel="nofollow"><img src="{{url('/')}}/images/banner_new.jpg" alt="Banner" class="img-responsive"></a>
                    </div>
                </div>
            </div>
        </div>
        @stop
