@extends('backend.layouts.parent')

@section('page_title', 'Update Career Details')

@section('page_content')
    <livewire:careers.edit field_id="{{ $field->id }}" career_id="{{ $career->id }}" />
@endsection