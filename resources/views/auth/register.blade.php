@extends('layouts.app')

@section('page_title', 'Create an Account')

@section('page_layout', 'register-page')

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
            <p class="login-box-msg">Register a new account</p>
            @endif 

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}" placeholder="Your Firstname" required="" autofocus autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="surname" class="form-control" value="{{ old('surname') }}" placeholder="Your Surname" required="" autofocus autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="form-group">
                    <div class="input-group">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirn Password" required autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
            </form>
            
            <p class="mb-1">
                <a href="{{ route('login') }}">I already have an account</a>
            </p>
        </div>
    </div>
</div>
@endsection