@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Change Password</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Profile</a>
    	                </li>
    	                <li class="breadcrumb-item active">Password</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/dashboard') }}" class="btn btn-primary">Dashboard</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->
		
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<form action="{{ url('admin/change_password') }}" method="POST">
							@csrf
							<div class="form-group">
							    <label for="">Old Password <span class="text-danger">*</span></label>
							    <input type="password" name="old_password" required class="form-control">
							</div>
							<div class="form-group">
							    <label for="">New Password <span class="text-danger">*</span></label>
							    <input type="password" name="new_password" required class="form-control">
							</div>
							<div class="form-group">
							    <label for="">Confirm Password <span class="text-danger">*</span></label>
							    <input type="password" name="new_password_confirmation" required class="form-control">
							</div>
							<input type="submit" class="btn btn-primary px-4">
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
		

    </div> <!-- container-fluid -->
@endsection
