<!DOCTYPE html>

<html lang="en">

<head>

   

@extends('layouts.app')

    <title>Address Guru</title>

    <meta name="description" content="">

    <meta name="keywords" content="">

    <link rel="canonical" href="">

@section('content')



<div class="container">

    <div class="row">

       <div class="col-md-12 text-center">

        @if($user ? $user->is_active == 1 : '<h2 class="heading">

                <b>Search Just One Click Away!</b>

            </h2>')

            <h2 class="heading">

                <b>Search Just One Click Away!</b>

            </h2>

        @else

        <div class="row" style="background-color:white;">

            <div class="col-md-12" style="margin-top:5px;">

                <center>*check your spam box if mail not received within 10-15 min.</center>

            </div>

            <div class="col-md-6">

                <h3 class="heading alert alert-danger" style="color:#337AB7;">

                <b>Verify your email to post Ad</b>

            </h3>

            </div>

            <div class="col-md-6">

                <div class="row" style="margin-top:32px;">

                    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['IndexPage@update', $user->id]]) !!}

                    <div class="col-xs-8">

                        <input type="number" placeholder="Enter OTP" name="verify" class="form-control" required="required">

                    </div>

                    <div class="col-xs-4">

                        <button class="btn btn-success pull-left">Verify</button>

                    </div>

                    {!! Form::close() !!}

                </div>

            </div>

        </div>

            



        @endif

        </div>

        <div class="col-md-12" style="background-color:#ccc;padding:4px;margin-top:8px;">

            <div style="padding:20px;background-color:white;">

                {!! Form::open(['action'=>'IndexPage@store']) !!}

                <div class="row text-center" style="margin-top:2px;">

                    <div class="col-md-3">

                       {!! Form::select('path', [''=>'Choose Category'] + $category, null, ['class'=>'form-control']) !!}

                    </div>

                    <div class="col-md-3">

                        <select name="state" id="city1_c" class="form-control index" required="required">

                            <option>Select State</option>

                        </select>

                    </div>

                    <div class="col-md-3">

                        <select name="city" id="city1_b" class="form-control cities2 index" required="required">

                            <option>Select City</option>

                        </select>

                    </div>

                    <div class="col-md-3">

                        <button class="btn btn-primary index" style="padding:6px 90px 6px 90px"><i class="fa fa-search"></i> Search</button>

                    </div>

                </div>

                {!! Form::close() !!}

            </div>

        </div>

        <div class="col-md-12" style="background-color:#ccc;padding:4px;margin-top:40px;">

            <div style="background-color:white;padding:20px;">

                <h2 class="heading" style="margin:0px;"><b>Categories</b></h2><hr/>

                <div class="row text-center">

                    @foreach($cat as $cate)

                        <div class="col-md-2 col-xs-4 main-box" style="padding:0px;">

                            <a href="" class="toggler" data-toggle="modal" data-target="#myModal" path="{{$cate->id}}">

                            <div class="p_box"> 

                                <span style="font-size:50px;color:{{$cate->colors}};"><i class="{{$cate->icon}}"></i></span><br/>

                                <p>{{$cate->name}}</p>

                            </div>

                            </a>

                    </div>

                    @endforeach



                </div>

            </div>

        </div>

        <div class="col-md-12 down-div">

            <p>

                Address Guru Is Online Local Business Directory That Provide Information About Your Daily Needs Just One Click Away. We Get Your Business Listed On It And Grow Online By Reaching Everyone Who Search You Online. You Can Post Your Advertisement, Create Enquiry Online About Any Business List, Share Your Thoughts About Your City. We Also Provide Services In Website Designing And Development To Promote Your Business And Services Through Internet And Make Your Online Presence. 

            </p>

        </div>

    </div>

</div>

@include('include.popup')

@endsection

<!DOCTYPE html>

<html lang="en">

<head>

   

@extends('layouts.app')

    <title>Address Guru</title>

    <meta name="description" content="">

    <meta name="keywords" content="">

    <link rel="canonical" href="">

@section('content')



<div class="container">

    <div class="row">

       <div class="col-md-12 text-center">

        @if($user ? $user->is_active == 1 : '<h2 class="heading">

                <b>Search Just One Click Away!</b>

            </h2>')

            <h2 class="heading">

                <b>Search Just One Click Away!</b>

            </h2>

        @else

        <div class="row" style="background-color:white;">

            <div class="col-md-12" style="margin-top:5px;">

                <center>*check your spam box if mail not received within 10-15 min.</center>

            </div>

            <div class="col-md-6">

                <h3 class="heading alert alert-danger" style="color:#337AB7;">

                <b>Verify your email to post Ad</b>

            </h3>

            </div>

            <div class="col-md-6">

                <div class="row" style="margin-top:32px;">

                    {!! Form::model($user, ['method'=>'PATCH', 'action'=>['IndexPage@update', $user->id]]) !!}

                    <div class="col-xs-8">

                        <input type="number" placeholder="Enter OTP" name="verify" class="form-control" required="required">

                    </div>

                    <div class="col-xs-4">

                        <button class="btn btn-success pull-left">Verify</button>

                    </div>

                    {!! Form::close() !!}

                </div>

            </div>

        </div>

            



        @endif

        </div>

        <div class="col-md-12" style="background-color:#ccc;padding:4px;margin-top:8px;">

            <div style="padding:20px;background-color:white;">

                {!! Form::open(['action'=>'IndexPage@store']) !!}

                <div class="row text-center" style="margin-top:2px;">

                    <div class="col-md-3">

                       {!! Form::select('path', [''=>'Choose Category'] + $category, null, ['class'=>'form-control']) !!}

                    </div>

                    <div class="col-md-3">

                        <select name="state" id="city1_c" class="form-control index" required="required">

                            <option>Select State</option>

                        </select>

                    </div>

                    <div class="col-md-3">

                        <select name="city" id="city1_b" class="form-control cities2 index" required="required">

                            <option>Select City</option>

                        </select>

                    </div>

                    <div class="col-md-3">

                        <button class="btn btn-primary index" style="padding:6px 90px 6px 90px"><i class="fa fa-search"></i> Search</button>

                    </div>

                </div>

                {!! Form::close() !!}

            </div>

        </div>

        <div class="col-md-12" style="background-color:#ccc;padding:4px;margin-top:40px;">

            <div style="background-color:white;padding:20px;">

                <h2 class="heading" style="margin:0px;"><b>Categories</b></h2><hr/>

                <div class="row text-center">

                    @foreach($cat as $cate)

                        <div class="col-md-2 col-xs-4 main-box" style="padding:0px;">

                            <a href="" class="toggler" data-toggle="modal" data-target="#myModal" path="{{$cate->id}}">

                            <div class="p_box"> 

                                <span style="font-size:50px;color:{{$cate->colors}};"><i class="{{$cate->icon}}"></i></span><br/>

                                <p>{{$cate->name}}</p>

                            </div>

                            </a>

                    </div>

                    @endforeach



                </div>

            </div>

        </div>

        <div class="col-md-12 down-div">

            <p>

                Address Guru Is Online Local Business Directory That Provide Information About Your Daily Needs Just One Click Away. We Get Your Business Listed On It And Grow Online By Reaching Everyone Who Search You Online. You Can Post Your Advertisement, Create Enquiry Online About Any Business List, Share Your Thoughts About Your City. We Also Provide Services In Website Designing And Development To Promote Your Business And Services Through Internet And Make Your Online Presence. 

            </p>

        </div>

    </div>

</div>

@include('include.popup')

@endsection

