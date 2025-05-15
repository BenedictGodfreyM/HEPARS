@extends('backend.layouts.parent')

@section('page_title', 'Update Field Details')

@section('page_content')
    <livewire:fields.edit field_id="{{ $field_id }}" />
@endsection
