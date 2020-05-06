@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Products</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Products</a>
    	                </li>
    	                <li class="breadcrumb-item active">Create</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/product/create') }}" class="btn btn-primary">+ Create New</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body">
				<table class="table table-bordered">
				    <thead>
					    <tr>
					        <th>Image</th>
					        <th >Product Name</th>
					        <th>Base (Price/stock)</th>
					        <th>Status</th>
					        <th>Action</th>
					    </tr>
				    </thead>
				    <tbody>
					    @foreach($products as $product)
					        <tr>
					            <td>
					                <img src="{{ url('storage'.$product->primary_img->image_sm) }}" alt="" style="max-height: 80px;">
					            </td>
					            <td style="max-width: 600px;">
					                {{ $product->product_name }}
					                <div class="small text-success">
						                @foreach($product->categories->pluck('category')->toArray() as $category)
						                	{{ $category }}
						                	<span class="mx-1 text-secondary">|</span>
						                @endforeach
					                </div>
					            </td>
					            <td style="min-width: 150px;">
					                <div>
					                	<b class="mr-1">Price: </b>
					                	<i class="fas fa-rupee-sign"></i>
					                	{{ $product->base_price }}
					                </div>
					                <div>
					                	<b class="mr-1">Stock: </b>
					                	{{ $product->base_stock }}
					                </div>
					            </td>
					            <td>
					                @if($product->status == '1')
					                    <div class="text-success font-weight-bold">
					                        Active
					                    </div>
					                @else
					                    <div class="text-secondary">
					                        In-Active
					                    </div>
					                @endif

					                @if($product->featured == '1')
					                    <div class="text-primary font-weight-bold">
					                        Featured
					                    </div>
					                @else
					                    <div class="text-secondary">
					                        Not Featured
					                    </div>
					                @endif
					            </td>
					            <td class="font-size-20">
					            	<a href="{{ url('admin/product/info/'.$product->id) }}" class="btn btn-sm btn-info" title="View Product">
					            	    <i class="fas fa-info-circle"></i>
					            	</a>
				                    <a href="{{ url('admin/product/details/'.$product->id) }}" class="btn btn-sm btn-primary" title="Product Details">
				                        <i class="fas fa-align-left"></i>
				                    </a>
				                    <a href="{{ url('admin/product/variants/'.$product->id) }}" class="btn btn-sm btn-dark" title="Product Variations">
				                        <i class="fas fa-code-branch"></i>
				                    </a>
				                    <a href="{{ url('admin/product/images/'.$product->id) }}" class="btn btn-sm btn-secondary" title="Product Images">
				                        <i class="far fa-images"></i>
				                    </a>
				                    <a href="{{ url('admin/product/delete/'.$product->id) }}" class="btn btn-sm btn-danger" title="Delete This">
				                        <i class="fas fa-trash"></i>
				                    </a>
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

				{{ $products->links() }}
			</div>
			
		</div>

    </div> <!-- container-fluid -->
@endsection
