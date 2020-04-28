@extends('layouts.auth')

@section('content')
<div class="account-pages">
    <!-- Begin page -->
    <div class="accountbg h-100" style="background: url('{{ url('assets/admin/images/bg.jpg') }}');background-size: cover;background-position: center;position: fixed;"></div>

    <div class="wrapper-page account-page-full">

        <div class="card shadow-none m-0">
            <div class="card-block">

                <div class="account-box">

                    <div class="card-box shadow-none p-4">
                        <div class="p-2">
                            <div class="text-center mt-4">
                                <a href="{{ url('/') }}">
                                    <img src="{{ url('assets/admin/images/logo-dark.png') }}" height="22" alt="logo">
                                </a>
                            </div>

                            <h4 class="font-size-18 mt-5 text-center">Welcome Back !</h4>
                            <p class="text-muted text-center">Sign in to continue to Veltrix.</p>

                          <form class="mt-4" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="userpassword">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <div class="custom-control custom-checkbox">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <button type="submit" class="btn btn-primary w-md waves-effect waves-light">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>

                            <div class="form-group mt-2 mb-0 row">
                                <div class="col-12 mt-3">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link pl-0" href="{{ route('password.request') }}">
                                            <i class="fas fa-unlock-alt mr-1"></i>
                                            Forgot your password?
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </form>

                        <div class="mt-5 text-center">
                            <p>
                                Don't have an account ? 
                                @if (Route::has('register'))
                                    <a class="btn btn-link pl-0" href="{{ route('register') }}">
                                        <i class="fas fa-unlock-alt mr-1"></i>
                                        Signup now
                                    </a>
                                @endif
                            </p>
                            <p>
                                © <script>document.write(new Date().getFullYear())</script> 
                                {{ config('app.name', 'Laravel') }}. Crafted with by Themesbrand
                            </p>
                        </div>

                    </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection