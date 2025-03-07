@extends('backend.layouts.parent')

@section('page_title', 'Update Career Paths Details')

@section('page_content')
    <livewire:career_paths.edit career_path_id="{{ $career_path_id }}" />
@endsection