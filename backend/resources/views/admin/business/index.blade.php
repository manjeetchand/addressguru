@extends('layouts.admin')
@section('content')
<style>
    .panel-primary>.panel-heading {
        font-size: 17px;
        font-weight: bolder;
    }
</style>
<div>
<h3>
<div>
    <span style="color:#337AB7;margin:5px 10px  5px 2px;"><i class="fa fa-edit"></i> {{$data['all_posts'] ?? 0}}</span> Total Business Listings 
    <!-- <span style="color:#337AB7;margin:5px 10px  5px 2px;"><i class="fa fa-edit"></i> Total Payments </span> $ 0 -->
</div>
<hr style="border-color:black;">
<!-- cards -->
<div class="row">
<div class="col-md-12">
    <div class="col-md-4 ">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                Approved Business Posts  
                    <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-business.listing','approve')}}">View All
                        <i class="fa fa-arrow-right"></i>
                    </a>
            </div>
            <div class="panel-body" style="padding:6px;">
                <div class="col-md-6 ">
                    <h2><b>{{$data['approved_posts'] ?? 0}}</b></h2>
                </div>
                <div class="col-md-6" style="color:#428bca;font-size:60px;">
                    <i class="fa fa-spinner pull-right"></i>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Pending Business Posts
                    <a style="float:right;color:white;margin:-8px 4px 3px 2px;"  href="{{route('admin-business.listing','pending')}}" >View All
                        <i class="fa fa-arrow-right"></i>
                    </a>
            </div>
            <div class="panel-body" style="padding:6px;">
                <div class="col-md-6">
                    <h2><b>{{$data['pending_posts'] ?? 0}}</b></h2>
                </div>
                <div class="col-md-6" style="color:#428bca;font-size:60px;">
                    <i class="fa fa-spinner pull-right"></i>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">De-Activated Jobs <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-business.listing','de-active')}}">View All
                        <i class="fa fa-arrow-right"></i>
                    </a></div>
            <div class="panel-body" style="padding:6px;">
                <div class="col-md-6">
                    <h2><b>{{$deActivejobs ?? 0}}</b></h2>
                </div>
                <div class="col-md-6" style="color:#428bca;font-size:60px;">
                    <i class="fa fa-spinner pull-right"></i>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div> -->
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Rejected Posts  <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-business.listing','reject')}}">View All
                        <i class="fa fa-arrow-right"></i>
                    </a></div>
            <div class="panel-body" style="padding:6px;">
                <div class="col-md-6">
                    <h2><b>{{$data['reject_posts'] ?? 0}}</b></h2>
                </div>
                <div class="col-md-6" style="color:#428bca;font-size:60px;">
                    <i class="fa fa-spinner pull-right"></i>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Queries <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-business.listing','query')}}">View All
                        <i class="fa fa-arrow-right"></i>
                    </a></div>
            <div class="panel-body" style="padding:6px;">
                <div class="col-md-6">
                    <h2><b>{{$data['queries'] ?? 0}}</b></h2>
                </div>
                <div class="col-md-6" style="color:#428bca;font-size:60px;">
                    <i class="fa fa-spinner pull-right"></i>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">Reports 
            <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-business.listing','report')}}">View All
                        <i class="fa fa-arrow-right"></i>
                    </a>
            </div>
            <div class="panel-body" style="padding:6px;">
                <div class="col-md-6">
                    <h2><b>{{$data['reports'] ?? 0}}</b></h2>
                </div>
                <div class="col-md-6" style="color:#428bca;font-size:60px;">
                    <i class="fa fa-spinner pull-right"></i>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- cards -->
<!-- bottom -->
<!-- <div class="row" >
<div class="col-md-12">
<div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Reports 
                <a  style="float:right;color:white;margin:-8px 4px 3px 2px;"  href="https://www.addressguru.in/admin-user/create">View All
                            <i class="fa fa-arrow-right"></i>
                        </a>
                </div>
                <div class="panel-body" style="padding:6px;">
                    <div class="col-md-6">
                        <h2><b>18</b></h2>
                    </div>
                    <div class="col-md-6" style="color:#428bca;font-size:60px;">
                        <i class="fa fa-spinner pull-right"></i>
                    </div>
                </div>
            </div>
</div>
<div class="col-md-6">
    <div class="panel panel-primary">
                <div class="panel-heading">Reports 
                <a  style="float:right;color:white;margin:-8px 4px 3px 2px;"  href="https://www.addressguru.in/admin-user/create">View All
                            <i class="fa fa-arrow-right"></i>
                        </a>
                </div>
                <div class="panel-body" style="padding:6px;">
                    <div class="col-md-6">
                        <h2><b>18</b></h2>
                    </div>
                    <div class="col-md-6" style="color:#428bca;font-size:60px;">
                        <i class="fa fa-spinner pull-right"></i>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
</div>
</div>
</div> -->
<!-- bottom  -->
</h3></div>
    <!-- /.container-fluid -->
@stop