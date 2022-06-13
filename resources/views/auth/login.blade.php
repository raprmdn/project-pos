@extends('auth.layouts.app')

@section('title', 'Login')
@section('body-page', 'login-page')

@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="{{ route('index') }}" class="h1"><b>Point</b> of <b>Sales</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your experience</p>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                               name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                               placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm btn-block">Sign In</button>
                </form>
                <p class="mb-0 mt-2 d-flex justify-content-center">
                    <a href="#" class="text-center text-sm">Doesn't have an account?</a>
                </p>
            </div>

        </div>
    </div>
@endsection
