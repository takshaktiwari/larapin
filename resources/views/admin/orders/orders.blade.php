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

				{{ $orders->links() }}
			</div>
		</div>

    </div> <!-- container-fluid -->
@endsection
