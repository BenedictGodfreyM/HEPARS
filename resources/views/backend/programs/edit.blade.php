@extends('backend.layouts.parent')

@section('page_title', $program->name)

@section('page_content')
    <livewire:programs.edit institution_id="{{ $institution->id }}" program_id="{{ $program->id }}" />
@endsection
