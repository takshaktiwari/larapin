@extends('layouts.app')

@section('styles')
	@parent
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
@endsection

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.png') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">{{ substr($product->product_name, 0, 20) }}...</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Shop Details</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="shop-details-page mt-120 rmt-70 mb-60 rmb-20">
		<div class="container">
			<div class="row col-gap-60">
				<div class="col-xl-3 col-lg-4">
					@include('shop_sidebar')
				</div>
				<div class="col-xl-9 col-lg-8">
					<div class="product-details-wrap">
						<div class="row col-gap-60">
							<div class="col-xl-5">
								<div class="product-preview-wrap">
									<div class="tab-content bg-white p-15 b1 br-5">
										<div class="tab-pane active" id="preview">
											<a data-fancybox="gallery" href="{{ url('storage'.$product->primary_img->image_lg) }}">
												<img src="{{ url('storage'.$product->primary_img->image_md) }}" alt="{{ url('storage'.$product->primary_img->title) }}" />
											</a>
										</div>
									</div>
									<ul class="nav nav-tabs mt-30">
										@foreach($product->images as $key => $image)
										<li>
											<a data-fancybox="gallery" href="{{ url('storage'.$image->image_lg) }}">
												<img src="{{ url('storage'.$image->image_sm) }}" alt="{{ $image->title }}" />
											</a>
										</li>
										@endforeach
									</ul>
								</div>
							</div>
							<div class="col-xl-7">
								<div class="product-details text-left bg-white p-20 b1 br-5">
									<h4 class="mb-25 rmt-25">{{ $product->product_name }}</h4>
									<div class="rating mb-25">
										<div class="star mr-15">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<div class="text">({{ $product->reviews->count() }} Review)</div>
									</div>
									<div class="short_description">
										{{ $product->short_description }}
									</div>
									<h6 class="stock">
										Availability: 
										<span>
											@if($product->base_stock <= 10)
												{{ $product->base_stock }} Left
											@else
												In Stock
											@endif
										</span>
									</h6>
									<h4 class="price">
										<span>
											<i class="fas fa-rupee-sign"></i>
											{{ number_format(product_sale_price($product), 2) }}
										</span>
										<del class="small text-secondary ml-1">
											<i class="fas fa-rupee-sign"></i>
											{{ number_format($product->base_price, 2) }}
										</del>
									</h4>
									<div class="product-spinner mt-20">
										<div class="number-input b1">
											<button class="minus"></button>
											<input min="1" name="quantity" value="1" type="number">
											<button class="plus"></button>
										</div>
										<a href="#" class="theme-btn br-30 ml-25">Add to Cart</a>
										<div class="add-wishlist">
											<i class="fas fa-heart"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="product-details-review bg-white mt-60 px-20 pt-20 pb-30 b1 br-5">
							<ul class="nav nav-tabs mb-20">
								<li><a href="#details" class="active" data-toggle="tab">Description</a></li>
								<li><a href="#addi-info" data-toggle="tab" class="">Additional information</a></li>
								<li><a href="#review" data-toggle="tab" class="">Reviews</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="details">
									{{ $product->details->description }}
								</div>
								<div class="tab-pane" id="addi-info">
									<p>Morbi non accumsan libero, volutpat ullamcorper odio. Donec non libero id augue suscipit commodo. Curabitur porta ac ligula vel sollicitudin. Praesent vestibulum tellus urna, in imperdiet neque lobortis eleifend. Nunc eros nulla, porta quis urna nec, luctus viverra diam. In ut ante est. Duis venenatis erat ac nisl malesuada gravida. Pellentesque pellentesque tempor urna, quis vehicula mi mollis hendrerit. Etiam iaculis convallis arcu, id lacinia massa imperdiet vitae.</p>
								</div>
								<div class="tab-pane" id="review">

									<div class="product-review-comments">

										<div class="latest-comments">
											<div class="comments-box">
												<div class="comments-avatar">
													<img src="assets/img/shop/reviewer-1.png" alt="">
												</div>
												<div class="comments-text">
													<div class="avatar-name">
														<h5>Daniel R. Stockton</h5>
														<span>3 Days Ago</span>
														<div class="ratings">
															<i class="flaticon-star"></i>
															<i class="flaticon-star"></i>
															<i class="flaticon-star"></i>
															<i class="flaticon-star"></i>
															<i class="flaticon-star"></i>
														</div>
													</div>
													<p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitaus metus lib eu augue. Morbi purus libero, faucibadipisci commodo quis, grav, est. Sed lectus.</p>
												</div>
											</div>
											<div class="child comments-box">
												<div class="comments-avatar">
													<img src="assets/img/shop/reviewer-1.png" alt="">
												</div>
												<div class="comments-text">
													<div class="avatar-name">
														<h5>Daniel R. Stockton</h5>
														<span>3 Days Ago</span>
													</div>
													<p>Sed egestas, ante et vulputate volutpat, eros pede semper est.</p>
												</div>
											</div>
										</div>

										<div class="latest-comments">
											<div class="comments-box">
												<div class="comments-avatar">
													<img src="assets/img/shop/reviewer-1.png" alt="">
												</div>
												<div class="comments-text">
													<div class="avatar-name">
														<h5>Daniel R. Stockton</h5>
														<span>3 Days Ago</span>
														<div class="ratings">
															<i class="flaticon-star"></i>
															<i class="flaticon-star"></i>
															<i class="flaticon-star"></i>
															<i class="flaticon-star"></i>
															<i class="flaticon-star"></i>
														</div>
													</div>
													<p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitaus metus eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, grav, est. Sed lectus.</p>
												</div>
											</div>
										</div>

										<div class="latest-comments">
											<div class="comments-box">
												<div class="comments-avatar">
													<img src="assets/img/shop/reviewer-1.png" alt="">
												</div>
												<div class="comments-text">
													<div class="avatar-name">
														<h5>Daniel R. Stockton</h5>
														<span>3 Days Ago</span>
														<div class="ratings">
															<i class="flaticon-star"></i>
															<i class="flaticon-star"></i>
															<i class="flaticon-star"></i>
															<i class="flaticon-star"></i>
															<i class="flaticon-star"></i>
														</div>
													</div>
													<p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitaus metus eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, grav, est. Sed lectus.</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="related-product mt-60 rmt-75">
							<h3 class="mb-35">Related Product</h3>
							<div class="row">
								
								@foreach($related as $item)
								<div class="col-xl-4 col-md-6 col-md-4 mb-30">
									<div class="product">
										<div class="product-img-wrap">
											<a href="{{ url('product/'.$product->slug) }}">
												<img src="{{ url('storage'.$item->primary_img->image_sm) }}" alt="{{ $item->product_name }}">
											</a>
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('scripts')
	@parent
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
@endsection