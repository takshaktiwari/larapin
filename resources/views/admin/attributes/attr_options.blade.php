@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Attribute Options</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Attributes</a>
    	                </li>
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Options</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/attr_option/create') }}" class="btn btn-primary">+ Create New</a>
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
					        <th>Option</th>
					        <th>Action</th>
					    </tr>
				    </thead>
				    <tbody>
					    @foreach($attr_options as $key => $attr_option)
					        <tr>
					        	<td>{{ $key+1 }}</td>
					            <td>{{ $attr_option->attr_option }}</td>
					            <td>{{ $attr_option->attribute->attribute }}</td>
					            <td class="font-size-20">
				                    <a href="{{ url('admin/attr_option/edit/'.$attr_option->id) }}" class="btn btn-sm btn-success" title="Edit this">
				                        <i class="fas fa-edit"></i>
				                    </a>

				                    <a href="{{ url('admin/attr_option/delete/'.$attr_option->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
				                        <i class="fas fa-trash"></i>
				                    </a>
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

				{{ $attr_options->links() }}
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
