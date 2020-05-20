@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Locations</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Locations</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	        	@can('location_create')
    	            <a href="{{ url('admin/location/create') }}" class="btn btn-primary">+ Create New</a>
    	            @endcan
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body">
				<table class="table table-bordered">
				    <thead>
					    <tr>
					        <th>#</th>
					        <th>Location</th>
					        <th>PinCode</th>
					        <th>District</th>
					        <th>State</th>
					        <th>Country</th>
					        <th>Action</th>
					    </tr>
				    </thead>


				    <tbody>
					    @foreach($locations as $key => $location)
					    	<tr>
					        	<td>{{ $key+1 }}</td>
					            <td> {{ $location->location }} </td>
					            <td> {{ $location->pincode->pincode }} </td>
					            <td> {{ $location->district->district }} </td>
					            <td> 
					            	@if(!empty($location->country->country))
					            		{{ $location->state->state }} 
					            	@endif
					            </td>
					            <td>
					            	@if(!empty($location->country->country))
					            		{{ $location->country->country }}
					            	@endif
					            </td>
					            <td class="font-size-20">
					            	@can('location_update')
				                    <a href="{{ url('admin/location/edit/'.$location->id) }}" class="btn btn-sm btn-success" title="Edit this">
				                        <i class="fas fa-edit"></i>
				                    </a>
				                    @endcan
									@can('location_delete')
				                    <a href="{{ url('admin/location/delete/'.$location->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
				                        <i class="fas fa-trash"></i>
				                    </a>
				                    @endcan
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

				{{ $locations->links() }}
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
