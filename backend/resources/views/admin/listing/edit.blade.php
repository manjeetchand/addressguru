@extends('layouts.admin')

<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
@if(Session::has('update'))

          <div class="alert alert-success" style="margin-top:10px;">
            <strong> {{session('update')}}</strong>
          </div>

        @endif
<h1 class="pull-left">Edit</h1>
@if($post->category->id == 52)

@else
<a href="{{url('admin-media', $post->id)}}" class="btn btn-success pull-right" style="margin-top:25px;"><i class="fa fa-edit"></i> Slider</a>
@endif
<br/><br/><br/><br/>
{!! Form::model($post, ['method'=>'PATCH', 'action'=>['AdminPost@update', $post->id]]) !!}
				<div class="row">
					<div class="col-md-6">
						<div class="{{ $errors->has('business_name') ? ' has-error' : '' }}">
							<label>Business Name <span>*</span></label>
							<input type="text" name="business_name" class="form-control" value="{{$post->business_name}}">
							@if ($errors->has('business_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('business_name') }}</strong>
                            </span>
                        	@endif
						</div>
					</div>
					<div class="col-md-6">
						<div class="{{ $errors->has('category_id') ? ' has-error' : '' }}">
							<label>Category <span>*</span></label>
							<select name="category_id" class="form-control" id="cat_id" required="required" onchange="get_subcate()">
								<option value="{{$post->category->id}}">{{$post->category->name}}</option>
								@foreach($cat as $cats)
								<option value="{{$cats->id}}">{{$cats->name}}</option>
								@endforeach
							</select>
							@if ($errors->has('category_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('category_id') }}</strong>
                            </span>
                        	@endif
						</div>
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-12">
						<div class="{{ $errors->has('subcategory_id') ? ' has-error' : '' }}">
							<label>Sub Category <span>*</span></label>
							<select class="form-control" name="subcategory_id" id="first_result">
								<option value="{{isset($post->subcategory) ? $post->subcategory->id : ''}}">{{isset($post->subcategory) ? $post->subcategory->name : ''}}</option>
								@foreach($sub as $subs)
								<option value="{{isset($subs) ? $subs->id : ''}}">{{isset($subs) ? $subs->name : ''}}</option>
								@endforeach
							</select>
							@if ($errors->has('subcategory_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subcategory_id') }}</strong>
                            </span>
                        	@endif
						</div>
					</div>
				</div><br/>
				<div class="row">
				<div class="{{ $errors->has('business_address') ? ' has-error' : '' }}">
					<div class="col-md-6">
						<label>Business Address <span>*</span></label>
						<textarea class="form-control" rows="3" placeholder="Address" name="business_address">{{ $post->business_address }}</textarea>
						@if ($errors->has('business_address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('business_address') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
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
						<label>Ad Description (min 200 max 1800 Character limit)<span>*</span></label>
						<textarea class="form-control" rows="6" placeholder="Type here..." name="ad_description" maxlength="1800">{{ $post->ad_description }}</textarea>
						@if ($errors->has('ad_description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ad_description') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
				</div>

				<div class="row">
					@if($post->payment == '[""]' OR $post->payment == '[null]')

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
				
				@if($post->facility == '[""]' OR $post->facility == '[null]')

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
				@if($post->course == '[""]' OR $post->course == '[null]')

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
				@if($post->service == '[""]' OR $post->service == '[null]')

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
@foreach($local as $lo)
<div class="row">
			<div class="col-md-12">
				<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
					
						<label>Locality<span>*</span></label>
						
						<input type="text" name="location" value="{{ $lo->location }}" class="form-control" placeholder="Locality">
						
						@if ($errors->has('location'))
                            <span class="help-block">
                                <strong>{{ $errors->first('location') }}</strong>
                            </span>
                    @endif
					<br/>
				</div>
			</div>
		</div><br/>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
					
						<label>State<span>*</span></label>
						
						<input type="text" name="state" value="{{ $lo->state }}" class="form-control" placeholder="State">
						
						@if ($errors->has('state'))
                            <span class="help-block">
                                <strong>{{ $errors->first('state') }}</strong>
                            </span>
                    @endif
					<br/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
					
						<label>City<span>*</span></label>
						
						<input type="text" name="city" value="{{ $lo->city }}" class="form-control" placeholder="City">
						
						@if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                    @endif
					<br/>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					
						<label>Email<span>*</span></label>
						
						<input type="text" name="email" value="{{ $lo->email }}" class="form-control" placeholder="Email">
						
						@if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
					<br/>
				</div>
			</div>
		</div>
		@endforeach<br/>
				@foreach($seo as $seos)
				<div class="row">
					<div class="col-md-6{{ $errors->has('s_description') ? ' has-error' : '' }}">
						<label>META Description<span>*</span></label>
						<textarea class="form-control" rows="4" placeholder="Type here..." name="s_description" maxlength="170">{{ $seos->s_description }}</textarea>
						@if ($errors->has('s_description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('s_description') }}</strong>
                            </span>
                        @endif
						
					</div>
					<div class="col-md-6{{ $errors->has('keywords') ? ' has-error' : '' }}">
						<label>META Keywords<span>*</span></label>
						<textarea class="form-control" rows="4" placeholder="Type here..." name="keywords" maxlength="170">{{ $seos->keywords }}</textarea>
						@if ($errors->has('keywords'))
                            <span class="help-block">
                                <strong>{{ $errors->first('keywords') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
				</div>
				@endforeach
		
		
		<div class="form-group">
			<center><button class="btn btn-primary">Update</button></center>
		</div>

	{!! Form::close() !!}


@stop
@section('footer')
<script>

function get_subcate() 
{
	var a = document.getElementById('cat_id').value;

	$.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
          url: '{{route("admin-listing.store")}}',
          type: 'post',
          data: { "a": a},
          success: function(data)
          {
             $("#first_result").html(data);
          }
      });

}


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