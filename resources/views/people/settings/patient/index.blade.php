@extends('layouts.master')

@section('title', 'Your Profile')
@section('sidebar_patients', 'active')

@section('content')
    <div class="container mt-5">
        <div class="row">

            @include('partials.people.settings.sidebar')

            <main class="col-sm-8 ml-sm-auto col-md-9 mb-5">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('patient-form.create') }}" class="btn btn-outline-danger btn-sm float-right">Add New</a>
                        <h4 class="card-text">Your patient form</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-rq">
                            <thead class="thead-rq">
                                <tr>
                                    <th>Form Name</th>
                                    <th>Patient Name</th>
                                    <th>Gender</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->form_name }}</td>
                                        <td>{{ $patient->full_name }}</td>
                                        <td>{{ $patient->gender }}</td>                                        
                                        <td>
                                            <form action="{{ route('patient-form.destroy', $patient->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <a href="{{ route('patient-form.edit', $patient->id) }}" class="btn btn-secondary btn-sm">edit</a>
                                                <button class="btn btn-danger btn-sm" type="submit">delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td>You don't have any patient form</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </main>

        </div>
    </div>
@endsection