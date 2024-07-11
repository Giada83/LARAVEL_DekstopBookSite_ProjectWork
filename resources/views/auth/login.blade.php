@extends('layouts.authenticated')
@section('content')
    <style>
        .login-box {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #F2E4D8;
        }

        .login-form {
            background-color: white;
            padding: 1rem 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .log-in::placeholder {
            font-weight: 300;
            font-size: 0.8rem;
            color: grey;
        }

        .login-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 1rem 0;
            border: none
        }

        .login-divider::before,
        .login-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }

        .login-divider::before {
            margin-right: .25em;
        }

        .login-divider::after {
            margin-left: .25em;
        }

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px white inset !important;
            box-shadow: 0 0 0 30px white inset !important;
        }

        input:-webkit-autofill {
            -webkit-text-fill-color: #495057 !important;
            color: #495057 !important;
        }

        .login-title div label {
            font-size: 0.8rem;

        }

        .login-title div input {
            font-size: 0.9rem;

        }

        .login-img img {
            max-width: 150px;

        }

        .login-btn {
            background-color: #F29F80;
            border: none;
            border-radius: none;
            padding: 5px 0;
            font-weight: 300;
        }

        .login-btn:hover {
            background-color: #F0DEC6;
        }

        .google-img {
            height: 35px;
            width: 35px;
        }

        .login-reg {
            color: #f17c52
        }
    </style>
    </head>

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
