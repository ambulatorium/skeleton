@extends('layouts.master')

@section('title', 'Group Staffs')

@section('group-staffs', 'active')

@section('menu')
    @include('partials.master.menu.groups.setting')
@endsection
 
@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <div class="table-responsive">
            <table class="table table-hover table-rq box-shadow-table">
                <thead class="thead-rq">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Join Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($staffs as $staff)
                    <tr>
                        <td>{{ $staff->user->name }}</td>
                        <td>{{ $staff->user->email }}</td>
                        <td>{{ $staff->user->roles->implode('name', ' ') }}</td>
                        <td>{{ $staff->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <a href="/{{ $group->slug }}/settings/invitations" class="btn btn-sm btn-light float-right active">Invite staff</a>
    </main>
@endsection