@extends('layouts.app')

@section('page_title', 'Verify E-Mail')

@section('page_layout', 'login-page')

@section('page_content_wrapper')
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ route('home') }}" class="h1">HEPARS</a>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <dl>
                    @foreach ($errors->all() as $error)
                        <dd>{{ $error }}</dd>
                    @endforeach
                </dl>
            </div>
            @else
            <p class="login-box-msg">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>
            @endif 
            
            @if (session('status') == 'verification-link-sent')
            <p class="login-box-msg">A new verification link has been sent to the email address you provided during registration.</p>
            @endif

            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <div class="text-center mt-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Resend Verification Email</button>
                </div>
            </form>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="text-center mt-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Log Out</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
