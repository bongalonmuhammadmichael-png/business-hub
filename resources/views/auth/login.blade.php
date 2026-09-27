@extends('layouts.app')

@section('content')

<div class="auth-page">

    <div class="auth-card">

        <div class="auth-brand">
            <span class="brand-mark">B</span>
            <span class="brand-name">Business Hub</span>
        </div>

        <div class="auth-heading">
            <h1>Welcome back</h1>

            <p>
                Log in to continue to your Business Hub workspace.
            </p>
        </div>

        <form method="POST" action="{{ route('login.store') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email">Email address</label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="you@example.com"
                >

                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your password"
                >

                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-options">
                <label class="remember-option">
                    <input
                        type="checkbox"
                        name="remember"
                    >

                    <span>Remember me</span>
                </label>

                <a href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            </div>

            <button type="submit" class="auth-submit">
                Log in
            </button>

        </form>

        <div class="auth-footer">
            <span>Don't have an account?</span>

            <a href="{{ route('register') }}">
                Create account
            </a>
        </div>

    </div>

</div>

@endsection