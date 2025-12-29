
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
				<br/>
				<div class="row">
					<div class="col-md-6">
						<label>Services<span>*</span></label>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Door-step Service" @if(is_array(old('service')) && in_array('Door-step Service', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Door-step Service') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>>  Door-step Service
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Locally" @if(is_array(old('service')) && in_array('Locally', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Locally') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Locally
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Out of Station" @if(is_array(old('service')) && in_array('Out of Station', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Out of Station') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Out of Station
								</div>
								
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<label>Facilities<span>*</span></label>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="facility[]" value="Birthday Parties" @if(is_array(old('facility')) && in_array('Birthday Parties', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Birthday Parties') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>>  Birthday Parties
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="facility[]" value="Weddings" @if(is_array(old('facility')) && in_array('Weddings', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Weddings') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Weddings
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="facility[]" value="Events" @if(is_array(old('facility')) && in_array('Events', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Events') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Events
								</div>

							</div>
						</div>
					</div>
				</div><br/><br/>
				<div class="row">
					@include('admin.forms.payment')
				</div>
				
				
				<input type="hidden" name="ifsc">
				<input type="hidden" name="course[]"><input type="hidden" name="job_category">
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
              
              <li><strong>Services</strong>: Mention Services of you provide.   </li>
              <li><strong>Facilities</strong>: Mention Facilities of you provide.   </li>
              <li><strong>Payment Mode</strong>: Mention the payment mode.   </li>
            </ul>
          </div>
        </div>
	@stop
	