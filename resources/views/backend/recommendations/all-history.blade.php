@extends('backend.layouts.parent')

@section('page_title', 'All Recommendations')

@section('page_content')
    <livewire:recommendations.all.datatable />
@endsection