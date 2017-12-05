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

<div class="col-12 mt-4">
    {{ $doctors->links('vendor.pagination.bootstrap-4') }}

    @can('add-doctors')
        <a href="/doctors/create" class="btn btn-outline-danger btn-sm">Create New</a>
    @endcan
</div>