<div class="list-group">
    <div class="list-group-item bg-secondary text-white text-center">
        <img src="{{ asset('img/example-avatar.png') }}" alt="reliqui avatar" class="img-responsive mb-3 mt-3" width="150">
        <h4><strong>{{ Auth::user()->name }}</strong></h4>
        <small><strong>{{ Auth::user()->email }}</strong></small>
    </div>
</div>