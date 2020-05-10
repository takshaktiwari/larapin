@extends('layouts.app')

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.png') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">Shop</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Shop</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="shop-page mt-120 rmt-80 mb-90 rmb-50">
		<div class="container">
			<div class="row">
				<div class="col-xl-3 col-lg-4">
					@include('shop_sidebar')
				</div>
				<div class="col-xl-9 col-lg-8">
					<div class="shop-items">
						<div class="search-result-header">
							<h5>Showing Result {{ $products->count() }} of {{ $products->total() }} Product</h5>
							<div class="sort-by">
								<h5>Sort:</h5>
								<select name="#" class="ml-2">
									<option value="value-1">-- Default --</option>
									<option value="value-2">Latest First</option>
									<option value="value-2">Oldest First</option>
									<option value="value-2">By Name (A - Z)</option>
									<option value="value-2">By Name (Z - A)</option>
									<option value="value-2">Price (Low-High)</option>
									<option value="value-2">Price (High-Low)</option>
								</select>
							</div>
						</div>
						<div class="row">
							
							@foreach($products as $product)
							<div class="col-xl-4 col-lg-6 col-sm-6">
								<div class="product">
									<div class="product-img-wrap">
										<img src="{{ url('storage'.$product->primary_img->image_sm) }}" alt="{{ $product->product_name }}">

										<button class="quick-view" type="button" data-toggle="modal" data-target="#quick-view">Quick View</button>
									</div>
									<div class="product-content-wrap">
										<div class="product-content">
											<p>
												<a href="{{ url('product/'.$product->slug) }}">
													{{ $product->product_name }}
												</a>
											</p>
											<div class="review">
												<span class="btn btn-success btn-sm font-weight-bold px-2 py-0 mr-2">
													4.5 <i class="fas fa-star"></i>
												</span>
												<span class="small">
													( {{ $product->reviews->count() }} Reviews )
												</span>
											</div>
										</div>
										<div class="product-action">
											<a href="#" class="add-to-btn small-btn">
												<i class="flaticon-shopping-cart"></i>
												<span>Add to Cart</span>
												<h5 class="product-price">
													<i class="fas fa-rupee-sign"></i>
													{{ number_format(product_sale_price($product), 2) }}
													
													@if(!empty($product->discount->discount))
														<del class="small text-secondary ml-1">
															<i class="fas fa-rupee-sign"></i>
															{{ number_format($product->base_price, 2) }}
														</del>
													@endif
												</h5>
											</a>
											<div class="add-wishlist">
												<i class="fas fa-heart"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach

						</div>

						{{ $products->links() }}
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection