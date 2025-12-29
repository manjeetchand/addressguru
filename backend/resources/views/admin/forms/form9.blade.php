

	
	
			<br/>
			
				
				
				<div class="row">
					<div class="{{ $errors->has('business_name') ? ' has-error' : '' }}">
						<div class="col-md-12">
							<label>Hotel Name <span>*</span></label>
							
								<input type="text" name="business_name" placeholder="Business Name" class="form-control" value="{{ isset($listing) ? $listing->business_name : old('business_name') }}" required="required">
							
							@if ($errors->has('business_name'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('business_name') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>
				<div class="row">
					<div class="col-md-6">
						<label>Room Type <span>*</span></label>
						
						<select class="form-control" name="r_type" required="required">
							<option value="{{isset($listing) ? $listing->r_type : old('r_type')}}">{{isset($listing) ? $listing->r_type : old('r_type')}}</option>
							<option value="1 King Bed">1 King Bed</option>
							<option value="1 Queen Bed">1 Queen Bed</option>
							<option value="2 Twin Bed">2 Twin Bed</option>
							<option value="A/C Rooms">A/C Rooms</option>
							<option value="Non-A/C Rooms">Non-A/C Rooms</option>
							<option value="Party Halls">Party Halls</option>
							<option value="Conference Rooms">Conference Rooms</option>
							<option value="A/C Rooms, Non-A/C Rooms, Party Halls, Conference Rooms">All above</option>
						</select>
						<br/>
					</div>
					<div class="col-md-6">
						<label>Starting Price <span>*</span></label>
						
						<input type="number" name="rent" value="{{isset($listing) ? $listing->rent : old('rent')}}" placeholder="Starting Rent" class="form-control">
						
					</div>
				</div>
				<div class="row{{ $errors->has('business_address') ? ' has-error' : '' }}">
					<div class="col-md-12">
						<label>Business Address <span>*</span></label>
						
						<textarea class="form-control" rows="3" placeholder="Address" name="business_address">{{isset($listing) ? $listing->business_address : old('business_address')}}</textarea>
						
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
						<label class="col-md-2">Facilities<span>*</span></label>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Laundry Service" @if(is_array(old('facility')) && in_array('Laundry Service', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Laundry Service') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Laundry Service 
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Internet Access" 
									@if(is_array(old('facility')) && in_array('Internet Access', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Internet Access') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Internet Access 
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Fitness Centre" @if(is_array(old('facility')) && in_array('Fitness Centre', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Fitness Centre') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Fitness Centre 
								</div>								
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Satellite TV Service" @if(is_array(old('facility')) && in_array('Satellite TV Service', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Satellite TV Service') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Satellite TV Service 
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Conference rooms" @if(is_array(old('facility')) && in_array('Conference rooms', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Conference rooms') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Conference rooms 
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Banquet facilities" @if(is_array(old('facility')) && in_array('Banquet facilities', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Banquet facilities') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Banquet facilities 
								</div>								
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Parking Available" @if(is_array(old('facility')) && in_array('Parking Available', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Parking Available') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Parking Available 
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Video Conferencing" @if(is_array(old('facility')) && in_array('Video Conferencing', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Video Conferencing') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Video Conferencing 
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Wedding services" @if(is_array(old('facility')) && in_array('Wedding services', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Wedding services') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Wedding services 
								</div>								
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Yoga Sessions" @if(is_array(old('facility')) && in_array('Yoga Sessions', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Yoga Sessions') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Yoga Sessions 
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Swimming Pool" @if(is_array(old('facility')) && in_array('Swimming Pool', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Swimming Pool') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Swimming Pool
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Poolside Bar" @if(is_array(old('facility')) && in_array('Poolside Bar', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Poolside Bar') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Poolside Bar 
								</div>								
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Smoking Zone" @if(is_array(old('facility')) && in_array('Smoking Zone', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Smoking Zone') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Smoking Zone
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Indoor Games" @if(is_array(old('facility')) && in_array('Indoor Games', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Indoor Games') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Indoor Games
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Spa & Sauna"  @if(is_array(old('facility')) && in_array('Spa & Sauna', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Spa & Sauna') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Spa & Sauna 
								</div>								
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Doctor on call"  @if(is_array(old('facility')) && in_array('Doctor on call', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Doctor on call') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Doctor on call 
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Room Service" @if(is_array(old('facility')) && in_array('Room Service', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Room Service') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>>  Room Service
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Garden" @if(is_array(old('facility')) && in_array('Garden', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Garden') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Garden 
								</div>								
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Restaurant" @if(is_array(old('facility')) && in_array('Restaurant', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Restaurant') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Restaurant
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Child Friendly" @if(is_array(old('facility')) && in_array('Child Friendly', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Child Friendly') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>>  Child Friendly
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Parking" @if(is_array(old('facility')) && in_array('Parking', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Parking') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Parking 
								</div>								
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Bar" @if(is_array(old('facility')) && in_array('Bar', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Bar') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Bar
								</div>					
							</div>

						</div>
					</div>
					</div>
				
				
				
				<input type="hidden" name="course[]"><input type="hidden" name="ifsc">
				<input type="hidden" name="job_category">
				<input type="hidden" name="only_for"><input type="hidden" name="floor">
				<input type="hidden" name="area"><input type="hidden" name="furnished">
				<input type="hidden" name="bathroom"><input type="hidden" name="religion_view">
				<input type="hidden" name="service[]"><input type="hidden" name="h_star">
				<input type="hidden" name="list_by"><input type="hidden" name="pet_friend"><input type="hidden" name="bedroom">
				<input type="hidden" name="facing"><input type="hidden" name="dwelling">

				
			@section('right_col')
<div class="col-md-3">
          <div class="alert alert-info form-alert">
            <h3><strong>Posting Tips</strong></h3><br/>
            <ul>
              <li><strong>Hotel Name</strong>: Mention your Hotel's name here mentioned as per the legal documents of the business. </li>
              <li><strong>Room Type</strong>: Mention your Hotel rooms type. </li>
              <li><strong>Starting Price</strong>: Starting price of your Hotel. </li>
              <li><strong>Business Address</strong>: Mention the address of your business' location.to be mentioned as per the legal documents of the business.  </li>
              <li><strong>Ad Description</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.  </li>
               <li><strong>Payment Mode</strong>: Mention the payment mode.   </li>
              <li><strong>Facilities</strong>: Mention Facilities of you provide.   </li>
             
            </ul>
          </div>
        </div>
	@stop	
	