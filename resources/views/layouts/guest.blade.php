<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('frontend/assets/img/HRP.png') }}" rel="icon">
    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('Backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('Backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Backend/css/new-admin.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body style="background: url('{{ asset('Backend/img/log_reg1.png') }}') no-repeat center center fixed; background-size: cover;">
    <div class="overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 0;"></div>

    <div class="container position-relative" style="z-index: 1;">
        @yield('content')
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('Backend/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('Backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('Backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('Backend/js/sb-admin-2.min.js') }}"></script>

    @stack('scripts')
</body>
</html>