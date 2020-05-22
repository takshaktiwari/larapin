@extends('layouts.app')

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.webp') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">My Addresses</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Addresses</li>
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
						<div class="cart-total-product b1 br-5 p-25">
                        	<h4 class="cart-heading">Change Password</h4>
							<form action="{{ url('user/change_password') }}" method="POST">
								@csrf
								<div class="row">
									<div class="col-md-7">
										<div class="form-group">
											<label for="old_password">Old Password*</label>
											<input type="password" name="old_password" class="form-control" id="old_password" placeholder="Old Password" required value="{{ old('old_password') }}">
										</div>
										<div class="form-group">
											<label for="new_password">New Password*</label>
											<input type="password" name="new_password" class="form-control" id="new_password" placeholder="New Password" required value="{{ old('new_password') }}">
										</div>
										<div class="form-group">
											<label for="new_password_confirmation">Confirm New Password*</label>
											<input type="password" name="new_password_confirmation" class="form-control" id="new_password_confirmation" placeholder="Confirm New Password" required value="{{ old('new_password_confirmation') }}">
										</div>
										<input type="submit" class="theme-btn">
									</div>
								</div>
								
							</form>
                    	</div>		        
					</div>
					<!-- /#page-content-wrapper -->

				</div>
			</div>
		</div>
	</section>
@endsection