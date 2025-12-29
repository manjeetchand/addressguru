
			
				<br/>
			
			
				<div class="row">
					<div>
						<div class="col-md-12">
							<label>Select Category<span>*</span></label>
							<select class="form-control" name="only_for" required="required">
								<option value="{{ isset($listing) ? $listing->only_for : '' }}">{{ isset($listing) ? $listing->only_for : 'Select Category' }}</option>
								<option value="Accounting & Audit Jobs">Accounting & Audit Jobs</option>
								<option value="Admin & Office Jobs">Admin & Office Jobs</option>
								<option value="Banking & Finance Jobs">Banking & Finance Jobs</option>
								<option value="Beauty & Wellness Jobs">Beauty & Wellness Jobs</option>
								<option value="Building & Construction Jobs">Building & Construction Jobs</option>
								<option value="Community & Social Services Jobs">Community & Social Services Jobs</option>
								<option value="Customer Service Jobs">Customer Service Jobs</option>
								<option value="Design Jobs">Design Jobs</option>
								<option value="Engineering Jobs">Engineering Jobs</option>
								<option value="Events & Promotions Jobs">Events & Promotions Jobs</option>
								<option value="Food & Beverage Jobs">Food & Beverage Jobs</option>
								<option value="General Jobs">General Jobs</option>
								<option value="Health & Fitness Jobs">Health & Fitness Jobs</option>
								<option value="Hospitality & Tourism Jobs">Hospitality & Tourism Jobs</option>
								<option value="Human Resources Jobs">Human Resources Jobs</option>
								<option value="Information Technology Jobs">Information Technology Jobs</option>
								<option value="Insurance Jobs">Insurance Jobs</option>
								<option value="Legal & Professional Services Jobs">Legal & Professional Services Jobs</option>
								<option value="Management Jobs">Management Jobs</option>
								<option value="Manufacturing Jobs">Manufacturing Jobs</option>
								<option value="Marketing & Public Relations Jobs">Marketing & Public Relations Jobs</option>
								<option value="Media & Advertising Jobs">Media & Advertising Jobs</option>
								<option value="Medical Services Jobs">Medical Services Jobs</option>
								<option value="Merchandising & Purchasing Jobs">Merchandising & Purchasing Jobs</option>
								<option value="Nursery, Nanny & Domestic Helpers Jobs">Nursery, Nanny & Domestic Helpers Jobs</option>
								<option value="Property Jobs">Property Jobs</option>
								<option value="Government & Civil Service Jobs">Government & Civil Service Jobs</option>
								<option value="Research & Development Jobs">Research & Development Jobs</option>
								<option value="Retail & Sales Jobs">Retail & Sales Jobs</option>
								<option value="Teaching Jobs">Teaching Jobs</option>
								<option value="Telecommunications Jobs">Telecommunications Jobs</option>
								<option value="Transportation & Logistics Jobs">Transportation & Logistics Jobs</option>
							</select>
							@if ($errors->has('only_for'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('only_for') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>

				<div class="row">
					<div class="{{ $errors->has('job_type') ? ' has-error' : '' }}">
						<div class="col-md-6">
							<label>Job Type<span>*</span></label>
							<select class="form-control" name="job_type" required="required">
								<option value="{{ isset($listing) ? $listing->job_type : '' }}">{{ isset($listing) ? $listing->job_type : 'Select Job Type' }}</option>
								<option value="Casual">Casual</option>
								<option value="Temporary">Temporary</option>
								<option value="Contract">Contract</option>
								<option value="Part-Time">Part-Time</option>
								<option value="Full-Time">Full-Time</option>
								<option value="Graduate">Graduate</option>
								<option value="Internship">Internship</option>
								<option value="Volunteer">Volunteer</option>
							</select>
							@if ($errors->has('job_type'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('job_type') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-6">
							<label>Education Level<span>*</span></label>
							<select class="form-control" name="edu_level" required="required">
								<option value="{{ isset($listing) ? $listing->edu_level : '' }}">{{ isset($listing) ? $listing->edu_level : 'Select Education Level' }}</option>
								<option value="Doctorate">Doctorate</option>
								<option value="Master">Master</option>
								<option value="Degree">Degree</option>
								<option value="Diploma">Diploma</option>
								<option value="Professional Certifications (e.g. ACCA, CPA)">Professional Certifications (e.g. ACCA, CPA)</option>
								<option value="Higher Nitec">Higher Nitec</option>
								<option value="Nitec">Nitec</option>
								<option value="A-Level">A-Level</option>
								<option value="O-Level">O-Level</option>
								<option value="N-Level">N-Level</option>
								<option value="Primary">Primary</option>
								<option value="Not Applicable">Not Applicable</option>
								<option value="Not Specified">Not Specified</option>
							</select>
							@if ($errors->has('edu_level'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('edu_level') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>

				<div class="row">
					<div class="{{ $errors->has('company_name') ? ' has-error' : '' }}">
						<div class="col-md-4">
							<label>Company Name<span>*</span></label>
							<input type="text" name="company_name" placeholder="Company Name" required="required" class="form-control" value="{{ isset($listing) ? $listing->company_name : old('company_name')}}">
							@if ($errors->has('company_name'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('company_name') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-4">
							<label>Company Website<span>*</span></label>
							<input type="text" name="company_website" placeholder="Company Website" required="required" class="form-control" value="{{ isset($listing) ? $listing->company_website : old('company_website')}}">
							@if ($errors->has('company_website'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('company_website') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-4">
							<label>EA License Number<span>*</span></label>
							<input type="text" name="ea_number" placeholder="EA License Number" required="required" class="form-control" value="{{ isset($listing) ? $listing->ea_number : old('ea_number')}}">
							@if ($errors->has('ea_number'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('ea_number') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>
				
						
				<div class="row">
					<div class="{{ $errors->has('title') ? ' has-error' : '' }}">
						<div class="col-md-12">
							<label>Ad Title<span>*</span></label>
								<input type="text" name="title" placeholder="Ad Title" class="form-control" value="{{ isset($listing) ? $listing->title : old('title') }}" required="required">
							@if ($errors->has('title'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('title') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>

				<div class="row{{ $errors->has('description') ? ' has-error' : '' }}">
					<div class="col-md-12">
						<label>Ad Description<span>*</span> </label> &nbsp;&nbsp;&nbsp; <b>( <span id="charNum"> 200 </span> )</b>
						<textarea name="description" rows="6" class="form-control" placeholder="Type here..." required="required" id="field" onkeyup="countChar(this)">{{isset($listing) ? $listing->description : old('description')}}</textarea>
						@if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
						<br/>
					</div>
				</div> 
				<div class="row{{ $errors->has('price') ? ' has-error' : '' }}">
					<!-- <div class="col-md-6">
						<label>Price<span>*</span> </label>
						<select class="form-control" name="price" required="required" id="price" onchange="checkprice()">
							<option value="{{ isset($listing) ? $listing->price : '' }}">{{ isset($listing) ? $listing->price : 'Select Price' }}</option>
							<option value="Amount">Amount</option>
							<option value="Free">Free</option>
							<option value="Contact For Price">Contact For Price</option>
							<option value="Swap/Trade">Swap/Trade</option>
						</select>
						@if ($errors->has('price'))
                            <span class="help-block">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                        @endif
						<br/>
					</div> -->
					@if(isset($listing))
					@if($listing->price == "Amount")
					<div class="col-md-12" id="amount">
						<label>Salary</label>
						<input type="number" name="amount" class="form-control" placeholder="Salary" value="{{ isset($listing) ? $listing->amount : old('amount') }}">
					</div>
					@else
						<input type="hidden" name="amount">
					@endif

					@else
					<div class="col-md-12" id="amount">
						<label>Salary</label>
						<input type="number" name="amount" class="form-control" placeholder="Salary" value="{{ isset($listing) ? $listing->amount : old('amount') }}">
					</div>
					@endif
				</div> 

				<input type="hidden" name="price" value="Amount">
				<input type="hidden" name="model"><input type="hidden" name="pro_by"><input type="hidden" name="dob"><input type="hidden" name="parking">
				<input type="hidden" name="available"><input type="hidden" name="cc"><input type="hidden" name="fuel_type"><input type="hidden" name="year"><input type="hidden" name="km"><input type="hidden" name="trans"><input type="hidden" name="color"><input type="hidden" name="condition"><input type="hidden" name="share"><input type="hidden" name="dwelling"><input type="hidden" name="size"><input type="hidden" name="bedroom"><input type="hidden" name="bathroom"><input type="hidden" name="smoking"><input type="hidden" name="pet"><input type="hidden" name="gender"><input type="hidden" name="cea">
      
	@section('right_col')
		<div class="col-md-3">
          	<div class="alert alert-info form-alert">
            	<h3><strong>Posting Tips</strong></h3><br/>
            	<ul>
              		<li><strong>Select Category</strong>: Select one of the categories you wanted to post the job.</li>
              		<li><strong>Job Type</strong>: Mention if the job post is part time, full time, internship, etc.</li>
              		<li><strong>Education Level </strong>: Mention the Minimum educational level required for the job post.</li>             
              		<li><strong>Company Name</strong>: Mention your Institutes’ name here mentioned as per the legal documents of the business.</li>      
              		<li><strong>Company Website</strong>: Mention your website link e.g. https://wwe.example.com</li>      
              		<li><strong>EA License Number</strong>: Enter your EA License number by IRS.</li>      
              		<li><strong>Ad Title</strong>: Mention the Job post title.</li>      
              		<li><strong>Ad Description</strong>: Describe the specification of the job post like position, work, salary, etc.</li>      
              		<li><strong>Salary</strong>: Mention offered Salary.</li>       
            	</ul>
          	</div>
        </div>
	@stop
	<script type="text/javascript">
		function checkprice() 
		{
			var a = document.getElementById('price').value;
			var b = document.getElementById('amount');

			if (a == "Amount") 
			{
				b.style.display = "block";
			}
			else
			{
				b.style.display = "none";
			}
		}
		
	</script>
	