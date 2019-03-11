<header class="container navbar navbar-expand navbar-light">
    <a class="navbar-brand text-dark mr-auto" href="/">
        <h1>RELIQUI</h1>
    </a>

    @auth('reliqui')
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/ambulatory">
                    <img src="{{ auth('reliqui')->user()->avatar }}"
                        alt="{{ auth('reliqui')->user()->name }}"
                        class="img-responsive rounded-circle"
                        width="40"
                        height="40">
                </a>
            </li>
        </ul>
    @else
        <div class="navbar-nav">
            <a href="ambulatory/login" class="btn btn-light shadow-sm text-uppercase mr-2">Sign in</a>
            <a href="ambulatory/register" class="btn btn-primary shadow-sm text-uppercase">Get started</a>
        </div>
    @endauth
</header>