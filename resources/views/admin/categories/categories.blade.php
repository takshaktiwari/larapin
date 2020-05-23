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
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block" >
    	            <a class="btn border font-weight-bold" data-toggle="collapse" data-target="#filter">
    	            	<i class="fas fa-sliders-h"></i>
    	            	Filter
    	            </a>
    	            @can('category_create')
    	            <a href="{{ url('admin/category/create') }}" class="btn btn-primary">+ Create New</a>
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
    						<input type="text" name="search" class="form-control mb-sm-0 mb-2" placeholder="Search" value="{{ Request::get('search') }}">
    					</div>
    					<div class="col-12 col-md-3">
    						<select name="parent" id="" class="form-control mb-sm-0 mb-2">
    							<option value="">Parent Category</option>
    							@foreach($categories as $category)
    								<option value="{{ $category->id }}" {{ selected(Request::get('parent'), $category->id) }}>
    									{{ $category->category }}
    								</option>
    							@endforeach
    						</select>
    					</div>
    					<div class="col-6 col-md-2">
    						<select name="status" id="" class="form-control mb-sm-0 mb-2">
    							<option value="">-- Select --</option>
    							<option value="1" {{ selected(Request::get('status'), '1') }} >Active</option>
    							<option value="0" {{ selected(Request::get('status'), '0') }} >In-Active</option>
    						</select>
    					</div>
						<div class="col-6 col-md-2">
							<select name="featured" id="" class="form-control mb-sm-0 mb-2">
								<option value="">-- Select --</option>
								<option value="1" {{ selected(Request::get('featured'), '1') }} >Featured</option>
								<option value="0" {{ selected(Request::get('featured'), '0') }} >Not-Featured</option>
							</select>
						</div>
						<div class="col-12 col-md-2">
							<input type="submit" class="btn btn-success px-3">
							<a href="{{ url('admin/categories') }}" class="btn btn-basic border">
								<i class="fas fa-times"></i>
							</a>
						</div>
    				</div>
    			</form>
    		</div>
    	</div>

		<div class="card">
			<div class="card-body table-responsive">
				<table class="table table-bordered">
				    <thead>
					    <tr>
					        <th>Image</th>
					        <th>Category</th>
					        <th>Parent</th>
					        <th>Featured</th>
					        <th>Status</th>
					        <th>Action</th>
					    </tr>
				    </thead>
				    <tbody>
					    @foreach($categories as $category)
					        <tr>
					            <td>
					                <img src="{{ url('storage/'.$category->image_sm) }}" alt="" style="max-height: 60px;">
					            </td>
					            <td>
					                {{ $category->category }}
					                <div class="small text-danger">
					                    {{ date('d-M-Y h:i A', strtotime($category->created_at)) }}
					                </div>
					            </td>
					            <td>
					                @isset($category->parent_category->category)
					                    {{ $category->parent_category->category }}
					                @endisset
					            </td>
					            <td>
					                @if($category->featured == '1')
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
					                @if($category->status == '1')
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
					            	@can('category_location')
					            	<a href="{{ url('admin/category/'.$category->id.'/countries') }}" class="btn btn-sm btn-secondary" title="Category Locations">
					            	    <i class="fas fa-map-marker-alt"></i>
					            	</a>
					            	@endcan
					            	@can('category_attributes')
					            	<a href="{{ url('admin/category/attributes/'.$category->id) }}" class="btn btn-sm btn-dark" title="category Attributes">
					            	    <i class="fas fa-bezier-curve"></i>
					            	</a>
					            	@endcan
					            	@can('category_update')
				                    <a href="{{ url('admin/category/edit/'.$category->id) }}" class="btn btn-sm btn-danger" title="Edit this">
				                        <i class="fas fa-edit"></i>
				                    </a>
				                    @endcan
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

				{{ $categories->links() }}
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
