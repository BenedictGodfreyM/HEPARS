@extends('backend.layouts.parent')

@section('page_title', 'High School Subjects')

@section('page_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Subjects being taught at High School</h3>
                <div class="card-tools">
                    <div class="btn-group show">
                        <a href="{{ route('subjects.register') }}" class="btn btn-sm btn-info">
                            <i class="fas fa-plus"></i> Register
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <livewire:subjects.datatable />
            </div>
        </div>
    </div>
</div>
@endsection