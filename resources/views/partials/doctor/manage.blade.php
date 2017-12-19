@can('edit-doctors')
    <div class="dropdown float-right">
        <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="manageDoctor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Manage
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="manageDoctor">
            <a href="/doctors/appointments/{{ $doctor->name }}" class="dropdown-item">Appointments</a>
            <a data-toggle="modal" data-target="#createSchedule" class="dropdown-item">Schedule</a>
            <a href="/doctors/{{ $doctor->name }}/edit" class="dropdown-item">Edit</a>
            <a href="/doctors/{{ $doctor->name }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('delete-doctors').submit();">
                Delete
            </a>
        </div>
    </div>
@endcan

@can('delete-doctors')
    <form id="delete-doctors" action="/doctors/{{ $doctor->name }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
    </form>
@endcan