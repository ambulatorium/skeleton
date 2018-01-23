<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-danger">
    <div class="container">

        @guest
            <a href="/" class="navbar-brand">
        @else
            <a href="/people" class="navbar-brand">
        @endguest
                <strong>RELIQUI</strong>
            </a>

        <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>

        @include('partials.master.navbar')

    </div>
</nav>