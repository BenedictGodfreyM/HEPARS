@extends('layouts.app')

@section('page_layout', 'light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed')

@section('page_top_navigation')
    @include('backend.layouts.nav')
@endsection

@section('page_side_navigation')
    @include('backend.layouts.sidebar')
@endsection

@section('page_content_wrapper')
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
@endsection

