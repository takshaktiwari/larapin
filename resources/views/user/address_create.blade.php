@extends('layouts.app')

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.webp') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">Create Address</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ url('user/address') }}">Addresses</a></li>
						<li class="breadcrumb-item active" aria-current="page">Create Address</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="user_section py-75">
		<div class="container">
			<div class="row">
				<div class="col-md-3" id="wrapper">
					@include('user/user_navigation')
				</div>
					<!-- /#sidebar-wrapper -->
				
				<div class="col-md-9">
					<!-- Page Content -->
					<div class="body-cntn" id="page-content-wrapper">
						<div class="cart-total-product b1 br-5 p-25">
                            <h4 class="cart-heading">
                            	Add Address
                            	<a href="{{ url('user/addresses') }}" class="theme-btn py-2 float-right">All Addresses</a>
                            </h4>
                           <form action="{{ url('user/address/create') }}" method="POST">
                           		@csrf
                            	<div class="row col-gap-50 clearfix">
                            		<div class="col-md-12">
                            			<div class="form-group">
                            				<label for="f-name">Your Name*</label>
                            				<input type="text" name="name" class="form-control" id="f-name" placeholder="Your full name" required value="{{ old('name') }}">
                            			</div>
                            		</div>
                            		<div class="col-md-6">
                            			<div class="form-group">
                            				<label for="phone-number">Mobile Number*</label>
                            				<input type="text" name="mobile" class="form-control" id="phone-number" required="" placeholder="eg: 9900..." maxlength="10" minlength="10" value="{{ old('mobile') }}">
                            			</div>
                            		</div>
                            		<div class="col-md-6">
                            			<div class="form-group">
                            				<label for="email">Email <span>(optional)</span></label>
                            				<input type="email" name="email" class="form-control" id="email" placeholder="eg: yourmail@gmail.com" required value="{{ old('email') }}">
                            			</div>
                            		</div>
                            		<div class="col-md-12">
                            			<div class="form-group">
                            				<label for="landmark">Landmark*</label>
                            				<input type="text" name="landmark" class="form-control"placeholder="Landmark" required="" value="{{ old('landmark') }}">
                            			</div>

                            			<div class="form-group">
                            				<label for="line1">Address Line 1*</label>
                            				<input type="text" name="line1" class="form-control" id="line1" placeholder="Address Line 1" required="" value="{{ old('line1') }}">
                            			</div>

                            			<div class="form-group">
                            				<label for="line2">Address Line 2</label>
                            				<input type="text" name="line2" class="form-control" id="line2" placeholder="Address Line 2" value="{{ old('line2') }}">
                            			</div>
                            		</div>
                            		<div class="col-md-6">
                            			<div class="form-group">
                            				<label for="country_id">Country*</label>
                            				<select class="form-control" id="country_id" name="country_id" required="">
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
                            				<select class="form-control" id="state_id" name="state_id" required="">
                            					<option value="">Select State</option>
                            				</select>
                            			</div>
                            		</div>
                            		<div class="col-md-6">
                            			<div class="form-group">
                            				<label for="district_id">City / District*</label>
                            				<select class="form-control" id="district_id" name="district_id" required="">
                            					<option value="">Select District</option>
                            				</select>
                            			</div>
                            		</div>
                            		<div class="col-md-6">
                            			<div class="form-group">
                            				<label for="pincode_id">PIN Code*</label>
                            				<select class="form-control" id="pincode_id" name="pincode_id" required="">
                            					<option value="">Select Location</option>
                            				</select>
                            			</div>
                            		</div>
                            		<div class="col-md-6">
                            			<div class="form-group">
                            				<label for="location_id">Location / Area*</label>
                            				<select class="form-control" id="location_id" name="location_id" required="">
                            					<option value="">Select Location</option>
                            				</select>
                            			</div>
                            		</div>
                            	</div>
                            	<input type="submit" class="theme-btn" value="Create Address">
							</form>
        				</div>		        
						
					</div>
					<!-- /#page-content-wrapper -->

				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function($) {
            $("#country_id").change(function(event) {
                var country_id = $(this).val();

                if(country_id != ''){
                    $.ajax({
                        url: '{{ url('ajax/get_country_states') }}',
                        type: 'POST',
                        data: {country_id: country_id ,_token: '{{csrf_token()}}'},
                        success: function(result){
                            $("#state_id").html('<option value="">-- Select State --</option>');
                            if(result != ''){
                                $.each(result, function(index, val) {
                                    $("#state_id").append('<option value="'+val.id+'">'+val.state+'</option>');
                                });
                            }
                        }
                    });
                    
                }
            });

            $("#state_id").change(function(event) {
                var state_id = $(this).val();

                if(state_id != ''){
                    $.ajax({
                        url: '{{ url('ajax/get_state_districts') }}',
                        type: 'POST',
                        data: {state_id: state_id ,_token: '{{csrf_token()}}'},
                        success: function(result){
                            $("#district_id").html('<option value="">-- Select District --</option>');
                            if(result != ''){
                                $.each(result, function(index, val) {
                                    $("#district_id").append('<option value="'+val.id+'">'+val.district+'</option>');
                                });
                            }
                        }
                    });
                    
                }
            });

            $("#district_id").change(function(event) {
                var district_id = $(this).val();

                if(district_id != ''){
                    $.ajax({
                        url: '{{ url('ajax/get_district_pincodes') }}',
                        type: 'POST',
                        data: {district_id: district_id ,_token: '{{csrf_token()}}'},
                        success: function(result){
                            $("#pincode_id").html('<option value="">-- Select Pincode --</option>');
                            if(result != ''){
                                $.each(result, function(index, val) {
                                    $("#pincode_id").append('<option value="'+val.id+'">'+val.pincode+'</option>');
                                });
                            }
                        }
                    });
                    
                }
            });

            $("#pincode_id").change(function(event) {
                var pincode_id = $(this).val();

                if(pincode_id != ''){
                    $.ajax({
                        url: '{{ url('ajax/get_pincode_locations') }}',
                        type: 'POST',
                        data: {pincode_id: pincode_id ,_token: '{{csrf_token()}}'},
                        success: function(result){
                            $("#location_id").html('<option value="">-- Select Location --</option>');
                            if(result != ''){
                                $.each(result, function(index, val) {
                                    $("#location_id").append('<option value="'+val.id+'">'+val.location+'</option>');
                                });
                            }
                        }
                    });
                    
                }
            });
        });
    </script>
@endsection