@extends('layouts.master')

@section('title', 'Group Staffs')
@section('sidebar_staffs', 'active')

@section('content')

    <div class="container mt-3">
        <div class="row">

            @include('partials.groups.settings.menu')

            <main class="col-sm-9 ml-sm-auto col-md-10 mt-5 mb-5">
                <div class="card mb-3">
                    <div class="card-header">
                        <a href="/{{ $group->slug }}/settings/invitations" class="btn btn-sm btn-outline-danger float-right">
                            Invite staff
                        </a>
                        <h5 class="card-text text-capitalize">staffs</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-rq">
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
                                    <tr><td>Empty Staff</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

        </div>
    </div>

@endsection
