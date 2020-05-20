@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Shipping Slots</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Shipping </a>
    	                </li>
    	                <li class="breadcrumb-item active">Slots</li>
    	            </ol>
    	        </div>
    	    </div>
    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/shipping_slot/create') }}" class="btn btn-primary">+ Create New</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-body table-responsive p-0">
				<table class="table mb-0">
					<thead>
						<th>#</th>
						<th>Slot From</th>
						<th>Slot To</th>
						<th>Period Name</th>
						<th>Action</th>
					</thead>
					<tbody>
						@foreach($shipping_slots as $key => $slot)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td>{{ date('h:i A', strtotime($slot->time_from)) }}</td>
								<td>{{ date('h:i A', strtotime($slot->time_to)) }}</td>
								<td>{{ $slot->time_period }}</td>
								<td>
									<a href="{{ url('admin/shipping_slot/edit/'.$slot->id) }}" class="btn btn-sm btn-success" title="Edit this">
									    <i class="fas fa-edit"></i>
									</a>

									<a href="{{ url('admin/shipping_slot/delete/'.$slot->id) }}" class="btn btn-sm btn-danger" title="Delete this" onclick="return confirm('Are you sure to delete ?')">
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
