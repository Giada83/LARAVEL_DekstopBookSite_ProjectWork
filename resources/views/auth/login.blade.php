@extends('layouts.authenticated')
@section('title', 'login')

@section('content')
    <section class="login-box">
        <div class="login-form">

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="login-title">
                @csrf

                <div class="text-center login-img"> <img src="{{ asset('assets/image/login.jpg') }}" alt="Logo">
                </div>

                {{-- email address --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" required autofocus autocomplete="username">
                    @error('email')
                        <div class="invalid-feedback">
                            <p class="p-size-small ps-1">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                {{-- password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check me-3">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me"><span>{{ __('Remember me') }}</span></label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="align-items-center d-flex"><span
                                class="p-size-small"> {{ __('Forgot your password?') }}</span></a>
                    @endif
                </div>


                <div class="d-grid mb-3">
                    <button type="submit" class="login-btn"> Sign In</button>
                </div>

                <div class="login-divider mb-2 text-center">
                    <span class="p-size">or</span>
                </div>

                <div class="d-grid justify-content-center">
                    <a href="{{ url('auth/google') }}" class="text-decoration-none">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/image/google_logo.png') }}" alt="Google Logo"
                                class="me-2 google-img">
                            <p class="mb-0 p-size-small darkgrey">Sign Up with Google</p>
                        </div>
                    </a>
                </div>

                <div class="d-grid justify-content-center mt-3 mb-0">
                    <p class="p-size-small">Ar you new? <a href="{{ route('register') }}" class="login-reg">Create an
                            Account</a></p>
                </div>
            </form>
        </div>
    @endsection
