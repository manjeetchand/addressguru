
	
	
			
				<br/>
			
			
				
				
						
				<div class="row">
					<div class="{{ $errors->has('business_name') ? ' has-error' : '' }}">
						<div class="col-md-12">
							<label>Institutes Name <span>*</span></label>
							
								<input type="text" name="business_name" placeholder="Institutes Name" class="form-control" value="{{ isset($listing) ? $listing->business_name : old('business_name') }}" required="required">
							
							@if ($errors->has('business_name'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('business_name') }}</strong>
                        	    </span>
                      		@endif
							
						</div>
					</div>
					
				</div><br/>
				<div class="row{{ $errors->has('business_address') ? ' has-error' : '' }}">
					<div class="col-md-12">
						<label>Business Address <span>*</span></label>
						
						<textarea class="form-control" rows="3" placeholder="Address" required="required" name="business_address">{{ isset($listing) ? $listing->business_address : old('business_address') }}</textarea>
						
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
						<label>Courses</label>
						<div class="table-responsive">
						@if(isset($listing))
						@if($listing->course == null)
						<table class="table table-bordered" id="dynamic_field">
							<tr>
								<td><input type="text" name="course[]" placeholder="Courses" class="form-control name_list" /></td>
								<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
							</tr>
						</table>
						@else
						<table class="table table-bordered" id="dynamic_field">
							<tr>
								<td>
									<?php

          						$cor=json_decode($listing->course);?>
              					@foreach ($cor as $key1sss => $cors) 
              
                          
                  					<input type="text" name="course[]" class="form-control name_list" value="{{$cors}}" required="required">
            
              					@endforeach

						


								</td>
								<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
							</tr>
						</table>
						@endif
						@else
						<table class="table table-bordered" id="dynamic_field">
							<tr>
								<td><input type="text" name="course[]" placeholder="Courses" class="form-control name_list" /></td>
								<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
							</tr>
						</table>
						@endif
					</div>
						      	
         
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-12">
						<label class="col-md-2">Facility<span>*</span></label>
						<div class="col-md-10">
						    @if(isset($listing->facilities))
						    @foreach($listing->facilities as $facility)
						    	<input type="checkbox" name="facility[]" value="{{$facility->name}}" @if(is_array(old('facility')) && in_array('{{$facility->name}}', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', '{{$facility->name}}') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>>  {{$facility->name}} &nbsp;&nbsp;&nbsp;	
						    @endforeach
						    @endif
						    
							
							<input type="checkbox" name="facility[]" value="Transport" @if(is_array(old('facility')) && in_array('Transport', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Transport') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Transport   &nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="facility[]" value="24 Hr Electricity" @if(is_array(old('facility')) && in_array('24 Hr Electricity', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', '24 Hr Electricity') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> 24 Hr Electricity	&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="facility[]" value="Water Purifying"  @if(is_array(old('facility')) && in_array('Water Purifying', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Water Purifying') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Water Purifying		&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="facility[]" value="A/C Room Avilable" @if(is_array(old('facility')) && in_array('A/C Room Avilable', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'A/C Room Avilable') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> A/C Room <br/><br/>
						</div>
					</div>
				</div>
				<input type="hidden" name="h_star"><input type="hidden" name="only_for"><input type="hidden" name="rent">
				<input type="hidden" name="r_type"><input type="hidden" name="floor">
				<input type="hidden" name="area"><input type="hidden" name="furnished">
				<input type="hidden" name="bathroom"><input type="hidden" name="religion_view">
				<input type="hidden" name="service[]"><input type="hidden" name="ifsc">
				<input type="hidden" name="list_by"><input type="hidden" name="pet_friend">
				<input type="hidden" name="bedroom"><input type="hidden" name="dwelling">
				<input type="hidden" name="facing"><input type="hidden" name="job_category">


<script>
$(document).ready(function(){
	var i=1;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="course[]" placeholder="Courses" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
	});
	
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
	});
	
	
	
});
</script>
	      
				@section('right_col')
<div class="col-md-3">
          <div class="alert alert-info form-alert">
            <h3><strong>Posting Tips</strong></h3><br/>
            <ul>
              <li><strong>Institutes Name</strong>: Mention your Institutes's name here mentioned as per the legal documents of the business. </li>
              <li><strong>Business Address</strong>: Mention the address of your business' location.to be mentioned as per the legal documents of the business.  </li>
              <li><strong>Ad Description</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.  </li>
               <li><strong>Payment Mode</strong>: Mention the payment mode.   </li>
              <li><strong>Courses</strong>: Mention Courses of you provide.   </li>
              <li><strong>Facilities</strong>: Mention Facilities of you provide.   </li>
             
            </ul>
          </div>
        </div>
	@stop
	