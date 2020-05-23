@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Product Upload</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Products</a>
    	                </li>
    	                <li class="breadcrumb-item active">upload</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	        	@can('product_access')
    	            <a href="{{ url('admin/products') }}" class="btn btn-primary">Products List</a>
					@endcan
    	        	@can('product_create')
    	            <a href="{{ url('admin/product/create') }}" class="btn btn-primary">+ Create New</a>
    	            @endcan
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->
    	<div class="row">
    		<div class="col-md-7">
				<div class="card">
					<div class="card-body">
						<form action="{{ url('admin/product/upload') }}" method="POST" enctype="multipart/form-data" class="p-sm-5 p-3">
							@csrf
							<div class="form-group">
								<label for="">Upload Files <span class="text-danger">*</span></label>
								<input type="file" name="import_file" class="form-control" required placeholder="placeholder" value="" >
							</div>
                            <ul class="text-danger pl-3">
                                <li>File type should be .xlsx (Office 2007 - 365)</li>
                                <li>Max file size should be less than 2MB (2048 KB)</li>
                                <li>Excelsheet should be contain 200 products at a time</li>
                                <li>Columns headings should be same as given in example file</li>
                                <li>
                                    <a href="{{ url('admin/product/upload/sample') }}" class="text-primary font-weight-bold font-size-16">
                                        <i class="fas fa-download"></i>
                                        Download Sample File
                                    </a>
                                </li>
                            </ul>
							<input type="submit" class="btn btn-success px-4">
						</form>
					</div>
				</div>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
