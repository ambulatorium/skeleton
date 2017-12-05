@can('edit-polyclinics')
    <div class="dropdown float-right">
        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="managePolyclinic" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Manage
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="managePolyclinic">
            <a href="/polyclinics/{{ $polyclinic->id }}/edit" class="dropdown-item">Edit</a>
            <a href="/polyclinics/{{ $polyclinic->id }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('delete-polyclinic').submit();">
                Delete
            </a>
        </div>
    </div>
@endcan

@can('delete-polyclinics')
    <form id="delete-polyclinic" action="/polyclinics/{{ $polyclinic->id }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
@endcan