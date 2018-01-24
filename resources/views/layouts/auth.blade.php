<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('partials.master.head')

<body>
    <div id="app">
        <a href="/" class="text-center text-secondary"><h1>RELIQUI</h1></a>

        @yield('form')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>