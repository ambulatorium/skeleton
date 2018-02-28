<div class="row mb-3">
    <div class="col-md-4">
        <div class="dropdown show">
            <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ request('date') ? Carbon\Carbon::parse(request('date'))->format('l, d F Y') : 'All appointment'}}
            </a>
            
            <div class="dropdown-menu bg-light" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="/{{$group->slug}}/appointments">All</a>
                <a class="dropdown-item" href="/{{$group->slug}}/appointments?date={{today()->format('Y-m-d')}}">Today</a>
                <a class="dropdown-item" href="/{{$group->slug}}/appointments?date={{Carbon\Carbon::tomorrow()->format('Y-m-d')}}">Tomorrow</a>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <form action="/{{ $group->slug }}/appointments" method="get">
            <input type="text" name="token" class="form-control bg-light" value="{{request('token')}}" placeholder="search by token">
        </form>
    </div>
</div>