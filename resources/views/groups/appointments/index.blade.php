@extends('layouts.master')

@section('title', $group->health_care_name)
@section('appointment-all', 'active') 

@section('menu')
    @include('partials.master.menu.groups.appointment')
@endsection

@section('content')
    <main class="col-md-8 offset-md-2 my-3 p-3">
        <div class="row">
            <div class="col-md-4 mb-3">
                <form action="/{{ $group->slug }}/appointments" method="get">
                    <input type="text" name="token" class="form-control bg-light box-shadow-table" value="{{request('token')}}" placeholder="search by token">
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-rq box-shadow-table">
                <thead class="thead-rq">
                    <tr>
                        <th>Patient Name</th>
                        <th>Token</th>
                        <th>Appointment date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->patient->full_name }}</td>
                            <td class="text-uppercase">
                                <a href="/{{$group->slug}}/appointments/{{$appointment->token}}">
                                    {{ $appointment->token }}
                                </a>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($appointment->date)->format('l') }},
                                {{ \Carbon\Carbon::parse($appointment->date)->format('d F Y')}},
                                {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td class="text-muted">...</td>
                        <td class="text-muted">...</td>
                        <td class="text-muted">...</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
@endsection