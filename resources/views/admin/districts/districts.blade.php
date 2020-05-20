@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Districts</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Districts</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	        	@can('district_create')
    	            <a href="{{ url('admin/district/create') }}" class="btn btn-primary">+ Create New</a>
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
					        <th>District</th>
					        <th>State</th>
					        <th>Country</th>
					        <th>Action</th>
					    </tr>
				    </thead>


				    <tbody>
					    @foreach($districts as $key => $district)
					    	<tr>
					        	<td>{{ $key+1 }}</td>
					            <td> {{ $district->district }} </td>
					            <td> 
					            	@if(!empty($district->state->state))
					            		{{ $district->state->state }} 
					            	@endif
					            </td>
					            <td>
					            	@if(!empty($district->country->country))
					            		{{ $district->country->country }}
					            	@endif
					            </td>
					            <td class="font-size-20">
					            	@can('district_update')
				                    <a href="{{ url('admin/district/edit/'.$district->id) }}" class="btn btn-sm btn-success" title="Edit this">
				                        <i class="fas fa-edit"></i>
				                    </a>
				                    @endcan
									@can('district_delete')
				                    <a href="{{ url('admin/district/delete/'.$district->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
				                        <i class="fas fa-trash"></i>
				                    </a>
				                    @endcan
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

				{{ $districts->links() }}
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
