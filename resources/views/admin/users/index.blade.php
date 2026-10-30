
@extends('layouts.admin')

@section('title', 'User Management | Business Hub')
@section('page-heading', 'User Management')

@section('content')

<div class="users-page">

    {{-- Success and error messages --}}
    @if (session('success'))
        <div class="users-alert users-alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="users-alert users-alert-error">
            {{ session('error') }}
        </div>
    @endif

    {{-- Page heading --}}
    <div class="users-page-header">
        <div>
            <h1>Manage Users</h1>
            <p>View and manage Business Hub users.</p>
        </div>

        <a
            href="{{ route('admin.users.create') }}"
            class="btn btn-primary users-add-button"
        >
            + Add User
        </a>
    </div>

    {{-- Users table --}}
    <div class="users-table-card">

        <div class="users-table-wrapper">

            <table class="users-table">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($users as $user)

                        <tr>
                            <td class="users-name-cell">
                                {{ $user->name }}
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            <td>
                                @if ($user->role === 'admin')
                                    <span class="user-role-badge user-role-admin">
                                        Admin
                                    </span>
                                @else
                                    <span class="user-role-badge user-role-employee">
                                        Employee
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ $user->created_at?->format('M d, Y') ?? '—' }}
                            </td>

                            <td>
                                <div class="users-table-actions">

                                    <a
                                        href="{{ route('admin.users.edit', $user) }}"
                                        class="users-edit-link"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.users.destroy', $user) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this user?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="users-delete-button"
                                        >
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="users-empty-state">
                                No users found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="users-table-footer">
            <span>
                Showing {{ $users->count() }} users
            </span>
        </div>

    </div>

</div>

@endsection
