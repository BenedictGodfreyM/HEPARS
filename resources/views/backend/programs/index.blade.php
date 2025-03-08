@extends('backend.layouts.parent')

@section('page_title', $institution->acronym . ' Programs')

@section('page_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Programs offered by {{ $institution->name }}</h3>
                <div class="card-tools">
                    <div class="btn-group show">
                        <a href="{{ route('institutions.programs.register', ['institution_id' => $institution->id]) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-plus"></i> Register
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <livewire:programs.datatable institution_id="{{ $institution->id }}" />
            </div>
        </div>
    </div>
</div>
@endsection