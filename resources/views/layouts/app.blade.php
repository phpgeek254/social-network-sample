<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.3/noty.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('partials.nav')

        @yield('content')
        @if(Auth::check())
        <notification :id="{{ Auth::id() }}"></notification>
        @endif

        <audio id="noty_audio">
            <source src="{{ asset('audio/notify.mp3') }}">
            <source src="{{ asset('audio/notify.ogg') }}">
            <source src="{{ asset('audio/notify.wav') }}">
        </audio>


    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.3/noty.js"></script>

</body>
</html>
