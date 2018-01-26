@extends('layouts.master')

@section('title', 'Manage Specialities')
@section('setting-specialities', 'active')

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
                        <th>Description</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($specialities as $speciality)
                        <tr>
                            <td>{{ $speciality->name }}</td>
                            <td>{{ $speciality->description }}</td>
                            <td>
                                <form action="/settings/specialities/{{ $speciality->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <a href="/settings/specialities/{{ $speciality->id }}/edit" class="btn btn-secondary btn-sm">edit</a>
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

        <a href="/settings/specialities/create" class="btn btn-sm btn-light float-right active">Add new</a>

        {{ $specialities->links('vendor.pagination.bootstrap-4') }}

    </main>
@endsection
