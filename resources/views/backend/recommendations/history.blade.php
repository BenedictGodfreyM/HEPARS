@extends('backend.layouts.parent')

@section('page_title', 'My Recommendations')

@section('page_content')
    <livewire:recommendations.datatable />
@endsection