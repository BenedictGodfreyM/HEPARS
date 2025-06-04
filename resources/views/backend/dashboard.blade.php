@extends('backend.layouts.parent')

@section('page_title', 'Dashboard')

@section('page_content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        @permission('view.institutions')
        <div class="col-lg-3 col-6">
            <livewire:shared.stat-box count="{{ $total_institutions }}" label="Institutions" referral_route="institutions" css_class="bg-olive" icon="icon-bag" />
        </div>
        @endpermission
        @permission('view.programs')
        <div class="col-lg-3 col-6">
            <livewire:shared.stat-box count="{{ $total_programs }}" label="Programs" referral_route="institutions" css_class="bg-info" icon="icon-bag" />
        </div>
        @endpermission
        @permission('view.careers')
        <div class="col-lg-3 col-6">
            <livewire:shared.stat-box count="{{ $total_careers }}" label="Careers" referral_route="fields" css_class="bg-success" icon="icon-bag" />
        </div>
        @endpermission
        @permission('view.users')
        <div class="col-lg-3 col-6">
            <livewire:shared.stat-box count="{{ $total_users }}" label="Users" referral_route="dashboard" css_class="bg-warning" icon="icon-bag" />
        </div>
        @endpermission
    </div>
@endsection