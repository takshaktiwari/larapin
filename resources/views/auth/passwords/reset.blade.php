@extends('layouts.app')

@section('content')

<section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.png') }}');">
    <div class="container">
        <div class="banner-inner text-center">
            <h2 class="page-title">Password Reset</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Password Reset</li>
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
                        <h2>Password</h2>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('password.update') }}" method="POST" class="login-form">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('New Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter new password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm New password">
                            </div>

                            <div class="alternative-login">
                                <span class="mr-1">
                                    <a href="{{ url('Login') }}">
                                        Login Here
                                    </a>
                                </span>
                                <span>Don't Have Account ?<a class="signup-link" href="{{ url('register') }}">Sign Up</a></span>
                            </div>
                            <div class="signin-button-wrap">
                                <button type="submit" class="btn-bg2">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>

                        </form>
                        <div class="or-text">or you can join with</div>
                        <div class="share-btn-wrap">
                            <div class="facebook-btn">
                                <a href="#"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
                            </div>
                            <div class="google-btn">
                                <a href="#"><i class="fab fa-google"></i><span>Google</span></a>
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
