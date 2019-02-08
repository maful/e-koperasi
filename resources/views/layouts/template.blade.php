<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Koperasi Tabungan Sukarela</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="{{ asset('js/require.min.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: "{{ URL::to('/') }}"
        });
    </script>
    <!-- Dashboard Core -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!-- c3.js') }} Charts Plugin -->
    <link href="{{ asset('plugins/charts-c3/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('plugins/charts-c3/plugin.js') }}"></script>
    <!-- Google Maps Plugin -->
    <link href="{{ asset('plugins/maps-google/plugin.css') }}" rel="stylesheet" />
    <script src="{{ asset('plugins/maps-google/plugin.js') }}"></script>
    <!-- Input Mask Plugin -->
    <script src="{{ asset('plugins/input-mask/plugin.js') }}"></script>
    <!-- Datatables Plugin -->
    <script src="{{ asset('plugins/datatables/plugin.js') }}"></script>
    <!-- Datepicker Plugin -->
    <link href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('plugins/bootstrap-datepicker/plugin.js') }}"></script>

    @yield('css')
</head>
<body class="">
    @yield('content')
</body>
@yield('js')
</html>
