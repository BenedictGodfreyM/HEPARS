@extends('backend.layouts.parent')

@section('page_title', 'Careers in '. ucwords(strtolower($field->name)))

@section('page_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Careers</h3>
                <div class="card-tools">
                    <div class="btn-group show">
                        <a href="{{ route('fields.careers.register', ['field_id' => $field->id]) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-plus"></i> Register
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <livewire:careers.datatable field_id="{{ $field->id }}" />
            </div>
        </div>
    </div>
</div>
@endsection