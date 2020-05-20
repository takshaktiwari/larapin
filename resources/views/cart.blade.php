@extends('layouts.app')

@section('styles')
	@parent
	<style>
		.cart-page .product-name{
			font-size: 15px;
			line-height: 20px;
		}
	</style>
@endsection

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.png') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">My Cart</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Cart</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="cart-page mt-70 rmt-80 mb-70 rmb-80">
		<div class="container">
			<div class="row col-gap-60">
				<div class="col-xl-8">
					<div class="cart-total-product rmb-80 b1 br-5 p-50">
						<h4 class="cart-heading">Shopping Cart</h4>

						@if(empty(session('cart', array())))
							<h2 class="mb-4">Cart is Empty</h2>
							<a href="{{ url('shop') }}" class="theme-btn">
								Start Shopping
							</a>
						@else
							<form action="{{ url('cart/update') }}" method="POST">
								@csrf
								<div class="cart-title d-none d-md-flex">
									<h5 class="product-title">Product</h5>
									<h5 class="quantity-title">Quantity</h5>
									<h5 class="price-title">Price</h5>
									<h5 class="total-title">Total</h5>
								</div>
								<div class="cart-items pb-15">
									@php
										$total_price = 0;
									@endphp
									@foreach(session('cart', array()) as $cart_item)
										@php
											$total_price += $cart_item['product_price'] * $cart_item['quantity'];
										@endphp
										<input type="hidden" name="cart_items[{{ $cart_item['id'] }}][cart_id]" value="{{ $cart_item['id'] }}">
										<div class="cart-single-item">
											<a href="{{ url('cart/remove/'.$cart_item['id']) }}" class="close">
												<i class="flaticon-cross"></i>
											</a>
											<div class="product-img">
												<a href="{{ url('product/'.$cart_item['product']['slug']) }}">
													<img src="{{ url('storage'.$cart_item['image_sm']) }}" alt="Product Image">
												</a>
											</div>
											<h6 class="product-name">
												<a href="{{ url('product/'.$cart_item['product']['slug']) }}">
													{{ $cart_item['product']['product_name'] }}
												</a>
												@foreach($cart_item['cart_attributes'] as $cart_attr)
													<div class="badge badge-warning">
														{{ $cart_attr['attr_option'] }}
													</div>
												@endforeach
											</h6>
											<div class="number-input">
												<button type="button" class="minus"></button>
												<input class="quantity" min="{{ $cart_item['quantity'] }}" name="cart_items[{{ $cart_item['id'] }}][quantity]" value="{{ $cart_item['quantity'] }}" type="number">
												<button type="button" class="plus"></button>
											</div>
											<h6 class="product-price">
												<i class="fas fa-rupee-sign"></i>
												{{ number_format($cart_item['product_price'], 2) }}
											</h6>
											<h6 class="product-total-price">
												<i class="fas fa-rupee-sign"></i>
												{{ number_format(($cart_item['product_price'] * $cart_item['quantity']), 2) }}
											</h6>
										</div>
									@endforeach
								</div>
								<div class="row text-center text-lg-left">
									<div class="col-lg-5">
										<div class="continue-shopping">
											<a href="{{ url('shop') }}" class="theme-btn bg-success no-shadow br-5">Continue Shopping</a>
										</div>
									</div>
									<div class="col-lg-7">
										<div class="update-shopping text-lg-right">
											<button type="submit" class="theme-btn no-shadow style-two br-10 rmt-30">Update Cart</button>
										</div>
									</div>
								</div>
							</form>
						@endif
					</div>
				</div>
				<div class="col-xl-4 text-center">
					@if(empty(session('cart', array())))
						<img src="{{ url('assets/sad-boy.jpg') }}" alt="" style="max-height: 300px;">
					@else
						<div class="cart-total-price p-50">
							<h4 class="cart-heading">Order Summary</h4>
							<div class="total-item-wrap">
								<div class="total-item sub-total">
									<span class="title">
										Total Item {{ count(session('cart', array())) }}
									</span>
									<span class="price">
										<i class="fas fa-rupee-sign"></i>
										{{ number_format($total_price, 2) }}
									</span>
								</div>
								<div class="total-item shipping">
									<span class="title">Shipping Cost</span>
									<span class="price">
										<i class="fas fa-rupee-sign"></i> 
										{{ number_format($shipping_charge, 2) }}
									</span>
								</div>

								{{-- if coupon is enabled by admin --}}
								@if(get_setting('coupon') == 'enable')
								<form action="{{ url('cart/coupon_apply') }}" method="POST" class="d-lg-block">
									@csrf
									
									@php
										if(empty(session('coupon', array()))){
											$coupon_code = null;
										}else{
											$coupon_code = session('coupon')['coupon'];
										}
									@endphp
									<h6 class="mb-25 mt-30">Promo Code</h6>
									<input class="w-100 br-5" type="text" name="coupon_code" placeholder="Enter Discount Code" value="{{ $coupon_code }}" required="">
									<button class="theme-btn no-shadow bg-success br-5" id="coupon_submit" type="submit">Apply</button>
									@if($coupon_code)
										<span class="fload-right text-success">
											<b>!! Applied</b>
										</span>
									@endif
								</form>
								<div class="total-item discount" id="cart_discount">
									<span class="title">Discount</span>
									<span class="price">
										<i class="fas fa-rupee-sign"></i> 
										@php
											if(!empty($coupon_code)){
												$discount = session('coupon')['amount'];
												if(empty($discount)){
													$discount = $total_price * (session('coupon')['percent'] / 100);
												}
												$total_price -= $discount;
												echo number_format($discount, 2);
											}else{
												echo '0.00';
											}
										@endphp
									</span>
								</div>
								@endif
								
								<div class="total-item total">
									<span class="title mb-0">Total</span>
									<span class="price mb-0">
										<i class="fas fa-rupee-sign"></i> 
										{{ number_format($total_price + $shipping_charge, 2) }}
									</span>
								</div>
							</div>
							<div class="proceed-btn mt-30">
								<a href="{{ url('checkout') }}" class="theme-btn w-100 text-center br-10">Proceed Checkout</a>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</section>
@endsection

