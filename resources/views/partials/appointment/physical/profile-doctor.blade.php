<div class="col-md-12">
    <div class="list-group">
        <div class="list-group-item">
            <a class="float-right btn btn-sm btn-outline-danger" data-toggle="collapse" href="#expand-bio" aria-expanded="false" aria-controls="expand-bio">Expand</a>
            <strong>{{ $doctor->user->name }}</strong>
            <p>{{ $doctor->group->health_care_name }} - {{ $doctor->speciality->name }}</p>

            <div class="collapse mt-3" id="expand-bio">
                <div class="alert alert-info text-center">
                    coming soon..
                </div>
            </div>
        </div>  
    </div>
</div>