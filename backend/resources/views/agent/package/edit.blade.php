@extends('layouts.agent')

@section('content')

<h1>Edit</h1><hr/>
 @if(Session::has('update'))

          <div class="alert alert-success">
            <strong> {{session('update')}}</strong>
          </div>

        @endif
{!! Form::model($pack, ['action'=>['AgentPack@update', $pack->id], 'method'=>'PATCH']) !!}
<div class="row">
  <div class="col-md-6{{ $errors->has('name') ? ' has-error' : '' }}">
    <div class="form-group">
      <label>Package Name</label>
      <input type="text" name="name" class="form-control" placeholder="Package Name" value="{{$pack->name}}">
      @if ($errors->has('name'))
        <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
      @endif
    </div> 
  </div>
  <div class="col-md-6{{ $errors->has('about') ? ' has-error' : '' }}">
    <div class="form-group">
      <label>Package Details</label>
      <textarea rows="3" class="form-control" name="about">{{$pack->about}}</textarea>
      @if ($errors->has('about'))
        <span class="help-block">
          <strong>{{ $errors->first('about') }}</strong>
        </span>
      @endif
    </div> 
  </div>
</div>
<div class="row">
  <div class="col-md-6{{ $errors->has('price') ? ' has-error' : '' }}">
    <div class="form-group">
       <label>Package Price</label>
      <input type="number" name="price" class="form-control" value="{{$pack->price}}">
       @if ($errors->has('price'))
        <span class="help-block">
          <strong>{{ $errors->first('price') }}</strong>
        </span>
      @endif
    </div> 
  </div>
  <div class="col-md-6{{ $errors->has('dates') ? ' has-error' : '' }}">
    <div class="form-group">
      <label>Package Days</label>
      <input type="text" name="dates" class="form-control" value="{{$pack->dates}}">
      @if ($errors->has('dates'))
        <span class="help-block">
          <strong>{{ $errors->first('dates') }}</strong>
        </span>
      @endif
    </div> 
  </div>
</div>
<div class="form-group"><br/>
  <center><button class="btn btn-success">Update</button></center>
</div>

{!! Form::close() !!}

@stop