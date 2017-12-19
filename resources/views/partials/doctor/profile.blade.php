<h4>
    <strong>{{ $doctor->name }},</strong>
    <small class="text-muted"> {{ $doctor->gender }}</small>
</h4>

<h6>{{ $group->health_care_name }} - {{ $doctor->speciality->name }}</h6>

<ul class="list-group mt-4">
    <li class="list-group-item text-center text-muted">
        @if($doctor->bio)
            <em>"{{ $doctor->bio }}"</em>"
        @else
            <em>"No bio yet"</em>
        @endif
    </li>
</ul>