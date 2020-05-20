@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Shipping Charge</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Shipping </a>
    	                </li>
    	                <li class="breadcrumb-item active">Charge</li>
    	            </ol>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		<div class="card">
			<div class="card-header">
				<h5 class="m-0">Shipping Type</h5>
			</div>
			<div class="card-body">
				<form action="{{ url('admin/shipping_type/update') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="custom-control custom-radio border py-4 px-5 rounded mb-3">
							    <input type="radio" class="custom-control-input" id="input1" name="shipping_type" value="1" required="" {{ checked($shipping_type->type, '1') }}>
							    <label class="custom-control-label" for="input1">Global Shipping</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="custom-control custom-radio border py-4 px-5 rounded ">
							    <input type="radio" class="custom-control-input" id="input2" name="shipping_type" value="2" required="" {{ checked($shipping_type->type, '2') }}>
							    <label class="custom-control-label" for="input2">Dynamic Shipping</label>
							</div>
						</div>
					</div>
					<input type="submit" class="btn btn-primary px-4">
				</form>
			</div>
		</div>
		
		@if($shipping_type->type == '1')
		<div class="card">
			<div class="card-header">
				<h5 class="m-0">
					Global Shipping
					<a href="" data-toggle="collapse" data-target="#add_shipping_block" class="btn btn-success btn-sm px-3 ml-3">+ Create New</a>
				</h5>
			</div>
			<div class="card-body">

				<form action="{{ url('admin/shipping_global/update') }}" method="POST">
					@csrf
					@foreach($shipping_global as $segment)
					<div class="row">
						<div class="col-md-3 col-6">
							<div class="form-group">
								<input type="text" name="title" class="form-control" placeholder="Name" value="{{ $segment->title }}" >
							</div>
						</div>
						<div class="col-md-2 col-6">
							<div class="form-group">
								<input type="number" name="min_value" class="form-control" placeholder="Min Amt." value="{{ $segment->min_value }}" >
							</div>
						</div>
						<div class="col-md-2 col-6">
							<div class="form-group">
								<input type="number" name="max_value" class="form-control" placeholder="Max Amt." value="{{ $segment->max_value }}" >
							</div>
						</div>
						<div class="col-md-3 col-6">
							<div class="form-group">
								<input type="number" name="charge" class="form-control" placeholder="Shipping Charge" value="{{ $segment->charge }}" >
							</div>
						</div>
						<div class="col-md-2 col-6">
							<a href="{{ url('admin/shipping_global/delete/'.$segment->id) }}" class="btn btn-danger">
								<i class="fas fa-trash"></i>
								Delete
							</a>
						</div>
					</div>
					@endforeach

					<div class="row pt-3 border-top collapse" id="add_shipping_block">
						<div class="col-md-3 col-6">
							<div class="form-group">
								<input type="text" name="shipping_global[new][title]" class="form-control" placeholder="Name" value="" >
							</div>
						</div>
						<div class="col-md-2 col-6">
							<div class="form-group">
								<input type="number" name="shipping_global[new][min_value]" class="form-control" placeholder="Min Amt." value="" >
							</div>
						</div>
						<div class="col-md-2 col-6">
							<div class="form-group">
								<input type="number" name="shipping_global[new][max_value]" class="form-control" placeholder="Max Amt." value="" >
							</div>
						</div>
						<div class="col-md-3 col-6">
							<div class="form-group">
								<input type="number" name="shipping_global[new][charge]" class="form-control" placeholder="Shipping Charge" value="" >
							</div>
						</div>
						<div class="col-md-2 col-6"></div>
					</div>

					<input type="submit" class="btn btn-primary px-4" value="Update">
				</form>
			</div>
		</div>
		@endif
		
		@if($shipping_type->type == '2')
		<div class="card">
			<div class="card-header">
				<h5 class="m-0">Dynamic Shipping</h5>
			</div>
			<div class="card-body">
				<form action="{{ url('admin/shipping_charge/update') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="min_charge" class="form-control" required placeholder="Min. Shipping Charge" value="" >
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="max_charge" class="form-control" required placeholder="Max. Shipping Charge" value="" >
							</div>
						</div>
						<div class="col-md-4">
							<input type="submit" class="btn btn-primary px-4">
						</div>
					</div>
				</form>
			</div>
		</div>
		@endif

    </div> <!-- container-fluid -->
@endsection
