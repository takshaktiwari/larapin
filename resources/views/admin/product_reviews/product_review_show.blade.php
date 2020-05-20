@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Product Review</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Product Reviews</a>
    	                </li>
    	                <li class="breadcrumb-item active">{{ substr($product_review->product->product_name, 0, 25) }}</li>
    	                <li class="breadcrumb-item active">Details</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/product_reviews') }}" class="btn btn-primary">+ All Reviews</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body">
				<table id="datatable" class="table table-bordered">
				    <tbody>
						<tr>
							<th>Product:</th>
							<td>
								<a href="{{ url('product/'.$product_review->product->slug) }}" target="_blank">
									{{ $product_review->product->product_name }}
								</a>
							</td>
						</tr>
						<tr>
							<th>User:</th>
							<td>{{ $product_review->user->name }}</td>
						</tr>
						<tr>
							<th>Email:</th>
							<td>{{ $product_review->user->email }}</td>
						</tr>
						<tr>
							<th>Rating:</th>
							<td>
								<span class="btn btn-sm btn-warning font-weight-bold text-dark">
									{{ number_format($product_review->rating, 1) }}
									<i class="fas fa-star"></i>
								</span>
							</td>
						</tr>
						<tr>
							<th>Title:</th>
							<td>{{ $product_review->title }}</td>
						</tr>
						<tr>
							<th>Review:</th>
							<td>{{ $product_review->review }}</td>
						</tr>
						<tr>
							<th></th>
							<td>
								<a href="{{ url('/reviews/'.$product_review->product->slug.'#review_'.$product_review->id) }}" class="btn px-4 btn-info" title="View this" target="_blank">
								    <i class="fas fa-eye"></i>
								    On Page
								</a>
								@can('product_review_delete')
								<a href="{{ url('admin/product_review/delete/'.$product_review->id) }}" class="btn px-4 btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
								    <i class="fas fa-trash mr-1"></i>
								    Delete
								</a>
								@endcan
							</td>
						</tr>
				    </tbody>
				</table>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
