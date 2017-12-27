@extends('layouts.auth')

@section('title', 'Invitation')

@section('form')

<div class="col-md-4 offset-md-4 mt-3">
    <p class="text-center">
        <strong>Accept Invitation with new account</strong>
    </p><br>

    <p class="text-muted">You're invited to Join {{ config('app.name') }} as a {{ $invite->role }}</a></p>
    <form method="POST" action="{{ route('join', $invite->token) }}" class="form-horizontal">
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
            <input type="email" class="form-control" name="email" value="{{ old('email', $invite->email) }}" readonly>
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
            <button class="btn btn-block btn-danger" type="submit">JOIN</button>
        </div>

    </form>

</div>

@endsection