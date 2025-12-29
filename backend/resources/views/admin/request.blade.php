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
<h1>Approval Request <span class="pull-right"><a href="{{url('admin-listing', 67)}}" class="btn btn-danger btn-sm"><i class="fa fa-ban fa-fw"></i> Rjected ({{number_format($rjected)}})</a></span></h1>
<hr/>
<div class="table-responsive">
    <table class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th>Business Image</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Payment Status</th>
                <th>Created at</th>
                <th style="width:200px;">Status</th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php $i = 1; ?>
            @foreach($data as $key)
            <tr id="row{{$i}}">
                <td>
                    <img src="{{url('/')}}/images/{{$key->photo}}" alt="{{$key->business_name}}" class="img-responsive" style="height:80px;width:100px;">
                </td>
                <td>
                    <a href="{{url('admin-listing', $key->user->id)}}">{{$key->user->name}} <small>({{$key->user->role->name}})</small></a>
                </td>
                <td>
                    @if($key->category->id == 52)
                    <a href="{{url('/profile-preview', $key->slug)}}">{{$key->business_name}}</a>
                    @else
                    <a href="{{url('/preview', $key->slug)}}">{{$key->business_name}}</a>
                    @endif
                    {{($key->lapps[0]->user_id != 0) ? 'Edited' : ''}}
                </td>
                <td>{{$key->category ? $key->category->name : 'Uncategorized'}}</td>
                <td>{{$key->paid ? 'Paid' : 'UnPaid'}}</td>
                <td>{{date('d F, Y', strtotime($key->created_at))}}</td>
                <td>
                    <a href="javascript::void(0)" id="app_btn{{$i}}" onclick="get_approve(<?php echo $key->id; ?>, '<?php echo 'row'.$i; ?>', '<?php echo 'app_btn'.$i; ?>')" class="btn btn-success btn-sm pull-left"><i class="fa fa-check-circle fa-fw"></i> Approve</a>
                    <a href="javascript::void(0)" id="reject_btn{{$i}}" onclick="get_reject(<?php echo $key->id; ?>, '<?php echo 'row'.$i; ?>', '<?php echo 'reject_btn'.$i; ?>')" class="btn btn-danger btn-sm pull-left" style="margin-left:10px;"><i class="fa fa-ban fa-fw"></i> Reject</a>
                </td>
            </tr>
            <?php $i++; ?>
            @endforeach
        </tbody>
    </table>
    {!! $data->render() !!}
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    function get_approve(a, b, c) 
    {
        var pid, row, abtn,

        row = document.getElementById(b);
        abtn = document.getElementById(c);

        abtn.innerHTML = "<i class='fa fa-check fa-fw'></i> Approved";
        abtn.setAttribute('class', 'btn btn-primary pull-left btn-sm');
        abtn.removeAttribute('onclick');
        row.style.background = "#eee";
        setTimeout(function(){row.parentNode.removeChild(row);}, 1000);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{route("admin-query.update", 1)}}',
            type: 'PATCH',
            data: {wid: a, status : 1},
            success: function(datalink){
                console.log(datalink);
                }
            });
    }

    function get_reject(a, b, c) 
    {
        var pid, row, rbtn, con,

        con = confirm('Are you sure?');

        if (con != true) 
        {
            return
        }

        row = document.getElementById(b);
        rbtn = document.getElementById(c);

        rbtn.innerHTML = "<i class='fa fa-check fa-fw'></i> Rejected";
        rbtn.setAttribute('class', 'btn btn-primary pull-left btn-sm');
        rbtn.setAttribute('style', 'margin-left:8px;');
        rbtn.removeAttribute('onclick');
        row.style.background = "#eee";
        setTimeout(function(){row.parentNode.removeChild(row);}, 1000);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{route("admin-banner.store")}}',
            type: 'POST',
            data: {post_id: a},
            success: function(datalink){
                console.log(datalink);
                }
            });
    }



    $(document).ready(function()
    {
        $("#myInput").on("keyup", function() 
        {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() 
            {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > 0)
            });
        });
    });
</script>
@stop

