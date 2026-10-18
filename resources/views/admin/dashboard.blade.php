@extends('layouts.admin')

@section('title', 'Dashboard | Business Hub')

@section('page-heading', 'Dashboard')

@section('content')

<div class="admin-dashboard">

    <div class="admin-header">
        <div>
            <h1>Dashboard</h1>
            <p>Welcome back, {{ auth()->user()->name }}.</p>
        </div>

        <div class="admin-user">
            <div class="admin-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div>
                <strong>{{ auth()->user()->name }}</strong>
                <span>{{ ucfirst(auth()->user()->role) }}</span>
            </div>
        </div>
    </div>


    <div class="dashboard-cards">

        <div class="dashboard-card">
            <span class="card-label">Total Users</span>

            <strong class="card-value">
                {{ $totalUsers }}
            </strong>

            <span class="card-description">
                Registered users
            </span>
        </div>


        <a href="{{ route('admin.users.index', ['role' => 'employee']) }}"
        class="dashboard-card dashboard-card-link">

            <span class="card-label">Employees</span>

            <strong class="card-value">
                {{ $totalEmployees }}
            </strong>

            <span class="card-description">
                Employee accounts
            </span>

        </a>


        <div class="dashboard-card">
            <span class="card-label">Projects</span>

            <strong class="card-value">
                {{ $totalProjects }}
            </strong>

            <span class="card-description">
                Business projects
            </span>
        </div>


        <a href="{{ route('admin.projects.index', ['status' => 'completed']) }}"
        class="dashboard-card dashboard-card-link">

            <span class="card-label">Completed</span>

            <strong class="card-value">
                {{ $completedProjects }}
            </strong>

            <span class="card-description">
                Completed projects
            </span>

        </a>

    </div>


    <div class="dashboard-section">

        <div class="section-header">
            <div>
                <h2>Quick Actions</h2>
                <p>Manage your Business Hub system.</p>
            </div>
        </div>

        <div class="quick-actions">

            <a href="{{ route('admin.users.index') }}"
                style="
                        display: block;
                        text-decoration: none;
                        color: inherit;
                " class="quick-action">

                    <div>
                        <strong>Manage Users</strong>

                        <p>View and manage system users</p>
                    </div>

            </a>

            <a href="{{ route('admin.projects.index') }}" class="quick-action">
                <strong>Projects</strong>
                <span>Manage business projects</span>
            </a>

            <a href="#" class="quick-action">
                <strong>Reports</strong>
                <span>View business reports</span>
            </a>

            <a href="#" class="quick-action">
                <strong>Settings</strong>
                <span>Manage system settings</span>
            </a>

        </div>

    </div>


    {{-- Recent Projects --}}
    <div class="dashboard-section recent-projects-section">

        <div class="section-header recent-projects-header">
            <div>
                <h2>Recent Projects</h2>
                <p>Your latest business projects and their current status.</p>
            </div>

            <a href="{{ route('admin.projects.index') }}"
            class="recent-projects-link">
                View all projects →
            </a>
        </div>

        <div class="recent-projects-table-wrapper">
            <table class="recent-projects-table">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Due Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($recentProjects as $project)
                        <tr>
                            <td>
                                <strong>{{ $project->name }}</strong>
                            </td>

                            <td>{{ $project->client }}</td>

                            <td>
                                @php
                                    $statusClasses = [
                                        'planning' => 'status-planning',
                                        'in_progress' => 'status-progress',
                                        'completed' => 'status-completed',
                                    ];

                                    $statusLabels = [
                                        'planning' => 'Planning',
                                        'in_progress' => 'In Progress',
                                        'completed' => 'Completed',
                                    ];
                                @endphp

                                <span class="project-status {{ $statusClasses[$project->status] ?? 'status-planning' }}">
                                    {{ $statusLabels[$project->status] ?? ucfirst(str_replace('_', ' ', $project->status)) }}
                                </span>
                            </td>

                            <td>
                                {{ $project->due_date?->format('M d, Y') ?? 'Not set' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="recent-projects-empty">
                                No projects yet. Create your first project to see it here.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <section class="recent-activity-panel">
        <div class="recent-activity-header">
            <div>
                <h2>Recent Activity</h2>
                <p>Latest actions across your workspace</p>
            </div>

            <span class="recent-activity-count">
                {{ $recentActivity->count() }} events
            </span>
        </div>

        @forelse ($recentActivity as $activity)
            <div class="activity-row">
                <div class="activity-mark {{ str_starts_with($activity->action, 'project.') ? 'activity-mark-project' : 'activity-mark-user' }}">
                    {{ str_starts_with($activity->action, 'project.') ? 'P' : 'U' }}
                </div>

                <div class="activity-copy">
                    <p class="activity-description">
                        {{ $activity->description }}
                    </p>

                    <p class="activity-details">
                        <span>{{ $activity->actor_name }}</span>
                        <span aria-hidden="true">·</span>
                        <time datetime="{{ $activity->created_at->toIso8601String() }}">
                            {{ $activity->created_at->format('M d, Y · h:i A') }}
                        </time>
                    </p>
                </div>

                <span class="activity-type">
                    {{ ucwords(str_replace('.', ' ', $activity->action)) }}
                </span>
            </div>
        @empty
            <p class="activity-empty">
                No activity has been recorded yet.
            </p>
        @endforelse
    </section>

</div>

@endsection


