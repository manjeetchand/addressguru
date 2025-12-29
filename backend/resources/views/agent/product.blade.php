@extends('layouts.user')
@section('content')
<?php 
    use Illuminate\Support\Facades\Crypt;
    ?>
    @if(Session::has('insert'))
                <div class="alert alert-success" style="margin-top:20px;">
                    <strong> {{session('insert')}}</strong>
                </div>
            @endif
<h3>Product</h3>
<hr/>
<div class="table-responsive">
    @if(count($pro) == 0)
    <center>No Record Found</center>
    @else
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Created at</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pro as $posts)
            <tr>
                <td>
                    <a href="{{$posts->post_status ? url('marketplace-preview', $posts->slug) : url('sell-step-one-edit', Crypt::encrypt($posts->id))}}">{{$posts->title}}</a>
                </td>
                <td>{{$posts->mcategory ? $posts->mcategory->name : 'Uncategorized'}} <small>{{$posts->msubcategory ? '('.$posts->msubcategory->name.')' : ''}}</small></td>
                <td>{{$posts->status == 1 ? 'Published' : 'Under-Review'}}</td>
                <td>{{date('d M, Y', strtotime($posts->created_at))}}</td>
                <td style="width:200px;">
                    <a href="{{url('sell-step-one-edit', Crypt::encrypt($posts->id))}}" class="btn btn-success btn-sm pull-left"><i class="fa fa-edit fa-fw"></i></a>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['AgentPayment@destroy', $posts->id], 'onsubmit'=>'return confirm("Are you sure?");']) !!}
                    <button class="btn btn-danger btn-sm pull-left" style="margin-left:10px;"><i class="fa fa-trash fa-fw"></i></button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {!! $pro->render() !!}
    @endif
</div>
@stop

