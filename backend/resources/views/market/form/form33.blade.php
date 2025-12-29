
			
				<br/>
			
			
				<div class="row">
					<div class="{{ $errors->has('available') ? ' has-error' : '' }}">
						<div class="col-md-6">
							<label>Available<span>*</span></label>
							<input type="date" name="available" class="form-control" required="required" value="{{ isset($listing) ? $listing->available : old('available') }}" style="min-height:50px;">
							@if ($errors->has('available'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('available') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-6">
							<label>Date of Birth<span>*</span></label>
							<input type="date" name="dob" max="{{Date('Y-m-d')}}" class="form-control" required="required" value="{{ isset($listing) ? $listing->dob : old('dob') }}" style="min-height:50px;">
							@if ($errors->has('dob'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('dob') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>

				<div class="row">
					<div class="{{ $errors->has('pro_by') ? ' has-error' : '' }}">
						<div class="col-md-12">
							<label>Offered By<span>*</span></label>
							<select class="form-control" name="pro_by" required="required">
								<option value="{{ isset($listing) ? $listing->pro_by : '' }}">{{ isset($listing) ? $listing->pro_by : 'Select Offered By' }}</option>
								<option value="Registered Breeder">Registered Breeder</option>
								<option value="Shelter">Shelter</option>
								<option value="Owner">Owner</option>
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
      			
				<input type="hidden" name="model"><input type="hidden" name="only_for"><input type="hidden" name="condition"><input type="hidden" name="job_type"><input type="hidden" name="company_name"><input type="hidden" name="company_website"><input type="hidden" name="ea_number"><input type="hidden" name="edu_level"><input type="hidden" name="cc"><input type="hidden" name="fuel_type"><input type="hidden" name="year"><input type="hidden" name="km"><input type="hidden" name="trans"><input type="hidden" name="color"><input type="hidden" name="share"><input type="hidden" name="dwelling"><input type="hidden" name="size"><input type="hidden" name="bedroom"><input type="hidden" name="bathroom"><input type="hidden" name="smoking"><input type="hidden" name="pet"><input type="hidden" name="gender"><input type="hidden" name="cea"><input type="hidden" name="parking">


	@section('right_col')
		<div class="col-md-3">
          	<div class="alert alert-info form-alert">
            	<h3><strong>Posting Tips</strong></h3><br/>
            	<ul>
              		<li><strong>Available</strong>: Mention the date from which it is available for sale.</li>
              		<li><strong>Date of Birth</strong>: Mention the approx. / specific date of birth.</li>
              		<li><strong>Offered by</strong>: Mention if you are a certified breeder, shelter-home or owner.</li>             
              		<li><strong>Ad Tittle</strong>: Mention the local name/species.</li>             
              		<li><strong>Ad Description</strong>: Describe the age, colour, species and other features.</li>             
              		<li><strong>Price</strong>: Mention if you want give it free, want to sell, call for price or want to trade.</li>             
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
	