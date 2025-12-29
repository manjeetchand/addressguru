	
	
			
			<br/>
			
		
				
			
						
				<div class="row">
					<div class="{{ $errors->has('business_name') ? ' has-error' : '' }}">
						<div class="col-md-12">
							<label>Business Name <span>*</span></label>
							
								<input type="text" name="business_name" placeholder="Business Name" class="form-control" value="{{ isset($listing) ? $listing->business_name : old('business_name') }}" required="required">
							
						 	@if ($errors->has('business_name'))
                            	<span class="help-block">
                                	<strong>{{ $errors->first('business_name') }}</strong>
                            	</span>
                        	@endif
							<br/>
						</div>
					</div>
					
				</div>
				
				<div class="row{{ $errors->has('business_address') ? ' has-error' : '' }}">
					<div class="col-md-12">
						<label>Business Address <span>*</span></label>
						
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
					@include('admin.forms.payment')
					<div class="col-md-6">
						<label>Services</label>
						<div class="table-responsive">
						@if(isset($listing))
						@if($listing->service == null)
						<table class="table table-bordered" id="dynamic_field">
							<tr>
								<td><input type="text" name="service[]" placeholder="Services" class="form-control name_list" /></td>
								<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
							</tr>
						</table>
						@else
						<table class="table table-bordered" id="dynamic_field">
							<tr>
								<td>
									<?php

          						$cor=json_decode($listing->service);?>
              					@foreach ($cor as $key1sss => $cors) 
              
                          
                  					<input type="text" name="service[]" class="form-control name_list" value="{{$cors}}" required="required">
            
              					@endforeach

						


								</td>
								<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
							</tr>
						</table>
						@endif
						@else
						<table class="table table-bordered" id="dynamic_field">
							<tr>
								<td><input type="text" name="service[]" placeholder="Services" class="form-control name_list" /></td>
								<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
							</tr>
						</table>
						@endif
					</div>
      
					
				</div></div><br/>
				<input type="hidden" name="facility[]">
				<input type="hidden" name="course[]"><input type="hidden" name="ifsc">
				<input type="hidden" name="bedroom">
				<input type="hidden" name="facing"><input type="hidden" name="job_category">
				<input type="hidden" name="r_type"><input type="hidden" name="floor">
				<input type="hidden" name="area"><input type="hidden" name="furnished">
				<input type="hidden" name="bathroom"><input type="hidden" name="religion_view"><input type="hidden" name="only_for"><input type="hidden" name="rent"><input type="hidden" name="dwelling">
				<input type="hidden" name="h_star"><input type="hidden" name="list_by"><input type="hidden" name="pet_friend">

				
				
	<script>
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="service[]" placeholder="Services" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
	});
	
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
	
	
	
});
</script>	@section('right_col')
<div class="col-md-3">
          <div class="alert alert-info form-alert">
            <h3><strong>Posting Tips</strong></h3><br/>
            <ul>
              <li><strong>Business Name</strong>: Mention your Business's name here mentioned as per the legal documents of the business. </li>
              <li><strong>Business Address</strong>: Mention the address of your business' location.to be mentioned as per the legal documents of the business.  </li>
              <li><strong>Ad Description</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.  </li>
               <li><strong>Payment Mode</strong>: Mention the payment mode.   </li>
              <li><strong>Services</strong>: Mention Services of you provide.   </li>
             
            </ul>
          </div>
        </div>
	@stop