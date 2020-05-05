@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">User Addresses</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Users</a>
    	                </li>
    	                <li class="breadcrumb-item active">{{ $user->name }}</li>
    	                <li class="breadcrumb-item active">Addresses</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/user/'.$user->id.'/address/create') }}" class="btn btn-primary">+ Create Address</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->
		
		<div class="row">
			<div class="col-md-6">
				<div class="card bg-tansparent">
					<div class="card-header">
						<h3>Shipping Addresses</h3>
					</div>
					<div class="card-body p-0">
						@foreach($shipping_addrs as $addr)
							<div class="card">
								<div class="card-body d-sm-flex">
									<div class="flex-fill pr-sm-3">
										<p class="font-size-16 mb-0">
											<b>{{ $addr->name }}</b><br>
											<b>{{ $addr->mobile }}</b>
										</p>
										@php
											if(!empty($addr->email)){
												echo $addr->email.',<br>';
											}
											if(!empty($addr->landmark)){
												echo $addr->landmark.',<br>';
											}
											if(!empty($addr->line1)){
												echo $addr->line1.',<br>';
											}
											if(!empty($addr->line2)){
												echo $addr->line2.',<br>';
											}
											if(!empty($addr->location)){
												echo $addr->location->location.' <b class="ml-2">[';
												echo $addr->pincode.'] </b>, <br>';
												echo $addr->state->state.',<br>';
												echo $addr->country->country.'<br>';
											}
										@endphp
									</div>
									<div class="m-auto">
										@if($addr->default_addr == false)
										<a href="{{ url('admin/user/address/primary', $addr->id) }}" class="btn btn-warning">
											<i class="fas fa-check-double"></i>
										</a>
										@endif
										<a href="{{ url('admin/user/address/edit', $addr->id) }}" class="btn btn-success">
											<i class="fas fa-edit"></i>
										</a>
										<a href="{{ url('admin/user/address/delete', $addr->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete ?')">
											<i class="fas fa-trash"></i>
										</a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>

			</div>
			<div class="col-md-6">
				<div class="card bg-tansparent">
					<div class="card-header">
						<h3>Billing Addresses</h3>
					</div>
					<div class="card-body p-0">
						@foreach($billing_addrs as $addr)
							<div class="card">
								<div class="card-body d-sm-flex">
									<div class="flex-fill pr-sm-3">
										<p class="font-size-16 mb-0">
											<b>{{ $addr->name }}</b><br>
											<b>{{ $addr->mobile }}</b>
										</p>
										@php
											if(!empty($addr->email)){
												echo $addr->email.',<br>';
											}
											if(!empty($addr->landmark)){
												echo $addr->landmark.',<br>';
											}
											if(!empty($addr->line1)){
												echo $addr->line1.',<br>';
											}
											if(!empty($addr->line2)){
												echo $addr->line2.',<br>';
											}
											if(!empty($addr->location)){
												echo $addr->location->location.' <b class="ml-2">[';
												echo $addr->pincode.'] </b>, <br>';
												echo $addr->state->state.',<br>';
												echo $addr->country->country.'<br>';
											}
										@endphp
									</div>
									<div class="m-auto">
										@if($addr->default_addr == false)
										<a href="{{ url('admin/user/address/primary', $addr->id) }}" class="btn btn-warning">
											<i class="fas fa-check-double"></i>
										</a>
										@endif
										<a href="{{ url('admin/user/address/edit', $addr->id) }}" class="btn btn-success">
											<i class="fas fa-edit"></i>
										</a>
										<a href="{{ url('admin/user/address/delete', $addr->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete ?')">
											<i class="fas fa-trash"></i>
										</a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>

			</div>
		</div>
		

    </div> <!-- container-fluid -->
@endsection
