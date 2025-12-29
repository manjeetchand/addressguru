
	
	
			<br/>
		
				<div class="row">
					<div class="{{ $errors->has('job_category') ? ' has-error' : '' }}">
						<div class="col-md-6">
						<label>Job Category <span>*</span></label>
						
						<select class="form-control" name="job_category" required="required">
							<option value="{{isset($listing) ? $listing->job_category : old('job_category')}}">{{isset($listing) ? $listing->job_category : old('job_category')}}</option>
							<option>Accounting & Audit Jobs</option>
							<option>Admin & Office Jobs</option>
							<option>Banking & Finance Jobs</option>
							<option>Beauty & Wellness Jobs</option>
							<option>Building & Construction Jobs</option>
							<option>Community & Social Services Jobs</option>
							<option>Customer Service Jobs</option>
							<option>Design Jobs</option>
							<option>Engineering Jobs</option>
							<option>Events & Promotions Jobs</option>
							<option>Food & Beverage Jobs</option>
							<option>General Jobs</option>
							<option>Health & Fitness Jobs</option>
							<option>Hospitality & Tourism Jobs</option>
							<option>Human Resources Jobs</option>
							<option>Information Technology Jobs</option>
							<option>Insurance Jobs</option>
							<option>Legal & Professional Services Jobs</option>
							<option>Management Jobs</option>
							<option>Manufacturing Jobs</option>
							<option>Marketing & Public Relations Jobs</option>
							<option>Media & Advertising Jobs</option>
							<option>Medical Services Jobs</option>
							<option>Merchandising & Purchasing Jobs</option>
							<option>Nursery, Nanny & Domestic Helpers Jobs</option>
							<option>Property Jobs</option>
							<option>Government & Civil Service Jobs</option>
							<option>Research & Development Jobs</option>
							<option>Retail & Sales Jobs</option>
							<option>Teaching Jobs</option>
							<option>Telecommunications Jobs</option>
							<option>Transportation & Logistics Jobs</option>
						</select>
						
					</div>
					
					</div>
					<div class="{{ $errors->has('r_type') ? ' has-error' : '' }}">
						<div class="col-md-6">
						<label>Job Type <span>*</span></label>
						
						<select class="form-control" name="r_type" required="required">
							<option value="{{isset($listing) ? $listing->r_type : old('r_type')}}">{{isset($listing) ? $listing->r_type : old('r_type')}}</option>
							<option>Casual</option>
							<option>Temporary</option>
							<option>Contract</option>
							<option>Part-Time</option>
							<option>Full-Time</option>
							<option>Graduate</option>
							<option>Internship</option>
							<option>Volunteer</option>
						</select>
						
					</div>
					
					</div>
				</div><br/>	
				<div class="row">
					<div class="col-md-12{{ $errors->has('only_for') ? ' has-error' : '' }}">
						<label>Education Level <span>*</span></label>
						
						<select class="form-control" name="only_for" required="required">
							<option value="{{isset($listing) ? $listing->only_for : old('only_for')}}">{{isset($listing) ? $listing->only_for : old('only_for')}}</option>
							<option>Doctorate</option>
							<option>Master</option>
							<option>Degree</option>
							<option>Diploma</option>
							<option>Professional Certifications (e.g. ACCA, CPA)</option>
							<option>Higher Nitec</option>
							<option>Nitec</option>
							<option>A-Level</option>
							<option>O-Level</option>
							<option>N-Level</option>
							<option>Primary</option>
							<option>Not Applicable</option>
							<option>Not Specified</option>
						</select>
						
					</div>
				</div>	<br/>
				<div class="row">
					<div class="col-md-12{{ $errors->has('list_by') ? ' has-error' : '' }}">
						<label>Company Name <span>*</span></label>
						
						<input type="text" name="list_by" class="form-control" value="{{isset($listing) ? $listing->list_by : old('list_by')}}" required="required" placeholder="Company Name">
						
					</div>
				</div><br/>	
				<div class="row">
					<div class="{{ $errors->has('business_name') ? ' has-error' : '' }}">
						<div class="col-md-12">
							<label>Job Title <span>*</span></label>
								
								<input type="text" name="business_name" placeholder="Job Title" class="form-control" value="{{ isset($listing) ? $listing->business_name : old('business_name') }}" required="required">
								<small>(example: Urgent Opening of a Software Developer in Singapore)</small>
							
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
						<label>Address <span>*</span></label>
						
						<textarea class="form-control" rows="3" placeholder="Address" name="business_address">{{ isset($listing) ? $listing->business_address : old('business_address')}}</textarea>
						
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
					
					<div class="col-md-12">
						<label>Salary (min-max) <span>*</span></label>
						
						<input type="text" name="rent" placeholder="10000 to 20000" value="{{isset($listing) ? $listing->rent : old('rent')}}" class="form-control" required="required">
						
					</div>
				</div>				
				
				
				<input type="hidden" name="course[]"><input type="hidden" name="h_star">
				<input type="hidden" name="floor">
				<input type="hidden" name="area"><input type="hidden" name="furnished">
				<input type="hidden" name="bathroom"><input type="hidden" name="religion_view">
				<input type="hidden" name="facility[]">
				<input type="hidden" name="service[]">
				<input type="hidden" name="web_link" value="no"><input type="hidden" name="video" value="no"><input type="hidden" name="payment[]"><input type="hidden" name="ifsc"><input type="hidden" name="bedroom">
				<input type="hidden" name="facing"><input type="hidden" name="dwelling">
				<input type="hidden" name="map" value="no"><input type="hidden" name="list_by"><input type="hidden" name="pet_friend">
				

			@section('right_col')
<div class="col-md-3">
          <div class="alert alert-info form-alert">
            <h3><strong>Posting Tips</strong></h3><br/>
            <ul>
              <li><strong>Job Category</strong>: Mention category of job your are offering. </li>
              <li><strong>Job Type</strong>: Mention job type full time, part time, etc. </li>
              <li><strong>Eductional Level</strong>: Mention expected eduction level. </li>
              <li><strong>Company Name</strong>: Mention company's name. </li>
              <li><strong>Job Title</strong>: Mention your job title here mentioned as per the legal documents of the business. </li>
              <li><strong>Address</strong>: Mention the address of your company' location.to be mentioned as per the legal documents of the business.  </li>
              <li><strong>Ad Description</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.  </li>
              <li><strong>Salery</strong>: Salary offered (min to max).   </li>
            </ul>
          </div>
        </div>
	@stop		
				
	