
@extends('layouts.admin')

@section('title', 'Settings | Business Hub')
@section('page-heading', 'Settings')

@section('content')
<div class="settings-page">

    <div class="settings-page-header">
        <div>
            <h2>Account Settings</h2>
            <p>Manage your profile information and account security.</p>
        </div>
    </div>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="settings-alert settings-alert-error">
            <strong>Please check the following:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Profile update status --}}
    @if (session('status') === 'profile-information-updated')
        <div class="settings-alert settings-alert-success">
            Your profile has been updated successfully.
        </div>
    @endif

    {{-- Password update status --}}
    @if (session('status') === 'password-updated')
        <div class="settings-alert settings-alert-success">
            Your password has been changed successfully.
        </div>
    @endif

    {{-- Profile information --}}
    <section class="settings-card">
        <div class="settings-card-heading">
            <div class="settings-icon">P</div>
            <div>
                <h3>Profile Information</h3>
                <p>Update the name and email associated with your account.</p>
            </div>
        </div>

        <form
            method="POST"
            action="{{ route('user-profile-information.update') }}"
            class="settings-form"
        >
            @csrf
            @method('PUT')

            <div class="settings-field">
                <label for="name">Full Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', auth()->user()->name) }}"
                    maxlength="255"
                    autocomplete="name"
                    required
                >
                @error('name')
                    <span class="settings-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="settings-field">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', auth()->user()->email) }}"
                    maxlength="255"
                    autocomplete="email"
                    required
                >
                @error('email')
                    <span class="settings-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="settings-form-actions">
                <button type="submit" class="settings-save-button">
                    Save Profile
                </button>
            </div>
        </form>
    </section>

    {{-- Password update --}}
    <section class="settings-card">
        <div class="settings-card-heading">
            <div class="settings-icon settings-icon-security">S</div>
            <div>
                <h3>Change Password</h3>
                <p>Use your current password to set a new one.</p>
            </div>
        </div>

        <form
            method="POST"
            action="{{ route('user-password.update') }}"
            class="settings-form"
        >
            @csrf
            @method('PUT')

            <div class="settings-field">
                <label for="current_password">Current Password</label>
                <input
                    type="password"
                    id="current_password"
                    name="current_password"
                    autocomplete="current-password"
                    required
                >
                @error('current_password')
                    <span class="settings-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="settings-field">
                <label for="password">New Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="new-password"
                    required
                >
                @error('password')
                    <span class="settings-field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="settings-field">
                <label for="password_confirmation">Confirm New Password</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    autocomplete="new-password"
                    required
                >
            </div>

            <div class="settings-form-actions">
                <button type="submit" class="settings-save-button">
                    Update Password
                </button>
            </div>
        </form>
    </section>

    {{-- Account information --}}
    <section class="settings-account-note">
        <h3>Account Information</h3>
        <p>
            <strong>Account role:</strong>
            {{ ucfirst(auth()->user()->role) }}
        </p>
        <p>
            Your account permissions are managed by the Business Hub
            administrator. This page does not allow you to change your role.
        </p>
    </section>

</div>
@endsection
