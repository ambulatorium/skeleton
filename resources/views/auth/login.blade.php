@extends('layouts.auth')

@section('title', 'Masuk Akun')

@section('form')

<div class="col-md-4 offset-md-4">
    <p class="text-center"><strong>Sign In with email account</strong></p><br>

    <p class="text-muted">Don't have an account? <a href="/register">Sign Up</a></p>
    <form method="POST" action="{{ route('login') }}" class="form-horizontal">
        {{ csrf_field() }}

        <div class="form-group">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email address" required autofocus>
            @if ($errors->has('email'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            @if ($errors->has('password'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <div class="d-flex w-100 justify-content-between">
                {{--  <div class="checkbox mt-2">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> remember me
                    </label>
                </div>  --}}

                <a href="{{ route('password.request') }}"> Forgot Password?</a>
            </div>

        </div>

        <div class="form-group">
            <button class="btn btn-block btn-danger" type="submit">Sign In</button>
            <p class="text-muted text-center mt-3">-or-</p>
            <a href="#" class="btn btn-block btn-secondary">Sign In with Google <em>(coming soon)</em></a>
            <a href="#" class="btn btn-block btn-secondary">Sign In with Facebook <em>(coming soon)</em></a>
        </div>

    </form>
</div>

@endsection