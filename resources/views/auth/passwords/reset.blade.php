@extends('layouts.auth')

@section('title', 'Reset Kata Sandi')

@section('form')

<div class="col-md-4 offset-md-4 mt-3">
    <p class="text-center"><strong>Reset Your Password</strong></p><br>

    <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="email address" required autofocus>
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
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
            @if ($errors->has('password_confirmation'))
                <span class="help-block text-danger">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <button class="btn btn-block btn-danger" type="submit">Reset Password</button>
        </div>

    </form>
</div>

@endsection