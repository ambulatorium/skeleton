@extends('layouts.master')

@section('title', 'Invite Staffs')

@section('content')
    <main class="col-md-4 offset-md-4 mt-4 mb-3">
        <h4 class="text-center">Invite Staff</h4>
        <hr>
        
        <form action="/settings/staffs" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-mail" autofocus required>
            </div>

            <div class="form-group form-check form-check-inline">
                @foreach($roles as $role)
                    <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="role" value="{{ $role->name }}"> {{ ucfirst($role->name) }}
                    </label>
                @endforeach
            </div>

            <div class="form-group">
                <button class="btn btn-block btn-danger" type="submit">INVITE</button>
                <a href="/settings/staffs" class="btn btn-block btn-secondary">CANCEL</a>
            </div>
        </form>
    </main>
@endsection