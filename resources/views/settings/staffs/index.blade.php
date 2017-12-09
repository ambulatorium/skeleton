@extends('layouts.master')

@section('title', 'Settings - Staffs')
@section('settings', 'active')
@section('menu_staffs', 'active')

@section('content')
            
    <div class="container">
        <div class="row">

            @include('partials.setting.menu')

            <main class="col-sm-9 ml-sm-auto col-md-10 mt-5 mb-5">
                <div class="card">

                    <div class="card-header">
                        <a href="/settings/staffs/create" class="btn btn-outline-danger btn-sm float-right">Add Staff</a>
                        <h4 class="card-text">Staff Management</h4>
                    </div>
                
                    <div class="table-responsive">
                        <table class="table table-hover table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Date Added</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->roles->implode('name', ' ') }}</td>
                                        <td>{{ $user->created_at->format('d F Y, h:ia') }}</td>
                                        <td>
                                            <form action="/settings/staffs/{{ $user->id }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href="/settings/staffs/{{ $user->id }}/edit" class="btn btn-secondary btn-sm">edit</a>
                                                <button class="btn btn-danger btn-sm" type="submit">delete</button>
                                            </form>
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
