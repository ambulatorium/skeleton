<div class="col-md-12">
    <div class="list-group">
        <div class="list-group-item">
            <a class="float-right btn btn-sm btn-outline-info" data-toggle="collapse" href="#expand-bio" aria-expanded="false" aria-controls="expand-bio">Expand</a>
            <strong>{{ $doctor->full_name }}</strong>
            <p>{{ $doctor->group->health_care_name }} - {{ $doctor->speciality->name }}</p>

            <div class="collapse mt-3" id="expand-bio">
                <div class="alert alert-info bg-light">
                    <ul>
                        <li>
                            {{ $doctor->years_of_experience }} Years of experience
                        </li>
                        <li>
                            {{ $doctor->qualification }}
                        </li>
                    </ul>
                    <hr>
                    <div class="text-center">{{ $doctor->bio }}</div>
                </div>
            </div>
        </div>  
    </div>
</div>