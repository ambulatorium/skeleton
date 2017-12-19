@extends('layouts.master')

@section('title', 'Settings - Speciality')
@section('sidebar_specialities', 'active')

@section('content')

    <div class="container mt-3">
        <div class="row">

            @include('partials.setting.menu')

            <main class="col-sm-9 ml-sm-auto col-md-10 mt-5 mb-5">
                
                <div class="card mb-3">

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

        </div>
    </div>

@endsection
