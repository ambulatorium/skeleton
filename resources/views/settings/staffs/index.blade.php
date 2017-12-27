@extends('layouts.master')

@section('title', 'Settings - Staffs')
@section('menu_staffs', 'active')

@section('content')
            
    <div class="container mt-3">
        <div class="row">

            @include('partials.setting.menu')

            <main class="col-sm-9 ml-sm-auto col-md-10 mt-5 mb-5">
                <div class="card">

                    <div class="card-header">
                        <a href="/settings/staffs/create" class="btn btn-outline-danger btn-sm float-right">Invite staff</a>
                        <h4 class="card-text">Staff Management</h4>
                    </div>
                
                    <div class="table-responsive">
                        <table class="table table-hover table-rq">
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

                </div>
            </main>
        
        </div>
    </div>

@endsection
