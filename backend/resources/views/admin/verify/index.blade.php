@extends('layouts.admin')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" />
<br/>
<a href="{{url('/admin')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<br/><br/>
<div class="row">
{!! Form::open(['method'=>'POST', 'action'=>'AdminVerify@store']) !!}
  
  <div class="col-md-12">
      <div class="form-group row">
                <select class="form-control selectpicker" name="user" data-live-search="true" onchange="this.form.submit()">
                  @foreach($user as $users)
                  <option value="{{$users->id}}" data-tokens="{{$users->name}}">{{$users->name}} ({{$users->email}})</option>
                  @endforeach
                </select>
            </div>
            </div>
{!! Form::close() !!}
</div>
<h3>Verify Listing {{number_format($per->total())}}</h3><hr/>
  <div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
   
      <tr>
        <th>User Name</th>
        <th>Post Name</th>
        <th>Created at</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>
   
        <?php $x = 1; ?>
        @foreach($per as $pers)
      <tr id="row{{$x}}">
       
        <td>{{$pers->user->name}}</td>
        <td><a href="{{url('preview', $pers->post->slug)}}">{{$pers->post->business_name}}</a></td>
        <td>{{date('d F, Y', strtotime($pers->created_at))}}</td>
        <td>
          <a href="javascript::void(0)" id="verify-btn{{$x}}" onclick="go_verify(<?php echo $pers->id; ?>, '<?php echo 'row'.$x; ?>', '<?php echo 'verify-btn'.$x; ?>')" class="btn btn-success btn-sm">Verify</a>
          <!-- {!! Form::model($pers, ['action'=>['AdminVerify@update', $pers->id], 'method'=>'PATCH']) !!}
            <button class="btn btn-success" style="padding:2px 15px 2px 15px;">Verify</button>
          {!! Form::close() !!} -->
          
        </td>
      </tr>
       <?php $x++; ?>
    @endforeach
   
    </tbody>
  </table>
</div>
{!! $per->render() !!}


<script type="text/javascript">
  function go_verify(a, b, c) 
  {
      var btn, row,

      btn = document.getElementById(c);
      row = document.getElementById(b);

      btn.innerHTML = "Verified";
      btn.setAttribute('class', 'btn btn-primary btn-sm');
      btn.removeAttribute('onclick');
      row.style.background = "#eee";
      setTimeout(function(){row.parentNode.removeChild(row);}, 1000);

      $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{route("admin-verify.update", 1)}}',
            type: 'PATCH',
            data: {wid: a},
            success: function(datalink){
                console.log(datalink);
                }
            });
  }
</script>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
@stop