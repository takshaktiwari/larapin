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
    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
	        		<a class="btn border font-weight-bold" data-toggle="collapse" data-target="#filter">
	        	    	<i class="fas fa-sliders-h"></i>
	        	    	Filter
	        	    </a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

    	<div class="card collapse" id="filter">
    		<div class="card-body">
    			<form action="">
    				<div class="row">
    					<div class="col-12 col-md-3">
    						<input type="text" name="search" class="form-control mb-2" placeholder="Search" value="{{ Request::get('search') }}">
    					</div>
    					<div class="col-12 col-md-3">
    						<select name="category" id="" class="form-control mb-2">
    							<option value="">Category</option>
    							@foreach($categories as $category)
    								<option value="{{ $category->id }}" {{ selected(Request::get('category'), $category->id) }}>
    									{{ $category->category }}
    								</option>
    							@endforeach
    						</select>
    					</div>
    					<div class="col-6 col-md-2">
    						<select name="status" id="" class="form-control mb-2">
    							<option value="">-- Select Status --</option>
    							<option value="1" {{ selected(Request::get('status'), '1') }} >Active</option>
    							<option value="0" {{ selected(Request::get('status'), '0') }} >In-Active</option>
    						</select>
    					</div>
						<div class="col-6 col-md-2">
							<select name="featured" id="" class="form-control mb-2">
								<option value="">-- Select Featured --</option>
								<option value="1" {{ selected(Request::get('featured'), '1') }} >Featured</option>
								<option value="0" {{ selected(Request::get('featured'), '0') }} >Not-Featured</option>
							</select>
						</div>
						<div class="col-12 col-md-2">
							<select name="in_offer" id="" class="form-control mb-2">
								<option value="">-- Select In-Offer Status --</option>
								<option value="1" {{ selected(Request::get('in_offer'), '1') }} >In-Offer</option>
								<option value="0" {{ selected(Request::get('in_offer'), '0') }} >Not In-Offer</option>
							</select>
						</div>
    					<div class="col-6 col-md-2">
    						<input type="text" name="min_price" class="form-control mb-2" placeholder="Min Price" value="{{ Request::get('min_price') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<input type="text" name="max_price" class="form-control mb-2" placeholder="Max Price" value="{{ Request::get('max_price') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<input type="text" name="min_stock" class="form-control mb-2" placeholder="Min Stock" value="{{ Request::get('min_stock') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<input type="text" name="max_stock" class="form-control mb-2" placeholder="Max Stock" value="{{ Request::get('max_stock') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<input type="text" name="min_discount" class="form-control mb-2" placeholder="Min Discount" value="{{ Request::get('min_discount') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<input type="text" name="max_discount" class="form-control mb-2" placeholder="Max Discount" value="{{ Request::get('max_discount') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<input type="date" name="expires_before" class="form-control mb-2" title="Expires Before" value="{{ Request::get('expires_before') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<input type="date" name="expires_after" class="form-control mb-2" title="Expires After" value="{{ Request::get('expires_after') }}">
    					</div>
    					
						<div class="col-12 col-md-2">
							<input type="submit" class="btn btn-success px-3">
							<a href="{{ url('admin/discount/products') }}" class="btn btn-danger">
								<i class="fas fa-times"></i>
							</a>
						</div>
    				</div>
    			</form>
    		</div>
    	</div>


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
						    @can('discount_product_update')
						    <tr>
						    	<td colspan="4">
						    		<div class="text-right py-1">
						    			<span class="btn px-4 disable_all" >Disable All</span>
						    			<input type="submit" class="btn btn-success px-4" value="Update Discounts">
						    		</div>
						    	</td>
						    </tr>
						    @endcan
					    </tbody>
					</table>

					{{ $products->appends([
									'search' 	=> 	Request::get('search'),
									'category'	=>	Request::get('category'),
									'status'	=>	Request::get('status'),
									'featured'	=>	Request::get('featured'),
									'in_offer'	=>	Request::get('in_offer'),
									'min_price'	=>	Request::get('min_price'),
									'max_price'	=>	Request::get('max_price'),
									'min_stock'	=>	Request::get('min_stock'),
									'max_stock'	=>	Request::get('max_stock'),
									'min_discount'	=>	Request::get('min_discount'),
									'max_discount'	=>	Request::get('max_discount'),
									'expires_before'=>	Request::get('expires_before'),
									'expires_after'	=>	Request::get('expires_after'),
								])->links() }}
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
