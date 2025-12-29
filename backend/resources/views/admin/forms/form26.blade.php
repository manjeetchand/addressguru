
	
	
			
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
				</div>
				<div class="row">
					<div class="col-md-12"><br/>
						<label>Services<span>*</span></label>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Criminal Law" @if(is_array(old('service')) && in_array('Criminal Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Criminal Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>>  Criminal Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Civil Law" @if(is_array(old('service')) && in_array('Civil Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Civil Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Civil Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Divorce Law" @if(is_array(old('service')) && in_array('Divorce Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Divorce Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Divorce Law
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Arbitration" @if(is_array(old('service')) && in_array('Arbitration', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Arbitration') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Arbitration
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Advertising & Media Law" @if(is_array(old('service')) && in_array('Advertising & Media Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Advertising & Media Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Advertising & Media Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Labour Law" @if(is_array(old('service')) && in_array('Labour Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Labour Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Labour Law
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Motor Accident Law" @if(is_array(old('service')) && in_array('Motor Accident Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Motor Accident Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Motor Accident Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Sports Law" @if(is_array(old('service')) && in_array('Sports Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Sports Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Sports Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Law of Torts" @if(is_array(old('service')) && in_array('Law of Torts', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Law of Torts') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Law of Torts
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="International Law" @if(is_array(old('service')) && in_array('International Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'International Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> International Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Taxation Law" @if(is_array(old('service')) && in_array('Taxation Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Taxation Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Taxation Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Human Rights Law" @if(is_array(old('service')) && in_array('Human Rights Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Human Rights Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Human Rights Law
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Environmental Law" @if(is_array(old('service')) && in_array('Environmental Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Human Rights Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Environmental Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Marriage Registration" @if(is_array(old('service')) && in_array('Marriage Registration', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Marriage Registration') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Marriage Registration
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Projects & Infrastructure" @if(is_array(old('service')) && in_array('Projects & Infrastructure', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Projects & Infrastructure') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Projects & Infrastructure
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Industrial/ Factory Law" @if(is_array(old('service')) && in_array('Industrial/ Factory Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Industrial/ Factory Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Industrial/ Factory Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Corporate and Trade Law" @if(is_array(old('service')) && in_array('Corporate and Trade Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Corporate and Trade Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Corporate and Trade Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Land/ Property Law" @if(is_array(old('service')) && in_array('Land/ Property Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Land/ Property Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Land/ Property Law
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Immigration Law" @if(is_array(old('service')) && in_array('Immigration Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Immigration Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Immigration Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Service/ Employment" @if(is_array(old('service')) && in_array('Service/ Employment', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Service/ Employment') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Service/ Employment
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Intellectual Property" @if(is_array(old('service')) && in_array('Intellectual Property', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Intellectual Property') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Intellectual Property
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Banking Law" @if(is_array(old('service')) && in_array('Banking Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Banking Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Banking Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Consumer Law" @if(is_array(old('service')) && in_array('Consumer Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Consumer Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Consumer Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Information Technology & Cyber Law" @if(is_array(old('service')) && in_array('Information Technology & Cyber Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Information Technology & Cyber Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Information Technology & Cyber Law
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Education Law" @if(is_array(old('service')) && in_array('Education Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Education Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Education Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Contract Law" @if(is_array(old('service')) && in_array('Contract Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Contract Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Contract Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Crime Against Women" @if(is_array(old('service')) && in_array('Crime Against Women', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Crime Against Women') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Crime Against Women
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Constitutional Law" @if(is_array(old('service')) && in_array('Constitutional Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Constitutional Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Constitutional Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Family Law" @if(is_array(old('service')) && in_array('Family Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Family Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Family Law
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="International Trade Law" @if(is_array(old('service')) && in_array('International Trade Law', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'International Trade Law') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> International Trade Law
								</div>
							</div>
							
							

						</div>
					</div>
					</div>
				<br/>
				
				
				<input type="hidden" name="course[]"><input type="hidden" name="ifsc">
				
				<input type="hidden" name="r_type"><input type="hidden" name="floor">
				<input type="hidden" name="area"><input type="hidden" name="furnished">
				<input type="hidden" name="bathroom"><input type="hidden" name="religion_view"><input type="hidden" name="only_for"><input type="hidden" name="rent"><input type="hidden" name="dwelling">
				<input type="hidden" name="h_star"><input type="hidden" name="facility[]">
				<input type="hidden" name="list_by"><input type="hidden" name="pet_friend"><input type="hidden" name="bedroom">
				<input type="hidden" name="facing"><input type="hidden" name="job_category">

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
				
	