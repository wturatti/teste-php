<html>
    <head>
        <title>App - @yield('title')</title>
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <script src="{{ asset('js/jquery.mask.min.js') }}" defer></script>
    </head>
    <body>
        @yield('top')

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>