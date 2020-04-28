@extends('layouts.admin')

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
                
				<form action="{{ url('admin/product/details/update') }}" method="POST" class="p-sm-3 p-1 ">
					@csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Shipping Charge </label>
                                <input type="text" name="ship_charge" class="form-control" value="{{ $product->ship_charge }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Shipping Time </label>
                                <input type="text" name="ship_time" class="form-control" value="{{ $product->ship_time }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">SKU Code </label>
                                <input type="text" name="sku_code" class="form-control" value="{{ $product->sku_code }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Product Description</label>
                        <textarea name="description" rows="6" class="form-control">{{ $product->details->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Meta Tile</label>
                        <textarea name="m_title" rows="2" class="form-control" maxlength="250">{{ $product->details->m_title }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Meta Keywords</label>
                        <textarea name="m_keywords" rows="2" class="form-control" maxlength="250">{{ $product->details->m_keywords }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Meta Description</label>
                        <textarea name="m_description" rows="2" class="form-control" maxlength="250">{{ $product->details->m_description }}</textarea>
                    </div>
					
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
					<input type="submit" class="btn btn-lg rounded-sm btn-dark px-5" value="Update">
				</form>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection

@section('scripts')
    @parent
    
@endsection