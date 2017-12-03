<h4>
    <strong>{{ $doctor->name }},</strong>
    <small class="text-muted"> {{ $doctor->gender }}</small>
</h4>

<h6 class="text-muted">{{ $doctor->polyclinic->name }} | Rp{{ $doctor->price_of_service }}</h6>
<h6 class="text-muted">Date added {{ $doctor->created_at->format('j F, Y g:ia') }}</h6>

<ul class="list-group mt-3">
    <li class="list-group-item text-center text-muted">
        @if($doctor->bio)
            <em>"{{ $doctor->bio }}"</em>"
        @else
            <em>"No bio yet"</em>
        @endif
    </li>
</ul>