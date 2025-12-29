
	
	
			<br/>
			
						
				<div class="row">
					<div class="{{ $errors->has('business_name') ? ' has-error' : '' }}">
						<div class="col-md-12">
							<label>School Name <span>*</span></label>
							
								<input type="text" name="business_name" placeholder="School Name" class="form-control" value="{{ isset($listing) ? $listing->business_name : old('business_name') }}" required="required">
							
							@if ($errors->has('business_name'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('business_name') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
					<!-- <div class="col-md-6">
						<label>School Type <span>*</span></label>
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-check"></i></span>
						<select class="form-control" name="only_for" required="required">
							<option value="{{old('only_for')}}">{{old('only_for')}}</option>
							<option value="Play School">Play School</option>
							<option value="High School">High School</option>
							<option value="Intermediate School">Intermediate School</option>
							<option value="School">School</option>
						</select>
						</div>
					</div> -->
				</div><br/>
				<div class="row{{ $errors->has('business_address') ? ' has-error' : '' }}">
					<div class="col-md-12">
						<label>School Address <span>*</span></label>
						
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
									<input type="checkbox" name="facility[]" value="Smart Classes" @if(is_array(old('facility')) && in_array('Smart Classes', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Smart Classes') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Smart Classes
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="School Canteen" @if(is_array(old('facility')) && in_array('School Canteen', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'School Canteen') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> School Canteen
								</div>	
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Wifi" @if(is_array(old('facility')) && in_array('Wifi', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Wifi') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Wifi
								</div>										
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Hot & Cold Water" @if(is_array(old('facility')) && in_array('Hot & Cold Water', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Hot & Cold Water') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>>  Hot & Cold Water
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Washroom" @if(is_array(old('facility')) && in_array('Washroom', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Washroom') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Washroom
								</div>	
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Medical Facility" @if(is_array(old('facility')) && in_array('Medical Facility', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Medical Facility') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Medical Facility
								</div>									
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Bus Facility" @if(is_array(old('facility')) && in_array('Bus Facility', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Bus Facility') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Bus Facility
								</div>	
								<div class="col-md-8">
									<input type="checkbox" name="facility[]" value="Extra Curricular Activities" @if(is_array(old('facility')) && in_array('Extra Curricular Activities', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Extra Curricular Activities') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Extra Curricular Activities
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
              <li><strong>Facilities</strong>: Mention Facilities of you provide.   </li>
            </ul>
          </div>
        </div>
	@stop	
				
				
	
