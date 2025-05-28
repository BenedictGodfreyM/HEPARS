@extends('layouts.app')

@section('page_title', 'Forgot Password')

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
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
            @endif 

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Your Email" required="" autofocus autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Email Password Reset Link</button>
                </div>
            </form>
            
            <p class="mb-1">
                <a href="{{ route('login') }}">Log In</a>
            </p>
        </div>
    </div>
</div>
@endsection