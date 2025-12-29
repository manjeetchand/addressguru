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
                <th>Logo</th>
                <th>User</th>
                <th>Title</th>
                <th>Created at</th>
                <th style="width:200px;">Status</th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php $i = 1; ?>
            @if(isset($jobs))
            @foreach($jobs as $key)
            <tr id="row{{$i}}">
                <td><img src="{{asset($key->company->image ?? '')}}" alt="{{$key->title}}" class="img-responsive" style="height:80px;width:100px;"></td>
                {{-- <td><a href="{{url('admin-listing', $key->user->id)}}">{{$key->user->name}} <small>({{$key->user->role->name}})</small></a></td> --}}
                <td><a href="{{url('/preview', $key->slug)}}">{{$key->title}}</a></td>
                <td>{{$key->paid ? 'Paid' : 'UnPaid'}}</td>
                <td>{{date('d F, Y', strtotime($key->created_at))}}</td>
                <td>
                    @if($type === 'approve')
                        <a href="javascript::void(0)" id="app_btn{{$i}}" onclick="get_approve(<?php echo $key->id; ?>,'reject')" class="btn btn-danger btn-sm pull-left" style="margin-left:10px;"><i class="fa fa-ban fa-fw"></i> Reject</a>
                    @elseif($type === 'pending')
                        <a href="javascript::void(0)" id="app_btn{{$i}}" onclick="get_approve(<?php echo $key->id; ?>,'approve')" class="btn btn-success btn-sm pull-left"><i class="fa fa-check-circle fa-fw"></i> Approve</a>
                    @elseif($type === 'de-active')
                        <a href="javascript::void(0)" id="app_btn{{$i}}" onclick="get_approve(<?php echo $key->id; ?>,'active')" class="btn btn-success btn-sm pull-left" style="margin-left:10px;"><i class="fa fa-check-circle fa-fw"></i>Active</a>
                        <a href="javascript::void(0)" id="app_btn{{$i}}" onclick="get_approve(<?php echo $key->id; ?>, 'reject')" class="btn btn-danger btn-sm pull-left" style="margin-left:10px;"><i class="fa fa-ban fa-fw"></i>Reject</a>
                    @elseif($type === 'reject')
                        <a href="javascript::void(0)" id="app_btn{{$i}}" onclick="get_approve(<?php echo $key->id; ?>, 'active')" class="btn btn-danger btn-sm pull-left" style="margin-left:10px;"><i class="fa fa-ban fa-fw"></i>Active</a>
                    @endif 
                </td>
            </tr>
            <?php $i++; ?>
            @endforeach 
            @endif
        </tbody>
    </table>
    @if(isset($jobs))
    {!! $jobs->render() !!}
    @endif
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script> 
function get_approve(id, status) {
    swal({
        title: "Are you sure?",
        text: "Do you want to change the status?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willApprove) => {
        if (willApprove) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("admin-jobs.active", 1) }}',
                type: 'POST',
                data: { wid: id, status: status },
                success: function(datalink) {
                    swal({
                        title: "Success!",
                        text: "The status has been updated successfully.",
                        icon: "success",
                    });
                    console.log(datalink);
                    location.reload();
                },
                error: function(error) {
                    swal({
                        title: "Error!",
                        text: "An error occurred while updating the status.",
                        icon: "error",
                    });
                    console.error(error);
                }
            });
        } else {
            swal("Action cancelled", "No changes were made.", "info");
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