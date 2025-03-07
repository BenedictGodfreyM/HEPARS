@extends('backend.layouts.parent')

@section('page_title', 'Update Institution Details')

@section('page_content')
    <livewire:institutions.edit institution_id="{{ $institution_id }}" />
@endsection