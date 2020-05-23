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
	        		<a class="btn border font-weight-bold" data-toggle="collapse" data-target="#filter">
	        	    	<i class="fas fa-sliders-h"></i>
	        	    	Filter
	        	    </a>
    	        	<a href="{{ url('admin/exports') }}" class="btn btn-success">Exports</a>
    	        	@can('product_create')
    	            <a href="{{ url('admin/product/create') }}" class="btn btn-primary">+ Create New</a>
    	            @endcan
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
    					
						<div class="col-12 col-md-2">
							<input type="submit" class="btn btn-success px-3">
							<a href="{{ url('admin/products') }}" class="btn btn-danger">
								<i class="fas fa-times"></i>
							</a>
						</div>
    				</div>
    			</form>
    		</div>
    	</div>

		<div class="card">
			<div class="card-body">
				<table class="table table-bordered">
				    <thead>
					    <tr>
					    	<th>#</th>
					        <th>Image</th>
					        <th>Product Name</th>
					        <th>Base (Price/stock)</th>
					        <th>Status</th>
					        <th>Action</th>
					    </tr>
				    </thead>
				    <tbody>
					    @foreach($products as $product)
					        <tr>
					        	<td>
					        		<div class="form-check">
					        		  	<label class="form-check-label">
					        		    	<input type="checkbox" class="form-check-input product_check" value="{{ $product->id }}">
					        		  	</label>
					        		</div>
					        	</td>
					            <td>
					            	@isset($product->primary_img->image_sm)
					                <img src="{{ url('storage'.$product->primary_img->image_sm) }}" alt="" style="max-height: 80px;">
					                @endisset
					            </td>
					            <td style="max-width: 600px;">
					                <a href="{{ url('product/'.$product->slug) }}" target="_blank">
					                	{{ $product->product_name }}
					                </a>
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

					                @if($product->in_offer)
					                	<div class="font-weight-bold text-warning">
					                		In Offer
					                	</div>
					                @endif
					            </td>
					            <td class="font-size-20">
					            	@can('product_update_info')
					            	<a href="{{ url('admin/product/info/'.$product->id) }}" class="btn btn-sm btn-info" title="View Product">
					            	    <i class="fas fa-info-circle"></i>
					            	</a>
					            	@endcan
					            	@can('product_update_details')
				                    <a href="{{ url('admin/product/details/'.$product->id) }}" class="btn btn-sm btn-primary" title="Product Details">
				                        <i class="fas fa-align-left"></i>
				                    </a>
				                    @endcan
				                    @can('product_update_variants')
				                    <a href="{{ url('admin/product/variants/'.$product->id) }}" class="btn btn-sm btn-dark" title="Product Variations">
				                        <i class="fas fa-code-branch"></i>
				                    </a>
				                    @endcan
				                    @can('product_update_images')
				                    <a href="{{ url('admin/product/images/'.$product->id) }}" class="btn btn-sm btn-secondary" title="Product Images">
				                        <i class="far fa-images"></i>
				                    </a>
				                    @endcan
				                    @can('product_delete')
				                    <a href="{{ url('admin/product/delete/'.$product->id) }}" class="btn btn-sm btn-danger" title="Delete This">
				                        <i class="fas fa-trash"></i>
				                    </a>
				                    @endcan
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>
				<div class="mb-4 d-sm-flex">
					<div class="border float-left mr-2" style="min-width: 120px;">
						<div class="form-check my-auto">
						  	<label class="form-check-label px-3 pt-1 pb-2">
						    	<input type="checkbox" class="form-check-input" id="product_check_all">
						    	Check All
						  	</label>
						</div>
					</div>
					

					<select id="action_selected" class="form-control" style="max-width: 250px;">
						<option value="">-- Action --</option>
						<option value="delete">Delete</option>
						<option value="in_active">In-Active</option>
						<option value="active">Active</option>
						<option value="featured">Mark Featured</option>
						<option value="not_featured">Mark Not Featured</option>
						<option value="in_offer">Mark In Offer</option>
						<option value="not_in_offer">Mark Not In Offer</option>
					</select>
				</div>


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
								])->links() }}
			</div>
			
		</div>

    </div> <!-- container-fluid -->
@endsection

@section('scripts')
	@parent
	<script>
		$(document).ready(function($) {
			$("#product_check_all").change(function(event) {
				if($(this).prop('checked') == true){
					$(".product_check").prop('checked', true);
				}else{
					$(".product_check").prop('checked', false);
				}
			});

			$("#action_selected").change(function(event) {
				if($(this).val()==''){
					return false
				}else{
					var action = $(this).val();
				}

				var products_ids = []; 
				$("input.product_check:checked").each(function() { 
	                products_ids.push($(this).val()); 
	            });

				if(products_ids.length == 0){
					alert('No products are selected.');
					return false;
				}

				if(confirm('This action will be applied on all selected product. Do you want to Proceed ?')){
					$(this).html('Please Wait ...');

		            $.ajax({
		            	url: '{{ url('ajax/selected_product_action') }}',
		            	type: 'POST',
		            	data: {	action: action, 
		            			products_ids: products_ids, 
		            			_token: '{{csrf_token()}}' },
		            })
		            .done(function(result) {
		            	window.location.href = '{{ url()->full() }}';
		            	console.log("success");
		            })
		            .fail(function(result) {
		            	console.log("error");
		            	$("#delete_selected").html('Failed !! Try again');
		            });
				}
			});
		});
	</script>
@endsection
