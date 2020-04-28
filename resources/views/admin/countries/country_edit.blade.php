@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Edit Country</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Countries</a>
    	                </li>
    	                <li class="breadcrumb-item active">Edit Country</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/countries') }}" class="btn btn-primary">+ All Countries</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		
		<div class="row">
			<div class="col-md-6">
				<form action="{{ url('admin/country/update') }}" method="POST" class="bg-white p-sm-5 p-3 shadow-sm">
					@csrf
					<div class="form-group">
					    <label for="">Country Name <span class="text-danger">*</span></label>
					    <input type="text" name="country" required class="form-control" value="{{ $country->country }}">
					</div>
                    <input type="hidden" name="country_id" value="{{ $country->id }}">
					<input type="submit" class="btn btn-dark px-5">
				</form>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection