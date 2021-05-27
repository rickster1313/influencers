<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Influencers</title>
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/icofont.min.css') }}">
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
        <script src="{{ asset('assets/js/bundle.min.js') }}"></script>
        <script type="text/javascript">
            var APP_URL = {!! json_encode(url('/')) !!};
        </script>
        <script src="{{ asset('assets/js/script.js') }}"></script>
    </head>
    <body>
        @yield('content')
    </body>
    </html>
    