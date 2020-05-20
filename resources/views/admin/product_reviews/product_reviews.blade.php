@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Product Reviews</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Product Reviews</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body">
				<table id="datatable" class="table table-bordered">
				    <thead>
					    <tr>
					        <th>#</th>
					        <th>User</th>
					        <th>Product</th>
					        <th>Review / Rating</th>
					        <th>Action</th>
					    </tr>
				    </thead>

				    <tbody>
					    @foreach($product_reviews as $key => $review)
					        <tr>
					        	<td>{{ $key+1 }}</td>
					        	<td>
					        		{{ $review->user->name }}
					        		<div class="small">{{ $review->user->email }}</div>
					        	</td>
					        	<td>{{ $review->product->product_name }}</td>
					            <td>
					            	{{ $review->title }}
					            	<span class="btn btn-sm btn-warning py-0 font-weight-bold text-dark">
					            		{{ number_format($review->rating, 1) }}
					            		<i class="fas fa-star"></i>
					            	</span>
					            </td>
					            <td class="font-size-20" style="min-width: 100px;">
					            	@can('product_review_show')
				                    <a href="{{ url('admin/product_review/show/'.$review->id) }}" class="btn btn-sm btn-info" title="View this">
				                        <i class="fas fa-info-circle"></i>
				                    </a>
				                    @endcan
									
									@can('product_review_delete')
				                    <a href="{{ url('admin/product_review/delete/'.$review->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
				                        <i class="fas fa-trash"></i>
				                    </a>
				                    @endcan
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

				{{ $product_reviews->links() }}
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
