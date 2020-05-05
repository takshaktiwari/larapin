@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Edit Role</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Roles</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	                <li class="breadcrumb-item active">Edit</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/roles') }}" class="btn btn-primary">Roles List</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="row">
			<div class="col-md-5">
				<div class="card">
					<div class="card-body">
						<form action="{{ url('admin/role/update') }}" method="POST" class="p-sm-3 p-0">
						    @csrf
						    <div class="form-group">
						        <label for="">User Role <span class="text-danger">*</span></label>
						        <input type="text" name="role_name" required class="form-control" value="{{ $role->role_name }}">
						    </div>
                            <input type="hidden" name="role_id" value="{{ $role->id }}">
						    <input type="submit" class="btn btn-dark px-4">
						</form>
					</div>
				</div>
			</div>
		</div>
		

    </div> <!-- container-fluid -->
@endsection
