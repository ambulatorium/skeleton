<div class="text-center pt-3">
    <img src="{{ asset('img/example-avatar.png') }}" alt="avatar" class="img-responsive" width="70" height="70">
    <h4 class="pt-2 text-dark font-weight-light">{{$doctor->full_name}}</h4>
    
    <h6 class="text-dark">
        <a href="/doctors/{{$doctor->speciality->slug}}">
            {{$doctor->speciality->name}}
        </a>
    </h6>

    <h6 class="text-dark">
        {{$doctor->years_of_experience}} years of experience 
        -
        {{$doctor->qualification}} qualification.
    </h6>

    <h6 class="text-secondary">
        <em>"{{$doctor->bio}}"</em>
    </h6>
</div>