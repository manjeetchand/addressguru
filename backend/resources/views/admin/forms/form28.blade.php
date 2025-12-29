
	
	
			<br/>

			@if($subcategory->id == 109)

			@include('admin.forms.form5')
			
			@elseif($subcategory->id == 92)
			
				<div class="row">
					<div class="col-md-6">
						<label>Select Type <span>*</span></label>
						
						<select class="form-control" name="only_for" required="required">
							<option value="{{isset($listing) ? $listing->only_for : old('only_for')}}">{{isset($listing) ? $listing->only_for : old('only_for')}}</option>
							<option value="For Sale">For Sale</option>
							<option value="For Rent">For Rent</option>
						</select>
						
					</div>
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
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Dwelling Type <span>*</span></label>
						
						<select class="form-control" name="dwelling" required="required">
							<option value="{{isset($listing) ? $listing->dwelling : old('dwelling')}}">{{isset($listing) ? $listing->dwelling : old('dwelling')}}</option>
            				<option value="Apartment">Apartment</option>
            				<option value="Condo">Condo</option>
            				<option value="House">House</option>
            				<option value="Land">Land</option>
            				<option value="HDB">HDB</option>
            				<option value="Villa">Villa</option>
            				<option value="Room">Room</option>
            				<option value="Other">Other</option>
						</select>
						<br/>
					</div>
				</div>
				<div class="row">
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
					<div class="col-md-6">
						<label>Facing <span>*</span></label>
						
						<select class="form-control" name="facing" required="required">
							<option value="{{isset($listing) ? $listing->facing : old('facing')}}">{{isset($listing) ? $listing->facing : old('facing')}}</option>
							<option value="East">East</option>
							<option value="North">North</option>
							<option value="North-East">North-East</option>
							<option value="North-West">North-West</option>
							<option value="South">South</option>
							<option value="South-East">South-East</option>
							<option value="South-West">South-West</option>
							<option value="West">West</option>
						</select>
						<br/>
					</div>
				</div>
				<div class="row">
					
					<div class="col-md-12">
						<label>Starting Price <span>*</span></label>
						
						<input type="number" name="rent" value="{{isset($listing) ? $listing->rent : old('rent')}}" placeholder="Starting Price" class="form-control">
						
					</div>
					</div><br/>
					<div class="row">
					<div class="{{ $errors->has('business_name') ? ' has-error' : '' }}">
						<div class="col-md-12">
							<label>Ad Title <span>*</span></label>
								<input type="text" name="business_name" placeholder="Ad Title" class="form-control" value="{{ isset($listing) ? $listing->business_name : old('business_name') }}" required="required">
							
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
				
				


				<input type="hidden" name="furnished"><input type="hidden" name="bedroom">
				<input type="hidden" name="bathroom"><input type="hidden" name="floor">
				<input type="hidden" name="facility"><input type="hidden" name="course[]"><input type="hidden" name="h_star">
				<input type="hidden" name="r_type"><input type="hidden" name="religion_view">
				<input type="hidden" name="service[]"><input type="hidden" name="payment[]">
				<input type="hidden" name="ifsc"><input type="hidden" name="pet_friend"><input type="hidden" name="job_category">

				@section('right_col')
