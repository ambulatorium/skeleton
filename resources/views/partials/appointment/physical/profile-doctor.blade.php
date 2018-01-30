<div class="col-md-12">
    <div class="list-group">
        <div class="list-group-item">
            <a class="float-right btn btn-sm btn-outline-info" data-toggle="collapse" href="#expand-bio" aria-expanded="false" aria-controls="expand-bio">Expand</a>
            <strong>{{ $schedule->doctor->full_name }}</strong>
            <p>{{ $schedule->doctor->group->health_care_name }} - {{ $schedule->doctor->speciality->name }}</p>

            <div class="collapse mt-3" id="expand-bio">
                <div class="alert alert-info bg-light">
                    <ul>
                        <li>
                            {{ $schedule->doctor->years_of_experience }} Years of experience
                        </li>
                        <li>
                            {{ $schedule->doctor->qualification }}
                        </li>
                    </ul>
                    <hr>
                    <div class="text-center">{{ $schedule->doctor->bio }}</div>
                </div>
            </div>
        </div>  
    </div>
</div>