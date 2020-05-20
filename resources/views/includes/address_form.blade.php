<div class="checkout-form">
	<div class="row col-gap-50 clearfix">
		<div class="col-md-12">
			<div class="form-group">
				<label for="f-name">Your Name*</label>
				<input type="text" name="addr_name" class="form-control address_form" id="f-name" placeholder="Your full name" value="{{ old('addr_name') }}">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="mobile">Mobile Number*</label>
				<input type="text" name="addr_mobile" class="form-control address_form" id="mobile" placeholder="9900..." minlength="10" maxlength="10" value="{{ old('addr_mobile') }}">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="email-addr">Email <span>(optional)</span></label>
				<input type="email" name="addr_email" class="form-control" id="email-addr" placeholder="eg: yourmail@gmail.com" value="{{ old('addr_email') }}">
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="landmark">Landmark*</label>
				<input type="text" name="addr_landmark" class="form-control address_form" id="landmark" placeholder="Landmark" value="{{ old('addr_landmark') }}">
			</div>

			<div class="form-group">
				<label for="line1">Address Line 1*</label>
				<input type="text" name="addr_line1" class="form-control address_form" id="line1" placeholder="Address Line 1" value="{{ old('addr_line1') }}">
			</div>

			<div class="form-group">
				<label for="line2">Address Line 2</label>
				<input type="text" name="addr_line2" class="form-control" id="line2" placeholder="Address Line 2" value="{{ old('addr_line2') }}">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="country_id">Country*</label>
				<select class="form-control address_form" id="country_id" name="addr_country_id">
					<option value="">Select Country</option>
					@foreach($countries as $country)
						<option value="{{ $country->id }}">
							{{ $country->country }}
						</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="state_id">State*</label>
				<select class="form-control address_form" id="state_id" name="addr_state_id">
					<option value="">Select State</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="district_id">City / District*</label>
				<select class="form-control address_form" id="district_id" name="addr_district_id">
					<option value="">Select District</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="pincode_id">PIN Code*</label>
				<select class="form-control address_form" id="pincode_id" name="addr_pincode_id">
					<option value="">Select PIN Code</option>
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="location_id">Location / Area*</label>
				<select class="form-control address_form" id="location_id" name="addr_location_id">
					<option value="">Select Location</option>
				</select>
			</div>
		</div>
	</div>
</div>