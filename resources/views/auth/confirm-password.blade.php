@extends('layouts.app')

@section('page_title', 'Confirm Password')

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
            <p class="login-box-msg">This is a secure area of the application. Please confirm your password before continuing.</p>
            @endif 

            <form action="{{ route('password.confirm') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
