	<div class="col-md-12">
	<h2><b>Social Details</b></h2><hr style="border-color:black;">
</div>
				<div class="row{{ $errors->has('web_link') ? ' has-error' : '' }}">
					<div class="col-md-12">
						<label>Website Link (Facebook page, Twitter page, etc)</label>
						
						{!! Form::text('web_link', null, ['class'=>'form-control', 'value'=>'old("web_link")', 'placeholder'=>'Website Link']) !!}
						
						@if ($errors->has('web_link'))
                            <span class="help-block">
                                <strong>{{ $errors->first('web_link') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
				</div>
				<input type="hidden" name="social" value="0">
				<div class="row">
					<div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">
					<div class="col-md-8 videoid">
						<label>Video Link (youtube video id) ?</label>
						
						{!! Form::text('video', null, ['class'=>'form-control', 'value'=>'old("video")', 'placeholder'=>'Video Link']) !!}
						
						@if ($errors->has('video'))
                            <span class="help-block">
                                <strong>{{ $errors->first('video') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
					<div class="col-md-4{{ $errors->has('image') ? ' has-error' : '' }}">
						<label>Featured Image <span>*</span></label>
						@if($listing->photo != null)
						<br/><img src="{{url('/')}}/images/{{$listing->photo}}" class="img-responisve" alt="image" width="100px"><br/><br/>
						
						<input type="file" name="image" value="{{ old('image') }}">
						
						@else
						
						<input type="file" name="image" value="{{ old('image') }}" required="required">
						
						@endif
						@if ($errors->has('image'))
                            <span class="help-block">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
						
					</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<label>Map (enabled source)</label>
						
						{!! Form::text('map', null, ['class'=>'form-control', 'value'=>'old("map")', 'placeholder'=>'Map Link']) !!}
						



      					<!-- <div class="form-group">
      						<label>Enter your Address</label>
        					<input type="text" id="searchmap" class="form-control">
        					<br/>
        					<div id="map-canvas"></div>
        					
      					</div>
      					<div class="form-group">
        					<input type="hidden" class="form-control input-sm" name="lat" id="lat">
      					</div>
      					<div class="form-group">
        					<input type="hidden" class="form-control input-sm" name="lng" id="lng">
      					</div> -->
  					</div>
				</div>