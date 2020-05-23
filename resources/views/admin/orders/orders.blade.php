@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
    	<!-- start page title -->
    	<div class="row align-items-center">
    	    <div class="col-sm-6">
    	        <div class="page-title-box">
    	            <h4 class="font-size-18">Orders</h4>
    	            <ol class="breadcrumb mb-0">
    	                <li class="breadcrumb-item">
    	                	<a href="javascript: void(0);">Orders</a>
    	                </li>
    	                <li class="breadcrumb-item active">Lists</li>
    	            </ol>
    	        </div>
    	    </div>

    	    <div class="col-sm-6">
    	        <div class="float-right d-none d-md-block">
	            	<a class="btn border font-weight-bold" data-toggle="collapse" data-target="#filter">
	                	<i class="fas fa-sliders-h"></i>
	                	Filter
	                </a>
    	        </div>
    	    </div>
    	</div>
    	<!-- end page title -->

    	<div class="card collapse" id="filter">
    		<div class="card-body">
    			<form action="">
    				<div class="row">
    					<div class="col-12 col-md-4">
    						<input type="text" name="search" class="form-control mb-2" placeholder="Search" value="{{ Request::get('search') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<select name="order_status" id="" class="form-control mb-2">
    							<option value="">-- Order Status --</option>
								<option value="pending" 
										{{ selected('pending', Request::get('order_status')) }} >
									Pending
								</option>
								<option value="in_process" 
										{{ selected('in_process', Request::get('order_status')) }} >
									In Process
								</option>
								<option value="in_transit" 
										{{ selected('in_transit', Request::get('order_status')) }} >
									In Transit
								</option>
								<option value="delivered" 
										{{ selected('delivered', Request::get('order_status')) }} >
									Delivered
								</option>
								<option value="cancelled" 
										{{ selected('cancelled', Request::get('order_status')) }} >
									Cancelled
								</option>
    						</select>
    					</div>
						<div class="col-6 col-md-2">
							<select name="payment_status" id="" class="form-control mb-2">
								<option value="">-- Payment Status --</option>
								<option value="0" 
										{{ selected('0', Request::get('payment_status')) }} >
									Pending
								</option>
								<option value="1" 
										{{ selected('1', Request::get('payment_status')) }} >
									Confirmed
								</option>
							</select>
						</div>
						<div class="col-12 col-md-2">
							<select name="payment_method" id="" class="form-control mb-2">
								<option value="">-- Payment method --</option>
								<option value="cod" 
										{{ selected('0', Request::get('payment_method')) }} >
									COD
								</option>
								<option value="online" 
										{{ selected('1', Request::get('payment_method')) }} >
									Online
								</option>
							</select>
						</div>
    					<div class="col-6 col-md-2">
    						<input type="text" name="min_amount" class="form-control mb-2" placeholder="Min amount" value="{{ Request::get('min_amount') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<input type="text" name="max_amount" class="form-control mb-2" placeholder="Max amount" value="{{ Request::get('max_amount') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<input type="text" name="min_discount" class="form-control mb-2" placeholder="Min discount" value="{{ Request::get('min_discount') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<input type="text" name="max_discount" class="form-control mb-2" placeholder="Max discount" value="{{ Request::get('max_discount') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<input type="text" name="min_products" class="form-control mb-2" placeholder="Min products" value="{{ Request::get('min_products') }}">
    					</div>
    					<div class="col-6 col-md-2">
    						<input type="text" name="max_products" class="form-control mb-2" placeholder="Max products" value="{{ Request::get('max_products') }}">
    					</div>
    					<div class="col-12 col-md-2">
    						<input type="text" name="pincode" class="form-control mb-2" placeholder="Pincode" value="{{ Request::get('pincode') }}">
    					</div>
    					
						<div class="col-12 col-md-2">
							<input type="submit" class="btn btn-success px-3">
							<a href="{{ url('admin/orders') }}" class="btn btn-danger">
								<i class="fas fa-times"></i>
							</a>
						</div>
    				</div>
    			</form>
    		</div>
    	</div>

		<div class="card">
			<div class="card-body">
				<table class="table table-bordered">
				    <thead>
					    <tr>
					        <th>#</th>
					        <th>Order</th>
					        <th>Price</th>
					        <th>Shipping To</th>
					        <th>Status</th>
					        <th>Action</th>
					    </tr>
				    </thead>


				    <tbody>
					    @foreach($orders as $key => $order)
					    	<tr>
					        	<td> {{ $key+1 }}</td>
					            <td>
					            	<div>#{{ sprintf('%08d', $order->id) }}</div>
					            	<b>Items: </b>{{ $order->order_products->count() }}
					            </td>
					            <td>
					            	<div>
					            		<i class="fas fa-rupee-sign"></i>
					            		{{ number_format($order->subtotal_price + $order->shipping_charge - $order->discount_price, 2) }}
					            	</div>
					            	<div class="badge badge-success">{{ strtoupper($order->payment_method) }}</div>
					            	<div class="badge badge-success">
					            		@if($order->payment_status == '0')
					            			Pending
					            		@else
					            			Confirmed
					            		@endif
					            	</div>
					            </td>
					            <td>
					            	{{ $order->addr_name }}
					            	<div>{{ $order->addr_mobile }}</div>
					            </td>
					            <td>
					            	<div><b>Order: </b>{{ ucfirst($order->order_status) }}</div>
					            	<div class="font-weight-bold text-primary">
					            		[ {{ $order->addr_pincode }} ]
					            	</div>
					            </td>
					            <td class="font-size-20">
					            	@can('order_show')
				                    <a href="{{ url('admin/order/detail/'.$order->id) }}" class="btn btn-sm btn-info" title="View Details" >
				                        <i class="fas fa-info-circle"></i>
				                        Detail
				                    </a>
				                    @endcan

				                    @can('order_delete')
				                    <a href="{{ url('admin/order/delete/'.$order->id) }}" class="btn btn-sm btn-danger" title="Delete Order" onclick="return confirm('Are you sure to delete')">
				                        <i class="fas fa-trash"></i>
				                    </a>
				                    @endcan
				                    
				                    <div class="font-size-14">
				                    	<span class="small">
				                    		{{ date('d-M-Y H:i A', strtotime($order->created_at)) }}
				                    	</span>
				                    </div>
					            </td>
					        </tr>
					    @endforeach
				    </tbody>
				</table>

				{{ $orders->appends([
									'search' 		=> 	Request::get('search'),
									'order_status'	=>	Request::get('order_status'),
									'payment_status'=>	Request::get('payment_status'),
									'payment_method'=>	Request::get('payment_method'),
									'min_amount'	=>	Request::get('min_amount'),
									'max_amount'	=>	Request::get('max_amount'),
									'min_discount'	=>	Request::get('min_discount'),
									'max_discount'	=>	Request::get('max_discount'),
									'min_products'	=>	Request::get('min_products'),
									'max_products'	=>	Request::get('max_products'),
									'pincode'		=>	Request::get('pincode'),
								])->links() }}
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
