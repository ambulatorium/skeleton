<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('partials.master.head')

</head>

<body>
    <div id="app">

        @include('partials.master.header')
        
        @yield('menu')
        
        @include('partials.master.errors')

        <div id="flash-msg">
            @include('flash::message')
        </div>

        @yield('content')
        
        @include('partials.master.footer')

    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        $(function () { 
            'use strict' 
            $('[data-toggle="offcanvas"]').on('click', function () { 
                $('.offcanvas-collapse').toggleClass('open')
            }) 
        })
    </script>

    <script>
        $(function () {
            // flash auto hide
            $('#flash-msg .alert').not('.alert-danger, .alert-important').delay(3000).slideUp(500);
        })
    </script>

</body>
</html>
