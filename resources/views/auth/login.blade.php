@extends('layouts.app')

@section('content')
	<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.webp') }}');">
		<div class="container">
			<div class="banner-inner text-center">
				<h2 class="page-title">Login</h2>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Login</li>
					</ol>
				</nav>
			</div>
		</div>
	</section>

	<section class="login-area my-120 rmy-80">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 pr-0 rpr-15 rmb-80">
					<div class="login-information bg-white br-5">
						<div class="login-info-inner">
							<h2>Welcome Back</h2>
							<form action="{{ route('login') }}" method="POST" class="login-form">
								@csrf
								<div class="email-field">
									<label for="email">Enter Email / Mobile*</label>
									<input id="email" type="text" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
	                                @error('email')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="password-field">
									<label for="pass">Password*</label>
									<input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
	                                @error('password')
	                                    <span class="invalid-feedback" role="alert">
	                                        <strong>{{ $message }}</strong>
	                                    </span>
	                                @enderror
								</div>
								<div class="alternative-login">
									@if (Route::has('password.request'))
										<span>
											<a href="{{ route('password.request') }}">
												Forget Password
											</a>
										</span>
                                	@endif
									<span>Don't Have Account ?<a class="signup-link" href="{{ url('register') }}">Sign Up</a></span>
								</div>
								<div class="signin-button-wrap">
									<button type="submit" class="btn-bg2">
									    {{ __('Login') }}
									</button>
								</div>
							</form>
							<div class="or-text">or you can join with</div>
							<div class="share-btn-wrap">
								<div class="facebook-btn">
									<a href="{{ url('auth/facebook') }}"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
								</div>
								<div class="google-btn">
									<a href="{{ url('auth/google') }}"><i class="fab fa-google"></i><span>Google</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-7 px-0 rpl-15">
					<div class="login_img bg-white">
						<img src="{{ url('assets/front/img/log-in.png') }}" alt="">
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection