<div class="col-md-4">
    <div class="list-group-item">
        <strong>Health History</strong>
    </div>

    <div id="accordion" role="tablist">
        <div class="list-group">

            @forelse ($healthHistories as $healthHistory)
                <div class="list-group-item">
                    <strong class="mb-0">
                        <a data-toggle="collapse" href="#{{$healthHistory->id}}" role="button" aria-expanded="true" aria-controls="{{$healthHistory->id}}">
                            #{{ $healthHistory->created_at->diffForHumans() }}
                        </a>
                    </strong>
                </div>
                <div id="{{$healthHistory->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$healthHistory->id}}" data-parent="#accordion">
                    <div class="list-group-item bg-light">
                        <strong>Diagnosis by {{ $healthHistory->doctor->full_name }}</strong>
                        {{ $healthHistory->doctor_diagnosis}}
                        <hr>
                        <strong>Action by {{ $healthHistory->doctor->full_name }}</strong>
                        <p>
                        {{ $healthHistory->doctor_action }}
                        <hr>
                        <strong>Note by {{ $healthHistory->doctor->full_name }}</strong>
                        <p>
                        {{ $healthHistory->doctor_note }}
                    </div>
                </div>
            @empty
                <div class="list-group-item">
                    <strong>EMPTY</strong>
                </div>
            @endforelse
            
        </div>
    </div>
</div>