@extends('backend.layouts.parent')

@section('page_title', $combination->name . ' Combination')

@section('page_content')
    <livewire:combinations.edit combination_id="{{ $combination->id }}" />
@endsection
