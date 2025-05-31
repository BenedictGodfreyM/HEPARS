@extends('backend.layouts.parent')

@section('page_title', 'Careers in '. ucwords(strtolower($field->name)))

@section('page_content')
    <livewire:careers.datatable field_id="{{ $field->id }}" />
@endsection