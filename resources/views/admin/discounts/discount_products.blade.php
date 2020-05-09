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
    	                <li class="breadcrumb-item active">Discounts</li>
    	            </ol>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body">
				<form action="{{ url('admin/discount/products/update') }}" method="POST">
					@csrf

					<table id="datatable" class="table table-bordered">
					    <thead>
						    <tr>
						        <th>#</th>
						        <th>Product</th>
						        <th>Discount <span class="small">(Max: 100%)</span></th>
						        <th>Expires At</th>
						    </tr>
					    </thead>

					    <tbody>
					    	@php
					    		$i=0;
					    	@endphp
						    @foreach($products as $key => $product)
						    	@php
						    		$i++;
						    		$discount = '';
						    		$expires_at = '';
						    		if(!empty($product->discount->discount)){
						    			$discount = $product->discount->discount;
						    		}
						    		if(!empty($product->discount->expires_at)){
						    			$expires_at = date('Y-m-d', strtotime($product->discount->expires_at));
						    			$expires_at .= 'T';
						    			$expires_at .= date('H:i:s', strtotime($product->discount->expires_at));
						    		}
						    	@endphp
						        <tr>
						        	<td>{{ $i }}</td>
						            <td>
						            	{{ $product->product_name }}
						            	<div class="small text-success">
						            		<b class="mr-1">Price: </b>
						            		<i class="fas fa-rupee-sign"></i>
						            		{{ $product->base_price }}
						            	</div>
						            </td>
						            <td>
						            	<input type="hidden" name="products[{{ $product->id }}][id]" value="{{ $product->id }}">
					                    <div class="input-group ">
					                    	<input type="text" class="form-control discount"  name="products[{{ $product->id }}][discount]" value="{{ $discount }}">
					                    	<div class="input-group-append">
					                    	  	<span class="input-group-text">%</span>
					                    	</div>
					                    </div>
						            </td>
						            <td>
					                    <input type="datetime-local" name="products[{{ $product->id }}][expires_at]" class="form-control expires_at" value="{{ $expires_at }}">
						            </td>
						        </tr>
						    @endforeach
						    <tr>
						    	<td colspan="4">
						    		<div class="text-right py-1">
						    			<span class="btn px-4 disable_all" >Disable All</span>
						    			<input type="submit" class="btn btn-success px-4" value="Update Discounts">
						    		</div>
						    	</td>
						    </tr>
					    </tbody>
					</table>

					{{ $products->links() }}
				</form>
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection

@section('scripts')
	@parent
	<script>
		$(document).ready(function($) {
			$(".disable_all").click(function(event) {
				$(".discount").val('0');
				$(".expires_at").val('0');
			});
		});
	</script>
@endsection
