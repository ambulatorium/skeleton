@foreach($doctors as $doctor)
    <div class="col-md-3 mb-1">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title"><a href="/doctors/{{ $doctor->id }}">{{ $doctor->name }}</a></h5>
                <p class="card-text"><span class="badge badge-info">{{ $doctor->polyclinic->name }}</span></p>
                {{--  <p class="card-text">{{ $doctor->bio }}</p>  --}}
            </div>
        </div>
    </div>
@endforeach

@can('add-doctors')
    <div class="col-12 mb-2 mt-2">
        <a href="/doctors/create" class="btn btn-outline-danger btn-sm">Create New</a>
    </div>
@endcan