@extends('layouts.master')

@section('title', 'Manage groups')
@section('setting-groups', 'active') 

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
                        <th>Address</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($groups as $group)
                        <tr>
                            <td><a href="/{{ $group->slug }}">{{ $group->health_care_name }}</a></td>
                            <td>{{ $group->address }}</td>
                            <td>
                                <form action="{{ $group->path() }}" method="POST">
                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-sm" type="submit">delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="/settings/groups/create" class="btn btn-sm btn-light float-right active">Add New</a>

        {{ $groups->links('vendor.pagination.bootstrap-4') }}
        
    </main>
@endsection
