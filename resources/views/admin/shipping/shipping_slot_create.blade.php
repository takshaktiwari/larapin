@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Create Slot</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Shipping </a>
    	                </li>
    	                <li class="breadcrumb-item">Slots</li>
                        <li class="breadcrumb-item active">Create</li>
    	            </ol>
    	        </div>
    	    </div>
    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/shipping_slots') }}" class="btn btn-primary">All Slots</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('admin/shipping_slot/create') }}" method="POST" class="p-0 p-sm-3">
                            @csrf
                            <div class="form-group">
                                <label for="">Time Start From <span class="text-danger">*</span></label>
                                <input type="time" name="time_from" class="form-control" required value="" >
                            </div>
                            <div class="form-group">
                                <label for="">Time End At <span class="text-danger">*</span></label>
                                <input type="time" name="time_to" class="form-control" required value="" >
                            </div>
                            <div class="form-group">
                                <label for="">Period Name </label>
                                <input type="text" name="time_period" class="form-control" placeholder="Morning/Noon/Evening" value="" >
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary px-4">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
		
		

    </div> <!-- container-fluid -->
@endsection
