@extends('layouts.app')

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.webp') }}');">
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
				@if(Agent::isDesktop())
					<div class="col-xl-3 col-lg-4">
						@include('shop_sidebar')
					</div>
				@endif

				<div class="col-xl-9 col-lg-8">
					<div class="shop-items" id="shop_items">
						<div class="search-result-header">
							<h5>Showing Result {{ $products->count() }} of {{ $products->total() }} Product</h5>
							<form action="{{ url('shop') }}" class="sort-by" id="sorting_form">
								<h5>Sort:</h5>
								<select name="sort" class="ml-2" id="sorting">
									<option value="">-- Default --</option>
									<option value="latest">Latest First</option>
									<option value="oldest">Oldest First</option>
									<option value="name-a-z">By Name (A - Z)</option>
									<option value="name-z-a">By Name (Z - A)</option>
									<option value="price-low-hight">Price (Low-High)</option>
									<option value="price-hight-low">Price (High-Low)</option>
								</select>
								<input type="hidden" name="category" value="{{ Request::get('category') }}">
							</form>
						</div>
						<div class="row">
							@foreach($products as $product)
							<div class="col-xl-4 col-lg-6 col-sm-6">
								<div class="product">
									<div class="product-img-wrap">
										@if(!empty($product->discount->discount))
											<div class="item-off">
												{{ $product->discount->discount }}%
												<span>off</span>
											</div>
										@endif
										<a href="{{ url('product/'.$product->slug) }}">
											<img src="{{ url('storage'.$product->primary_img->image_md) }}" alt="{{ $product->product_name }}">
										</a>
									</div>
									<div class="product-content-wrap">
										<div class="product-content">
											<p>
												<a href="{{ url('product/'.$product->slug) }}">
													{{ $product->product_name }}
												</a>
											</p>
											@if($product->reviews->count() > 0)
												<div class="review">
													<a href="{{ url('reviews/'.$product->slug) }}" class="btn btn-success btn-sm font-weight-bold px-2 py-0 mr-2">
														{{ number_format($product->reviews->avg('rating'), 1) }} <i class="fas fa-star"></i>
													</a>
													<span class="small">
														( {{ $product->reviews->count() }} Reviews )
													</span>
												</div>
											@endif
										</div>
										<div class="product-action">
											<a href="{{ url('cart/store?quantity=1&product_id='.$product->id) }}" class="add-to-btn small-btn">
												<i class="fas fa-shopping-cart"></i>
												<span>Add to Cart</span>
												<h5 class="product-price">
													<i class="fas fa-rupee-sign"></i>
													{{ number_format(product_sale_price($product), 2) }}
													
													@if(!empty($product->discount->discount))
														<del class="small text-secondary absolute ml-1 mt-1">
															{{ number_format($product->base_price, 2) }}
														</del>
													@endif
												</h5>
											</a>
											<a href="{{ url('user/wishlist/add/'.$product->id) }}" class="add-wishlist index-9">
												<i class="fas fa-heart"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							@endforeach

						</div>

					</div>
					
					{{ $products->appends([
									'category' 	=> 	Request::get('category'),
									'search'	=>	Request::get('search'),
									'sort'		=>	Request::get('sort'),
								])
								->links() }}
					
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
	@parent
	<script>
		$(document).ready(function($) {
			$("#sorting").change(function(event) {
				$("#sorting_form").submit();
			});
		});
	</script>
@endsection