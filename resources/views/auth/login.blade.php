@extends('auth.layouts.app')

@section('title', 'Login')

@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Enter your credentials to login your account</p>

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group has-feedback @error('email') has-error @enderror">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                    <small class="help-block">
                        <strong>{{ $message }}</strong>
                    </small>
                @enderror
            </div>
            <div class="form-group has-feedback @error('password') has-error @enderror">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @error('password')
                    <small class="help-block">
                        <strong>{{ $message }}</strong>
                    </small>
                @enderror
            </div>
            <div class="checkbox icheck">
                <label>
                    <input type="checkbox"> Remember Me
                </label>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat mt-2">Sign In</button>
        </form>

        <div class="text-center">
            <a href="#">Forgot Password?</a><br>
            <a href="#" class="text-center">Don't have an account? Sign Up</a>
        </div>

    </div>
@endsection
