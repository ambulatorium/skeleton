@extends('layouts.master')

@section('title', 'Patients')
@section('patients', 'active')

@section('content')

    <div class="container">
        <div class="row">
        
            <main class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <a href="/patients/create" class="btn btn-outline-danger btn-sm float-right">Add Patient</a>
                        <h4 class="card-text">Patient's Data</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>City</th>
                                    <th>State</th>
                                    <th>Home Phone</th>
                                    <th>Cell Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($patients as $patient)
                                    <tr>
                                        <td><a href="#">{{ $patient->user->name }}</a></td>
                                        <td>{{ $patient->user->email }}</td>
                                        <td>{{ $patient->gender }}</td>
                                        <td>{{ $patient->city }}</td>
                                        <td>{{ $patient->state }}</td>
                                        <td>{{ $patient->home_phone }}</td>
                                        <td>{{ $patient->cell_phone }}</td>
                                    </tr>
                                @empty
                                    <tr><td class="text-muted">No patients yet...</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $patients->links('vendor.pagination.bootstrap-4') }}
                </div>

            </main>
        </div>
    </div>

@endsection
