@extends('layouts.master')

@section('title', 'Manage groups')
@section('manage-groups', 'active') 

@section('menu')
    @include('partials.master.menu.manage')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 mt-3 mb-3">
        <div class="card">
            <div class="card-header">
                <a href="/settings/groups/create" class="btn btn-outline-danger btn-sm float-right">Add New</a>
                <h4 class="card-text text-capitalize">{{ config('app.name', 'reliqui') }} Group</h4>
            </div>
        
            <div class="table-responsive">
                <table class="table table-hover table-rq">
                    <thead class="thead-rq">
                        <tr>
                            <th>Health Care Name</th>
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
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        {{--  <a href="{{ $group->editGroup() }}" class="btn btn-secondary btn-sm">edit</a>  --}}
                                        <button class="btn btn-danger btn-sm" type="submit">delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td>Empty</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        {{ $groups->links('vendor.pagination.bootstrap-4') }}

    </main>
@endsection
