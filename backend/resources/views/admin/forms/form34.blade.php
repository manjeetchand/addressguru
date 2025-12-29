<br/>

<center>Fill up your packages form dashboard</center>
<br/><br/>
			
						
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
						<label>Courses<span>*</span></label>
						<div class="row">
							<div class="col-md-6">
								<input type="checkbox" name="course[]" value="200 Hour Yoga Teacher Training" @if(is_array(old('course')) && in_array('200 Hour Yoga Teacher Training', old('course'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->course : '', '200 Hour Yoga Teacher Training') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> 200 Hour Yoga Teacher Training 
							</div>
							<div class="col-md-6">
								<input type="checkbox" name="course[]" value="300 Hour Yoga Teacher Training" @if(is_array(old('course')) && in_array('300 Hour Yoga Teacher Training', old('course'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->course : '', '300 Hour Yoga Teacher Training') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> 300 Hour Yoga Teacher Training 
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<input type="checkbox" name="course[]" value="400 Hour Yoga Teacher Training" @if(is_array(old('course')) && in_array('400 Hour Yoga Teacher Training', old('course'))) checked @endif f <?php 

                            if (strpos(isset($listing) ? $listing->course : '', '400 Hour Yoga Teacher Training') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> 400 Hour Yoga Teacher Training 
							</div>
							<div class="col-md-6">
								<input type="checkbox" name="course[]" value="500 Hour Yoga Teacher Training" @if(is_array(old('course')) && in_array('500 Hour Yoga Teacher Training', old('course'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->course : '', '500 Hour Yoga Teacher Training') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> 500 Hour Yoga Teacher Training
							</div>
						</div>
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-12">
						<label class="col-md-2">Facility<span>*</span></label>
						<div class="col-md-10">
							<input type="checkbox" name="facility[]" value="Food" @if(is_array(old('facility')) && in_array('Food', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Food') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>>  Food		&nbsp;&nbsp;&nbsp;		
							<input type="checkbox" name="facility[]" value="Medical Facility" @if(is_array(old('facility')) && in_array('Medical Facility', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Medical Facility') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Medical Facility   &nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="facility[]" value="24 Hr Electricity" @if(is_array(old('facility')) && in_array('24 Hr Electricity', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', '24 Hr Electricity') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> 24 Hr Electricity	&nbsp;&nbsp;&nbsp;
							<input type="checkbox" name="facility[]" value="Water Purifying" @if(is_array(old('facility')) && in_array('Water Purifying', old('facility'))) checked @endif <?php 

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
				
				<input type="hidden" name="service[]"><input type="hidden" name="ifsc">
				<input type="hidden" name="job_category">
				<input type="hidden" name="r_type"><input type="hidden" name="floor">
				<input type="hidden" name="area"><input type="hidden" name="furnished">
				<input type="hidden" name="bathroom"><input type="hidden" name="religion_view"><input type="hidden" name="only_for"><input type="hidden" name="rent"><input type="hidden" name="bedroom">
				<input type="hidden" name="facing"><input type="hidden" name="dwelling">
				<input type="hidden" name="h_star"><input type="hidden" name="list_by"><input type="hidden" name="pet_friend">

				
		@section('right_col')
<div class="col-md-3">
          <div class="alert alert-info form-alert">
            <h3><strong>Posting Tips</strong></h3><br/>
            <ul>
              <li><strong>Business Name</strong>: Mention your business/organization's name here mentioned as per the legal documents of the business. </li>
              <li><strong>Business Address</strong>: Mention the address of your business' location.to be mentioned as per the legal documents of the business.  </li>
              <li><strong>Ad Description</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.  </li>
              <li><strong>Payment Mode</strong>: Mention the payment mode.   </li>
              <li><strong>Courses</strong>: Mention Courses of you provide.   </li>
              <li><strong>Facilities</strong>: Mention Facilities of you provide.   </li>
            </ul>
          </div>
        </div>
	@stop	
			
	