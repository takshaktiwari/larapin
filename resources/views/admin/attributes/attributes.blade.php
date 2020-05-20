@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Attributes</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Attributes</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	        	@can('attribute_create')
    	            	<a href="{{ url('admin/attribute/create') }}" class="btn btn-primary">+ Create New</a>
    	            @endcan
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body table-responsive">
				<table class="table table-bordered" >
				    <thead>
					    <tr>
					        <th>#</th>
					        <th>Attribute</th>
					        <th>Action</th>
					    </tr>
				    </thead>


				    <tbody>
					    @foreach($attributes as $key => $attribute)
					        <tr>
					        	<td>{{ $key+1 }}</td>
					            <td>
					                {{ $attribute->attribute }}
					            </td>
					            <td class="font-size-20">
					            	@can('attribute_update')
				                    <a href="{{ url('admin/attribute/edit/'.$attribute->id) }}" class="btn btn-sm btn-success" title="Edit this">
				                        <i class="fas fa-edit"></i>
				                    </a>
				                    @endcan
									
									@can('attribute_delete')
				                    <a href="{{ url('admin/attribute/delete/'.$attribute->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
				                        <i class="fas fa-trash"></i>
				                    </a>
				                    @endcan
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

				{{ $attributes->links() }}
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
