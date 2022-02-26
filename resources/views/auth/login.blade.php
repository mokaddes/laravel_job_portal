@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="login_page">
    <div class="login mt-5 mb-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h5>Login</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-floating mb-3">

                                    <input id="floatingInput" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <label for="floatingInput">Email</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="form-floating mb-2">

                                    <input id="floatingPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    <label for="floatingPassword">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="mb-1 forgot-pass">
                                    <a href="{{ route('password.request') }}">I forgot my password</a>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-3">Login</button>
                                </div>
                            </form>
                            <!-- social login -->
                            <div class="social-login mt-3 text-center">
                                <h6>Login with ...</h6>
                                <ul class="list-group list-group-horizontal justify-content-center" >
                                    <li class="list-inline-item">
                                        <a href=" {{ route('login.facebook') }} " class="fb"><i class="fab fa-facebook"></i></a>
                                    </li>
                                    {{-- <li class="list-inline-item">
                                        <a href="" class="lin"><i class="fab fa-linkedin"></i></a>
                                    </li> --}}
                                    <li class="list-inline-item">
                                        <a href="{{ route('login.google') }}" class="gle"><i class="fab fa-google"></i></a>
                                    </li>
                                    {{-- <li class="list-inline-item">
                                        <a href="{{ route('login.github') }}" class="git"><i class="fab fa-github"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="xin"><i class="fab fa-xing"></i></a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
