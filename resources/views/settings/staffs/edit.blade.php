@extends('layouts.master')

@section('title', 'Edit Staffs')

@section('content')
    <main class="col-md-4 offset-md-4 my-3 p-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-text text-capitalize">edit staff</h5>
            </div>
            <div class="card-body">
                <form action="/settings/staffs/{{ $user->id }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}

                    <div class="form-group">
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly>
                    </div>

                    @foreach($roles as $role)
                        <div class="form-group custom-control custom-radio custom-control-inline">
                            <input type="radio" id="userRole{{ $role->name }}" class="custom-control-input" name="roles[]" value="{{ $role->id }}" {{ $user->roles->implode('name', ' ') == $role->name ? 'checked' : '' }}>
                            <label class="custom-control-label" for="userRole{{ $role->name }}">{{ ucfirst($role->name) }}</label>
                        </div>
                    @endforeach

                    <hr>
                    <button class="btn btn-sm btn-danger" type="submit">UPDATE</button>
                    <a href="/settings/staffs" class="btn btn-sm btn-secondary">CANCEL</a>
                </form>
            </div>
        </div>
    </main>
@endsection