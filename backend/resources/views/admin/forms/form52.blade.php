
	
	
			
				<br/>
			
			
				
				
						
				<div class="row">
					<div class="{{ $errors->has('business_name') ? ' has-error' : '' }}">
						<div class="col-md-6">
							<label>Full Name <span>*</span></label>
							
								<input type="text" name="business_name" placeholder="Full Name" class="form-control" value="{{ isset($listing) ? $listing->business_name : old('business_name') }}" required="required">
							
							@if ($errors->has('business_name'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('business_name') }}</strong>
                        	    </span>
                      		@endif
							
						</div>
						<div class="col-md-6">
						<label>Business Profile <span>*</span></label>
						
						<input type="text" name="only_for" class="form-control" placeholder="Business Profile"  value="{{ isset($listing) ? $listing->only_for : old('only_for') }}" required="required">
						
					</div>
					</div>
					
				</div><br/>
				<div class="row{{ $errors->has('business_address') ? ' has-error' : '' }}">
					<div class="col-md-12">
						<label>Address <span>*</span></label>
						
						<textarea class="form-control" rows="3" placeholder="Address" name="business_address">{{ isset($listing) ? $listing->business_address : old('business_address') }}</textarea>
						
						@if ($errors->has('business_address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('business_address') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
				</div>
				@include('admin.forms.des')
				<div class="row">
					<div class="col-md-6">
						<label>Qualification</label>
						<div class="table-responsive">
						<table class="table table-bordered" id="dynamic_field1">
							<tr>
								<td><input type="text" name="course[]" placeholder="Qualification" class="form-control name_list" /></td>
								<td><button type="button" name="add" id="add1" class="btn btn-success">Add More</button></td>
							</tr>
						</table>
					</div>
						      	
        
					</div>
					<div class="col-md-6">
						<label>Work Experience<span>*</span></label>
						<div class="table-responsive">
						<table class="table table-bordered" id="dynamic_field">
							<tr>
								<td><input type="text" name="facility[]" placeholder="Work Experience" class="form-control name_list" /></td>
								<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
							</tr>
						</table>
					</div>
						
				</div>
			</div><br/>
				
				
				<input type="hidden" name="service[]"><input type="hidden" name="ifsc">
				<input type="hidden" name="job_category">
				<input type="hidden" name="r_type"><input type="hidden" name="floor">
				<input type="hidden" name="area"><input type="hidden" name="furnished">
				<input type="hidden" name="bathroom"><input type="hidden" name="religion_view">
				<input type="hidden" name="rent"><input type="hidden" name="payment[]">
				<input type="hidden" name="h_star"><input type="hidden" name="map" value="no">
				<input type="hidden" name="video" value="no"><input type="hidden" name="dwelling">
				<input type="hidden" name="list_by"><input type="hidden" name="pet_friend"><input type="hidden" name="bedroom">
				<input type="hidden" name="facing">

				
				

<script>
$(document).ready(function(){
	var i=1;
	$('#add1').click(function(){
		i++;
		$('#dynamic_field1').append('<tr id="row'+i+'"><td><input type="text" name="course[]" placeholder="Qualification" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove1">X</button></td></tr>');
	});
	
	$(document).on('click', '.btn_remove1', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
	
	
	
});
</script>
	<script>
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="facility[]" placeholder="Work Experience" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
	});
	
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
	
	
	
});
</script>	


	      