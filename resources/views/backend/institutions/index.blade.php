@extends('backend.layouts.parent')

@section('page_title', 'Institutions')

@section('page_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registered Institutions</h3>
                <div class="card-tools">
                    <div class="btn-group show">
                        <a href="{{ route('institutions.register') }}" class="btn btn-sm btn-info">
                            <i class="fas fa-plus"></i> Register
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <livewire:institutions.datatable />
            </div>
        </div>
    </div>
</div>
@endsection