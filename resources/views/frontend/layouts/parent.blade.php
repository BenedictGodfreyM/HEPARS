@extends('layouts.app')

@section('page_layout', 'layout-top-nav')

@section('page_top_navigation')
    @include('frontend.layouts.nav')
@endsection

@section('page_content_wrapper')
<div class="content-wrapper" style="min-height: 632.4px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('page_content_title')</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">@yield('page_content')</div>
    </div>
</div>
@endsection

