@extends('layouts.app')

@section('content')
    <section class="banner-section" style="background-image:url('{{ url('assets/front/img/banner.webp') }}');">
        <div class="container">
            <div class="banner-inner text-center">
                <h2 class="page-title">Sign Up</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section class="login-area my-120 rmy-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 pr-0 rpr-15 rmb-80">
                    <div class="login-information bg-white br-5 py-125">
                        <div class="login-info-inner">
                            <h2>Sign Up</h2>
                            <form method="POST" action="{{ route('register') }}" class="login-form">
                                @csrf
                                <div class="text-field">
                                    <label for="name">Full Name*</label>
                                    <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="email-field">
                                    <label for="email">Enter Email*</label>
                                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="password-field">
                                    <label for="pass">Password*</label>
                                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="password-field">
                                    <label for="pass">Password*</label>
                                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="alternative-login">
                                    Do You Have Account ?<a class="signup-link" href="{{ url('login') }}">Login</a>
                                </div>
                                <div class="signin-button-wrap">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
                <div class="col-lg-7 px-0 rpl-15 login-image-wrap">
                    <div class="login_img">
                        <img src="{{ url('assets/front/img/sign-up.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
