<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title>@yield('title', config('app.name', 'Laravel'))</title>
	<meta name="description" content="@yield('m_description', config('app.name', 'Laravel'))">
	<meta name="keywords" content="@yield('m_keywords', config('app.name', 'Laravel'))">
	<meta name="author" content="@yield('m_author', config('app.name', 'Laravel'))">
	
	@section('styles')
		<link rel="shortcut icon" href="{{ url('/') }}/assets/front/img/favicon.png" type="image/x-icon">
		<link rel="stylesheet" href="{{ url('/') }}/assets/front/css/style.css">
		<link rel="stylesheet" href="{{ url('/') }}/assets/front/css/responsive.css">
	@show
</head>
<body>
	<div class="page-wrapper">

		<div class="preloader"></div>

		<header class="main-header">
			<div class="container">
				<div class="header-inner">
					<div class="logo">
						<a href="{{ url('/') }}">
							<img src="{{ url('/') }}/assets/front/img/logo.png" alt="Main Logo">
						</a>
					</div>
					<div class="categories">
						<button>
							<i class="flaticon-list"></i>
							<span>Categories</span>
						</button>
						<ul>
							@foreach(get_categories() as $category)
								<li>
									<a href="shop.html">
										<i class="fas fa-angle-double-right"></i>
										{{ $category->category }}
									</a>
								</li>
								@foreach($category->child_categories as $child)
									<li class="ml-2 small">
										<a href="shop.html">
											<i class="fas fa-caret-right"></i>
											{{ $child->category }}
										</a>
									</li>
								@endforeach
							@endforeach
						</ul>
					</div>
					<form action="{{ url('shop') }}" class="menu-search">
						<input type="search" placeholder="Search" required>
						<button type="submit">Search</button>
					</form>
					<div class="menu-collections">
						<div class="collection-item watch">
							<i class="flaticon-heart"></i>
							<div class="collection-inner">
								<div class="alert single-collection">
									<button data-dismiss="alert"><i class="flaticon-delete-button"></i></button>
									<div class="collection-image">
										<img src="{{ url('/') }}/assets/front/img/shop/cart-1.png" alt="">
									</div>
									<div class="collection-content">
										<p>Danish Full Cream Milk</p>
										<h6>$120.00</h6>
									</div>
								</div>
								<div class="alert single-collection">
									<button data-dismiss="alert"><i class="flaticon-delete-button"></i></button>
									<div class="collection-image">
										<img src="{{ url('/') }}/assets/front/img/shop/cart-2.png" alt="">
									</div>
									<div class="collection-content">
										<p>Healthy Yellow Papaya</p>
										<h6>$120.00</h6>
									</div>
								</div>
								<div class="collection-btn">
									<a href="cart.html" class="theme-btn bg-blue no-shadow mx-auto">Add to Cart</a>
								</div>
							</div>
						</div>
						<div class="collection-item cart">
							<i class="flaticon-shopping-cart"></i>
							<div class="collection-inner">
								<div class="alert single-collection">
									<button data-dismiss="alert"><i class="flaticon-delete-button"></i></button>
									<div class="collection-image">
										<img src="{{ url('/') }}/assets/front/img/shop/cart-1.png" alt="">
									</div>
									<div class="collection-content">
										<p>Danish Full Cream Milk</p>
										<h6>$120.00</h6>
									</div>
								</div>
								<div class="alert single-collection">
									<button data-dismiss="alert"><i class="flaticon-delete-button"></i></button>
									<div class="collection-image">
										<img src="{{ url('/') }}/assets/front/img/shop/cart-2.png" alt="">
									</div>
									<div class="collection-content">
										<p>Healthy Yellow Papaya</p>
										<h6>$120.00</h6>
									</div>
								</div>
								<div class="collection-btn">
									<a href="cart.html" class="theme-btn bg-blue no-shadow mr-10">View Cart</a>
									<a href="checkout.html" class="theme-btn ml-auto no-shadow">Checkout</a>
								</div>
							</div>
						</div>
						<div class="collection-item profile">
							<i class="flaticon-user-1"></i>
							<div class="collection-inner">
								<ul>
									<li><a href="cart.html">Cart</a></li>
									<li><a href="checkout.html">Checkout</a></li>
									<li><a href="{{ url('login') }}">Login</a></li>
									<li><a href="{{ url('register') }}">Sign Up</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="main-menu">
						<button><i class="flaticon-list-menu"></i></button>
						<ul>
							<li><a href="{{ url('/') }}">Home</a></li>
							<li><a href="{{ url('categories') }}">Categories</a></li>
							<li><a href="{{ url('shop') }}">Shop</a></li>
							<li class="dropdown">
								<a href="#">User Account</a>
								<ul>
									<li><a href="{{ url('login') }}">Sign In</a></li>
									<li><a href="{{ url('register') }}">Sign Up</a></li>
								</ul>
							</li>
							<li><a href="{{ url('contact') }}">Contact</a></li>
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
							<div class="footer-logo">
								<a href="index-2.html"><img src="{{ url('/') }}/assets/front/img/logo-footer.png" alt="footer logo"></a>
							</div>
							<p>Praesent dapi cursus faucibus, tortor neque egestas auguae, eu vulputate magna eros erat. Aliquam erat volutpat.</p>
							<div class="footer-social-icon">
								<ul class="social-style-one">
									<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
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
								<li><a href="#"><img src="{{ url('/') }}/assets/front/img/pay-method/visa.png" alt=""></a></li>
								<li><a href="#"><img src="{{ url('/') }}/assets/front/img/pay-method/mastercard.png" alt=""></a></li>
								<li><a href="#"><img src="{{ url('/') }}/assets/front/img/pay-method/discover.png" alt=""></a></li>
								<li><a href="#"><img src="{{ url('/') }}/assets/front/img/pay-method/americanexpress.png" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">

						<div class="copyright text-center pl-10 pr-10 pt-30 pb-10 mt-10 mb-10">
							<p><a href="https://tf.techoners.com/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="efac809f969d8688879bafac809a86">[email&#160;protected]</a> 2019. All rights reserved</p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>


	<button class="scroll-top scroll-to-target" data-target="html">
		<span class="fa fa-angle-up"></span>
	</button>
	
	@section('scripts')
		<script src="{{ url('assets/front/js/jquery.min.js') }}"></script>
		<script src="{{ url('assets/front/js/bootstrap-v4.1.3.min.js') }}"></script>
		<script src="{{ url('assets/front/js/jquery.simpleLoadMore.min.js') }}"></script>
		<script src="{{ url('assets/front/js/slick.min.js') }}"></script>
		<script src="{{ url('assets/front/js/appear.js') }}"></script>
		<script src="{{ url('assets/front/js/rocket-loader.min.js') }}"></script>
		<script src="{{ url('assets/front/js/script.js') }}"></script>
	@show
</body>

</html>
