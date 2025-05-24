<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('page_title') | HEPARS</title>

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <!-- SweetAlert2 -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <!-- Toastr -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">

        @livewireStyles

        @stack('styles')
    </head>
    <body class="@yield('page_layout')">
        <!-- Navbar -->
        @yield('page_top_navigation')
        <!-- /.navbar -->

        <!-- Sidebar -->
        @yield('page_side_navigation')

        @yield('page_content_wrapper')

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- SweetAlert2 -->
        <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
        <!-- Toastr -->
        <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/js/adminlte.min.js') }}"></script>

        @livewireScripts
        
        @stack('scripts')
    </body>
</html>