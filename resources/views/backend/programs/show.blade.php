@extends('backend.layouts.parent')

@section('page_title', $program->name)

@section('page_content')
    <livewire:programs.view institution_id="{{ $institution->id }}" program_id="{{ $program->id }}" />
@endsection
