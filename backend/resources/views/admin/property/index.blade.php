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
    <span style="color:#337AB7;margin:5px 10px  5px 2px;"> 
        <i class="fa fa-edit"></i> {{$allproperty ?? 0}}
    </span> Total Property Listings |

    <span style="color:#337AB7;margin:5px 10px  5px 2px;"> 
        <i class="fa fa-edit"></i> Total Payments    
    </span> 4,616

</div>


<hr style="border-color:black;">

<!-- <div style="margin:0 0 20px 0;" class="col-md-12 mb-5">
    <form action="https://www.addressguru.in/admin-jobs/jobs/search" method="get">
        <input style="border:3px solid #ECF2FF;background-color:white; box-shadow: 5px 5px #ECF2FF;" type="text" name="search" class="form-control" placeholder="Search Job Here..">
    </form>
</div> -->

<!-- cards -->
<div class="row">
<div class="col-md-12">
    <div class="col-md-4 ">
        <div class="panel panel-primary ">
            <div class="panel-heading">
                Approved Property  
                    <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-property.listing','approve')}}">View All
                        <i class="fa fa-arrow-right"></i>
                    </a>
            </div>
            <div class="panel-body" style="padding:6px;">
                <div class="col-md-6 ">
                    <h2><b>{{$approvedproperty ?? 0}}</b></h2>
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
            <div class="panel-heading">Pending Property
                    <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-property.listing','pending')}}">View All
                        <i class="fa fa-arrow-right"></i>
                    </a>
            </div>
            <div class="panel-body" style="padding:6px;">
                <div class="col-md-6">
                    <h2><b>{{$pendingproperty ?? 0}}</b></h2>
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
            <div class="panel-heading">De-Activated Property <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-property.listing','de-active')}}">View All
                        <i class="fa fa-arrow-right"></i>
                    </a></div>
            <div class="panel-body" style="padding:6px;">
                <div class="col-md-6">
                    <h2><b>{{$deActiveproperty ?? 0}}</b></h2>
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
            <div class="panel-heading">Rejected Property  <a style="float:right;color:white;margin:-8px 4px 3px 2px;" href="{{route('admin-property.listing','reject')}}">View All
                        <i class="fa fa-arrow-right"></i>
                    </a></div>
            <div class="panel-body" style="padding:6px;">
                <div class="col-md-6">
                    <h2><b>{{$rejectedproperty ?? 0}}</b></h2>
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