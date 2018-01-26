@extends('layouts.master')

@section('title', 'Manage Staffs')
@section('setting-staffs', 'active') 

@section('menu')
    @include('partials.master.menu.users.app-settings')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <div class="table-responsive">
            <table class="table table-hover table-rq box-shadow-table">
                <thead class="thead-rq">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Join Date</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roles->implode('name', ' ') }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="/settings/staffs/{{ $user->id }}/edit" class="btn btn-secondary btn-sm">edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <a href="/settings/staffs/create" class="btn btn-sm btn-light float-right active">Invite</a>
        
    </main>
@endsection
