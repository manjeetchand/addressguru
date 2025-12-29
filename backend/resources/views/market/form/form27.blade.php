
			
				<br/>
			
			
				<div class="row">
					<div class="{{ $errors->has('pro_by') ? ' has-error' : '' }}">
						<div class="col-md-6">
							<label>Sale By<span>*</span></label>
							<select class="form-control" name="pro_by" required="required">
								<option value="{{ isset($listing) ? $listing->pro_by : '' }}">{{ isset($listing) ? $listing->pro_by : 'Select Sale By' }}</option>
								<option value="Owner">Owner</option>
								<option value="Dealer">Dealer</option>
							</select>
							@if ($errors->has('pro_by'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('pro_by') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-6">
							<label>Maker<span>*</span></label>
							<select class="form-control" name="only_for" required="required">
								<option value="{{ isset($listing) ? $listing->only_for : '' }}">{{ isset($listing) ? $listing->only_for : 'Select Maker' }}</option>
            					<option value="Acura">Acura</option>
					            <option value="Alfa Romeo">Alfa Romeo</option>
					            <option value="Aston Martin">Aston Martin</option>
					            <option value="Audi">Audi</option>
					            <option value="Bentley">Bentley</option>
					            <option value="BMW">BMW</option>
					            <option value="Chrysler">Chrysler</option>
					            <option value="Citroen">Citroen</option>
					            <option value="Daewoo">Daewoo</option>
					            <option value="Daihatsu">Daihatsu</option>
					            <option value="Daimler">Daimler</option>
					            <option value="Ferrari">Ferrari</option>
					            <option value="Fiat">Fiat</option>
            					<option value="Ford">Ford</option>
					            <option value="Hino">Hino</option>
					            <option value="Honda">Honda</option>
					            <option value="Hummer">Hummer</option>
					            <option value="Hyundai">Hyundai</option>
					            <option value="Isuzu">Isuzu</option>
					            <option value="Jaguar">Jaguar</option>
					            <option value="Jeep">Jeep</option>
					            <option value="Kia">Kia</option>
					            <option value="Lamborghini">Lamborghini</option>
					            <option value="Land Rover">Land Rover</option>
					            <option value="Lexus">Lexus</option>
					            <option value="Lotus">Lotus</option>
					            <option value="Maserati">Maserati</option>
					            <option value="Maybach">Maybach</option>
					            <option value="Mazda">Mazda</option>
					            <option value="Mercedes-Benz">Mercedes-Benz</option>
					            <option value="Mini">Mini</option>
					            <option value="Mitsubishi">Mitsubishi</option>
					            <option value="Mitsuoka">Mitsuoka</option>
					            <option value="Nissan">Nissan</option>
					            <option value="Opel">Opel</option>
					            <option value="Peugeot">Peugeot</option>
					            <option value="Porsche">Porsche</option>
					            <option value="Renault">Renault</option>
					            <option value="Rolls-Royce">Rolls-Royce</option>
					            <option value="rovRoverer">Rover</option>
					            <option value="Saab">Saab</option>
					            <option value="Smart">Smart</option>
					            <option value="Ssangyong">Ssangyong</option>
					            <option value="Subaru">Subaru</option>
					            <option value="Suzuki">Suzuki</option>
					            <option value="Toyota">Toyota</option>
					            <option value="UD">UD</option>
					            <option value="Volkswagen">Volkswagen</option>
					            <option value="Volvo">Volvo</option>
					            <option value="Other">Other</option>
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
					<div class="{{ $errors->has('model') ? ' has-error' : '' }}">
						<div class="col-md-6">
							<label>Model<span>*</span></label>
							<select class="form-control" name="model" required="required">
								<option value="{{ isset($listing) ? $listing->model : '' }}">{{ isset($listing) ? $listing->model : 'Select Model' }}</option>
								<option value="3.2TL">3.2TL</option>
								<option value="3.5RL">3.5RL</option>
								<option value="RL">RL</option>
								<option value="RSX">RSX</option>
								<option value="Other">Other</option>
							</select>
							@if ($errors->has('model'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('model') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-6">
							<label>Body Type<span>*</span></label>
							<select class="form-control" name="job_type" required="required">
								<option value="{{ isset($listing) ? $listing->job_type : '' }}">{{ isset($listing) ? $listing->job_type : 'Select Body Type' }}</option>
            					<option value="Convertible">Convertible</option>
            					<option value="Coupe (2 door)">Coupe (2 door)</option>
            					<option value="Hatchback">Hatchback</option>
            					<option value="MPV">MPV</option>
            					<option value="Sedan">Sedan</option>
            					<option value="SUV">SUV</option>
            					<option value="4 x 4">4 x 4</option>
            					<option value="Other">Other</option>
							</select>
							@if ($errors->has('job_type'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('job_type') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>

				<div class="row">
					<div class="{{ $errors->has('cc') ? ' has-error' : '' }}">
						<div class="col-md-6">
							<label>Engine Displacement (cc)<span>*</span></label>
							<input type="text" name="cc" placeholder="Engine Displacement (cc)" class="form-control" value="{{ isset($listing) ? $listing->cc : old('cc') }}" required="required">
							@if ($errors->has('cc'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('cc') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-6">
							<label>Fuel Type<span>*</span></label>
							<select class="form-control" name="fuel_type" required="required">
								<option value="{{ isset($listing) ? $listing->fuel_type : '' }}">{{ isset($listing) ? $listing->fuel_type : 'Select Fuel Type' }}</option>
            					<option value="Petrol">Petrol</option>
            					<option value="Diesel">Diesel</option>
            					<option value="Hybrid-Electric">Hybrid-Electric</option>
            					<option value="Eletric">Eletric</option>
            					<option value="Other">Other</option>
							</select>
							@if ($errors->has('fuel_type'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('fuel_type') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>

				<div class="row">
					<div class="{{ $errors->has('year') ? ' has-error' : '' }}">
						<div class="col-md-6">
							<label>Year<span>*</span></label>
							<input type="text" name="year" placeholder="Year" class="form-control" value="{{ isset($listing) ? $listing->year : old('year') }}" required="required">
							@if ($errors->has('year'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('year') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-6">
							<label>Kilometers<span>*</span></label>
							<input type="text" name="km" placeholder="Kilometers" class="form-control" value="{{ isset($listing) ? $listing->km : old('km') }}" required="required">
							@if ($errors->has('km'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('km') }}</strong>
                        	    </span>
                      		@endif
						</div>
					</div>
				</div><br/>

				<div class="row">
					<div class="{{ $errors->has('trans') ? ' has-error' : '' }}">
						<div class="col-md-6">
							<label>Transmission<span>*</span></label>
							<select class="form-control" name="trans" required="required">
								<option value="{{ isset($listing) ? $listing->trans : '' }}">{{ isset($listing) ? $listing->trans : 'Select Transmission' }}</option>
            					<option value="Manual">Manual</option>
            					<option value="Automatic">Automatic</option>
            					<option value="Other">Other</option>
							</select>
							@if ($errors->has('trans'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('trans') }}</strong>
                        	    </span>
                      		@endif
						</div>
						<div class="col-md-6">
							<label>Color<span>*</span></label>
							<select class="form-control" name="color" required="required">
								<option value="{{ isset($listing) ? $listing->color : '' }}">{{ isset($listing) ? $listing->color : 'Select Color' }}</option>
            					<option value="Blue">Blue</option>
            					<option value="Brown">Brown</option>
            					<option value="Burgundy">Burgundy</option>
            					<option value="Gold">Gold</option>
            					<option value="Grey">Grey</option>
            					<option value="Green">Green</option>
            					<option value="Orange">Orange</option>
            					<option value="Pink">Pink</option>
            					<option value="Purple">Purple</option>
            					<option value="Red">Red</option>
            					<option value="Silver">Silver</option>
            					<option value="White">White</option>
            					<option value="Yellow">Yellow</option>
            					<option value="Other">Other</option>
							</select>
							@if ($errors->has('color'))
                         	   <span class="help-block">
                        	        <strong>{{ $errors->first('color') }}</strong>
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

				<input type="hidden" name="condition"><input type="hidden" name="dob"><input type="hidden" name="parking">
				<input type="hidden" name="available"><input type="hidden" name="company_name"><input type="hidden" name="company_website"><input type="hidden" name="ea_number"><input type="hidden" name="edu_level"><input type="hidden" name="share"><input type="hidden" name="dwelling"><input type="hidden" name="size"><input type="hidden" name="bedroom"><input type="hidden" name="bathroom"><input type="hidden" name="smoking"><input type="hidden" name="pet"><input type="hidden" name="gender"><input type="hidden" name="cea">


      
	@section('right_col')
		<div class="col-md-3">
          	<div class="alert alert-info form-alert">
            	<h3><strong>Posting Tips</strong></h3><br/>
            	<ul>
              		<li><strong>Sale By</strong>: Mention if you are a dealer or the owner of the cars.</li>
              		<li><strong>Maker</strong>: Select the maker from the list.</li>
              		<li><strong>Model</strong>: Select the modal of your vehicle from the list</li>             
              		<li><strong>Body Type</strong>: Select the one of the body types from the lists. </li>             
              		<li><strong>Engine Displacement</strong>: Mention the engine displacement (cc) </li>             
              		<li><strong>Fuel type</strong>: Select one of the fuel types of your vehicle as per the manufacturer specification </li>             
              		<li><strong>Year</strong>: Mention the years from the year of the manufacturing. </li>             
              		<li><strong>Kilometers</strong>: Mention the number of kilometers the vehicle have travel. </li>             
              		<li><strong>Transmission</strong>: Mention if your vehicle has automatic, manual transmission </li>             
              		<li><strong>Color</strong>: Choose the color of your vehicle </li>             
              		<li><strong>Ad Title</strong>: Mention your Name or modal of the car </li>             
              		<li><strong>Ad description</strong>: Mention about the company, modal, year of manufacturing, specification of the car parts specified by the manufacturing company. </li>             
              		<li><strong>Price</strong>: Mention the price of the vehicle you are expecting. </li>             
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
	