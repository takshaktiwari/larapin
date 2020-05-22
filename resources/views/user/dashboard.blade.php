@extends('layouts.app')

@section('styles')
	@parent
	<style>
		.dashboard-links .block{
			margin: 5px;
		}
		.dashboard-links .block .icon{
			font-size: 24px;
		}
		.dashboard-links .block .link_title{
			font-size: 16px;
			font-weight: 800;
			text-transform: capitalize;
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
						<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
								<h4 class="cart-heading">Dashboard</h4>
								<div class="row">
									<div class="col-md-3">
										<div class="user-img">
											@if(empty(Auth::user()->user_img))
												<img class="rounded-circle img-thumbnail" src="{{ url('assets/user-avatar.png') }}" style="max-width: 150px;">
											@else
												<img class="rounded-circle img-thumbnail" src="{{ url('storage'.Auth::user()->user_img) }}" style="max-width: 150px;">
											@endif
										</div>
									</div>	
									<div class="col-md-9">
										<div class="user-detail py-3">
											<h3><label>Name:</label> {{ Auth::user()->name }}</h3>
											<h3><label>Email:</label> {{ Auth::user()->email }}</h3>
											@if(!empty(Auth::user()->mobile))
												<h3>
													<label>Mobile:</label> 
													{{ Auth::user()->mobile }}
												</h3>
											@endif
											<h3>
												<label>Password:</label> 
												<a href="{{ url('user/change_password') }}" class="font-weight-normal color-theme">Change Password</a>
											</h3>
										</div>
									</div>
								</div>
								
								<div class="dashboard-links d-flex flex-wrap mt-4">
									<a href="{{ url('user/orders') }}" class="block theme-btn rounded py-2 px-4 text-center text-white shadow-sm flex-fill">
										<div class="icon">
											<i class="fas fa-truck-loading"></i>
										</div>
										<div class="link_title">
											My Orders
										</div>
									</a>
									<a href="{{ url('user/wishlist') }}" class="block theme-btn rounded py-2 px-4 text-center text-white shadow-sm flex-fill">
										<div class="icon">
											<i class="fas fa-heart"></i>
										</div>
										<div class="link_title">
											My Wishlist
										</div>
									</a>
									<a href="{{ url('user/addresses') }}" class="block theme-btn rounded py-2 px-4 text-center text-white shadow-sm flex-fill">
										<div class="icon">
											<i class="fas fa-home"></i>
										</div>
										<div class="link_title">
											My Addresses
										</div>
									</a>
									<a href="{{ url('user/profile') }}" class="block theme-btn rounded py-2 px-4 text-center text-white shadow-sm flex-fill">
										<div class="icon">
											<i class="fas fa-pen-nib"></i>
										</div>
										<div class="link_title">
											Edit Profile
										</div>
									</a>
									<a href="{{ url('user/change_password') }}" class="block theme-btn rounded py-2 px-4 text-center text-white shadow-sm flex-fill">
										<div class="icon">
											<i class="fas fa-key"></i>
										</div>
										<div class="link_title">
											Change Passowrd
										</div>
									</a>
									<a href="{{ route('logout') }}" class="block theme-btn rounded py-2 px-4 text-center text-white shadow-sm flex-fill" 
		   							onclick="event.preventDefault();
		                 			document.getElementById('user-nav-logout-form').submit();">
										<div class="icon">
											<i class="fas fa-power-off"></i>
										</div>
										<div class="link_title">
											Logout
										</div>
									</a>
									<form id="user-nav-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									    @csrf
									</form>
								</div>
							</div>		        
						</div>
								
					</div>
					<!-- /#page-content-wrapper -->

				</div>
			</div>
		</div>
	</section>
@endsection