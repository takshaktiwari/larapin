@extends('layouts.app')

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.png') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">Profile</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item"><a href="{{ url('user/home') }}">Dashboard</a></li>
						<li class="breadcrumb-item active" aria-current="page">Profile</li>
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
								<h4 class="cart-heading">Update Profile</h4>
								<form action="{{ url('user/profile/update') }}" method="POST" enctype="multipart/form-data" class="mt-4">
									@csrf
									<div class="row">
										<div class="col-md-3 text-center mb-30">
											@if(empty(Auth::user()->user_img))
												<img class="rounded-circle img-thumbnail" src="{{ url('assets/user-avatar.png') }}" style="max-width: 150px;">
											@else
												<img class="rounded-circle img-thumbnail" src="{{ url('storage'.Auth::user()->user_img) }}" style="max-width: 150px;">
											@endif
										</div>
										<div class="col-md-9">
											<div class="form-group">
												<label for="user_img">Profile Image</label>
												<input type="file" name="user_img" class="form-control" id="user_img">
											</div>
											<div class="form-group">
												<label for="f-name">Your Name*</label>
												<input type="text" name="name" class="form-control" id="f-name" placeholder="Your full name" required value="{{ Auth::user()->name }}">
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="phone-number">Mobile Number*</label>
														<input type="text" name="mobile" class="form-control" id="phone-number" required="" placeholder="eg: 9900..." maxlength="10" minlength="10" value="{{ Auth::user()->mobile }}">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="email">Email*</label>
														<input type="email" name="email" class="form-control" id="email" placeholder="eg: yourmail@gmail.com" required value="{{ Auth::user()->email }}">
													</div>
												</div>
											</div>
											<input type="submit" class="theme-btn" value="Update">
										</div>
									</div>
								</form>
							</div>		        
						</div>
								
					</div>
					<!-- /#page-content-wrapper -->

				</div>
			</div>
		</div>
	</section>
@endsection