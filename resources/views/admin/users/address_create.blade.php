@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Create Address</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Users</a>
    	                </li>
    	                <li class="breadcrumb-item active">{{ $user->name }}</li>
    	                <li class="breadcrumb-item active">Addresses</li>
                        <li class="breadcrumb-item active">Create Address</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/user/'.$user->id.'/addresses') }}" class="btn btn-primary">All Address</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->
		
		<div class="row">
            <div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="card">
                    <form action="{{ url('admin/user/address/create') }}" method="POST" class="card-body">
                        @csrf

                        <div class="form-group">
                            <label for="">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" required class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Email </label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Mobile <span class="text-danger">*</span></label>
                            <input type="text" name="mobile" required class="form-control" value="{{ old('mobile') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Address Line 1 <span class="text-danger">*</span></label>
                            <input type="text" name="line1" required class="form-control" value="{{ old('line1') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Address Line 2 </label>
                            <input type="text" name="line2" class="form-control" value="{{ old('line2') }}">
                        </div>
                        <div class="form-group">
                            <label for="">Landmark </label>
                            <input type="text" name="landmark" class="form-control" value="{{ old('landmark') }}">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Country <span class="text-danger">*</span></label>
                                    <select name="country_id" id="country_id" class="form-control" required>
                                        <option value="">-- Select --</option>
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
                                    <label for="">State <span class="text-danger">*</span></label>
                                    <select name="state_id" id="state_id" class="form-control" required>
                                        <option value="">-- Select --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Location <span class="text-danger">*</span></label>
                                    <select name="location_id" id="location_id" class="form-control" required>
                                        <option value="">-- Select --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Pin-Code <span class="text-danger">*</span></label>
                                    <input type="text" name="pincode" id="pincode" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Shipping / Billing Address <span class="text-danger">*</span></label>
                            <select name="shipping_billing" class="form-control" required>
                                <option value="1" {{ selected('1', old('shipping_billing')) }} >
                                    Shipping Address
                                </option>
                                <option value="2" {{ selected('2', old('shipping_billing')) }} >
                                    Billing Address
                                </option>
                                <option value="3" {{ selected('3', old('shipping_billing')) }} >
                                    Both Shipping & Billing Address
                                </option>
                            </select>
                        </div>
                        
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
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
                        url: '{{ url('ajax/get_state_locations') }}',
                        type: 'POST',
                        data: {state_id: state_id ,_token: '{{csrf_token()}}'},
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

            $("#location_id").change(function(event) {
                var location_id = $(this).val();

                if(location_id != ''){
                    $.ajax({
                        url: '{{ url('ajax/get_location_pincode') }}',
                        type: 'POST',
                        data: {location_id: location_id ,_token: '{{csrf_token()}}'},
                        success: function(result){
                            
                            if(result != ''){
                                $("#pincode").val(result.pincode);
                            }
                        }
                    });
                    
                }
            });
        });
    </script>
@endsection