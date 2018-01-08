<div class="list-group">
    <div class="list-group-item">
        <a class="float-right btn btn-sm btn-outline-danger" data-toggle="collapse" href="#expand-bio" aria-expanded="false" aria-controls="expand-bio">Expand</a>
        <strong>{{ $appointment->user->name }}</strong>
        <p>{{ $appointment->user->patient->address }} - {{ $appointment->user->patient->city }}</p>

        <div class="collapse mt-3" id="expand-bio">
            <div class="alert alert-info text-center">
                coming soon..
            </div>
        </div>
    </div>  
</div>