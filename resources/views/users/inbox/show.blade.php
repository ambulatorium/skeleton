@extends('layouts.master') 

@section('title', Auth::user()->name) 

@section('content')
<main class="col-md-8 offset-md-2 my-3 p-3 text-center">
    @if ($appointment->status === 'scheduled')
        <h1 class="mt-3">
            {{ \Carbon\Carbon::parse($appointment->date)->format('l') }}
            <p>{{ \Carbon\Carbon::parse($appointment->date)->format('d F Y') }}</p>
        </h1>

        <h5>
            <strong>
                Preferred Time {{ \Carbon\Carbon::parse($appointment->preferred_time)->format('H:ia') }}
                with {{ $appointment->doctor->full_name }}
            </strong>
        </h5>

        <h4 class="text-secondary">
            show this token <span class="badge badge-info text-uppercase">{{ $appointment->token }}</span> when visiting
            <p>{{ $appointment->doctor->group->name }}, {{ $appointment->doctor->group->address }}, {{ $appointment->doctor->group->city}}.
        </h4>

        <div class="list-group mt-5">
            <div class="list-group-item bg-light">
                <em>{{ $appointment->patient_condition }}</em>
            </div>
        </div>

        <div class="mt-5">
            <form action="/user/inbox/{{$appointment->token}}" method="POST">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                
                <a href="/user/inbox" class="btn btn-sm btn-outline-secondary">< back</a>
                <button class="btn btn-sm btn-outline-danger" type="submit">Cancel</button>
            </form>
        </div>
    @else
        <div class="alert alert-info text-center">
            you've checked-in. enjoy your treatment :)
        </div>
    @endif
</main>
@endsection