@extends('backend.layouts.parent')

@section('page_title', 'Update Subject Details')

@section('page_content')
    <livewire:subjects.edit subject_id="{{ $subject_id }}" />
@endsection