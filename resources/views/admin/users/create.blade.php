@extends('layouts.admin')

@section('title', 'Add User | Business Hub')

@section('page-heading', 'Add User')

@section('content')

<div class="container" style="padding: 60px 0; max-width: 900px;">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 35px;">

        <div>
            <h1 style="margin-bottom: 8px;">Add New User</h1>

            <p style="color: #64748b;">
                Create a new Business Hub user account.
            </p>
        </div>

        <a href="{{ route('admin.users.index') }}"
           class="btn btn-primary">
            ← Back to Users
        </a>

    </div>


    @if ($errors->any())

        <div style="
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 25px;
        ">

            <strong>Please fix the following errors:</strong>

            <ul style="margin-top: 10px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    <div style="
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 35px;
    ">

        <form method="POST" action="{{ route('admin.users.store') }}">

            @csrf

            <div style="margin-bottom: 22px;">

                <label for="name">
                    Full Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    style="width: 100%; padding: 13px; margin-top: 8px;"
                >

            </div>


            <div style="margin-bottom: 22px;">

                <label for="email">
                    Email Address
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    style="width: 100%; padding: 13px; margin-top: 8px;"
                >

            </div>


            <div style="margin-bottom: 22px;">

                <label for="role">
                    Role
                </label>

                <select
                    id="role"
                    name="role"
                    required
                    style="width: 100%; padding: 13px; margin-top: 8px;"
                >

                    <option value="employee">
                        Employee
                    </option>

                    <option value="admin">
                        Admin
                    </option>

                </select>

            </div>


            <div style="margin-bottom: 22px;">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    style="width: 100%; padding: 13px; margin-top: 8px;"
                >

            </div>


            <div style="margin-bottom: 30px;">

                <label for="password_confirmation">
                    Confirm Password
                </label>

                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    style="width: 100%; padding: 13px; margin-top: 8px;"
                >

            </div>


            <button
                type="submit"
                class="btn btn-primary"
            >
                Create User
            </button>

        </form>

    </div>

</div>

@endsection