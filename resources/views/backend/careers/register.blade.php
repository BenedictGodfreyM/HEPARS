@extends('backend.layouts.parent')

@section('page_title', 'Register Careers in ' . ucwords(strtolower($field->name)))

@section('page_content')
    <livewire:careers.register field_id="{{ $field->id }}" />
@endsection