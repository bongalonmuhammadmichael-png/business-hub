@extends('layouts.admin')

@section('title', 'User Management | Business Hub')

@section('page-heading', 'User Management')

@section('content')

<div class="container" style="padding: 50px 0;">

    @if (session('success'))
        <div style="
            margin-bottom: 24px;
            padding: 14px 18px;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            background: #f0fdf4;
            color: #166534;
            font-weight: 600;
        ">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="
            margin-bottom: 24px;
            padding: 14px 18px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            background: #fef2f2;
            color: #991b1b;
            font-weight: 600;
        ">
            ✕ {{ session('error') }}
        </div>
    @endif

    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    ">


<div class="container" style="padding: 50px 0;">

    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    ">
        <div>
            <h1 style="margin-bottom: 8px;">Manage Users</h1>

            <p style="color: #64748b;">
                View and manage Business Hub users.
            </p>
        </div>

        <a
            href="{{ route('admin.users.create') }}"
            class="btn btn-primary"
        >
            + Add User
        </a>
    </div>


    <div style="
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        overflow: hidden;
    ">

        <div style="overflow-x: auto;">

            <table style="
                width: 100%;
                border-collapse: collapse;
            ">

                <thead>
                    <tr style="background: #f8fafc;">

                        <th style="padding: 16px; text-align: left;">
                            Name
                        </th>

                        <th style="padding: 16px; text-align: left;">
                            Email
                        </th>

                        <th style="padding: 16px; text-align: left;">
                            Role
                        </th>

                        <th style="padding: 16px; text-align: left;">
                            Created
                        </th>

                        <th style="padding: 16px; text-align: left;">
                            Actions
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse ($users as $user)

                        <tr style="border-top: 1px solid #e2e8f0;">

                            <td style="padding: 16px;">
                                {{ $user->name }}
                            </td>

                            <td style="padding: 16px;">
                                {{ $user->email }}
                            </td>

                            <td style="padding: 16px;">

                                @if ($user->role === 'admin')

                                    <span style="
                                        display: inline-block;
                                        padding: 5px 10px;
                                        border-radius: 999px;
                                        background: #e0e7ff;
                                        color: #3730a3;
                                        font-size: 13px;
                                        font-weight: 600;
                                    ">
                                        Admin
                                    </span>

                                @else

                                    <span style="
                                        display: inline-block;
                                        padding: 5px 10px;
                                        border-radius: 999px;
                                        background: #f1f5f9;
                                        color: #475569;
                                        font-size: 13px;
                                        font-weight: 600;
                                    ">
                                        Employee
                                    </span>

                                @endif

                            </td>

                            <td style="padding: 16px;">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>

                            <td style="padding: 16px;">
                                <span style="color: #94a3b8;">
                                    <div style="display: flex; gap: 10px; align-items: center;">

                                        <a
                                            href="{{ route('admin.users.edit', $user) }}"
                                            style="
                                                color: #2563eb;
                                                text-decoration: none;
                                                font-weight: 600;
                                            "
                                        >
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('admin.users.destroy', $user) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this user?');"
                                            style="margin: 0;"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                style="
                                                    border: none;
                                                    background: none;
                                                    color: #dc2626;
                                                    cursor: pointer;
                                                    font-weight: 600;
                                                    padding: 0;
                                                "
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </div>
                                </span>
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5"
                                style="
                                    padding: 40px;
                                    text-align: center;
                                    color: #64748b;
                                ">

                                No users found.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection