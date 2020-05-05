@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Pages</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Pages</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/page/create') }}" class="btn btn-primary">+ Create New</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body">
				<table id="datatable" class="table table-bordered">
				    <thead>
					    <tr>
					        <th>#</th>
					        <th>Image</th>
					        <th>Title</th>
					        <th>Action</th>
					    </tr>
				    </thead>


				    <tbody>
					    @foreach($pages as $key => $page)
					        <tr>
					        	<td>{{ $key+1 }}</td>
					        	<td>
					        		<img src="{{ url('storage'.$page->image_sm) }}" alt="" style="max-height: 60px;">
					        	</td>
					            <td>{{ $page->title }}</td>
					            <td class="font-size-20">
				                    <a href="{{ url('admin/page/edit/'.$page->id) }}" class="btn btn-sm btn-success" title="Edit this">
				                        <i class="fas fa-edit"></i>
				                    </a>

				                    <a href="{{ url('admin/page/delete/'.$page->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
				                        <i class="fas fa-trash"></i>
				                    </a>
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
