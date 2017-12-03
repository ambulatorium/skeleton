<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('partials.master.head')

</head>

<body>
    <div id="app">

        @include('partials.master.header')

        @include('flash::message')

        <div class="mt-5">
            @yield('content')
        </div>

        @include('partials.master.footer')

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
