@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Categories</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Categories</a>
    	                </li>
    	                <li class="breadcrumb-item active">Discounts</li>
    	            </ol>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body">
				<form action="{{ url('admin/discount/categories/update') }}" method="POST">
					@csrf

					<table id="datatable" class="table table-bordered">
					    <thead>
						    <tr>
						        <th>#</th>
						        <th>Category</th>
						        <th>Discount <span class="small">(Max: 100%)</span> </th>
						        <th>Expires At</th>
						    </tr>
					    </thead>

					    <tbody>
					    	@php
					    		$i=0;
					    	@endphp
						    @foreach($categories as $key => $category)
						    	@php
						    		$i++;
						    		$discount = '';
						    		$expires_at = '';
						    		if(!empty($category->discount_category->discount)){
						    			$discount = $category->discount_category->discount;
						    		}
						    		if(!empty($category->discount_category->expires_at)){
						    			$expires_at = date('Y-m-d', strtotime($category->discount_category->expires_at));
						    			$expires_at .= 'T';
						    			$expires_at .= date('H:i:s', strtotime($category->discount_category->expires_at));
						    		}
						    	@endphp
						        <tr>
						        	<td>{{ $i }}</td>
						            <td>{{ $category->category }}</td>
						            <td>
						            	<input type="hidden" name="categories[{{ $category->id }}][id]" value="{{ $category->id }}">
					                    <div class="input-group ">
					                    	<input type="text" class="form-control discount"  name="categories[{{ $category->id }}][discount]" value="{{ $discount }}">
					                    	<div class="input-group-append">
					                    	  	<span class="input-group-text">%</span>
					                    	</div>
					                    </div>
						            </td>
						            <td>
					                    <input type="datetime-local" name="categories[{{ $category->id }}][expires_at]" class="form-control expires_at" value="{{ $expires_at }}">
						            </td>
						        </tr>
						        @if($category->child_categories != '')
						        	@foreach($category->child_categories as $child)
						        		@php
						        			$i++;
						        			$discount = '';
						        			$expires_at = '';
						        			if(!empty($child->discount_category->discount)){
						        				$discount = $child->discount_category->discount;
						        			}
						        			if(!empty($child->discount_category->expires_at)){
						        				$expires_at = date('Y-m-d', strtotime($child->discount_category->expires_at));
						        				$expires_at .= 'T';
						        				$expires_at .= date('H:i:s', strtotime($child->discount_category->expires_at));
						        			}
						        		@endphp
				        		        <tr>
				        		        	<td>{{ $i }}</td>
				        		            <td>
				        		            	{{ $child->category }}
				        		            	@isset($child->parent_category->category)
				        		            	    <div class="small text-success">
				        		            	    	{{ $child->parent_category->category }}
				        		            	    </div>
				        		            	@endisset
				        		            </td>
				        		            <td>
				        		            	<input type="hidden" name="categories[{{ $child->id }}][id]" value="{{ $child->id }}" >
				        	                    <div class="input-group ">
				        	                    	<input type="text" class="form-control discount"  name="categories[{{ $child->id }}][discount]" value="{{ $discount }}">
				        	                    	<div class="input-group-append">
				        	                    	  	<span class="input-group-text">%</span>
				        	                    	</div>
				        	                    </div>
				        		            </td>
				        		            <td>
				        	                    <input type="datetime-local" name="categories[{{ $child->id }}][expires_at]" class="form-control expires_at" value="{{ $expires_at }}">
				        		            </td>
				        		        </tr>
						        	@endforeach
						        @endif
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

					{{ $categories->links() }}
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
