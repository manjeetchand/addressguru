@extends('layouts.user')
<script src="{{ asset('js/corp.js') }}"></script>
<script src="{{ asset('js/cp.js') }}"></script>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/icropper.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<br/>
<a href="{{route('user.post.index')}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a><br/>
@if(Session::has('insert'))
    <div class="alert alert-success">
        <strong> {{session('insert')}}</strong>
    </div>
@endif
<h1>{{$post->business_name}}</h1><hr style="border-color:black;" />
Note* Image size must be: width - 750 pixel and height - 400 pixel

<div class="row">
	<div class="col-md-12">
		
    <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            <label>Choose Image</label>
            <input type="file" name="image" required="required" id="upload">
            @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <div id="upload-demo" style="width:350px;margin-left:2px;"></div>
        </div>
        <div class="form-group">
           <a class="btn btn-success btn-sm upload-result">Submit</a>
        </div>
		
	</div>
</div>
<br/>
<div class="table-responsive">
 <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Images</th>
        <th>Operation</th>
      </tr>
    </thead>
    <tbody>    		
    	@foreach($photo as $photos)

    		@if($post->id == $photos->post_id)
   		<tr>
   			<td>
   				<img src="/images/{{$photos->name}}" alt="{{$post->business_name}}" class="img-responsive image-resize" width="150px">
   			</td>
   			<td>

   				<!-- <a href="{{route('user.media.edit', $photos->id)}}" class="btn btn-success pull-left"><i class="fa fa-edit"></i></a> -->

   				{!! Form::open(['method'=>'DELETE', 'action'=>['UserMedia@destroy', $photos->id]]) !!}

   					<button class="btn btn-danger"><i class="fa fa-trash"></i></button>
   				{!! Form::close() !!}
   			</td>
   		</tr>
   			@endif

   		@endforeach
    </tbody>
  </table>
</div>

<script type="text/javascript">
    $.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 750,
        height: 400,
        type: 'square'
    },
    boundary: {
        width: 760,
        height: 410
    }
});
$('#upload').on('change', function () { 
    var reader = new FileReader();
    reader.onload = function (e) {
        $uploadCrop.croppie('bind', {
            url: e.target.result
        }).then(function(){
            console.log('jQuery bind complete');
        });
    }
    reader.readAsDataURL(this.files[0]);
    document.getElementById('apbut').style.display = 'block';
});
$('.upload-result').on('click', function (ev) {
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (resp) {
        $.ajax({
            url: "{{route('user.media.store')}}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                "image":resp,"id":<?php echo $post->id; ?>
            },
            success: function (data) {
              window.location.href = "/user/media/<?php $id = base64_encode($post->id); echo $id; ?>";
            }
        });
    });
});
</script>

@stop