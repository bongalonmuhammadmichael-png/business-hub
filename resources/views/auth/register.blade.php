@extends('layouts.app')

@section('content')

<div class="auth-page">

    <div class="auth-card">

        <div class="auth-brand">
            <span class="brand-mark">B</span>
            <span class="brand-name">Business Hub</span>
        </div>

        <div class="auth-heading">
            <h1>Create your account</h1>

            <p>
                Start organizing your business in one centralized workspace.
            </p>
        </div>

        <form method="POST" action="{{ route('register.store') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="name">Full name</label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Enter your full name"
                >

                @error('name')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email address</label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
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
                    autocomplete="new-password"
                    placeholder="Create a secure password"
                >

                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm password</label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Repeat your password"
                >
            </div>

            <button type="submit" class="auth-submit">
                Create account
            </button>

        </form>

        <div class="auth-footer">
            <span>Already have an account?</span>

            <a href="{{ route('login') }}">
                Log in
            </a>
        </div>

    </div>

</div>

@endsection