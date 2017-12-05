@foreach($polyclinics as $polyclinic)
    <div class="col-md-3 mb-1">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title"><a href="/polyclinics/{{ $polyclinic->id }}">{{ $polyclinic->name }}</a></h5>
                <p class="card-text"><span class="badge badge-info">Location on the {{ $polyclinic->location }}</span></p>
                {{--  <p class="card-text text-muted">
                    {{ $polyclinic->service_description }}
                </p>  --}}
            </div>
        </div>
    </div>
@endforeach

@can('add-polyclinics')
    <div class="col-12 mb-2 mt-4">
        <a href="/polyclinics/create" class="btn btn-outline-danger btn-sm">Create New</a>
    </div>
@endcan