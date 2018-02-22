@extends('layouts.master')

@section('title', 'Manage Specialities')
@section('setting-specialities', 'active')

@section('menu')
    @include('partials.master.menu.users.appSettings')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <div class="table-responsive">
            <table class="table table-hover table-rq box-shadow-table">
                <thead class="thead-rq">
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($specialities as $speciality)
                        <tr>
                            <td>{{ $speciality->name }}</td>
                            <td>{{ $speciality->slug }}</td>
                            <td>{{ $speciality->description }}</td>
                            <td>
                                <form action="{{ route('specialities.destroy', $speciality) }}" method="POST">
                                    @method('delete')
                                    @csrf

                                    <a href="{{ route('specialities.edit', $speciality) }}" class="btn btn-secondary btn-sm">edit</a>
                                    <button class="btn btn-danger btn-sm" type="submit">delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Empty.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <a href="{{ route('specialities.create') }}" class="btn btn-sm btn-light float-right active">New Speciality</a>

        {{ $specialities->links('vendor.pagination.bootstrap-4') }}

    </main>
@endsection
