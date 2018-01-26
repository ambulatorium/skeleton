<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('partials.master.head')

<body>
    <div id="app">
        <a href="/" class="text-center text-secondary"><h1>RELIQUI</h1></a>

        @include('partials.master.errors')

        <div id="flash-msg">
            @include('flash::message')
        </div>

        @yield('form')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $(function () {
            // flash auto hide
            $('#flash-msg .alert').not('.alert-danger, .alert-important').delay(3000).slideUp(500);
        })
    </script>
</body>
</html>