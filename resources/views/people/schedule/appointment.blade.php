@extends('layouts.master')

@section('title', Auth::user()->name)
@section('tab-appointments', 'active')

@section('content')

    @include('partials.people.tab')

        <div class="col-md-8 offset-md-2 mt-5">
            <div class="list-group">
                <h5 class="text-center">You have <strong>{{ $appointments->total() }}</strong> appointment with patient today.</h5>
                @forelse ($appointments  as $appointment)
                    <a href="/people/doctor/appointments/{{$appointment->token}}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mt-3">
                        #{{ $appointment->queue_number }} With {{ $appointment->user->name }}
                       
                        <span class="badge badge-info">
                            {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                        </span>
                    </a>
                @empty
                    <h5 class="text-center">When you have appointment, it'll show up here.</h5>
                @endforelse

            </div>
        </div>
@endsection