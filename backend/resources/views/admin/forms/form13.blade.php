
	
	
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
					<!-- <div class="col-md-6">
						<label>Restaurant Type <span>*</span></label>
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-check"></i></span>
						<select class="form-control" name="only_for" required="required">
							<option value="{{old('only_for')}}">{{old('only_for')}}</option>
							<option value="Restaurant & Lounge">Restaurant & Lounge</option>
							<option value="Bar & Lounge">Bar & Lounge</option>
							<option value="Bar">Bar</option>
							<option value="Lounge">Lounge</option>
							<option value="Restaurants & Bar">Restaurant & Bar</option>
							<option value="Restaurants">Restaurant</option>
						</select>
						</div>
					</div> -->
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
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Indian Food" @if(is_array(old('service')) && in_array('Indian Food', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Indian Food') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Indian Food
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="South Indian Food" @if(is_array(old('service')) && in_array('South Indian Food', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'South Indian Food') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> South Indian Food
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Fast Food" @if(is_array(old('service')) && in_array('Fast Food', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Fast Food') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Fast Food
								</div>		
																
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Chinese Food" @if(is_array(old('service')) && in_array('Chinese Food', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Chinese Food') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Chinese Food
								</div>		
								
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Italian Food" @if(is_array(old('service')) && in_array('Italian Food', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Italian Food') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Italian Food
								</div>		
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Non-Veg" @if(is_array(old('service')) && in_array('Non-Veg', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Non-Veg') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Non-Veg
								</div>										
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Bar (Alcohol)" @if(is_array(old('service')) && in_array('Bar (Alcohol)', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Bar (Alcohol)') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Bar (Alcohol)
								</div>		
								
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Hookah" @if(is_array(old('service')) && in_array('Hookah', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Hookah') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Hookah
								</div>		
								<div class="col-md-4">
									<input type="checkbox" name="service[]" value="Dancing Area" @if(is_array(old('service')) && in_array('Dancing Area', old('service'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->service : '', 'Dancing Area') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Dancing Area
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
				<input type="hidden" name="list_by"><input type="hidden" name="pet_friend">
				<input type="hidden" name="bedroom"><input type="hidden" name="dwelling">
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