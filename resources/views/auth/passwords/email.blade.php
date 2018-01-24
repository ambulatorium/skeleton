@extends('layouts.auth')

@section('title', 'Reset Password')

@section('form')
    <div class="col-md-4 offset-md-4">
        <p class="text-center"><strong>Reset Your Password</strong></p><br>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email address" required autofocus>
                <span class="help-block text-muted">
                    <small>Reset Password you must be have validate email address</small>
                </span>
                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button class="btn btn-block btn-danger" type="submit">Reset</button>
                <p class="text-muted text-center mt-3">
                    Back to <a href="/login">Sign In</a> or <a href="/register">Sign Up</a>
                </p>
            </div>

        </form>
    </div>
@endsection