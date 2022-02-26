@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="register_page">
    <div class="login mt-5 mb-5">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h5>Register</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="name" class="control-label">{{ __('Name') }}</label>

                                    <div class="">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>

                                    <div class="">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="control-label">{{ __('Password') }}</label>

                                    <div class="">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="control-label">{{ __('Confirm Password') }}</label>

                                    <div class="">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-3">Register</button>
                                </div>
                            </form>
                            {{-- <form action="" method="post">
                                <div class="form-floating mb-3">
                                    <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" required>
                                    <label for="floatingInput">Username</label>
                                </div>
                                <div class="form-floating mb-2">
                                    <input type="email" class="form-control" id="floatingemail" placeholder="Email" required>
                                    <label for="floatingemail">Email</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-3">Register</button>
                                </div>
                            </form> --}}
                            <!-- social login -->
                            <div class="social-login mt-3 text-center">
                                <h6>Register with ...</h6>
                                <ul class="list-group list-group-horizontal d-flex justify-content-center" >
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
