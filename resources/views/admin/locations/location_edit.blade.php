@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Edit Location</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Locations</a>
    	                </li>
    	                <li class="breadcrumb-item active">Edit Location</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/locations') }}" class="btn btn-primary">+ All Locations</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		
		<div class="row">
			<div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('admin/location/update') }}" method="POST" class="p-sm-3 p-0">
                            @csrf
                            <div class="form-group">
                                <label for="">Country <span class="text-danger">*</span></label>
                                <select name="country_id" id="country_id" class="form-control" required>
                                    <option value="">-- Select Country --</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ selected($country->id, $location->country_id) }} >
                                            {{ $country->country }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">State <span class="text-danger">*</span></label>
                                <select name="state_id" id="state_id" class="form-control" required>
                                    <option value="">-- Select Country --</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}" {{ selected($state->id, $location->state_id) }}>
                                            {{ $state->state }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">District <span class="text-danger">*</span></label>
                                <select name="district_id" id="district_id" class="form-control" required>
                                    <option value="">-- Select District --</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ selected($district->id, $location->district_id) }}>
                                            {{ $district->district }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Pincode <span class="text-danger">*</span></label>
                                <select name="pincode_id" id="pincode_id" class="form-control" required>
                                    <option value="">-- Select Pincode --</option>
                                    @foreach($pincodes as $pincode)
                                        <option value="{{ $pincode->id }}" {{ selected($pincode->id, $location->pincode_id) }}>
                                            {{ $pincode->pincode }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Location Name <span class="text-danger">*</span></label>
                                <input type="text" name="location" required class="form-control" value="{{ $location->location }}">
                            </div>
                            <input type="hidden" name="location_id" value="{{ $location->id }}">
                            <input type="submit" class="btn btn-primary px-5">
                        </form>
                    </div>
                </div>
				
			</div>
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
                            $("#state_id").html('<option value="">-- Select Country --</option>');
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
                            $("#pincode_id").html('<option value="">-- Select Country --</option>');
                            if(result != ''){
                                $.each(result, function(index, val) {
                                    $("#pincode_id").append('<option value="'+val.id+'">'+val.pincode+'</option>');
                                });
                            }
                        }
                    });
                    
                }
            });
        });
    </script>
@endsection