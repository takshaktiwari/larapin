@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Pincodes</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Pincodes</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	        	@can('pincode_create')
    	            <a href="{{ url('admin/pincode/create') }}" class="btn btn-primary">+ Create New</a>
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
					        <th>PinCode</th>
					        <th>District</th>
					        <th>State</th>
					        <th>Country</th>
					        <th>Action</th>
					    </tr>
				    </thead>


				    <tbody>
					    @foreach($pincodes as $key => $pincode)
					    	<tr>
					        	<td>{{ $key+1 }}</td>
					            <td> {{ $pincode->pincode }} </td>
					            <td> {{ $pincode->district->district }} </td>
					            <td> 
					            	@if(!empty($pincode->state->state))
					            		{{ $pincode->state->state }} 
					            	@endif
					            </td>
					            <td>
					            	@if(!empty($pincode->country->country))
					            		{{ $pincode->country->country }}
					            	@endif
					            </td>
					            <td class="font-size-20">
									@can('pincode_update')
				                    <a href="{{ url('admin/pincode/edit/'.$pincode->id) }}" class="btn btn-sm btn-success" title="Edit this">
				                        <i class="fas fa-edit"></i>
				                    </a>
				                    @endcan
									
									@can('pincode_delete')
				                    <a href="{{ url('admin/pincode/delete/'.$pincode->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
				                        <i class="fas fa-trash"></i>
				                    </a>
				                    @endcan
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

				{{ $pincodes->links() }}
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
