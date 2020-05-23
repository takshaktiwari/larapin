@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Brands</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Brands</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	        	<a class="btn border font-weight-bold" data-toggle="collapse" data-target="#filter">
    	            	<i class="fas fa-sliders-h"></i>
    	            	Filter
    	            </a>
    	        	@can('brand_create')
    	            <a href="{{ url('admin/brand/create') }}" class="btn btn-primary">+ Create New</a>
    	            @endcan
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

    	<div class="card collapse" id="filter">
    		<div class="card-body">
    			<form action="">
    				<div class="row">
    					<div class="col-8 col-md-9">
    						<input type="text" name="search" class="form-control mb-sm-0 mb-0" placeholder="Search" value="{{ Request::get('search') }}">
    					</div>
						<div class="col-4 col-md-3">
							<input type="submit" class="btn btn-success px-3">
							<a href="{{ url('admin/brands') }}" class="btn btn-basic border">
								<i class="fas fa-times"></i>
							</a>
						</div>
    				</div>
    			</form>
    		</div>
    	</div>


		<div class="card">
			<div class="card-body">
				<table id="datatable" class="table table-bordered">
				    <thead>
					    <tr>
					        <th>#</th>
					        <th>Brand</th>
					        <th>Action</th>
					    </tr>
				    </thead>


				    <tbody>
					    @foreach($brands as $key => $brand)
					        <tr>
					        	<td>{{ $key+1 }}</td>
					            <td>
					                {{ $brand->brand }}
					            </td>
					            <td class="font-size-20">
					            	@can('brand_update')
				                    <a href="{{ url('admin/brand/edit/'.$brand->id) }}" class="btn btn-sm btn-success" title="Edit this">
				                        <i class="fas fa-edit"></i>
				                    </a>
				                    @endcan
									
									@can('brand_delete')
				                    <a href="{{ url('admin/brand/delete/'.$brand->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
				                        <i class="fas fa-trash"></i>
				                    </a>
				                    @endcan
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

				{{ $brands->links() }}
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
