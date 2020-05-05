@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">New Brand</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Brands</a>
    	                </li>
    	                <li class="breadcrumb-item active">New Brand</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/brands') }}" class="btn btn-primary">+ All Brands</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		
		<div class="row">
			<div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('admin/brand/create') }}" method="POST" class="p-sm-3 p-0">
                            @csrf
                            <div class="form-group">
                                <label for="">Brand <span class="text-danger">*</span></label>
                                <input type="text" name="brand" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Meta Title </label>
                                <textarea name="m_title" rows="2" class="form-control" maxlength="250"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Meta Keywords </label>
                                <textarea name="m_keywords" rows="2" class="form-control" maxlength="250"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Meta Description </label>
                                <textarea name="m_description" rows="2" class="form-control" maxlength="250"></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary px-5">
                        </form>
                    </div>
                </div>
				
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection

