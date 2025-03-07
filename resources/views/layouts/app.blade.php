<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('page_title') | HEPARS</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
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
        <!-- /.sidebar -->

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('page_title')</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <section class="content">
                <div class="container-fluid">@yield('page_content')</div>
            </section>
        </div>

        <!-- REQUIRED SCRIPTS -->
        <!-- jQuery -->
        <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('assets/js/adminlte.js') }}"></script>

        <!-- PAGE PLUGINS -->
        <!-- jQuery Mapael -->
        <script src="{{ asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
        <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>

        @livewireScripts
        
        @stack('scripts')
    </body>
</html>