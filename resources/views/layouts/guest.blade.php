<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('Backend/avendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('Backend/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @push('styles')
<style>
    .bg-gradient-teal {
        background: linear-gradient(to right, #1abc9c, #2980b9);
    }
</style>
@endpush


    @stack('styles')
</head>

<body class="bg-gradient-teal">

    <div class="container">

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

