<div class="col-md-12">
	<h2><b>Business Contact Details</b></h2><hr style="border-color:black;">
</div>

	@if(Auth::user()->role->name == 'Agent' OR Auth::user()->role->name == 'Editor')
	<div class="row">
	<div class="{{ $errors->has('name') ? ' has-error' : '' }}">
	<div class="col-md-6">
		<label>Full Name <span>*</span></label>
		
		<input type="text" name="name" value="{{$personals->name ? $personals->name : old('name') }}" placeholder="Full Name" required="required"  class="form-control">
		
		@if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
	</div>
	</div>
		<div class="col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">
			<label>Email <span>*</span></label>
			
				<input type="email" name="email" value="{{$personals->email ? $personals->email : old('email')}}" placeholder="Email"  class="form-control" required="required">
			
			@if ($errors->has('email'))
          		<span class="help-block">
            	    <strong>{{ $errors->first('email') }}</strong>
            	</span>
        	@endif
			<br/>
		</div>
		<input type="hidden" name="agent" value="1">
		<input type="hidden" name="is_active" value="0">
		</div>
		<div class="row{{ $errors->has('state') ? ' has-error' : '' }}">
	<div class="col-md-6">
		<label>State <span>*</span></label>
		
		<select name="state" id="city1_c" class="form-control">
			<option>{{$personals->state ? $personals->state : old('state')}}</option>
        </select>
    	
        @if ($errors->has('state'))
            <span class="help-block">
                <strong>{{ $errors->first('state') }}</strong>
            </span>
        @endif
	</div>
	<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
	<div class="col-md-6">
		<label>City <span>*</span></label>
		
		<select name="city" id="city1_b" class="form-control cities2">
			<option>{{$personals->city ? $personals->city : old('city')}}</option>
        </select>
    	
        @if ($errors->has('city'))
            <span class="help-block">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
        @endif
        <br/>
	</div>
	</div>
	<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
	<div class="col-md-12">
		<label>Locality (near by place name)<span>*</span></label>
		
		<input type="text" name="location" class="form-control" value="{{$personals->location ? $personals->location : old('location')}}" placeholder="Locality" required="required">
    	
        @if ($errors->has('location'))
            <span class="help-block">
                <strong>{{ $errors->first('location') }}</strong>
            </span>
        @endif
        <br/>
	</div>
	</div>
</div>

<div class="row">
<div class="{{ $errors->has('ph_number') ? ' has-error' : '' }}">
	<div class="col-md-6">
		<label>Mobile Number (0-9)<span>*</span></label>
		
		<input type="number" name="ph_number" value="{{$personals ? $personals->ph_number : old('ph_number')}}" class="form-control" placeholder="Mobile Number" maxlength="10" minlength="10" required="required">
		
		@if ($errors->has('ph_number'))
            <span class="help-block">
                <strong>{{ $errors->first('ph_number') }}</strong>
            </span>
        @endif
	</div>
</div>
	<div class="{{ $errors->has('ph_number1') ? ' has-error' : '' }}">
	<div class="col-md-6">
		<label>Mobile Number (Optional)</label>
		
		<input type="number" name="ph_number1" value="{{$personals ? $personals->ph_number1 : old('ph_number1')}}" class="form-control" placeholder="Mobile Number" maxlength="10" minlength="10">
		
		@if ($errors->has('ph_number1'))
            <span class="help-block">
                <strong>{{ $errors->first('ph_number1') }}</strong>
            </span>
        @endif
		<br/>
	</div>
	</div>
</div>




	@else



<div class="row">

		<div class="{{ $errors->has('name') ? ' has-error' : '' }}">
	<div class="col-md-6">
		<label>Full Name <span>*</span></label>
		
		<input type="text" name="name" value="{{$user->name}}" placeholder="Full Name" required="required"  class="form-control">
		
		@if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
	</div>
	</div>
		<div class="col-md-6{{ $errors->has('email') ? ' has-error' : '' }}">
			<label>Email <span>*</span></label>
			
				<input type="email" name="email" value="{{$user->email}}" placeholder="Email"  class="form-control" readonly="readonly">
			
			@if ($errors->has('email'))
          		<span class="help-block">
            	    <strong>{{ $errors->first('email') }}</strong>
            	</span>
        	@endif
			<br/>
		</div>
		<input type="hidden" name="agent" value="0">
		<input type="hidden" name="is_active" value="1">
		</div>

		<div class="row{{ $errors->has('state') ? ' has-error' : '' }}">
	<div class="col-md-6">
		<label>State <span>*</span></label>
		
		<select name="state" id="city1_c" class="form-control">
			<option>{{$personals->state ? $personals->state : old('state')}}</option>
        </select>
    	
        @if ($errors->has('state'))
            <span class="help-block">
                <strong>{{ $errors->first('state') }}</strong>
            </span>
        @endif
	</div>
	<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
	<div class="col-md-6">
		<label>City <span>*</span></label>
		
		<select name="city" id="city1_b" class="form-control cities2">
			<option>{{$personals->city ? $personals->city : old('city')}}</option>
        </select>
    	
        @if ($errors->has('city'))
            <span class="help-block">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
        @endif
        <br/>
	</div>
	</div>
	<div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
	<div class="col-md-12">
		<label>Locality  (near by place name)<span>*</span></label>
		
		<input type="text" name="location" class="form-control" value="{{$personals->location ? $personals->location : old('location')}}" placeholder="Locality" required="required">
    	
        @if ($errors->has('location'))
            <span class="help-block">
                <strong>{{ $errors->first('location') }}</strong>
            </span>
        @endif
        <br/>
	</div>
	</div>
</div>


<div class="row">
<div class="{{ $errors->has('ph_number') ? ' has-error' : '' }}">
	<div class="col-md-6">
		<label>Mobile Number (0-9)<span>*</span></label>
		
		<input type="number" name="ph_number" value="{{$personals ? $personals->ph_number : old('ph_number')}}" class="form-control" placeholder="Mobile Number" maxlength="10" minlength="10" required="required">
		
		@if ($errors->has('ph_number'))
            <span class="help-block">
                <strong>{{ $errors->first('ph_number') }}</strong>
            </span>
        @endif
	</div>
</div>
	<div class="{{ $errors->has('ph_number1') ? ' has-error' : '' }}">
	<div class="col-md-6">
		<label>Mobile Number (Optional)</label>
		
		<input type="number" name="ph_number1" value="{{$personals ? $personals->ph_number1 : old('ph_number1')}}" class="form-control" placeholder="Mobile Number" maxlength="10" minlength="10">
		
		@if ($errors->has('ph_number1'))
            <span class="help-block">
                <strong>{{ $errors->first('ph_number1') }}</strong>
            </span>
        @endif
		<br/>
	</div>
	</div>
</div>

	@endif


				
