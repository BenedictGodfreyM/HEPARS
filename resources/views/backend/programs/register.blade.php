@extends('backend.layouts.parent')

@section('page_title', 'Register ' . $institution->acronym . ' Programs')

@section('page_content')
    <livewire:programs.register institution_id="{{ $institution->id }}" />
@endsection
