@extends('layouts.master')

@section('title', 'Invitation staffs')
@section('group-invitations', 'active')

@section('menu')
    @include('partials.master.menu.groups.setting')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <div class="card">
            <div class="card-header">
                <form action="/invitations" method="POST" class="form-inline float-right">
                    {{ csrf_field() }}
                
                    <input type="hidden" name="group_id" value="{{ $group->id }}" required>

                    <div class="form-group pr-1">
                        <select name="role" class="form-control form-control-sm" required>
                            <option value="">Select Role...</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}"> {{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group pr-1">
                        <input class="form-control form-control-sm" type="email" name="email" placeholder="input email address" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger btn-sm" type="submit">Send</button>
                    </div>
                </form>
                <h5 class="card-text text-capitalize">Invitations</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-rq">
                    <thead class="thead-rq">
                        <tr>
                            <th>E-mail</th>
                            <th>Role</th>
                            <th>Sent</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invitations as $invitation)
                            <tr>
                                <td>{{ $invitation->email }}</td>
                                <td>{{ $invitation->role }}</td>
                                <td>{{ $invitation->created_at->diffForHumans() }}</td>
                                <td>
                                    <form action="/invitations/{{ $invitation->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button class="btn btn-danger btn-sm" type="submit">delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td>Empty Invitations</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
