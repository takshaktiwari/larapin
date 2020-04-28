@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">New Location</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Locations</a>
    	                </li>
    	                <li class="breadcrumb-item active">New Location</li>
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
				<form action="{{ url('admin/location/create') }}" method="POST" class="bg-white p-sm-5 p-3 shadow-sm">
					@csrf
                    <div class="form-group">
                        <label for="">Country <span class="text-danger">*</span></label>
                        <select name="country_id" id="country_id" class="form-control" required>
                            <option value="">-- Select Country --</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">
                                    {{ $country->country }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">State <span class="text-danger">*</span></label>
                        <select name="state_id" id="state_id" class="form-control" required>
                            <option value="">-- Select Country --</option>
                        </select>
                    </div>
					<div class="form-group">
					    <label for="">Location Name <span class="text-danger">*</span></label>
					    <input type="text" name="location" required class="form-control" >
					</div>
                    <div class="form-group">
                        <label for="">Pincode <span class="text-danger">*</span></label>
                        <input type="text" name="pin_code" required class="form-control" >
                    </div>
					<input type="submit" class="btn btn-dark px-5">
				</form>
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
        });
    </script>
@endsection