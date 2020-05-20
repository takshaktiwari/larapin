@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Slider</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Slider</a>
    	                </li>
    	                <li class="breadcrumb-item active">Slides</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	        	@can('slider_create')
    	            <a href="{{ url('admin/slide/create') }}" class="btn btn-primary">+ Create New</a>
    	            @endcan
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
					    @foreach($slides as $key => $slide)
					        <tr>
					        	<td>{{ $key+1 }}</td>
					        	<td>
					        		<img src="{{ url('storage'.$slide->image_sm) }}" alt="" style="max-height: 100px;">
					        	</td>
					            <td>
					                {{ $slide->title }}
					                <div class="small">{{ $slide->caption }}</div>
					                <div class="text-secondary mt-1">
					                	<b class="mr-2">Status:</b> 
					                	@if($slide->status == '0')
					                		In-Active
					                	@elseif($slide->status == '1')
					                		Active
					                	@endif

					                	<br>
					                	<b class="mr-2">Set Order:</b> {{ $slide->set_order }}
					                </div>
					            </td>
					            <td class="font-size-20">
					            	@can('slider_update')
				                    <a href="{{ url('admin/slide/edit/'.$slide->id) }}" class="btn btn-sm btn-success" title="Edit this">
				                        <i class="fas fa-edit"></i>
				                    </a>
				                    @endcan
									
									@can('slider_delete')
				                    <a href="{{ url('admin/slide/delete/'.$slide->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
				                        <i class="fas fa-trash"></i>
				                    </a>
				                    @endcan
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
