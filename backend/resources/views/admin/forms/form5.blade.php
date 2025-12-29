
			
				<br/>
			
	
				
				<div class="row ">
					<div class="col-md-12">
						<label>Property Type <span>*</span></label>
						
						<select class="form-control" name="r_type" required="required">
							<option value="{{isset($listing) ? $listing->r_type : old('r_type')}}">{{isset($listing) ? $listing->r_type : old('r_type')}}</option>
							<option value="Hostel">Hostel</option>
							<option value="Paying Guest">Paying Guest</option>
						</select>
						<br/>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Listed By <span>*</span></label>
						
						<select class="form-control" name="list_by" required="required">
							<option value="{{isset($listing) ? $listing->list_by : old('list_by')}}">{{isset($listing) ? $listing->list_by : old('list_by')}}</option>
							<option>Builder</option>
							<option>Dealer</option>
							<option>Owner</option>
						</select>
						<br/>
					</div>
					<div class="col-md-6">
						<label>Pet Friendly <span>*</span></label>
						
						<select class="form-control" name="pet_friend" required="required">
							<option value="{{isset($listing) ? $listing->pet_friend : old('pet_friend')}}">{{isset($listing) ? $listing->pet_friend : old('pet_friend')}}</option>
							<option>Yes</option>
							<option>No</option>
						</select>
						<br/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Floor <span>*</span></label>
						
						<select class="form-control" name="floor" required="required">
							<option value="{{isset($listing) ? $listing->floor : old('floor')}}">{{isset($listing) ? $listing->floor : old('floor')}}</option>
							<option>Ground Floor</option>
							<option>1st Floor</option>
							<option>2nd Floor</option>
							<option>3rd Floor</option>
							<option>5th Floor</option>
							<option>6th Floor</option>
							<option>7th Floor</option>
							<option>8th Floor</option>
							<option>9th Floor</option>
							<option>10th Floor and Above...</option>
						</select>
						<br/>
					</div>
					<div class="col-md-6">
						<label>Property Area <span>*</span></label>
						
						<select class="form-control" name="area" required="required">
							<option value="{{isset($listing) ? $listing->area : old('area')}}">{{isset($listing) ? $listing->area : old('area')}}</option>
							<option>Less then 200 Sq.ft</option>
							<option>200 to 500 Sq.ft</option>
							<option>500 to 1000 Sq.ft</option>
							<option>1000 to 1500 Sq.ft</option>
							<option>1500 to 2000 Sq.ft</option>
							<option>And above...</option>
						</select>
						<br/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Furnished <span>*</span></label>
						
						<select class="form-control" name="furnished" required="required">
							<option value="{{isset($listing) ? $listing->furnished : old('furnished')}}">{{isset($listing) ? $listing->furnished : old('furnished')}}</option>
							<option>Full Furnished</option>
							<option>Semi Furnished</option>
							<option>Not Furnished</option>
						</select>
						<br/>
					</div>
					<div class="col-md-6">
						<label>Bathroom <span>*</span></label>
						
						<select class="form-control" name="bathroom" required="required">
							<option value="{{isset($listing) ? $listing->bathroom : old('bathroom')}}">{{isset($listing) ? $listing->bathroom : old('bathroom')}}</option>
							<option>Attached</option>
							<option>Common</option>
							<option>Both Attached/Common</option>
						</select>
						<br/>
					</div>
				</div>
				
				<div class="row">
					<!-- <div class="col-md-6">
						<label>Religion Belief <span>*</span></label>
						<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-street-view"></i></span>
						<select class="form-control" name="religion_view" required="required">
							<option value="{{isset($listing) ? $listing->religion_view : old('religion_view')}}">{{isset($listing) ? $listing->religion_view : old('religion_view')}}</option>
							<option>Hindu</option>
							<option>Muslim</option>
							<option>Christan</option>
							<option>Sikh</option>
							<option>Jain</option>
							<option>Parsi</option>
							<option>Buddhist</option>
							<option>Inter-Religion</option>
							<option>No Religion</option>
						</select>
						</div><br/>
					</div> -->
					<div class="col-md-12">
						<label>Only For <span>*</span></label>
						
						<select class="form-control" name="only_for" required="required">
							<option value="{{isset($listing) ? $listing->only_for : old('only_for')}}">{{isset($listing) ? $listing->only_for : old('only_for')}}</option>
							<option value="Boys">Boys</option>
							<option value="Girls">Girls</option>
							<option value="Working">Working</option>
							<option value="Boys, Girls, Working">Anyone</option>
						</select>
						<br/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label>Starting Price <span>*</span></label>
						
						<input type="number" name="rent" value="{{isset($listing) ? $listing->rent : old('rent')}}" placeholder="Starting Price" class="form-control">
						
					</div>
					<div class="col-md-8">
						<label class="col-md-2">Facility<span>*</span></label>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Wifi" @if(is_array(old('facility')) && in_array('Wifi', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Wifi') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>>  Wifi 
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Internet" @if(is_array(old('facility')) && in_array('Internet', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Internet') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Internet
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Gym" @if(is_array(old('facility')) && in_array('Gym', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Gym') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Gym
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Indoor Game" @if(is_array(old('facility')) && in_array('Indoor Game', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Indoor Game') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Indoor Game
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Outdoor Game" @if(is_array(old('facility')) && in_array('Outdoor Game', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Outdoor Game') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Outdoor Game
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Transport" @if(is_array(old('facility')) && in_array('Transport', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Transport') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Transport
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="24 Hr Electricity" @if(is_array(old('facility')) && in_array('24 Hr Electricity', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', '24 Hr Electricity') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> 24 Hr Electricity
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Cafetria" @if(is_array(old('facility')) && in_array('Cafetria', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Cafetria') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Cafetria
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Common Hall" @if(is_array(old('facility')) && in_array('Common Hall', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Common Hall') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Common Hall
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Washerman" @if(is_array(old('facility')) && in_array('Washerman', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Washerman') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Washerman
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Medical Facility" @if(is_array(old('facility')) && in_array('Medical Facility', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Medical Facility') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Medical Facility
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Water Purifying" @if(is_array(old('facility')) && in_array('Water Purifying', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Water Purifying') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Water Purifying
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="A/C Room Avilable" @if(is_array(old('facility')) && in_array('A/C Room Avilable', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'A/C Room Avilable') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> A/C Room Avilable
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Libarary" @if(is_array(old('facility')) && in_array('Libarary', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Libarary') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Libarary
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="24 Hr Water Supply" @if(is_array(old('facility')) && in_array('4 Hr Water Supply', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', '24 Hr Water Supply') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> 24 Hr Water Supply
								</div>
								
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Tv in room" @if(is_array(old('facility')) && in_array('Tv in room', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Tv in room') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Tv in Room
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Mess" @if(is_array(old('facility')) && in_array('Mess', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Mess') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Mess
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Hot & Cold Water" " @if(is_array(old('facility')) && in_array('Hot & Cold Water', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Hot & Cold Water') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Hot & Cold Water
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Smoking" @if(is_array(old('facility')) && in_array('Smoking', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Smoking') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Smoking
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Car Parking" @if(is_array(old('facility')) && in_array('Car Parking', old('facility'))) checked @endif <?php 

                            if (strpos(isset($listing) ? $listing->facility : '', 'Car Parking') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Car Parking
								</div>
								
								
							</div>

						</div>
					</div>
				</div>
				<div class="row">
					<div class="{{ $errors->has('business_name') ? ' has-error' : '' }}">
					<div class="col-md-12">
						<label>Hostel/PG Name <span>*</span></label>
						
						<input type="text" name="business_name" placeholder="Hostel/PG Name" class="form-control" value="{{ isset($listing) ? $listing->business_name : old('business_name') }}" required="required">
						
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
						<label>Property Address <span>*</span></label>
						
						<textarea class="form-control" rows="3" placeholder="Address" name="business_address">{{isset($listing) ? $listing->business_address : old('business_address')}}</textarea>
						
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
				
				
				<input type="hidden" name="job_category">
				<input type="hidden" name="service[]"><input type="hidden" name="bedroom">
				<input type="hidden" name="facing"><input type="hidden" name="dwelling">
				<input type="hidden" name="course[]"><input type="hidden" name="religion_view">
				<input type="hidden" name="h_star"><input type="hidden" name="ifsc">
				


	@section('right_col')
<div class="col-md-3">
          <div class="alert alert-info form-alert">
            <h3><strong>Posting Tips</strong></h3><br/>
            <ul>
              <li><strong>Property Type</strong>: Select your property type whether it is Hostel or PG. </li>
              <li><strong>Listed By</strong>: Mention whether you are Builder, Broker or Owner. </li>
              <li><strong>Pet Friendly</strong>: Mention your Hostel/PG is pet friendly or not. </li>
              <li><strong>Floor</strong>: Mention your Hostel/PG Floors. </li>
              <li><strong>Property Area</strong>: Area of your Property. </li>
              <li><strong>Furnished</strong>: Whether your Hostel/PG is furnished. </li>
              <li><strong>Bathroom</strong>: Select your bathroom type. </li>
              <li><strong>Only For</strong>: Your Hostel/PG is onlt for. </li>
              <li><strong>Starting Price</strong>: Starting price of your Hostel/PG. </li>
              <li><strong>Hostel/PG Name</strong>: Name of your Hostel/PG. </li>
              <li><strong>Property Address</strong>: Mention the address of your location. to be mentioned as per the legal documents of the business.  </li>
              <li><strong>Ad Description</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.  </li>
              <li><strong>Payment Mode</strong>: Mention the payment mode you take.   </li>
            </ul>
          </div>
        </div>
	@stop
		