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
            <livewire:shared.stat-box count="{{ $total_users }}" label="Users" referral_route="users" css_class="bg-warning" icon="icon-bag" />
        </div>
        @endpermission
    </div>
    <div class="row">
        @permission('view.recommendation.history.chart')
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-1"></i> My Recommendation Request History Stats
                    </h3>
                </div>
                <div class="card-body">
                    <livewire:shared.line-chart description="Number of Requests" :chartLabels='$my_recommendation_requests_labels' :chartData='$my_recommendation_requests_data' />
                </div>
            </div>
        </div>
        @endpermission
        @permission('view.recommendation.history.chart.of.all.users')
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-1"></i> All Recommendation Request History Stats
                    </h3>
                </div>
                <div class="card-body">
                    <livewire:shared.bar-chart description="Number of Requests" :chartLabels='$all_recommendation_requests_labels' :chartData='$all_recommendation_requests_data' />
                </div>
            </div>
        </div>
        @endpermission
    </div>
@endsection