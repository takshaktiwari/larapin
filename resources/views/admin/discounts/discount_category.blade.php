@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Countries</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Countries</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
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
						        <th>Discount</th>
						        <th>Expires At</th>
						    </tr>
					    </thead>


					    <tbody>
						    @foreach($categories as $key => $category)
						    	@php
						    		$discount = '';
						    		$expires_at = '';
						    		if(!empty($category->discount_category->discount)){
						    			$discount = $category->discount_category->discount;
						    		}
						    		if(!empty($category->discount_category->expires_at)){
						    			$expires_at = date('Y-m-d', strtotime($category->discount_category->expires_at));
						    			$expires_at .= 'T';
						    			$expires_at = date('H:i:s', strtotime($category->discount_category->expires_at));
						    		}
						    	@endphp
						        <tr>
						        	<td>{{ $key+1 }}</td>
						            <td>{{ $category->category }}</td>
						            <td>
						            	<input type="hidden" name="categories[{{ $category->id }}][id]" value="{{ $category->id }}">
					                    <div class="input-group ">
					                    	<input type="text" class="form-control"  name="categories[{{ $category->id }}][discount]" value="{{ $discount }}">
					                    	<div class="input-group-append">
					                    	  	<span class="input-group-text">%</span>
					                    	</div>
					                    </div>
						            </td>
						            <td>
					                    <input type="datetime-local" name="categories[{{ $category->id }}][expires_at]" class="form-control" value="{{ $expires_at }}">
						            </td>
						        </tr>
						        @if($category->child_categories != '')
						        	@foreach($category->child_categories as $child)
				        		        <tr>
				        		        	<td>{{ $key+1 }}</td>
				        		            <td>
				        		            	{{ $child->category }}
				        		            	@isset($child->parent_category->category)
				        		            	    <div class="small text-success">
				        		            	    	{{ $child->parent_category->category }}
				        		            	    </div>
				        		            	@endisset
				        		            </td>
				        		            <td>
				        		            	<input type="hidden" name="categories[{{ $child->id }}][id]" value="{{ $child->id }}">
				        	                    <div class="input-group ">
				        	                    	<input type="text" class="form-control"  name="categories[{{ $child->id }}][discount]">
				        	                    	<div class="input-group-append">
				        	                    	  	<span class="input-group-text">%</span>
				        	                    	</div>
				        	                    </div>
				        		            </td>
				        		            <td>
				        	                    <input type="datetime-local" name="categories[{{ $child->id }}][expires_at]" class="form-control">
				        		            </td>
				        		        </tr>
						        	@endforeach
						        @endif
						    @endforeach
						    <tr>
						    	<td colspan="4">
						    		<div class="text-center py-2">
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
