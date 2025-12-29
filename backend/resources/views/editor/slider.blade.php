@extends('layouts.editor')


@section('content')
<h3>{{$post->business_name}}</h3><hr style="border-color:black;" />
<center>Note* Image size must be: width - 750 pixel and height - 400 pixel</center>
<div class="row">
	<div class="col-md-12">
		{!! Form::open(['action'=>'EditorImage@store', 'files'=>true, 'class'=>'dropzone']) !!}

			<input type="hidden" name="post_id" value="{{$post->id}}">
		{!! Form::close() !!}
	</div>
</div>
<br/>
<div class="table-responsive">
 <table class="table table-striped">
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

   				<a href="{{route('editor-image.edit', $photos->id)}}" class="btn btn-success pull-left"><i class="fa fa-edit"></i></a>
   			</td>
   		</tr>
   			@endif

   		@endforeach
    </tbody>
  </table>
</div>




@stop