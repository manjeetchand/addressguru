@extends('layouts.admin')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div>
@endif
<div style="padding:40px;">
<div class="row">
  <div class="col-md-12">
      {!! Form::open(['method'=>'POST', 'action'=>'AdminMessage@store']) !!}
      <div class="form-group row">
              <label for="" class="form-control-label">Select User</label>
              
                <select class="form-control selectpicker" id="cid" onchange="go()" data-live-search="true">
                  @foreach($user as $users)
                  <option value="{{$users->id}}" data-tokens="{{$users->name}}">{{$users->name}} ({{$users->email}})</option>
                  @endforeach
                </select>

              
            </div>
      {!! Form::close() !!}
      <br/>
      <div class="row" id="result">
        


      </div>
  </div>
</div>
</div>

<script type="text/javascript">
  function go() 
  {
    var d = document.getElementById("cid").value;

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{route("admin-message.store")}}',
            type: 'post',
            data: {wid: d},
            success: function(datalink){
                console.log(datalink);
                $("#result").html(datalink);
                }
            });
  }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
@stop