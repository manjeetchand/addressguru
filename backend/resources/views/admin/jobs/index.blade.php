@extends('layouts.admin')
@section('content')
<style>
    .panel-primary>.panel-heading {
        font-size: 17px;
        font-weight: bolder;
    }
</style>
<div>
    <h3>Total Jobs Listings {{$data['all_jobs'] ?? 0}}</h3>
    <hr style="border-color:black;">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4 ">
                <div class="panel panel-primary ">
                    <div class="panel-heading">
                        Approved Jobs  
                            <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-job.listing','approve')}}">View All
                                <i class="fa fa-arrow-right"></i>
                            </a>
                    </div>
                    <div class="panel-body" style="padding:6px;">
                        <div class="col-md-6 ">
                            <h2><b>{{$data['approved_jobs'] ?? 0}}</b></h2>
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
                    <div class="panel-heading">Pending Jobs
                            <a style="float:right;color:white;margin:-8px 4px 3px 2px;"  href="{{route('admin-job.listing','pending')}}" >View All
                                <i class="fa fa-arrow-right"></i>
                            </a>
                    </div>
                    <div class="panel-body" style="padding:6px;">
                        <div class="col-md-6">
                            <h2><b>{{$data['pending_jobs'] ?? 0}}</b></h2>
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
                    <div class="panel-heading">Rejected Jobs  <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-job.listing','reject')}}">View All
                                <i class="fa fa-arrow-right"></i>
                            </a></div>
                    <div class="panel-body" style="padding:6px;">
                        <div class="col-md-6">
                            <h2><b>{{$data['rejected_jobs'] ?? 0}}</b></h2>
                        </div>
                        <div class="col-md-6" style="color:#428bca;font-size:60px;">
                            <i class="fa fa-spinner pull-right"></i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Active Jobs <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-job.listing','de-active')}}">View All
                                <i class="fa fa-arrow-right"></i>
                            </a></div>
                    <div class="panel-body" style="padding:6px;">
                        <div class="col-md-6">
                            <h2><b>{{$data['active_jobs'] ?? 0}}</b></h2>
                        </div>
                        <div class="col-md-6" style="color:#428bca;font-size:60px;">
                            <i class="fa fa-spinner pull-right"></i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">De-Activated Jobs <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-job.listing','de-active')}}">View All
                                <i class="fa fa-arrow-right"></i>
                            </a></div>
                    <div class="panel-body" style="padding:6px;">
                        <div class="col-md-6">
                            <h2><b>{{$data['in_active_jobs'] ?? 0}}</b></h2>
                        </div>
                        <div class="col-md-6" style="color:#428bca;font-size:60px;">
                            <i class="fa fa-spinner pull-right"></i>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Queries <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-job.listing','query')}}">View All
                                <i class="fa fa-arrow-right"></i>
                            </a></div>
                    <div class="panel-body" style="padding:6px;">
                        <div class="col-md-6">
                            <h2><b>{{$queries ?? 0}}</b></h2>
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
                    <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-job.listing','report')}}">View All
                                <i class="fa fa-arrow-right"></i>
                            </a>
                    </div>
                    <div class="panel-body" style="padding:6px;">
                        <div class="col-md-6">
                            <h2><b>{{$reports ?? 0}}</b></h2>
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
</div>
@stop