<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('partials.master.head')

<body>
    <div id="app">

        <header class="navbar navbar-expand navbar-light justify-content-center">
            <a href="/" class="navbar-brand"><h1>RELIQUI</h1></a>
        </header>

        @include('flash::message')

        @yield('form')
        
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>