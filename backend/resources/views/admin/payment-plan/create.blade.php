@extends('layouts.admin')
@section('content')
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('insert'))
    <div class="alert alert-success">
        {{ Session::get('insert') }}
    </div>
@endif
 <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm" style="margin-top:10px;"><i class="fa fa-arrow-left fa-fw"></i> Go Back</a>
<h3><i class="fa fa-file fa-fw"></i> Payment Plan Create : </h3><hr>
  {!! Form::open(['method'=>'POST', 'action'=>['PaymentPackageController@store']]) !!}
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label>Plan Type</label>
            <select class="form-control" name="type" required="" fdprocessedid="pl8ho8">
              <option>Select type</option>
              <option value="JOBS">JOBS</option>
              <option value="MARKETPLACE">MARKETPLACE</option>
              <option value="BUSINESS">BUSINESS</option>
            </select>
        </div>
        <div class="form-group">
          <label>Sequence</label>
          <input type="number" name="sequence" placeholder="Sequence" class="form-control" value="" required="" fdprocessedid="0cgbfl">
        </div>
        <div class="form-group">
          <label>Plan Name</label>
          <input type="text" name="name" placeholder="Plan Name" class="form-control " required="required" value="" fdprocessedid="6kk7n3">
        </div>
        <div class="form-group">
          <label>Price</label>
          <input type="number" name="price" placeholder="Plan Name" class="form-control" required="required" value="0" fdprocessedid="pskcwa">
        </div>
        <div class="form-group">
          <label>Days</label>
          <input type="number" name="days" placeholder="Plan Name" class="form-control" required="required" value="1" fdprocessedid="ivcd9q">
        </div>
        <div class="form-group">
          <label>Discount</label>
          <input type="number" name="discount" placeholder="Plan Name" class="form-control" required="required" value="0" fdprocessedid="3tomh">
        </div>
        <div class="form-group">
          <label>Plan Description</label>
          <textarea rows="5" name="description" placeholder="Plan description" class="form-control" data-qb-tmp-id="lt-781129" spellcheck="false" data-gramm="false"></textarea>
        </div>
        <div class="form-group">
          <label>Best Deal </label><br>
             <!-- Rounded switch -->
            <label class="switch">
              <input name="deal" type="checkbox">
              <span class="slider round"></span>
            </label>
        </div>
        <div class="form-group">
          <label>Active / DeActive</label><br>
             <!-- Rounded switch -->
            <label class="switch">
              <input name="status" type="checkbox">
              <span class="slider round"></span>
            </label>
        </div>
      </div>
    </div>
    <br>
    <div class="form-group">
      <button class="btn btn-primary btn-md" type="submit"><i class="fa fa-file fa-fw"></i> Create</button>
    </div>
     {!! Form::close() !!}
@endsection