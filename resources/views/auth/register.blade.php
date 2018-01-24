@extends('layouts.auth')

@section('title', 'Register')

@section('form')
    <div class="col-md-4 offset-md-4">
        <p class="text-center"><strong>Register New Account</strong></p><br>
        <p class="text-muted">Have Account? <a href="/login">Sign Here</a></p>

        <form method="POST" action="{{ route('register') }}" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full Name" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email address" required>
                @if ($errors->has('email'))
                    <span class="help-block text-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <button class="btn btn-block btn-danger" type="submit">Register</button>
            </div>

        </form>
    </div>
@endsection
