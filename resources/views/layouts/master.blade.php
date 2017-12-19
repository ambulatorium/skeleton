<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('partials.master.head')

</head>

<body>
    <div id="app">

        @include('partials.master.header')

        @include('partials.master.errors')

        <div id="flash-msg">
            @include('flash::message')
        </div>

        {{--  <div class="mt-4">  --}}
            @yield('content')
        {{--  </div>  --}}

        @include('partials.master.footer')

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
