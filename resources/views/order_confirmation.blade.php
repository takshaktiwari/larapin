@extends('layouts.app')

@section('styles')
	@parent
	<style>
		.order_product .product_image{
			max-height: 100px;
		}
	</style>
@endsection

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.png') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">Order Confirmation</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ url('checkout') }}">Checkout</a></li>
						<li class="breadcrumb-item active" aria-current="page">Confirm</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="cart-page mt-70 rmt-80 mb-70 rmb-80	">
		<div class="container">
			<div class="row col-gap-60">
				<div class="col-md-8">
					<div class="cart-total-product rmb-80 b1 br-5 p-50">
						<h4 class="cart-heading">Your Order Is Placed</h4>

						@foreach($order->order_products as $product)
							<div class="d-sm-flex d-block text-center text-sm-left order_product mb-20">
								<div>
									<img src="{{ url('storage'.$product->image_sm) }}" alt="{{ $product->product_name }}" class="product_image img-thumbnail">
								</div>
								<div class="my-auto px-sm-3 px-0">
									<h6 class="mb-2">
										<a href="{{ url('product/'.$product->slug) }}">
											{{ $product->product_name }}
										</a>
									</h6>
									<h5 class="">
										<b class="color-theme">
											<i class="fas fa-rupee-sign"></i>
											{{ number_format($product->product_price, 2) }}
										</b>
										<span class="px-2 font-weight-normal">
											<i class="fas fa-times"></i>
										</span>
										<span>
											{{ $product->quantity }}
										</span>
									</h5>
								</div>
							</div>
						@endforeach
						<div class="custom-control">
							<div class="d-sm-flex mb-2">
								<h5 class="my-auto flex-fill font-weight-normal">
									Subtotal: 
								</h5>
								<h4 class="my-auto color-theme">
									<i class="fas fa-rupee-sign"></i>
									{{ number_format($order->subtotal_price, 2) }}
								</h4>
							</div>
							<div class="d-sm-flex mb-2">
								<h5 class="my-auto flex-fill font-weight-normal">
									Shipping: 
								</h5>
								<h4 class="my-auto color-theme">
									<i class="fas fa-rupee-sign"></i>
									{{ number_format($order->shipping_charge, 2) }}
								</h4>
							</div>
							<div class="d-sm-flex mb-0">
								<h5 class="my-auto flex-fill font-weight-normal">
									Discount: 
								</h5>
								<h4 class="my-auto color-theme">
									<i class="fas fa-rupee-sign"></i>
									{{ number_format($order->discount_price, 2) }}
								</h4>
							</div>
						</div>
						<div class="custom-control">
							<div class="d-sm-flex">
								<h4 class="my-auto flex-fill font-weight-normal">
									Total Amount: 
								</h4>
								<h4 class="my-auto color-theme">
									<i class="fas fa-rupee-sign"></i>
									{{ number_format(($order->subtotal_price + $order->shipping_charge) - $order->discount_price, 2) }}
								</h4>
							</div>
						</div>
						<div class="text-center">
							<a href="{{ url('shop') }}" class="theme-btn">
								Continue Shopping
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<img src="{{ url('assets/delivery-box.png') }}" alt="" class="w-100">
				</div>
			</div>
		</div>
	</section>
@endsection

