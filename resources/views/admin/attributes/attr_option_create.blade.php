@extends('layouts.admin')


@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">New Attribute Option</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Attribute Options</a>
    	                </li>
    	                <li class="breadcrumb-item active">New Option</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/attr_options') }}" class="btn btn-primary">+ All Options</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		
		<div class="row">
			<div class="col-md-6">
				<form action="{{ url('admin/attr_option/create') }}" method="POST" class="bg-white p-sm-5 p-3 shadow-sm">
					@csrf
					<div class="form-group">
					    <label for="">Attribute <span class="text-danger">*</span></label>
                        <select name="attribute_id" class="form-control" required>
                            <option value="">-- Select --</option>
                            @foreach($attributes as $attribute)
                                <option value="{{ $attribute->id }}">
                                    {{ $attribute->attribute }}
                                </option>
                            @endforeach
                        </select>
					</div>
                    <div class="form-group">
                        <label for="">Option <span class="text-danger">*</span></label>
                        <input type="text" name="attr_option" required class="form-control">
                    </div>
					<input type="submit" class="btn btn-dark px-5">
				</form>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection