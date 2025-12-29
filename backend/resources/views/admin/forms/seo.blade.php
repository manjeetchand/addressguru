<div class="col-md-12">
	<h2><b>Make It Search Engine Friendly</b></h2><hr style="border-color:black;">
</div>
<div class="row{{ $errors->has('description') ? ' has-error' : '' }}">
	<div class="col-md-12">
		<label>Short Description of Business (170 Character limit)<span>*</span></label>
		
		<textarea rows="3" name="description" class="form-control" maxlength="170" placeholder="Type here..." required="required">{{ $seo ? $seo->s_description : old('description') }}</textarea>
		
		@if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
		<br/>
	</div>
</div>
<div class="row{{ $errors->has('keywords') ? ' has-error' : '' }}">
	<div class="col-md-12">
		<label>Keywords (4 max keywords)<span>*</span></label>
		
		<input type="text" name="keywords" value="{{ $seo ? $seo->keywords : old('keywords') }}" maxlength="200" required="required" placeholder="Keywords (keyword, keyword)" class="form-control">
		
		@if ($errors->has('keywords'))
            <span class="help-block">
                <strong>{{ $errors->first('keywords') }}</strong>
            </span>
        @endif
		<br/>
	</div>
</div>