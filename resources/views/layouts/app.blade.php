<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title>@yield('title', config('app.name', 'LalajiKirana'))</title>
	<meta name="description" content="@yield('m_description', config('app.name', 'LalajiKirana'))">
	<meta name="keywords" content="@yield('m_keywords', config('app.name', 'LalajiKirana'))">
	<meta name="author" content="@yield('m_author', config('app.name', 'LalajiKirana'))">
	<link rel="manifest" href="{{ url('/manifest.json') }}">
	<link rel="shortcut icon" href="{{ url('/assets/front/logo/logo-48.png') }}" type="image/x-icon">
	@section('styles')
		<link rel="stylesheet" href="{{ url('/assets/front/css/style.css') }}">
		<link rel="stylesheet" href="{{ url('/assets/front/css/responsive.css') }}">
	@show
</head>
<body>
	@include('includes/errors')
	<div class="page-wrapper">

		<div class="preloader"></div>

		<header class="main-header">
			<div class="container">
				<div class="header-inner">
					<div class="logo">
						<a href="{{ url('/') }}">
							@if(Agent::isDesktop())
								<img src="{{ url('assets/front/logo/sm-logo-96.png') }}" alt="Main Logo">
							@else
								<img src="{{ url('assets/front/logo/sm-logo-72.png') }}" alt="Main Logo">
							@endif
						</a>
					</div>
					@if(Agent::isDesktop())
					<div class="categories">
						<button>
							<i class="fas fa-list"></i>
							<span>Categories</span>
						</button>
						<ul class="small-scroll">
							@foreach(get_categories() as $category)
								<li>
									<a href="{{ url('shop?category='.$category->slug) }}">
										<i class="fas fa-angle-double-right"></i>
										{{ $category->category }}
									</a>
								</li>
								@foreach($category->child_categories as $child)
									<li class="ml-2 small">
										<a href="{{ url('shop?category='.$child->slug) }}">
											<i class="fas fa-caret-right"></i>
											{{ $child->category }}
										</a>
									</li>
								@endforeach
							@endforeach
						</ul>
					</div>
					@endif
					<form action="{{ url('shop') }}" class="menu-search">
						<input type="search" name="search" placeholder="Search" value="{{ Request::get('search') }}">
						<input type="hidden" name="category" value="{{ Request::get('category') }}">
						<input type="hidden" name="sort" value="{{ Request::get('sort') }}">
						<button type="submit">Search</button>
					</form>
					<div class="menu-collections">
						@if(Agent::isDesktop())
							<div class="collection-item watch">
								<span class="badge badge-pill badge-primary cart_badge">
									@if(empty(Auth::user()->wishlists))
										0
									@else
										{{ Auth::user()->wishlists->count() }}
									@endif
								</span>
								<i class="fas fa-heart"></i>
								<div class="collection-inner">
									@if(empty(Auth::user()->wishlists))
										<div class="text-center my-10">
											<h3 class="px-20 ">
												No Items
											</h3>
											<a href="{{ url('shop') }}" class="theme-btn">
												Shop Now
											</a>
										</div>
									@else
										@foreach(Auth::user()->wishlists as $item)
										<div class="alert single-collection">
											<a href="{{ url('user/wishlist/delete/'.$item->id) }}">
												<i class="fas fa-times"></i>
											</a>
											<div class="collection-image">
												<img src="{{ url('storage'.$item->product->primary_img->image_sm) }}" alt="">
											</div>
											<div class="collection-content">
												<p class="mb-0">
													<a href="{{ url('product/'.$item->product->slug) }}">
														{{ $item->product->product_name }}
													</a>
												</p>
												<h6>
													<i class="fas fa-rupee-sign"></i>
													{{ number_format(product_sale_price($item->product), 2) }}
													
													@if(!empty($item->product->discount->discount))
														<del class="small text-secondary absolute ml-1 mt-1">
															{{ number_format($item->product->base_price, 2) }}
														</del>
													@endif

												</h6>
												<a href="{{ url('cart/store?quantity=1&product_id='.$item->product->id) }}" class="font-weight-bold color-theme">
													+ Add to Cart
												</a>
											</div>
										</div>
										@endforeach

										@if(Auth::user()->wishlists->count())
										<div class="collection-btn">
											<a href="{{ url('user/wishlist') }}" class="theme-btn bg-blue no-shadow mx-auto">View List</a>
										</div>
										@else
											<div class="text-center my-10">
												<h3 class="px-20 ">
													No Items
												</h3>
												<a href="{{ url('shop') }}" class="theme-btn">
													Shop Now
												</a>
											</div>
										@endif

									@endif
									
								</div>
							</div>
							<div class="collection-item cart">
								<span class="badge badge-pill badge-primary cart_badge">
									{{ count(session('cart', array())) }}
								</span>
								<i class="fas fa-shopping-cart"></i>
								<div class="collection-inner">
									<div id="header_cart_items_list" class="small-scroll">
										@foreach(session('cart', array()) as $cart_item)
										<div class="alert single-collection">
											<a href="{{ url('cart/remove/'.$cart_item['id']) }}" class="text-danger">
												<i class="fas fa-trash"></i>
											</a>
											<div class="collection-image">
												<a href="{{ url('product/'.$cart_item['product']['slug']) }}">
													<img src="{{ url('storage'.$cart_item['image_sm']) }}" alt="">
												</a>
											</div>
											<div class="collection-content">
												<a href="{{ url('product/'.$cart_item['product']['slug']) }}">
													{{ $cart_item['product']['product_name'] }}
												</a>
												<h6 class="mt-1">
													<i class="fas fa-rupee-sign"></i>
													{{ number_format($cart_item['product_price'], 2) }}

													<span class="mx-2"><i class="fas fa-times"></i></span>
													{{ $cart_item['quantity'] }}
												</h6>
											</div>
										</div>
										@endforeach
									</div>
									
									@if(session('cart', array()))
									<div class="text-center pt-4 border-top">
										<a href="{{ url('cart') }}" class="theme-btn py-2">
											View Cart
										</a>
										<a href="{{ url('checkout') }}" class="theme-btn py-2">
											Checkout
										</a>
									</div>
									@else
										<div class="text-center my-10">
											<h3 class="px-20 ">
												Empty Cart
											</h3>
											<a href="{{ url('cart') }}" class="theme-btn py-2">
												View Cart
											</a>
											<a href="{{ url('shop') }}" class="theme-btn py-2">
												Shop Now
											</a>
										</div>
									@endif
								</div>
							</div>
						@endif
						<div class="collection-item profile">
							<i class="fas fa-user-tie"></i>
							<div class="collection-inner">
								<ul>
									<li>
										<a href="{{ url('cart') }}">
											<i class="fas fa-shopping-cart mr-1 color-theme"></i>
											My Cart
										</a>
									</li>
									<li>
										<a href="{{ url('checkout') }}">
											<i class="far fa-credit-card mr-1 color-theme"></i>
											Checkout
										</a>
									</li>
									@guest
										<li>
											<a href="{{ url('login') }}">
												<i class="fas fa-sign-in-alt mr-1 color-theme"></i>
												Sign In
											</a>
										</li>
										<li>
											<a href="{{ url('register') }}">
												<i class="fas fa-sign-out-alt mr-1 color-theme"></i>
												Sign Up
											</a>
										</li>
									@else
										<li>
											<a href="{{ url('user/home') }}">
												<i class="fas fa-tachometer-alt mr-1 color-theme"></i>
												Dashboard
											</a>
										</li>
										<li>
											<a href="{{ url('user/orders') }}">
												<i class="fas fa-truck-loading mr-1 color-theme"></i>
												Orders
											</a>
										</li>
										<li>
											<a href="{{ url('user/wishlist') }}">
												<i class="fas fa-heart mr-1 color-theme"></i>
												Wishlist
											</a>
										</li>
										<li>
											<a href="{{ url('user/addresses') }}">
												<i class="fas fa-home mr-1 color-theme"></i>
												Addresses
											</a>
										</li>
										<li>
											<a 	href="{{ route('logout') }}" 
												onclick="event.preventDefault();
		                 						document.getElementById('user-icon-logout-form').submit();">
												<i class="fas fa-power-off mr-1 color-theme"></i>
												Logout
											</a>
											<form id="user-icon-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											    @csrf
											</form>
										</li>
									@endguest
								</ul>
							</div>
						</div>
					</div>
					<div class="main-menu">
						<button><i class="fas fa-bars"></i></button>
						<ul class="small-scroll">
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href="{{ url('shop') }}">Shop</a></li>
							<li class="dropdown">
								<a href="#">Categories</a>
								<ul>
									@foreach(get_categories() as $category)
										<li>
											<a href="{{ url('shop?category='.$category->slug) }}">
												<i class="fas fa-caret-right mr-1 color-theme"></i>
												{{ $category->category }}
											</a>
										</li>
									@endforeach
								</ul>
							</li>
							<li class="dropdown">
								<a href="#">My Account</a>
								<ul>
									<li>
										<a href="{{ url('cart') }}">
											<i class="fas fa-shopping-cart mr-1 color-theme"></i>
											My Cart
										</a>
									</li>
									<li>
										<a href="{{ url('checkout') }}">
											<i class="far fa-credit-card mr-1 color-theme"></i>
											Checkout
										</a>
									</li>
									@guest
										<li>
											<a href="{{ url('login') }}">
												<i class="fas fa-sign-in-alt mr-1 color-theme"></i>
												Sign In
											</a>
										</li>
										<li>
											<a href="{{ url('register') }}">
												<i class="fas fa-sign-out-alt mr-1 color-theme"></i>
												Sign Up
											</a>
										</li>
									@else
										<li>
											<a href="{{ url('user/home') }}">
												<i class="fas fa-tachometer-alt mr-1 color-theme"></i>
												Dashboard
											</a>
										</li>
										<li>
											<a href="{{ url('user/orders') }}">
												<i class="fas fa-truck-loading mr-1 color-theme"></i>
												Orders
											</a>
										</li>
										<li>
											<a href="{{ url('user/wishlist') }}">
												<i class="fas fa-heart mr-1 color-theme"></i>
												Wishlist
											</a>
										</li>
										<li>
											<a href="{{ url('user/addresses') }}">
												<i class="fas fa-home mr-1 color-theme"></i>
												Addresses
											</a>
										</li>
										<li>
											<a 	href="{{ route('logout') }}" 
												onclick="event.preventDefault();
		                 						document.getElementById('primary-logout-form').submit();">
												<i class="fas fa-power-off mr-1 color-theme"></i>
												Logout
											</a>
											<form id="primary-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											    @csrf
											</form>
										</li>
									@endguest
								</ul>
							</li>
							<li><a href="{{ url('contact') }}">Contact Us</a></li>
							@foreach(get_pages() as $page)
								<li>
									<a href="{{ url('page/'.$page->slug) }}">
										{{ $page->title }}
									</a>
								</li>
							@endforeach
						</ul>
						<div class="menu-overlay"></div>
					</div>
				</div>
			</div>
			<div class="collection-close"></div>
		</header>
		
		@section('content')
		@show


		<footer class="footer bg-black pt-100 text-lg-left text-center">
			<div class="container">
				<div class="row">

					<div class="col-lg-3 col-md-12 mb-30">
						<div class="footer-widget logo-widget mr-20">
							<div class="footer-logo text-sm-left text-center">
								<a href="{{ url('/') }}"><img src="{{ url('assets/front/logo/logo-152.png') }}" alt="footer logo"></a>
							</div>
							<p>Praesent dapi cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros erat. Aliquam erat volutpat.</p>
							<div class="footer-social-icon">
								<ul class="social-style-one">
									<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
									<li><a href="#"><i class="fab fa-instagram"></i></a></li>
								</ul>
							</div>
						</div>
					</div>

					<div class="col-lg-2 col-md-3 mb-30">
						<div class="footer-widget links-widget float-lg-right mr-40">
							<h5 class="footer-title mb-30">Company</h5>
							<ul class="list">
								<li><a href="#">ABOUT US</a></li>
								<li><a href="#">BLOG</a></li>
								<li><a href="#">SHOP</a></li>
								<li><a href="#">CONTACT</a></li>
							</ul>
						</div>
					</div>

					<div class="col-lg-4 col-md-5 mb-30">
						<div class="footer-widget form-widget ml-115 mr-30">
							<h5 class="footer-title mb-30">Subscribe Our News Letter</h5>
							<p>Praesent dapi cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros</p>
							<form class="subscribe">
								<input type="email" placeholder="Your Email For Notify" required>
								<button type="submit">Send</button>
							</form>
						</div>
					</div>

					<div class="col-lg-3 col-md-4 mb-30">
						<div class="footer-widget pament-widget">
							<h5 class="footer-title mb-30">Payment</h5>
							<ul class="list">
								<li>
									<a href="#">
										<img src="{{ url('/assets/front/img/pay-method/visa.png') }}" alt="visa">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="{{ url('/assets/front/img/pay-method/mastercard.png') }}" alt="mastercard">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="{{ url('/assets/front/img/pay-method/discover.png') }}" alt="discover">
									</a>
								</li>
								<li>
									<a href="#">
										<img src="{{ url('/assets/front/img/pay-method/americanexpress.png') }}" alt="americanexpress">
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">

						<div class="copyright text-center pl-10 pr-10 pt-30 pb-10 mt-10 mb-10">
							<p>
								All rights reserved <i class="far fa-copyright"></i> {{ date('Y') }}.  
								Created By 
								<a href="https://inventivemonks.com" target="_blank" class="font-weight-bold color-theme">
									Inventive Monks
								</a> 
								.
							</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>


	<button class="scroll-top scroll-to-target" data-target="html">
		<span class="fa fa-angle-up"></span>
	</button>

	<div class="container-fluid d-none" id="installAppWrapper">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="p-10 rounded d-flex text-center m-auto flex-wrap bg-theme">
					<div class="my-auto flex-fill">
						<h5 class="text-white mb-0">Install the App</h5>
					</div>
					<div>
						<button class="bg-white color-theme theme-btn py-2 installAppBtn" id="installAppBtn">Install</button>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
	
	@section('scripts')
		<script src="{{ url('assets/front/js/jquery.min.js') }}"></script>
		<script src="{{ url('assets/front/js/bootstrap-v4.1.3.min.js') }}"></script>
		<script src="{{ url('assets/front/js/slick.min.js') }}"></script>
		<script src="{{ url('assets/front/js/rocket-loader.min.js') }}"></script>
		<script src="{{ url('assets/front/js/script.js') }}"></script>
	@show
	
</body>

</html>
