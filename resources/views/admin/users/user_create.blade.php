@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Create User</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Users</a>
    	                </li>
    	                <li class="breadcrumb-item active">List</li>
    	                <li class="breadcrumb-item active">Create</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/users') }}" class="btn btn-primary">Users List</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->
		
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
						<form action="{{ url('admin/user/create') }}" method="POST">
							@csrf
							<div class="form-group">
							    <label for="">Name <span class="text-danger">*</span></label>
							    <input type="text" name="name" required class="form-control" value="{{ old('name') }}">
							</div>
							<div class="form-group">
							    <label for="">Email <span class="text-danger">*</span></label>
							    <input type="email" name="email" required class="form-control" value="{{ old('email') }}">
							</div>
							<div class="form-group">
							    <label for="">Mobile <span class="text-danger">*</span></label>
							    <input type="number" name="mobile" required class="form-control" value="{{ old('mobile') }}">
							</div>
							<div class="form-group">
							    <label for="">Gender</label>
							    <select name="gender" class="form-control" >
							        <option value="">-- Select --</option>
							        <option value="male">Male</option>
							        <option value="female">Female</option>
							        <option value="others">Others</option>
							    </select>
							</div>
							<div class="form-group">
							    <label for="">Password</label>
							    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
							</div>
							<div class="form-check mt-2 mb-3">
							  	<label class="form-check-label ">
							    	<input type="checkbox" class="form-check-input " name="verified" value="1">
							    	Verified User
							  	</label>
							</div>

							<input type="submit" class="btn btn-primary px-5">
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
		

    </div> <!-- container-fluid -->
@endsection
