@extends('layouts.app')

@section('styles')
	@parent
	<style>
		.order_product img{
			max-height: 100px;
		}
		.order_product:last-child{
			margin-bottom: 0px;
		}
		.delivery_segment .segment_left{
			font-size: 24px;
			width: 50px;
		}
		img.arrow-down{
			max-height: 40%;

		}
	</style>
@endsection

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.png') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">Order Detail</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ url('user/home') }}">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="{{ url('user/orders') }}">Orders</a></li>
						<li class="breadcrumb-item active" aria-current="page">Detail</li>
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
								<h4 class="cart-heading">Order Detail</h4>

								<div class="row">
									<div class="col-md-6">
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
									</div>
									<div class="col-md-6">
										<h5 class="color-theme">Shipping To</h5>
										<h6 class="mb-1">{{ $order->addr_name }}</h6>
										<h6 class="mb-1">{{ $order->addr_mobile }}</h6>
										<div class="mb-1">
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
										<h6 class="mb-0">
											<span class="">Delivery On: </span>
											<span class="color-theme ml-2">
												{{ date('h:i A', strtotime($order->shipping_slot->time_from)) }}
												<span class="text-dark px-1">-</span>
												{{ date('h:i A', strtotime($order->shipping_slot->time_to)) }}
											</span>
										</h6>
									</div>
								</div>

							</div>
							<div class="cart-total-product b1 br-5 p-25 mt-20">
								@foreach($order->order_products as $order_product)
									<div class="order_product d-sm-flex mb-30 text-center text-sm-left">
										<div class="">
											<img src="{{ url('storage'.$order_product->image_sm) }}" alt="" class="img-thumbnail">
										</div>
										<div class="my-auto px-sm-3 px-0">
											<a href="{{ url('product/'.$order_product->slug) }}">
												{{ $order_product->product_name }}
											</a>
											@foreach($order_product->order_product_attrs as $attribute)
												<span class="bg-warning small rounded px-2 mr-5 text-dark font-weight-bold">
													{{ $attribute->attr_option }}
												</span>
											@endforeach
											@if($order_product->product->reviews->count() > 0)
												<div class="review mb-2">
													<span class="btn btn-success btn-sm font-weight-bold px-2 py-0 mr-2">
														{{ number_format($order_product->product->reviews->avg('rating'), 1) }} <i class="fas fa-star"></i>
													</span>
													<span class="small">
														( {{ $order_product->product->reviews->count() }} Reviews )
													</span>
													<a href="" class="small ml-2 font-weight-bold color-theme badge">
														<i class="fas fa-pen-nib"></i>
														Write A Review
													</a>
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

							@if(count($order->order_histories) > '0')
							<div class="cart-total-product b1 br-5 p-25 mt-20 delivery_segment">
								@foreach($order->order_histories as $history)
								<div class="segment d-flex">
									<div class="text-center color-theme segment_left">
										<i class="fas fa-dot-circle"></i>
										<img src="{{ url('assets/arrow-down.png') }}" alt="" class="arrow-down">
									</div>
									<div class="segment_body pl-3">
										<h6 class="mb-1">{{ ucfirst(str_replace('_', ' ', $history->order_status)) }}</h6>
										<div class="small">{{ date('Y-m-d h:i') }}</div>
										<p class="small">{{ $history->description }}</p>
									</div>
								</div>
								@endforeach
							</div>
							@endif
							
							@if(get_setting('cancel_order') == 'enable' && !in_array($order->order_status, ['delivered', 'cancelled']))
							<div class="text-center mt-25">
								<button class="theme-btn py-2 bg-danger" data-toggle="collapse" data-target="#cancel_order">
									<i class="fas fa-ban"></i> Cancel Order
								</button>
							</div>
							<div class="cart-total-product b1 br-5 p-25 mt-20 bg-light collapse" id="cancel_order">
								<form action="{{ url('user/order/cancel') }}" method="POST">
									@csrf
									<div class="form-group">
										<label for="">Specify a valid reason to cancel your order</label>
										<textarea name="description" rows="6" class="form-control" placeholder="Write Your reason Here.."></textarea>
									</div>
									<input type="hidden" name="order_id" value="{{ $order->id }}">
									<input type="submit" class="theme-btn">
								</form>
							</div>
							@endif
						</div>
								
					</div>
					<!-- /#page-content-wrapper -->

				</div>
			</div>
		</div>
	</section>
@endsection