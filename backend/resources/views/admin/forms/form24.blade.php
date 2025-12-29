
	
	
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
						</div>
					</div>
				</div><br/>
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
						<label class="col-md-2">Facilities<span>*</span></label>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Guest House" @if(is_array(old('facility')) && in_array('Guest House', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Guest House') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Guest House
								</div>	
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Wedding Halls" @if(is_array(old('facility')) && in_array('Wedding Halls', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Wedding Halls') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Wedding Halls
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Non AC Halls" @if(is_array(old('facility')) && in_array('Non AC Halls', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Non AC Halls') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Non AC Halls
								</div>											
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="AC Halls" @if(is_array(old('facility')) && in_array('AC Halls', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'AC Halls') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> AC Halls
								</div>	
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Wedding Grounds" @if(is_array(old('facility')) && in_array('Wedding Grounds', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Wedding Grounds') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Wedding Grounds
								</div>	
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Party Lawns" @if(is_array(old('facility')) && in_array('Party Lawns', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Party Lawns') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Party Lawns
								</div>										
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Open Air Halls" @if(is_array(old('facility')) && in_array('Open Air Halls', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Open Air Halls') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Open Air Halls
								</div>	
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Exhibition Halls" @if(is_array(old('facility')) && in_array('Exhibition Halls', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Exhibition Halls') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Exhibition Halls
								</div>	
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Caterers Halls" @if(is_array(old('facility')) && in_array('Caterers Halls', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Caterers Halls') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Caterers Halls
								</div>										
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Decorator Hall" @if(is_array(old('facility')) && in_array('Decorator Hall', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Decorator Hall') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Decorator Hall
								</div>	
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Conference Halls" @if(is_array(old('facility')) && in_array('Conference Halls', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Conference Halls') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Conference Halls
								</div>	
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Pre Decorated Halls" @if(is_array(old('facility')) && in_array('Pre Decorated Halls', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Pre Decorated Halls') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Pre Decorated Halls
								</div>										
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Farm House" @if(is_array(old('facility')) && in_array('Farm House', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Farm House') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Farm House
								</div>	
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Parking Area" @if(is_array(old('facility')) && in_array('Parking Area', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Parking Area') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Parking Area
								</div>										
							</div>
						</div>
					</div>
					</div>
				
				
				
				<input type="hidden" name="course[]"><input type="hidden" name="h_star">
				<input type="hidden" name="r_type"><input type="hidden" name="floor">
				<input type="hidden" name="area"><input type="hidden" name="furnished">
				<input type="hidden" name="bathroom"><input type="hidden" name="religion_view">
				<input type="hidden" name="service[]"><input type="hidden" name="rent">
				<input type="hidden" name="ifsc"><input type="hidden" name="only_for"><input type="hidden" name="job_category">
				<input type="hidden" name="list_by"><input type="hidden" name="pet_friend"><input type="hidden" name="bedroom">
				<input type="hidden" name="facing"><input type="hidden" name="dwelling">
				
@section('right_col')
<div class="col-md-3">
          <div class="alert alert-info form-alert">
            <h3><strong>Posting Tips</strong></h3><br/>
            <ul>
              <li><strong>Business Name</strong>: Mention your business/organization's name here mentioned as per the legal documents of the business. </li>
              <li><strong>Business Address</strong>: Mention the address of your business' location.to be mentioned as per the legal documents of the business.  </li>
              <li><strong>Ad Description</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.  </li>
              <li><strong>Payment Mode</strong>: Mention the payment mode.   </li>
              <li><strong>Facilities</strong>: Mention Facilities of you provide.   </li>
            </ul>
          </div>
        </div>
	@stop
				
				
	
