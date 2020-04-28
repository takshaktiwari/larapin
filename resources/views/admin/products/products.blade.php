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

		
		<div class="bg-white p-3 shadow-sm">
			<table class="table table-bordered">
			    <thead>
				    <tr>
				        <th>Image</th>
				        <th>Product Name</th>
				        <th>Category</th>
				        <th>Featured</th>
				        <th>Status</th>
				        <th>Action</th>
				    </tr>
			    </thead>
			    <tbody>
				    @foreach($products as $product)
				        <tr>
				            <td>
				                
				            </td>
				            <td>
				                {{ $product->product_name }}
				            </td>
				            <td>
				                
				            </td>
				            <td>
				                @if($product->featured == '1')
				                    <span class="text-primary font-weight-bold">
				                        Featured
				                    </span>
				                @else
				                    <span class="text-secondary">
				                        ---
				                    </span>
				                @endif
				            </td>
				            <td>
				                @if($product->status == '1')
				                    <span class="text-success font-weight-bold">
				                        Active
				                    </span>
				                @else
				                    <span class="text-secondary">
				                        In-Active
				                    </span>
				                @endif
				            </td>
				            <td class="font-size-20">
				            	<a href="{{ url('admin/product/info/'.$product->id) }}" class="btn btn-sm btn-info" title="Edit this">
				            	    <i class="fas fa-info-circle"></i>
				            	</a>
			                    <a href="{{ url('admin/product/details/'.$product->id) }}" class="btn btn-sm btn-primary" title="Edit this">
			                        <i class="fas fa-align-left"></i>
			                    </a>
			                    <a href="{{ url('admin/product/variants/'.$product->id) }}" class="btn btn-sm btn-dark" title="Edit this">
			                        <i class="fas fa-code-branch"></i>
			                    </a>
			                    <a href="{{ url('admin/product/images/'.$product->id) }}" class="btn btn-sm btn-secondary" title="Edit this">
			                        <i class="far fa-images"></i>
			                    </a>
			                    <a href="{{ url('admin/product/delete/'.$product->id) }}" class="btn btn-sm btn-danger" title="Edit this">
			                        <i class="fas fa-trash"></i>
			                    </a>
				            </td>
				        </tr>
				    @endforeach
			    </tbody>
			</table>

			{{ $products->links() }}
		</div>

    </div> <!-- container-fluid -->
@endsection
