@extends('layouts.master')

@section('title', 'Settings - Staffs')
@section('settings', 'active')
@section('menu_staffs', 'active')

@section('content')

    <main class="col-md-4 offset-md-4">

        <div class="card">
            <div class="card-header">
                <h4 class="card-text text-center">Edit Staff</h4>
            </div>
            <div class="card-body">
                <form action="/settings/staffs/{{ $user->id }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" autofocus required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" placeholder="E-mail" required>
                    </div>

                    <div class="form-group form-check form-check-inline">
                        @foreach($roles as $role)
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="roles[]" value="{{ $role->id }}" {{ $user->roles->implode('name', ' ') == $role->name ? 'checked' : '' }} > {{ ucfirst($role->name) }}
                            </label>
                        @endforeach
                    </div>

                                    
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-block btn-danger" type="submit">UPDATE</button>
                        <a href="/settings/staffs" class="btn btn-block btn-secondary">CANCEL</a>
                    </div>

                </form>
            </div>
        </div>

    </main>

@endsection