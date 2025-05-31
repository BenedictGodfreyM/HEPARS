@extends('backend.layouts.parent')

@section('page_title', $institution->acronym . ' Programs')

@section('page_content')
    <livewire:programs.datatable institution_id="{{ $institution->id }}" />
@endsection