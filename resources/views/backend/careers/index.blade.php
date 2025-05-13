@extends('backend.layouts.parent')

@section('page_title', 'Careers in '. ucwords(strtolower($discipline->name)))

@section('page_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Careers</h3>
                <div class="card-tools">
                    <div class="btn-group show">
                        <a href="{{ route('disciplines.careers.register', ['discipline_id' => $discipline->id]) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-plus"></i> Register
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <livewire:careers.datatable discipline_id="{{ $discipline->id }}" />
            </div>
        </div>
    </div>
</div>
@endsection