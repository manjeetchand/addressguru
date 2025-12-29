<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
@extends('layouts.admin')


@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
        @if(Session::has('transfer'))

          <div class="alert alert-success" style="margin-top:10px;">
            <strong> {{session('transfer')}}</strong>
          </div>

        @endif
    </div>
  </div>
</div>

<h3>Transfer Ownership - <a>{{$post->business_name}}</a></h3><hr/>
<div class="row">
  
      {!! Form::open(['method'=>'PATCH', 'action'=>['AdminIndex@update', $post->id]]) !!}
    <div class="col-md-11">
      <div class="form-group row">
              
              
                <select class="form-control selectpicker" name="transfer" data-live-search="true">
                  @foreach($user as $users)
                  <option value="{{$users->id}}" data-tokens="{{$users->name}}">{{$users->name}} ({{$users->email}})</option>
                  @endforeach
                </select>

              
            </div>
            </div>
  <div class="col-md-1">
  <button class="btn btn-success">Transfer</button>
</div>
      {!! Form::close() !!}
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
@stop