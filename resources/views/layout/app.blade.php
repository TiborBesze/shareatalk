<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', env('APP_NAME')) | {{ env('APP_NAME') }}</title>
        <meta name="description" content="@yield('description', env('APP_DESCRIPTION'))">
        <link rel="stylesheet" href="{{ mix('css/shareatalk.css') }}">
    </head>
    <body>
        @include('layout.partials._nav')
        @yield('content')
        <script src="{{ mix('js/shareatalk.js') }}"></script>
    </body>
</html>
