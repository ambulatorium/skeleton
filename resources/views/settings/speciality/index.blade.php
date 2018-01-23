@extends('layouts.master')

@section('title', 'Manage Specialities')
@section('manage-specialities', 'active')

@section('menu')
    @include('partials.master.menu.manage')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 mt-3 mb-3">
        <div class="card">
            <div class="card-header">
                <a href="/settings/specialities/create" class="btn btn-outline-danger btn-sm float-right">Add New</a>
                <h4 class="card-text">Specialities</h4>
            </div>
        
            <div class="table-responsive">
                <table class="table table-hover table-rq">
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
                            <tr><td>Empty</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        {{ $specialities->links('vendor.pagination.bootstrap-4') }}

    </main>
@endsection
