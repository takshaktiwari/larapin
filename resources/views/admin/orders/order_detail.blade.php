@extends('layouts.admin')

@section('styles')
	@parent
	<style>
		.order_product img{
			max-height: 100px;
		}
		.order_product:last-child{
			margin-bottom: 0px!important;
		}
		.delivery_segment .segment_left{
			font-size: 24px;
			max-width: 50px;
		}
		img.arrow-down{
			max-height: 40%;
			width: 45px;
		}
	</style>
@endsection

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Order: <b>#{{ sprintf('%08d', $order->id) }}</b></h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Orders</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	                <li class="breadcrumb-item active">Detail</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
    	            <a href="{{ url('admin/orders') }}" class="btn btn-primary">All Orders</a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

		@can('order_show')
		<div class="row">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0">Order Summary</h5>
					</div>
					<div class="card-body">
						<h5 class="d-flex">
							<span class="flex-fill">Order:</span> 
							<span class="font-weight-normal">
								#{{ sprintf('%08d', $order->id) }}
							</span>
						</h5>
						<h5 class="d-flex">
							<span class="flex-fill">Products: </span>
							<span class="font-weight-normal">
								{{ $order->order_products->count() }}
								Item
							</span>
						</h5>
						<h5 class="d-flex">
							<span class="flex-fill">Subtotal: </span>
							<span class="font-weight-normal">
								<i class="fas fa-rupee-sign"></i>
								{{ number_format($order->subtotal_price, 2) }}
							</span>
						</h5>
						<h5 class="d-flex">
							<span class="flex-fill">Discount: </span>
							<span class="font-weight-normal">
								<i class="fas fa-rupee-sign"></i>
								{{ number_format($order->discount_price, 2) }}
							</span>
						</h5>
						<h5 class="d-flex">
							<span class="flex-fill">Shipping: </span>
							<span class="font-weight-normal">
								<i class="fas fa-rupee-sign"></i>
								{{ number_format($order->shipping_charge, 2) }}
							</span>
						</h5>
						<h5 class="d-flex">
							<span class="flex-fill">Total Amt: </span>
							<span class="font-weight-normal">
								<i class="fas fa-rupee-sign"></i>
								{{ number_format($order->subtotal_price+$order->subtotal_price-$order->discount_price, 2) }}
							</span>
						</h5>
						<h5 class="d-flex">
							<span class="flex-fill">Payment: </span>
							<span class="font-weight-normal">
								<span class="badge badge-success">
									{{ $order->payment_method }}
								</span>
								@if($order->payment_status)
									Paid
								@else
									Pending
								@endif
							</span>
						</h5>
						<h5 class="d-flex mb-0">
							<span class="flex-fill">Order Status: </span>
							<span class="font-weight-normal">
								{{ $order->order_status }}
							</span>
						</h5>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0">Shipping Address</h5>
					</div>
					<div class="card-body">
						<h5 class="mb-1">{{ $order->addr_name }}</h5>
						<h5 class="mb-2">{{ $order->addr_mobile }}</h5>
						<div class="mb-2">
							{{ $order->addr_landmark }} <br>
							{{ $order->addr_line1 }} <br>
							@if(!empty($order->addr_line2))
								{{ $order->addr_line2 }} <br>
							@endif
							{{ $order->addr_location }}, 
							{{ $order->addr_district }} <br>
							{{ $order->addr_state }},
							{{ $order->addr_country }}
							<b>[{{ $order->addr_pincode }}]</b>
						</div>
						<h5 class="mb-0">
							<span class="">Delivery On: </span>
							<span class="color-theme ml-2">
								{{ date('h:i A', strtotime($order->shipping_slot->time_from)) }}
								<span class="text-dark px-1">-</span>
								{{ date('h:i A', strtotime($order->shipping_slot->time_to)) }}
							</span>
						</h5>
					</div>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<h5 class="mb-0">Products</h5>
			</div>
			<div class="card-body">
				@foreach($order->order_products as $order_product)
					<div class="order_product d-sm-flex mb-4 text-center text-sm-left">
						<div class="">
							<img src="{{ url('storage'.$order_product->image_sm) }}" alt="" class="img-thumbnail">
						</div>
						<div class="my-auto px-sm-3 px-0">
							<div class="mb-1 font-size-16">
								<a href="{{ url('product/'.$order_product->slug) }}" target="_blank">
									{{ $order_product->product_name }}
								</a>
							
								@foreach($order_product->order_product_attrs as $attribute)
									<span class="bg-warning small rounded px-2 mr-1 text-dark font-weight-bold">
										{{ $attribute->attr_option }}
									</span>
								@endforeach
							</div>
							@if($order_product->product->reviews->count() > 0)
								<div class="review mb-2">
									<span class="btn btn-success btn-sm font-weight-bold px-2 py-0 mr-2">
										{{ number_format($order_product->product->reviews->avg('rating'), 1) }} <i class="fas fa-star"></i>
									</span>
									<span class="small">
										( {{ $order_product->product->reviews->count() }} Reviews )
									</span>
								</div>
							@endif
							<h5 class="mb-0">
								<span class="color-theme">
									<i class="fas fa-rupee-sign"></i>
									{{ number_format(product_sale_price($order_product->product), 2) }}
								</span>
								<span class="font-weight-normal px-2">
									<i class="fas fa-times"></i>
								</span>
								<span>
									{{ $order_product->quantity }}
								</span>
							</h5>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		@endcan
		
		@can('order_status_access')
		<div class="row">
			<div class="col-md-7">
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0">Order Status</h5>
					</div>
					<div class="card-body delivery_segment">
						@foreach($order->order_histories as $history)

						<div class="segment d-flex">
							<div class="text-center text-warning segment_left">
								<i class="fas fa-dot-circle"></i>
								<img src="{{ url('assets/arrow-down.png') }}" alt="" class="arrow-down">
							</div>

							<div class="segment_body pl-3">
								<h5 class="mb-1">{{ ucfirst($history->order_status) }}</h5>
								<div class="small text-danger">
									<b>{{ $history->user->name }}: </b> 
									{{ date('d-M-Y h:i A', strtotime($history->created_at)) }}
								</div>
								<p class="mt-1">{{ $history->description }}</p>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-md-5">
				@can('order_status_update')
				<div class="card">
					<div class="card-header">
						<h5 class="mb-0">Update Status</h5>
					</div>
					<div class="card-body">
						<form action="{{ url('admin/order/history/create') }}" method="POST">
							@csrf
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Order <span class="text-danger">*</span></label>
										<select name="order_status" id="" class="form-control">
											<option value="">-- Order Status --</option>
											<option value="pending" 
													{{ selected('pending', $order->order_status) }} >
												Pending
											</option>
											<option value="in_process" 
													{{ selected('in_process', $order->order_status) }} >
												In Process
											</option>
											<option value="in_transit" 
													{{ selected('in_transit', $order->order_status) }} >
												In Transit
											</option>
											<option value="delivered" 
													{{ selected('delivered', $order->order_status) }} >
												Delivered
											</option>
											<option value="cancelled" 
													{{ selected('cancelled', $order->order_status) }} >
												Cancelled
											</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Payment <span class="text-danger">*</span></label>
										<select name="payment_status" id="" class="form-control">
											<option value="">-- Payment Status --</option>
											<option value="0" 
													{{ selected('0', $order->payment_status) }} >
												Pending
											</option>
											<option value="1" 
													{{ selected('1', $order->payment_status) }} >
												Confirmed
											</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="">Description <span class="text-danger">*</span></label>
								<textarea name="description" rows="5" class="form-control" maxlength="500"></textarea>
							</div>
							<input type="hidden" name="order_id" value="{{ $order->id }}">
							<input type="submit" class="btn btn-success px-4" value="Update">
						</form>
					</div>
				</div>
				@endcan
			</div>
		</div>
		@endcan
		
	

    </div> <!-- container-fluid -->
@endsection
