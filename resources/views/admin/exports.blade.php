@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Exports</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Exports</a>
    	                </li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	        	<a href="{{ url('admin/export/products') }}" class="btn btn-success">Export Products</a>
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
					        <th>Exported File</th>
					        <th>Modified Date</th>
					        <th>Size</th>
					        <th>Action</th>
					    </tr>
				    </thead>
				    <tbody>
				    	@foreach($files as $key => $file)
				    		<tr>
				    			<td>{{ $key+1 }}</td>
				    			<td>{{ basename($file) }}</td>
				    			<td>{{ gmdate('d-M-Y h:i A', Storage::lastModified($file)) }}</td>
				    			<td>{{ ceil(Storage::size($file) / 1000).'KB' }}</td>
				    			<td>
				    				<a href="{{ url('admin/export/download?file='.$file) }}" class="btn btn-sm btn-success" title="Delete This">
				    				    <i class="fas fa-download"></i>
				    				</a>
				    				<a href="{{ url('admin/export/delete?file='.$file) }}" class="btn btn-sm btn-danger" title="Delete This">
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
