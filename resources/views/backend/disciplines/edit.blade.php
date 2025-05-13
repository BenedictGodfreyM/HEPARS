@extends('backend.layouts.parent')

@section('page_title', 'Update Discipline Details')

@section('page_content')
    <livewire:disciplines.edit discipline_id="{{ $discipline_id }}" />
@endsection
