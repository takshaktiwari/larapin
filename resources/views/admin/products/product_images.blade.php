@extends('layouts.admin')

@section('styles')
    @parent
    
@endsection

@section('content')


    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Product Details</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Products</a>
    	                </li>
    	                <li class="breadcrumb-item active">Details</li>
                        <li class="breadcrumb-item active">{{ substr($product->product_name, 0, 50) }}...</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/products') }}" class="btn btn-primary">All Products</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->
        
        @include('admin.products.product_nav')
		<div class="card">
			<div class="card-body">
                <div class="row my-4">
                    <div class="col-md-5">
        				<form action="{{ url('admin/product/images/update') }}" method="POST" class="p-4 border rounded" enctype="multipart/form-data">
        					@csrf
                            <div class="form-group">
                                <label for="">Image Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" required class="form-control" maxlength="250" value="{{ $product->product_name }}">
                            </div>

                            <div class="form-group">
                                <label for="">Choose Images <span class="text-danger">*</span></label>
                                <input type="file" name="product_img[]" multiple="" required class="form-control">
                            </div>
                                
        					
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
        					<input type="submit" class="btn rounded-sm btn-dark px-5 mt-2" value="Update">
        				</form>
                    </div>
                    <div class="col-md-7">
                        <div class="row">
                            @foreach($product->images as $image)
                                <div class="col-md-6 pb-3">
                                    <img src="{{ url('storage/'.$image->image_sm) }}" class="w-100 img-thumbnail">
                                    <div class="border">
                                        <p class="m-0 p-1 small">{{ $image->title }}</p>
                                        <div class="d-flex">
                                            @if($image->primary_img == false)
                                                <a href="{{ url('admin/product/images/primary', $image->id) }}" class="flex-fill btn btn-warning rounded-0" title="Make primary">
                                                    <i class="far fa-sun"></i>
                                                    Primary
                                                </a>
                                                <a href="{{ url('admin/product/images/delete', $image->id) }}" class="flex-fill btn btn-danger rounded-0" title="Make primary" onclick="return confirm('Are you sure to delete')">
                                                    <i class="fas fa-trash"></i>
                                                    Delete
                                                </a>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection

@section('scripts')
    @parent
    
@endsection