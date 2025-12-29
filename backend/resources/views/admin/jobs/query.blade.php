@extends('layouts.admin')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@if(Session::has('transfer'))
<div class="alert alert-success" style="margin-top:10px;">
    <strong> {{session('transfer')}}</strong>
</div>
@endif
<a href="/admin" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<br/><br/>
<input class="form-control" id="myInput" type="text" placeholder="Search..">
<hr/>
<div class="table-responsive">
    <table class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>Title</th>
                @if($type === 'query')
                <th>Queries</th>
                @else
                <th>Report</th>
                @endif
                <th>Phone no.</th>
                <th>State</th>
                <th>City</th>
                <th style="width:200px;">Status</th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php $i = 1; ?>
            @if(isset($jobs))
            @foreach($jobs as $key)
            <tr id="row{{$i}}">
                <td>{{$i}}</td>
                <td><a href="{{url('/preview', $key->slug)}}">{{$key->title}}</a><br>
                    <small>{{$key->user->name ?? ''}} || {{date('d F, Y', strtotime($key->created_at))}}</small>
                 </td>
                @if($type === 'query')
                <td><a href="{{url('admin-listing', $key->user->id)}}">Queries ({{$key->quires->count() ?? 0}})</small></a> </td>
                @else
                <td><a href="{{url('admin-listing', $key->user->id)}}">Report ({{$key->report->count() ?? 0}})</small></a> </td>
                @endif
                <td>{{$key->phone}}</td>
                <td>{{$key->state}}</td>
                <td>{{$key->city}}</td>
                <td>
                    <a href="javascript::void(0)" id="app_btn{{$i}}" onclick="get_approve(<?php echo $key->id; ?>, '<?php echo 'row'.$i; ?>', '<?php echo 'app_btn'.$i; ?>')" class="btn btn-success btn-sm pull-left"><i class="fa fa-check-circle fa-fw"></i> Approve</a>
                    <!--<a href="javascript::void(0)" id="reject_btn{{$i}}" onclick="get_reject(<?php echo $key->id; ?>, '<?php echo 'row'.$i; ?>', '<?php echo 'reject_btn'.$i; ?>')" class="btn btn-danger btn-sm pull-left" style="margin-left:10px;"><i class="fa fa-ban fa-fw"></i> Reject</a>-->
                </td>
            </tr>
            <?php $i++; ?>
            @endforeach
            @endif
        </tbody>
    </table>
    {!! $jobs->render() !!}
</div>
@stop