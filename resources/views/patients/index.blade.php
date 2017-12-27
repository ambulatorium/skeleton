@extends('layouts.master')

@section('title', 'Patients')
@section('patients', 'active')

@section('content')

    <div class="container">
        <div class="row">
        
            <main class="col-md-12">

                <div class="card tbr-0 mb-2">
                    <div class="card-header">
                        <h4 class="card-text">All Patient</h4>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-rq">
                            <thead class="thead-rq">
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
                </div>

                {{ $patients->links('vendor.pagination.bootstrap-4') }}

            </main>
            
        </div>
    </div>

@endsection
