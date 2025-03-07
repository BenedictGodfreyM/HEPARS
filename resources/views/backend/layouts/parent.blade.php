@extends('layouts.app')

@section('page_layout', 'dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed')

@section('page_top_navigation')
    @include('backend.layouts.nav')
@endsection

@section('page_side_navigation')
    @include('backend.layouts.sidebar')
@endsection

