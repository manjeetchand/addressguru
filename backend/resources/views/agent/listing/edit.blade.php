@extends('layouts.agent')


@section('content')
<br/>
<?php $id = base64_encode($post->id); ?>
<a href="{{url('agent/listing/'.$id)}}" style="font-size:20px;"><i class="fa fa-arrow-left"></i></a>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if(Session::has('update'))
        		<div class="alert alert-success" style="margin-top:20px;">
           			<strong> {{session('update')}}</strong>
        		</div>
    		@endif
		</div>
	</div>
</div>
<h1>Edit</h1>

{!! Form::model($post, ['method'=>'PATCH', 'action'=>['PartnerListing@update', $post->id]]) !!}
		<div class="row">
					<div class="col-md-6{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
						<label>Business Address <span>*</span></label>
						<textarea class="form-control" rows="3" placeholder="Address" name="business_address">{{ $post->business_address }}</textarea>
						@if ($errors->has('business_address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('business_address') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
					
					<div class="col-md-6{{ $errors->has('web_link') ? ' has-error' : '' }}">
						<label>Website Link <span>*</span></label>
						<input type="text" name="web_link" value="{{ $post->web_link}}" placeholder="Website Link" class="form-control">
						@if ($errors->has('web_link'))
                            <span class="help-block">
                                <strong>{{ $errors->first('web_link') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
				</div>

				@if($post->category->id == 52)
						<input type="hidden" name="map" value="no">
					<input type="hidden" name="video" value="no">
				@else
				<div class="row">
					<div class="col-md-6{{ $errors->has('map') ? ' has-error' : '' }}">
						<label>Map <span>*</span></label>
						<input type="text" name="map" value="{{ $post->map }}" class="form-control" placeholder="Map Link">
						@if ($errors->has('map'))
                            <span class="help-block">
                                <strong>{{ $errors->first('map') }}</strong>
                            </span>
                        @endif
					</div>
						
			
					<div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">
					<div class="col-md-6 videoid">
						<label>Video Link (youtube video id) ?<span>*</span></label>
						<input type="text" name="video" value="{{ $post->video }}" class="form-control" placeholder="Video Link">
						@if ($errors->has('video'))
                            <span class="help-block">
                                <strong>{{ $errors->first('video') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
					</div>
			
				</div>
				@endif
		
				<div class="row{{ $errors->has('ad_description') ? ' has-error' : '' }}">
					<div class="col-md-12">
						<label>Ad Description (800 Word limit)<span>*</span></label>
						<textarea class="form-control" rows="6" placeholder="Type here..." name="ad_description" maxlength="800">{{ $post->ad_description }}</textarea>
						@if ($errors->has('ad_description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ad_description') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
				</div>
				<div class="row">
					@if($post->payment == '[""]')

					<input type="hidden" name="payment[]" value=''>

				@else

					<div class="col-md-6{{ $errors->has('payment') ? ' has-error' : '' }}">
						<label>payment<span>*</span></label>
						<div class="table-responsive">
						<table class="table table-bordered" id="dynamic_field1">
							<tr>
								<td>
									<?php

          						$pay=json_decode($post->payment);?>
              					@foreach ($pay as $key11s1ss => $pays) 
              
                          
                  					<input type="text" name="payment[]" class="form-control name_list" value="{{$pays}}" required="required">
            
              					@endforeach

						


								</td>
								<td><button type="button" name="add" id="add1" class="btn btn-success">Add More</button></td>
							</tr>
						</table>
						</div>

						@if ($errors->has('payment'))
                            <span class="help-block">
                                <strong>{{ $errors->first('payment') }}</strong>
                            </span>
                        @endif
						
					</div>

				@endif
				
				@if($post->facility == '[""]')

				<input type="hidden" name="facility[]" value=''>
				@else

					<div class="col-md-6{{ $errors->has('facility') ? ' has-error' : '' }}">
						@if($post->category->id == 52)

							<label>Work Experience<span>*</span></label>

						@else

							<label>Facilities<span>*</span></label>

						@endif
						
						<div class="table-responsive">
						<table class="table table-bordered" id="dynamic_field">
							<tr>
								<td>
									<?php

          						$fac=json_decode($post->facility);?>
              					@foreach ($fac as $keys1ss => $facs) 
              
                          
                  					<input type="text" name="facility[]" class="form-control name_list" value="{{$facs}}" required="required">
            
              					@endforeach

						


								</td>
								<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
							</tr>
						</table>
						</div>

						@if ($errors->has('facility'))
                            <span class="help-block">
                                <strong>{{ $errors->first('facility') }}</strong>
                            </span>
                        @endif
						
					</div>

				@endif
				</div><br/>
				<div class="row">
				@if($post->course == '[""]')

				<input type="hidden" name="course[]" value=''>


				@else

					<div class="col-md-6{{ $errors->has('course') ? ' has-error' : '' }}">
						@if($post->category->id == 52)

							<label>Qulification<span>*</span></label>

						@else

							<label>Courses<span>*</span></label>

						@endif
						
						<div class="table-responsive">
						<table class="table table-bordered" id="dynamic_field2">
							<tr>
								<td>
									<?php

          						$cor=json_decode($post->course);?>
              					@foreach ($cor as $key1sss => $cors) 
              
                          
                  					<input type="text" name="course[]" class="form-control name_list" value="{{$cors}}" required="required">
            
              					@endforeach

						


								</td>
								<td><button type="button" name="add" id="add2" class="btn btn-success">Add More</button></td>
							</tr>
						</table>
						</div>

						@if ($errors->has('course'))
                            <span class="help-block">
                                <strong>{{ $errors->first('course') }}</strong>
                            </span>
                        @endif
						
					</div>

				@endif
				@if($post->service == '[""]')

				<input type="hidden" name="service[]" value=''>

				@else

					<div class="col-md-6{{ $errors->has('service') ? ' has-error' : '' }}">
						<label>Services<span>*</span></label>
						
						 <div class="table-responsive">
						<table class="table table-bordered" id="dynamic_field3">
							<tr>
								<td>
									<?php

          						$ser=json_decode($post->service);?>
              					@foreach ($ser as $keysss => $sers) 
              
                          
                  					<input type="text" name="service[]" class="form-control name_list" value="{{$sers}}" required="required">
            
              					@endforeach

						


								</td>
								<td><button type="button" name="add" id="add3" class="btn btn-success">Add More</button></td>
							</tr>
						</table>
						</div>

						@if ($errors->has('service'))
                            <span class="help-block">
                                <strong>{{ $errors->first('service') }}</strong>
                            </span>
                        @endif
						
					</div>

				@endif
				</div>
<br/>
		
		<div class="row">
			<div class="col-md-12">
				<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
					
						<label>Locality<span>*</span></label>
						@foreach($local as $lo)
						<input type="text" name="location" value="{{ $lo->location }}" class="form-control" placeholder="Locality">
						@endforeach
						@if ($errors->has('location'))
                            <span class="help-block">
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                    @endif
					<br/>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<center><button class="btn btn-primary">Update</button></center>
		</div>

	{!! Form::close() !!}


@stop
@section('footer')
<script>

$(document).ready(function(){
    var i=1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="facility[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
    });
    
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id"); 
        $('#row'+button_id+'').remove();
    });
    
    
    
});
$(document).ready(function(){
    var i=1;
    $('#add2').click(function(){
        i++;
        $('#dynamic_field2').append('<tr id="row'+i+'"><td><input type="text" name="course[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove2">X</button></td></tr>');
    });
    
    $(document).on('click', '.btn_remove2', function(){
        var button_id = $(this).attr("id"); 
        $('#row'+button_id+'').remove();
    });
    
    
    
});
$(document).ready(function(){
    var i=1;
    $('#add1').click(function(){
        i++;
        $('#dynamic_field1').append('<tr id="row'+i+'"><td><input type="text" name="payment[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove1">X</button></td></tr>');
    });
    
    $(document).on('click', '.btn_remove1', function(){
        var button_id = $(this).attr("id"); 
        $('#row'+button_id+'').remove();
    }); 
});
$(document).ready(function(){
    var i=1;
    $('#add3').click(function(){
        i++;
        $('#dynamic_field3').append('<tr id="row'+i+'"><td><input type="text" name="service[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove3">X</button></td></tr>');
    });
    
    $(document).on('click', '.btn_remove3', function(){
        var button_id = $(this).attr("id"); 
        $('#row'+button_id+'').remove();
    });
});
</script>
@stop