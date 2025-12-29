<div class="row{{ $errors->has('ad_description') ? ' has-error' : '' }}">
					<div class="col-md-12">
						<label>Ad Description (min 200 max 2500 Character limit)<span>*</span> </label> &nbsp;&nbsp;&nbsp; <b>( <span id="charNum"> 200 </span> )</b>
						
						{!! Form::textarea('ad_description', old('ad_description'), ['rows' => 6, 'class'=>'form-control', 'placeholder'=>'Type here...', 'required'=>'required', 'maxlength'=>18000, 'id'=>'field', 'onkeyup'=>'countChar(this)']) !!}
						
						@if ($errors->has('ad_description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ad_description') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
				</div>