
	
	
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
					<!-- <div class="col-md-6">
						<label>Hospital Type <span>*</span></label>
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-check"></i></span>
						<select class="form-control" name="only_for" required="required">
							<option value="{{old('only_for')}}">{{old('only_for')}}</option>
							<option>Private Hospital</option>
							<option>Public Hospital</option>
							<option>Children Hospital</option>
							<option>Eye Hospital</option>
							<option>Mental Hospital</option>
							<option>Dental Hospital</option>
							<option>Government Hospital</option>
							<option>Hospital</option>
						</select>
						</div><br/>
					</div> -->
					
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
						<label class="col-md-2">Services<span>*</span></label>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Paediatric Surgeon Doctors" @if(is_array(old('service')) && in_array('Paediatric Surgeon Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Paediatric Surgeon Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Paediatric Surgeon Doctors
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Pathology Labs" @if(is_array(old('service')) && in_array('Pathology Labs', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Pathology Labs') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Pathology Labs
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Urologist Doctors" @if(is_array(old('service')) && in_array('Urologist Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Urologist Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Urologist Doctors
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="General Surgeon Doctors" @if(is_array(old('service')) && in_array('General Surgeon Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'General Surgeon Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> General Surgeon Doctors
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Rheumatologist Doctors" @if(is_array(old('service')) && in_array('Rheumatologist Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Rheumatologist Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Rheumatologist Doctors
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="ENT Surgeon Doctors" @if(is_array(old('service')) && in_array('ENT Surgeon Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'ENT Surgeon Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> ENT Surgeon Doctors
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Acupuncture Doctors" @if(is_array(old('service')) && in_array('Acupuncture Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Acupuncture Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Acupuncture Doctors
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Paralysis Doctors" @if(is_array(old('service')) && in_array('Paralysis Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Paralysis Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Paralysis Doctors
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Asthma Doctors" @if(is_array(old('service')) && in_array('Asthma Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Asthma Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Asthma Doctors
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Sexologist Doctors" @if(is_array(old('service')) && in_array('Sexologist Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Sexologist Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Sexologist Doctors
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Vascular Surgery Doctors" @if(is_array(old('service')) && in_array('Vascular Surgery Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Vascular Surgery Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Vascular Surgery Doctors
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Hepatologist Doctors" @if(is_array(old('service')) && in_array('Hepatologist Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Hepatologist Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Hepatologist Doctors
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="ICU Ambulance Services" @if(is_array(old('service')) && in_array('ICU Ambulance Services', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'ICU Ambulance Services') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> ICU Ambulance Services
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Psychologist Doctors" @if(is_array(old('service')) && in_array('Psychologist Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Psychologist Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Psychologist Doctors
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Kidney Surgeon Doctors" @if(is_array(old('service')) && in_array('Kidney Surgeon Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Kidney Surgeon Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Kidney Surgeon Doctors
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Kidney Surgeon Doctors" @if(is_array(old('service')) && in_array('Kidney Surgeon Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Kidney Surgeon Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Naturopath Doctors
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Hypospadias Surgeon Doctors" @if(is_array(old('service')) && in_array('Hypospadias Surgeon Doctors', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Hypospadias Surgeon Doctors') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Hypospadias Surgeon Doctors
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Thyroid Surgeons" @if(is_array(old('service')) && in_array('Thyroid Surgeons', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Thyroid Surgeons') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Thyroid Surgeons
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Physiotherapy" @if(is_array(old('service')) && in_array('Physiotherapy', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Physiotherapy') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Physiotherapy
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Cardiology & Internal Medicine" @if(is_array(old('service')) && in_array('Cardiology & Internal Medicine', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Cardiology & Internal Medicine') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Cardiology & Internal Medicine
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Trauma & Orthopaedic Surgery" @if(is_array(old('service')) && in_array('Trauma & Orthopaedic Surgery', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Trauma & Orthopaedic Surgery') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Trauma & Orthopaedic Surgery
								</div>
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Dental Doctor" @if(is_array(old('service')) && in_array('Dental Doctor', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Dental Doctor') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Dental Doctor
								</div>
								
							</div>

						</div>
					</div>
					</div>
				<br/>
				
				
				<input type="hidden" name="course[]"><input type="hidden" name="ifsc">
				<input type="hidden" name="r_type"><input type="hidden" name="floor">
				<input type="hidden" name="area"><input type="hidden" name="furnished">
				<input type="hidden" name="bathroom"><input type="hidden" name="religion_view">
				<input type="hidden" name="rent"><input type="hidden" name="only_for">
				<input type="hidden" name="h_star"><input type="hidden" name="facility[]">
				<input type="hidden" name="list_by"><input type="hidden" name="pet_friend"><input type="hidden" name="bedroom">
				<input type="hidden" name="facing"><input type="hidden" name="dwelling"><input type="hidden" name="job_category">

				
				
	@section('right_col')
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