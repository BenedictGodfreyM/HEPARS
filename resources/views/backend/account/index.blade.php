@extends('backend.layouts.parent')

@section('page_title', 'My Account')

@section('page_content')
<div class="row">
    <div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <i class="fa-7x fas fa-user-circle"></i>
                </div>

                <h3 class="profile-username text-center">{{ Auth::user()->fullname }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Change Password</h3>
            </div>
                <div class="card-body">
                    <livewire:account.change-password />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection