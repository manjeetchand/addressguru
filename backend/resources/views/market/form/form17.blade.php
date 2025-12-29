
			
				<br/>
			
			
				<div class="row">
					<div class="{{ $errors->has('pro_by') ? ' has-error' : '' }}">
						<div class="col-md-12">
							<label>Rent By<span>*</span></label>
							<select class="form-control" name="pro_by" required="required">
								<option value="{{ isset($listing) ? $listing->pro_by : '' }}">{{ isset($listing) ? $listing->pro_by : 'Select Rent By' }}</option>
								<option value="Owner">Owner</option>
								<option value="Broker">Broker</option>
								<option value="Agency">Agency</option>
							</select>
							@if ($errors->has('pro_by'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('pro_by') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>

				<div class="row">
					<div class="{{ $errors->has('available') ? ' has-error' : '' }}">
						<div class="col-md-6">
							<label>Available<span>*</span></label>
							<input type="date" name="available" class="form-control" min="{{Date('Y-m-d')}}" required="required" value="{{ isset($listing) ? $listing->available : old('available') }}" style="min-height:50px;">
							@if ($errors->has('available'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('available') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-6">
							<label>Dwelling Type<span>*</span></label>
							<select class="form-control" name="dwelling" required="required">
								<option value="{{ isset($listing) ? $listing->dwelling : '' }}">{{ isset($listing) ? $listing->dwelling : 'Select Dwelling Type' }}</option>
								<option value="Apartment">Apartment</option>
								<option value="Condo">Condo</option>
								<option value="House">House</option>
								<option value="Land">Land</option>
								<option value="HDB">HDB</option>
								<option value="Villa">Villa</option>
								<option value="Room">Room</option>
								<option value="Other">Other</option>
							</select>
							@if ($errors->has('dwelling'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('dwelling') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>

				<div class="row">
					<div class="{{ $errors->has('size') ? ' has-error' : '' }}">
						<div class="col-md-6">
							<label>Size (sqft)<span>*</span></label>
							<input type="text" name="size" class="form-control" required="required" value="{{ isset($listing) ? $listing->size : old('size') }}" placeholder="Size (sqft)">
							@if ($errors->has('size'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('size') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-6">
							<label>Bedrooms<span>*</span></label>
							<select class="form-control" name="bedroom" required="required">
								<option value="{{ isset($listing) ? $listing->bedroom : '' }}">{{ isset($listing) ? $listing->bedroom : 'Select Bedrooms' }}</option>
								<option value="Studio or Bachelor Pad">Studio or Bachelor Pad</option>
								<option value="1 bedroom">1 bedroom</option>
								<option value="2 bedrooms">2 bedrooms</option>
								<option value="3 bedrooms">3 bedrooms</option>
								<option value="4 bedrooms">4 bedrooms</option>
								<option value="5 bedrooms">5 bedrooms</option>
								<option value="6 or more bedrooms">6 or more bedrooms</option>
							</select>
							@if ($errors->has('bedroom'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('bedroom') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>

				<div class="row">
					<div class="{{ $errors->has('bathroom') ? ' has-error' : '' }}">
						<div class="col-md-6">
							<label>Bathrooms<span>*</span></label>
							<select class="form-control" name="bathroom" required="required">
								<option value="{{ isset($listing) ? $listing->bathroom : '' }}">{{ isset($listing) ? $listing->bathroom : 'Select Bathrooms' }}</option>
								<option value="1 bathroom">1 bathroom</option>
								<option value="2 bathrooms">2 bathrooms</option>
								<option value="3 bathrooms">3 bathrooms</option>
								<option value="4 or more bathrooms">4 or more bathrooms</option>
							</select>
							@if ($errors->has('bathroom'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('bathroom') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-6">
							<label>Smoking<span>*</span></label>
							<select class="form-control" name="smoking" required="required">
								<option value="{{ isset($listing) ? $listing->smoking : '' }}">{{ isset($listing) ? $listing->smoking : 'Select Smoking' }}</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
							@if ($errors->has('smoking'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('smoking') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>

				<div class="row">
					<div class="{{ $errors->has('pet') ? ' has-error' : '' }}">
						<div class="col-md-4">
							<label>Pet Friendly<span>*</span></label>
							<select class="form-control" name="pet" required="required">
								<option value="{{ isset($listing) ? $listing->pet : '' }}">{{ isset($listing) ? $listing->pet : 'Select Pet Friendly' }}</option>
								<option value="Yes">Yes</option>
								<option value="No">No</option>
							</select>
							@if ($errors->has('pet'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('pet') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-4">
							<label>Parking<span>*</span></label>
							<select class="form-control" name="parking" required="required">
								<option value="{{ isset($listing) ? $listing->parking : '' }}">{{ isset($listing) ? $listing->parking : 'Select Parking' }}</option>
								<option value="Garage">Garage</option>
								<option value="Covered">Covered</option>
								<option value="Street">Street</option>
								<option value="None">None</option>
							</select>
							@if ($errors->has('parking'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('parking') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-4">
							<label>CEA Number <small>(Optional)</small></label>
							<input type="text" name="cea" placeholder="CEA Number" class="form-control" value="{{ isset($listing) ? $listing->cea : old('cea') }}">
							@if ($errors->has('cea'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('cea') }}</strong>
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
					<div class="col-md-6">
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
					</div>
					@if(isset($listing))
					@if($listing->price == "Amount")
					<div class="col-md-6" id="amount">
						<label>Amount</label>
						<input type="number" name="amount" class="form-control" placeholder="Amount" value="{{ isset($listing) ? $listing->amount : old('amount') }}">
					</div>
					@else
						<input type="hidden" name="amount">
					@endif

					@else
					<div class="col-md-6" id="amount">
						<label>Amount</label>
						<input type="number" name="amount" class="form-control" placeholder="Amount" value="{{ isset($listing) ? $listing->amount : old('amount') }}">
					</div>
					@endif
				</div> 

				<input type="hidden" name="condition"><input type="hidden" name="only_for">
				<input type="hidden" name="model"><input type="hidden" name="dob"><input type="hidden" name="gender">
				<input type="hidden" name="job_type"><input type="hidden" name="company_name"><input type="hidden" name="company_website"><input type="hidden" name="ea_number"><input type="hidden" name="edu_level"><input type="hidden" name="cc"><input type="hidden" name="fuel_type"><input type="hidden" name="year"><input type="hidden" name="km"><input type="hidden" name="trans"><input type="hidden" name="color">
				<input type="hidden" name="share">
      
	@section('right_col')
		<div class="col-md-3">
          	<div class="alert alert-info form-alert">
            	<h3><strong>Posting Tips</strong></h3><br/>
            	<ul>
              		<li><strong>Rent By</strong>: Mention your Institutes's name here mentioned as per the legal documents of the business.</li>
              		<li><strong>Available</strong>: Mention the address of your business' location.to be mentioned as per the legal documents of the business.</li>
              		<li><strong>Dwelling Type</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.</li>             
              		<li><strong>Size (sqft)</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.</li>             
              		<li><strong>Bedrooms</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.</li>             
              		<li><strong>Bathrooms</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.</li>             
              		<li><strong>Smoking</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.</li>             
              		<li><strong>Pet Friendly</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.</li>             
              		<li><strong>Parking</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.</li>             
              		<li><strong>CEA Number</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.</li>             
              		<li><strong>Ad Title</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.</li>             
              		<li><strong>Ad Description</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.</li>             
              		<li><strong>Price</strong>: Describe your business, what is serves, its motto, establishment date, industry, its.products dealing in.</li>             
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
	