
	
	
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
						<label class="col-md-2">Services<span>*</span></label>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Architectural Designing Services" @if(is_array(old('service')) && in_array('"Architectural Designing Services', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Architectural Designing Services') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Architectural Designing Services
								</div>	
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Interior Designers" @if(is_array(old('service')) && in_array('Interior Designers', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Interior Designers') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Interior Designers
								</div>										
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Interior Decorators" @if(is_array(old('service')) && in_array('Interior Decorators', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Interior Decorators') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Interior Decorators
								</div>	
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Landscape Gardening" @if(is_array(old('service')) && in_array('Landscape Gardening', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Landscape Gardening') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Landscape Gardening
								</div>										
							</div>
							<div class="row">
								<div class="col-md-6">
									<input type="checkbox" name="service[]" value="Commercial Architects" @if(is_array(old('service')) && in_array('Commercial Architects', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Commercial Architects') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Commercial Architects
								</div>									
							</div>
						</div>
					</div>
					</div>
				
				
				
				<input type="hidden" name="course[]"><input type="hidden" name="h_star">
				<input type="hidden" name="r_type"><input type="hidden" name="floor">
				<input type="hidden" name="area"><input type="hidden" name="furnished">
				<input type="hidden" name="bathroom"><input type="hidden" name="religion_view">
				<input type="hidden" name="facility[]"><input type="hidden" name="rent">
				<input type="hidden" name="ifsc"><input type="hidden" name="only_for">
				<input type="hidden" name="list_by"><input type="hidden" name="pet_friend"><input type="hidden" name="bedroom">
				<input type="hidden" name="facing"><input type="hidden" name="dwelling"><input type="hidden" name="job_category">
				

				
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
	