<div class="col-md-3">
          <div class="alert alert-info form-alert">
            <h3><strong>Posting Tips</strong></h3><br/>
            <ul>
              <li><strong>Select Type</strong>: Select your property type whether it is for Sale or Rent. </li>
              <li><strong>Listed By</strong>: Mention whether you are Builder, Broker or Owner. </li>
              <li><strong>Dwelling Type</strong>: Property type. </li>

              <li><strong>Property Area</strong>: Area of your Property. </li>
              <li><strong>Facing</strong>: Facing side of your Property. </li>
               <li><strong>Starting Price</strong>: Starting price of your Hostel/PG. </li>
        
             
              <li><strong>Ad Title</strong>: Name of your Ad. </li>
              <li><strong>Business Address</strong>: Mention the address of your location. to be mentioned as per the legal documents of the business.  </li>
              <li><strong>Ad Description</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.  </li>
              
            </ul>
          </div>
        </div>
	@stop
			@else


			
			
						
				
				<div class="row">
					<div class="col-md-6">
						<label>Select Type <span>*</span></label>
						
						<select class="form-control" name="only_for" required="required">
							<option value="{{isset($listing) ? $listing->only_for : old('only_for')}}">{{$listing->only_for ? $listing->only_for : old('only_for')}}</option>
							<option value="For Sale">For Sale</option>
							<option value="For Rent">For Rent</option>
						</select>
						
					</div>
					<div class="col-md-6">
						<label>Listed By <span>*</span></label>
						
						<select class="form-control" name="list_by" required="required">
							<option value="{{isset($listing) ? $listing->list_by : old('list_by')}}">{{$listing->list_by ? $listing->list_by : old('list_by')}}</option>
							<option>Builder</option>
							<option>Dealer</option>
							<option>Owner</option>
						</select>
						<br/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Furnished <span>*</span></label>
						
						<select class="form-control" name="furnished" required="required">
							<option value="{{isset($listing) ? $listing->furnished : old('furnished')}}">{{$listing->furnished ? $listing->furnished : old('furnished')}}</option>
							<option>Full Furnished</option>
							<option>Semi Furnished</option>
							<option>Not Furnished</option>
						</select>
						<br/>
					</div>
					@if($subcategory->id != 108)
					<div class="col-md-6">
						<label>Bedroom <span>*</span></label>
						
						<select class="form-control" name="bedroom" required="required">
							<option value="{{isset($listing) ? $listing->bedroom : old('bedroom')}}">{{$listing->bedroom ? $listing->bedroom : old('bedroom')}}</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
						</select>
						<br/>
					</div>
					<div class="col-md-6">
						<label>Bathroom <span>*</span></label>
						
						<select class="form-control" name="bathroom" required="required">
							<option value="{{isset($listing) ? $listing->bathroom : old('bathroom')}}">{{$listing->bathroom ? $listing->bathroom : old('bathroom')}}</option>
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
						</select>
						<br/>
					</div>
					@else
					<input type="hidden" name="bathroom"><input type="hidden" name="bedroom">
					@endif
					
				</div>
				<div class="row">
					<div class="col-md-6">
						<label>Floor <span>*</span></label>
						
						<select class="form-control" name="floor" required="required">
							<option value="{{isset($listing) ? $listing->floor : old('floor')}}">{{$listing->floor ? $listing->floor : old('floor')}}</option>
							<option>Ground Floor</option>
							<option>1st Floor</option>
							<option>2nd Floor</option>
							<option>3rd Floor</option>
							<option>4th Floor and Above...</option>
						</select>
						<br/>
					</div>
					<div class="col-md-6">
						<label>Property Area <span>*</span></label>
						
						<select class="form-control" name="area" required="required">
							<option value="{{isset($listing) ? $listing->area : old('area')}}">{{$listing->area ? $listing->area : old('area')}}</option>
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
					<div class="col-md-12">
						<label>Facing <span>*</span></label>
						
						<select class="form-control" name="facing" required="required">
							<option value="{{isset($listing) ? $listing->facing : old('facing')}}">{{$listing->facing ? $listing->facing : old('facing')}}</option>
							<option value="East">East</option>
							<option value="North">North</option>
							<option value="North-East">North-East</option>
							<option value="North-West">North-West</option>
							<option value="South">South</option>
							<option value="South-East">South-East</option>
							<option value="South-West">South-West</option>
							<option value="West">West</option>
						</select>
						<br/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>Facilities Available<span>*</span></label>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Wifi" @if(is_array(old('facility')) && in_array('Wifi', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Wifi') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>>  Wifi 
								</div>
								
								
								
							
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="24 Hr Electricity" @if(is_array(old('facility')) && in_array('24 Hr Electricity', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, '24 Hr Electricity') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> 24 Hr Electricity
								</div>
								
								
							
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Washerman" @if(is_array(old('facility')) && in_array('Washerman', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Washerman') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Washerman
								</div>
								</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Medical Facility" @if(is_array(old('facility')) && in_array('Medical Facility', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Medical Facility') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Medical Facility
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Water Purifying" @if(is_array(old('facility')) && in_array('Water Purifying', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Water Purifying') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Water Purifying
								</div>
							
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="A/C Room Avilable" @if(is_array(old('facility')) && in_array('A/C Room Avilable', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'A/C Room Avilable') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> A/C Room Avilable
								</div>
								</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="24 Hr Water Supply" @if(is_array(old('facility')) && in_array('4 Hr Water Supply', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, '24 Hr Water Supply') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> 24 Hr Water Supply
								</div>
								
							
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Tv in room" @if(is_array(old('facility')) && in_array('Tv in room', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Tv in room') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Tv in Room
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Smoking" @if(is_array(old('facility')) && in_array('Smoking', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Smoking') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Smoking
								</div>
								</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Hot & Cold Water" " @if(is_array(old('facility')) && in_array('Hot & Cold Water', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Hot & Cold Water') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Hot & Cold Water
								</div>
							
								
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Car Parking" @if(is_array(old('facility')) && in_array('Car Parking', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Car Parking') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Car Parking
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Jogging Track" @if(is_array(old('facility')) && in_array('Jogging Track', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Jogging Track') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Jogging Track
								</div>
								
								
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="ATM" @if(is_array(old('facility')) && in_array('ATM', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'ATM') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> ATM
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Lift Available" @if(is_array(old('facility')) && in_array('Lift Available', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Lift Available') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Lift Available
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Swimming Pool" @if(is_array(old('facility')) && in_array('Swimming Pool', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Swimming Pool') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Swimming Pool
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Hospital" @if(is_array(old('facility')) && in_array('Hospital', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Hospital') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Hospital
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="Gas connection" @if(is_array(old('facility')) && in_array('Gas connection', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'Gas connection') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> Gas connection
								</div>
								<div class="col-md-4">
									<input type="checkbox" name="facility[]" value="School" @if(is_array(old('facility')) && in_array('School', old('facility'))) checked @endif <?php 

                            if (strpos($listing->facility, 'School') !== false) 
                            {
                              echo 'checked';
                            }
                           ?>> School
								</div>
							</div>
						</div>
					</div>
				</div><br/>
				<div class="row">
					<div class="{{ $errors->has('business_name') ? ' has-error' : '' }}">
						<div class="col-md-12">
							
							<label>Ad Title <span>*</span></label>
							
							@if($subcategory->id == 108)
							{!! Form::text('business_name', null, ['class'=>'form-control', 'value'=>'old("business_name")', 'placeholder'=>'Ad Title', 'required'=> 'required']) !!}

							@else
							{!! Form::text('business_name', null, ['class'=>'form-control', 'value'=>'old("business_name")', 'placeholder'=>'Ad Title', 'required'=> 'required']) !!}
							<small>(example: 2 bedroom with city views above Tanjong Pagar MRT)</small>
							@endif
								
							
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
						
						<textarea class="form-control" rows="3" placeholder="Address" name="business_address">{{ $listing->business_address ? $listing->business_address : old('business_address') }}</textarea>
						
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
						<label>Starting Price <span>*</span></label>
						
						<input type="number" name="rent" value="{{$listing->rent ? $listing->rent : old('rent')}}" placeholder="Starting Price" class="form-control">
						
					</div>
					</div>
				
				
				
				<input type="hidden" name="course[]"><input type="hidden" name="h_star">
				<input type="hidden" name="r_type"><input type="hidden" name="religion_view">
				<input type="hidden" name="service[]"><input type="hidden" name="payment[]">
				<input type="hidden" name="ifsc"><input type="hidden" name="pet_friend">
				<input type="hidden" name="dwelling"><input type="hidden" name="job_category">

				@section('right_col')
<div class="col-md-3">
          <div class="alert alert-info form-alert">
            <h3><strong>Posting Tips</strong></h3><br/>
            <ul>
              <li><strong>Select Type</strong>: Select your property type whether it is for Sale or Rent. </li>
              <li><strong>Listed By</strong>: Mention whether you are Builder, Broker or Owner. </li>
              <li><strong>Furnished</strong>: Whether your Hostel/PG is furnished. </li>
              @if($subcategory->id != 108)
              <li><strong>Bedroom</strong>: Mention number of Bedrooms. </li>
              <li><strong>Bathroom</strong>: Select your bathroom type. </li>
              @endif
              <li><strong>Floor</strong>: Mention your Hostel/PG Floors. </li>
              <li><strong>Property Area</strong>: Area of your Property. </li>
              <li><strong>Facing</strong>: Facing side of your Property. </li>
              <li><strong>Facilities Available</strong>: Facilities available in Property. </li>
             
              <li><strong>Ad Title</strong>: Name of your Ad. </li>
              <li><strong>Business Address</strong>: Mention the address of your location. to be mentioned as per the legal documents of the business.  </li>
              <li><strong>Ad Description</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.  </li>
               <li><strong>Starting Price</strong>: Starting price of your Hostel/PG. </li>
            </ul>
          </div>
        </div>
	@stop
		

				@endif
				

				
	
