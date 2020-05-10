@extends('layouts.app')

@section('content')
	<section class="hero-section">
		<div class="hero-slider owl-carousel-home">
			
			@foreach($slider as $slide)
			<div class="hero-slide-item" style="background-image:url('{{ url('storage'.$slide->image_lg) }}');">
				<div class="container">
					<div class="hero-inner">
						<h1 class="mb-20 light">
							{{ $slide->caption }}
						</h1>
						<p class="mb-40 mr-120 light">
							{{ $slide->caption }}
						</p>
						<div class="hero-btn">
							<a href="shop.html" class="theme-btn">Order Now</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</section>

	<section class="special-offer text-center pt-110 rpt-70 pb-35">
		<div class="container">
			<div class="section-title mb-15">
				<h2>Special Offer</h2>
				<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<div class="special-offer-inner special-offer-slider">

						<div class="single-product">
							<div class="special-offer-product bg-white m-25 p-25 b1 br-5">
								<div class="off">10%<span>off</span></div>
								<div class="product-img-wrap">
									<img src="{{ url('/') }}/assets/front/img/product/product1.png" alt="img">
								</div>
								<div class="product-content">
									<div class="offer-product-price">
										<span class="discounted-price">$100.00</span>
										<span class="actual-price has-discount">$120.00</span>
									</div>
									<p>Chashi Aromatic Chinigura Rice (1 Bag 5 kg)</p>
								</div>
								<div class="product-action">
									<a href="#" class="add-to-btn">Add to Cart</a>
									<div class="add-wishlist wish">
										<i class="fa fa-heart-o"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="single-product">
							<div class="special-offer-product bg-white m-25 p-25 b1 br-5">
								<div class="off">10%<span>off</span></div>
								<div class="product-img-wrap">
									<img src="{{ url('/') }}/assets/front/img/product/product2.png" alt="img">
								</div>
								<div class="product-content">
									<div class="offer-product-price">
										<span class="discounted-price">$100.00</span>
										<span class="actual-price has-discount">$120.00</span>
									</div>
									<p>Chashi Aromatic Chinigura Rice (1 Bag 5 kg)</p>
								</div>
								<div class="product-action">
									<a href="#" class="add-to-btn">Add to Cart</a>
									<div class="add-wishlist">
										<i class="fa fa-heart-o"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="single-product">
							<div class="special-offer-product bg-white m-25 p-25 b1 br-5">
								<div class="off">10%<span>off</span></div>
								<div class="product-img-wrap">
									<img src="{{ url('/') }}/assets/front/img/product/product3.png" alt="img">
								</div>
								<div class="product-content">
									<div class="offer-product-price">
										<span class="discounted-price">$100.00</span>
										<span class="actual-price has-discount">$120.00</span>
									</div>
									<p>Chashi Aromatic Chinigura Rice (1 Bag 5 kg)</p>
								</div>
								<div class="product-action">
									<a href="#" class="add-to-btn">Add to Cart</a>
									<div class="add-wishlist">
										<i class="fa fa-heart-o"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="single-product">
							<div class="special-offer-product bg-white m-25 p-25 b1 br-5">
								<div class="off">10%<span>off</span></div>
								<div class="product-img-wrap">
									<img src="{{ url('/') }}/assets/front/img/product/product4.png" alt="img">
								</div>
								<div class="product-content">
									<div class="offer-product-price">
										<span class="discounted-price">$100.00</span>
										<span class="actual-price has-discount">$120.00</span>
									</div>
									<p>Chashi Aromatic Chinigura Rice (1 Bag 5 kg)</p>
								</div>
								<div class="product-action">
									<a href="#" class="add-to-btn">Add to Cart</a>
									<div class="add-wishlist">
										<i class="fa fa-heart-o"></i>
									</div>
								</div>
							</div>
						</div>

						<div class="single-product">
							<div class="special-offer-product bg-white m-25 p-25 b1 br-5">
								<div class="off">10%<span>off</span></div>
								<div class="product-img-wrap">
									<img src="{{ url('/') }}/assets/front/img/product/product3.png" alt="img">
								</div>
								<div class="product-content">
									<div class="offer-product-price">
										<span class="discounted-price">$100.00</span>
										<span class="actual-price has-discount">$120.00</span>
									</div>
									<p>Chashi Aromatic Chinigura Rice (1 Bag 5 kg)</p>
								</div>
								<div class="product-action">
									<a href="#" class="add-to-btn">Add to Cart</a>
									<div class="add-wishlist">
										<i class="fa fa-heart-o"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="advertise-offer pt-60 pb-50 rpt-20 rpb-10 bg-light">
		<div class="container">
			<div class="row col-gap-40">
				<div class="col-lg-7 rmb-30">
					<div class="advertise d-flex align-items-center justify-content-between h-100 bg-color1 br-5">
						<div class="advertise-text pt-40 pl-40 pb-40">
							<h6>Fresh Vegetables</h6>
							<h3>Healthy Vegetables</h3>
							<p>Get 20% Off Selected Product</p>
							<a href="shop.html" class="theme-btn">Order Now</a>
						</div>
						<div class="advertise-img pr-20">
							<img src="{{ url('/') }}/assets/front/img/product/f1.png" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-5">
					<div class="advertise d-flex align-items-center justify-content-between h-100 bg-color2 br-5">
						<div class="advertise-text pt-40 pl-40 pb-40">
							<h6>Home Appliances</h6>
							<h3>Appliances</h3>
							<p>Get 20% Off Selected Product</p>
							<a href="shop.html" class="theme-btn">Order Now</a>
						</div>
						<div class="advertise-img  pr-20">
							<img src="{{ url('/') }}/assets/front/img/product/f2.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="categories-section text-center pt-60 pb-30">
		<div class="container">
			<div class="section-title mb-45">
				<h2>Shop by Categories</h2>
				<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
			</div>
			<div class="row">
				@foreach(get_categories() as $category)
				<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-30">
					<a href="shop.html" class="categori-item bg-white br-5">
						<div class="categori-img d-flex align-items-center justify-content-center">
							<img src="{{ url('storage'.$category->image_sm) }}" alt="img">
						</div>
						<div class="categori-name">
							<span>{{ $category->category }}</span>
						</div>
					</a>
				</div>
				@endforeach
				<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-30">
					<a href="{{ url('categories') }}" class="categori-item bg-white br-5">
						<div class="categori-img d-flex flex-column align-items-center justify-content-center m-auto pt-4">
							<h1 class="text-success pt-3">
								<i class="fas fa-arrow-alt-circle-down"></i>
							</h1>
							<h5>Browse All</h5>
						</div>
					</a>
				</div>
			</div>
		</div>
	</section>

	<section class="advertise-offer pt-60 pb-60 rpt-20 rpb-20 bg-light">
		<div class="container">
			<div class="row col-gap-40">
				<div class="col-lg-6 rmb-30">
					<div class="advertise d-flex align-items-center justify-content-between h-100 bg-color3 br-5">
						<div class="advertise-text pt-40 pl-40 pb-40">
							<h6>Fresh Fruits</h6>
							<h3>Healthy Food</h3>
							<p>Get 20% Off Selected Product</p>
							<a href="shop.html" class="theme-btn">Order Now</a>
						</div>
						<div class="advertise-img pr-20">
							<img src="{{ url('/') }}/assets/front/img/product/f3.png" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="advertise d-flex align-items-center justify-content-between h-100 bg-color4 br-5">
						<div class="advertise-text pt-40 pl-40 pb-40">
							<h6>Fresh Fruits</h6>
							<h3>Healthy Food</h3>
							<p>Get 20% Off Selected Product</p>
							<a href="shop.html" class="theme-btn">Order Now</a>
						</div>
						<div class="advertise-img  pr-20">
							<img src="{{ url('/') }}/assets/front/img/product/f4.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="made-for-product text-center pt-45 pb-20">
		<div class="container">
			<div class="section-title mb-45">
				<h2>Made For You</h2>
				<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
			</div>
			<div class="row">
				@foreach(feat_products() as $product)
				<div class="custom-5-item col-xl-3 col-lg-4 col-md-6">
					<div class="product">
						<div class="product-img-wrap">
							<a href="{{ url('product/'.$product->slug) }}">
								<img src="{{ url('storage'.$product->primary_img->image_sm) }}" alt="{{ $product->product_name }}">
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


				<div class="blog-btn text-center w-100 mt-25 mb-30">
					<a href="{{ url('shop') }}" class="theme-btn br-30">
						Browse More
					</a>
				</div>

				<div class="modal product-modal fade" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body p-35 pt-0">
								<div class="product-quick-view">
									<div class="container">
										<div class="row">
											<div class="col-lg-6">
												<div class="product-preview-wrap">
													<div class="tab-content bg-white p-50 b1 br-5">
														<div class="tab-pane" id="preview1">
															<img src="{{ url('/') }}/assets/front/img/product/product23.png" alt="Product Preview Image" data-magnify-src="{{ url('/') }}/assets/front/img/product/product23.png" />
														</div>
														<div class="tab-pane active" id="preview2">
															<img src="{{ url('/') }}/assets/front/img/product/onion3.png" alt="Product Preview Image" data-magnify-src="{{ url('/') }}/assets/front/img/product/onion3.png" />
														</div>
														<div class="tab-pane" id="preview3">
															<img src="{{ url('/') }}/assets/front/img/product/product23.png" alt="Product Preview Image" data-magnify-src="{{ url('/') }}/assets/front/img/product/product23.png" />
														</div>
														<div class="tab-pane" id="preview4">
															<img src="{{ url('/') }}/assets/front/img/product/onion2.png" alt="Product Preview Image" data-magnify-src="{{ url('/') }}/assets/front/img/product/onion2.png" />
														</div>
													</div>
													<ul class="nav nav-tabs flex-nowrap align-content-between mt-30">
														<li>
															<a data-toggle="tab" href="#preview1">
																<img src="{{ url('/') }}/assets/front/img/product/product23.png" alt="Product Thumbnail Image" />
															</a>
														</li>
														<li>
															<a class="active" data-toggle="tab" href="#preview2">
																<img src="{{ url('/') }}/assets/front/img/product/onion3.png" alt="Product Thumbnail Image" />
															</a>
														</li>
														<li>
															<a data-toggle="tab" href="#preview3">
																<img src="{{ url('/') }}/assets/front/img/product/product23.png" alt="Product Thumbnail Image" />
															</a>
														</li>
														<li>
															<a data-toggle="tab" href="#preview4">
																<img src="{{ url('/') }}/assets/front/img/product/onion2.png" alt="Product Thumbnail Image" />
															</a>
														</li>
													</ul>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="product-details text-left bg-white ml-25 px-50 py-45 b1 br-5">
													<h3 class="mb-25 rmt-25">Fresh Onion 1kg</h3>
													<div class="rating mb-25">
														<div class="star mr-15">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="text">(13 Review)</div>
													</div>
													<p>Sed egestas, ante et vulputate volutpat, eropede semper est, vitluctus metus libero eu augue. Morbi purus libero, faucibus adipiscing.</p>
													<p>commodo quis, gravida id, est. Sed lectus. Praest elemhendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat.lacus a ultrices.</p>
													<h6>Availability: <span>In Stock</span></h6>
													<h4 class="price">$120.00</h4>
													<div class="product-spinner mt-20">
														<div class="number-input b1">
															<button class="minus"></button>
															<input min="1" name="quantity" value="2" type="number">
															<button class="plus"></button>
														</div>
														<a href="#" class="theme-btn br-30 ml-20">Add to Cart</a>
														<div class="add-wishlist">
															<i class="fa fa-heart-o"></i>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<section class="how-work text-center pt-60 pb-60 rpt-20 rpb-20 bg-light">
		<div class="container">
			<div class="section-title">
				<h2>Delivery Process</h2>
				<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="work-box down-dashed">
						<span class="work-number"><i class="flaticon-shopping-cart"></i></span>
						<h5>Step 1</h5>
						<span class="line"></span>
						<p>Choose Your Product</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="work-box up-dashed">
						<span class="work-number"><i class="flaticon-harvest"></i></span>
						<h5>Step 2</h5>
						<span class="line"></span>
						<p>Local Farm Product It</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="work-box down-dashed">
						<span class="work-number"><i class="flaticon-address"></i></span>
						<h5>Step 3</h5>
						<span class="line"></span>
						<p>Pick Up From Local Spot</p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="work-box">
						<span class="work-number"><i class="flaticon-delivery-truck"></i></span>
						<h5>Step 4</h5>
						<span class="line"></span>
						<p>We Can Delivery it Fast</p>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

