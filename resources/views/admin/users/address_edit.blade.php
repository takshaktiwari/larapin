@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Edit Address</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Users</a>
    	                </li>
    	                <li class="breadcrumb-item active">{{ $address->user->name }}</li>
    	                <li class="breadcrumb-item active">Addresses</li>
                        <li class="breadcrumb-item active">Edit Address</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/user/'.$address->user->id.'/addresses') }}" class="btn btn-primary">All Address</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->
		
		<div class="row">
            <div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="card">
                    <form action="{{ url('admin/user/address/update') }}" method="POST" class="card-body">
                        @csrf

                        <div class="form-group">
                            <label for="">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="form-control" value="{{ $address->name }}">
                        </div>
                        <div class="form-group">
                            <label for="">Email </label>
                            <input type="email" name="email" class="form-control" value="{{ $address->email }}">
                        </div>
                        <div class="form-group">
                            <label for="">Mobile <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" required class="form-control" value="{{ $address->mobile }}">
                        </div>
                        <div class="form-group">
                            <label for="">Address Line 1 <span class="text-danger">*</span></label>
                            <input type="text" name="line1" required class="form-control" value="{{ $address->line1 }}">
                        </div>
                        <div class="form-group">
                            <label for="">Address Line 2 </label>
                            <input type="text" name="line2" class="form-control" value="{{ $address->line2 }}">
                        </div>
                        <div class="form-group">
                            <label for="">Landmark </label>
                            <input type="text" name="landmark" class="form-control" value="{{ $address->landmark }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Country <span class="text-danger">*</span></label>
                                    <select name="country_id" id="country_id" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ selected($country->id, $address->country_id) }}>
                                                {{ $country->country }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">State <span class="text-danger">*</span></label>
                                    <select name="state_id" id="state_id" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ selected($state->id, $address->state_id) }}>
                                                {{ $state->state }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">District <span class="text-danger">*</span></label>
                                    <select name="district_id" id="district_id" class="form-control" required>
                                        <option value="">-- Select District --</option>
                                        @foreach($districts as $district)
                                            <option value="{{ $district->id }}" {{ selected($district->id, $address->district_id) }}>
                                                {{ $district->district }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Pincode <span class="text-danger">*</span></label>
                                    <select name="pincode_id" id="pincode_id" class="form-control" required>
                                        <option value="">-- Select Pincode --</option>
                                        @foreach($pincodes as $pincode)
                                            <option value="{{ $pincode->id }}" {{ selected($pincode->id, $address->pincode_id) }}>
                                                {{ $pincode->pincode }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Location <span class="text-danger">*</span></label>
                                    <select name="location_id" id="location_id" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        @foreach($locations as $location)
                                            <option value="{{ $location->id }}" {{ selected($location->id, $address->location_id) }}>
                                                {{ $location->location }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="address_id" value="{{ $address->id }}">
                        <input type="submit" class="btn btn-primary px-4">
                    </form>
                </div>
			</div>
            <div class="col-md-3"></div>
		</div>
		

    </div> <!-- container-fluid -->
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