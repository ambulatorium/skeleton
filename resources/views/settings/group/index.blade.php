@extends('layouts.master')

@section('title', 'Settings')
@section('settings', 'active')
@section('sidebar_group', 'active')

@section('content')

    <div class="container mt-3">
        <div class="row">

            @include('partials.setting.menu')

            <main class="col-sm-9 ml-sm-auto col-md-10 mt-5 mb-5">
                
                <div class="card mb-3">

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

        </div>
    </div>

@endsection
