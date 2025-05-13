@extends('backend.layouts.parent')

@section('page_title', 'Register Careers in ' . ucwords(strtolower($discipline->name)))

@section('page_content')
    <livewire:careers.register discipline_id="{{ $discipline->id }}" />
@endsection