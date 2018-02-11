@extends('layouts.master')

@section('title', 'Account settings')
@section('setting-account', 'active')

@section('menu')
    @include('partials.master.menu.users.setting')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-text text-capitalize">Your account</h5>
            </div>
            <div class="card-body">

                <form action="/user/settings/account/{{ Auth::user()->id }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" readonly required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="******">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="******">
                        </div>
                    </div>

                    <hr>
                    <button class="btn btn-sm btn-danger" type="submit"><strong>UPDATE</strong></button>
                </form>

            </div>
        </div>
    </main>
@endsection