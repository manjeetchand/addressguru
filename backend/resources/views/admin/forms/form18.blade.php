
	
	
			
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
					@include('admin.forms.payment')<br/>
					<div class="col-md-6">
						<label class="col-md-2">Services<span>*</span></label>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="X-Rays" @if(is_array(old('service')) && in_array('X-Rays', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'X-Rays') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>>  X-Rays
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Immunization and Flu treatment" @if(is_array(old('service')) && in_array('Immunization and Flu treatment', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Immunization and Flu treatment') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Immunization and Flu treatment
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Nursing Services" @if(is_array(old('service')) && in_array('Nursing Services', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Nursing Services') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Nursing Services
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Physician Services" @if(is_array(old('service')) && in_array('Physician Services', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Physician Services') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Physician Services
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="The Dispensary" @if(is_array(old('service')) && in_array('The Dispensary', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'The Dispensary') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> The Dispensary
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Dietitian Services" @if(is_array(old('service')) && in_array('Dietitian Services', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Dietitian Services') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Dietitian Services
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Pathology Lab" @if(is_array(old('service')) && in_array('Pathology Lab', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Pathology Lab') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Pathology Lab
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Home Services" @if(is_array(old('service')) && in_array('Home Services', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Home Services') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Home Services
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Ultrasound" @if(is_array(old('service')) && in_array('Ultrasound', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Ultrasound') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Ultrasound
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Ultrasonography" @if(is_array(old('service')) && in_array('Ultrasonography', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Ultrasonography') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Ultrasonography
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Retina Service" @if(is_array(old('service')) && in_array('Retina Service', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Retina Service') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Retina Service
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Cataract Service" @if(is_array(old('service')) && in_array('Cataract Service', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Cataract Service') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Cataract Service
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Squint Service" @if(is_array(old('service')) && in_array('Squint Service', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Squint Service') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Squint Service
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Lazy Eye" @if(is_array(old('service')) && in_array('Lazy Eye', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Lazy Eye') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Lazy Eye
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Glaucoma Services" @if(is_array(old('service')) && in_array('Glaucoma Services', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Glaucoma Services') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Glaucoma Services
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Paediatric Ophthalmology" @if(is_array(old('service')) && in_array('Paediatric Ophthalmology', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Paediatric Ophthalmology') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Paediatric Ophthalmology
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="LASIK" @if(is_array(old('service')) && in_array('LASIK', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'LASIK') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> LASIK
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Oculoplastic Service" @if(is_array(old('service')) && in_array('Oculoplastic Service', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Oculoplastic Service') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Oculoplastic Service
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Hair Treatment" @if(is_array(old('service')) && in_array('Hair Treatment', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Hair Treatment') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Hair Treatment
								</div>		
													
								
							</div>
							
							
							

						</div>
					</div>
					</div>
				<br/>
				
				
				<input type="hidden" name="course[]"><input type="hidden" name="job_category">
				<input type="hidden" name="r_type"><input type="hidden" name="floor">
				<input type="hidden" name="area"><input type="hidden" name="furnished">
				<input type="hidden" name="bathroom"><input type="hidden" name="religion_view"><input type="hidden" name="only_for"><input type="hidden" name="rent"><input type="hidden" name="bedroom">
				<input type="hidden" name="facing"><input type="hidden" name="dwelling">
				<input type="hidden" name="h_star"><input type="hidden" name="facility[]">
				<input type="hidden" name="ifsc"><input type="hidden" name="list_by"><input type="hidden" name="pet_friend">
				

				
				
	@section('right_col')
<div class="col-md-3">
          <div class="alert alert-info form-alert">
            <h3><strong>Posting Tips</strong></h3><br/>
            <ul>
              <li><strong>Business Name</strong>: Mention your business/organization's name here mentioned as per the legal documents of the business. </li>
              <li><strong>Business Address</strong>: Mention the address of your business' location.to be mentioned as per the legal documents of the business.  </li>
              <li><strong>Ad Description</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.  </li>
              <li><strong>Payment Mode</strong>: Mention the payment mode.   </li>
              <li><strong>Services</strong>: Mention Services of you provide.   </li>
            </ul>
          </div>
        </div>
	@stop