@extends('layouts.app')

@section('styles')
	@parent
	<style>
		.orders .product_image{
			max-height: 80px;
		}
	</style>
@endsection

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.webp') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">Dashboard</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ url('user/home') }}">Dashboard</a></li>
						<li class="breadcrumb-item active" aria-current="page">Orders</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="user_section py-75">
		<div class="container">
			<div class="row">
				<div class="col-md-3" id="wrapper">
					@include('user/user_navigation')
				</div>
					<!-- /#sidebar-wrapper -->
				
				<div class="col-md-9">
					<!-- Page Content -->
					<div id="page-content-wrapper">

						<div class="body-cntn">
							<div class="cart-total-product b1 br-5 p-25">
								<h4 class="cart-heading">My Orders</h4>

								<div class="orders pb-15">
									@foreach($orders as $order)
							    	<div class="d-sm-flex mb-35 text-sm-left text-center">
							    		<div class="d-flex flex-wrap text-center">
							    			@foreach($order->order_products->pluck('image_sm')->toArray() as $image)
							    			<div class="text-center m-auto">
							    				<img src="{{ url('storage'.$image) }}" alt="" class="product_image img-thumbnail">
							    			</div>
							    			@endforeach
							    		</div>
							    		<div class="my-auto px-sm-3 px-0">
							    			<h6 class="mb-1">
							    				<span class="mr-1">Order: </span>
							    				<span class="color-theme">
								    				{{ sprintf("%06d", $order->id) }}
								    			</span>
							    			</h6>
							    			<h6 class="mb-0">
							    				<span class="mr-1">Products: </span>
							    				<span class="color-theme">
								    				{{ $order->order_products->count() }}
								    				Items
								    			</span>
							    			</h6>
							    			<h6>
							    				<span class="mr-1">Total Amount: </span>
							    				<span class="color-theme">
							    					<i class="fas fa-rupee-sign"></i>
							    					{{ number_format(($order->subtotal_price + $order->shipping_charge) - $order->discount_price, 2) }}
							    				</span>
							    			</h6>
							    		</div>
							    		<div class="m-auto">
							    			<h5 class="text-center mb-2">{{ ucfirst($order->order_status) }}</h5>
							    			<a href="{{ url('user/order/'.$order->id) }}" class="theme-btn py-1">
							    				<i class="fas fa-info-circle"></i>
							    				Details
							    			</a>
							    		</div>
							    	</div>
								    @endforeach
								</div>
								
								{{ $orders->links() }}

							</div>		        
						</div>
								
					</div>
					<!-- /#page-content-wrapper -->

				</div>
			</div>
		</div>
	</section>
@endsection