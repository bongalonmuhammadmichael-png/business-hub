
@extends('layouts.admin')

@section('title', 'Reports | Business Hub')
@section('page-heading', 'Reports')

@section('content')
<div class="reports-page">

    {{-- Page heading --}}
    <div class="reports-page-header">
        <div>
            <h2>Business Overview</h2>
            <p>
                Review your project progress and team statistics
                using live database records.
            </p>
        </div>

        <div class="reports-generated">
            <span>Report generated</span>
            <strong>{{ now()->format('M d, Y') }}</strong>
        </div>
    </div>

    {{-- Project statistics --}}
    <section class="report-section">
        <div class="report-section-heading">
            <h3>Project Summary</h3>
            <p>Current status of all registered projects</p>
        </div>

        <div class="report-stats-grid">
            <article class="report-stat-card">
                <span class="report-stat-label">Total Projects</span>
                <strong class="report-stat-number">
                    {{ $totalProjects }}
                </strong>
                <span class="report-stat-note">All projects</span>
            </article>

            <article class="report-stat-card report-stat-planning">
                <span class="report-stat-label">Planning</span>
                <strong class="report-stat-number">
                    {{ $planningProjects }}
                </strong>
                <span class="report-stat-note">Awaiting progress</span>
            </article>

            <article class="report-stat-card report-stat-progress">
                <span class="report-stat-label">In Progress</span>
                <strong class="report-stat-number">
                    {{ $inProgressProjects }}
                </strong>
                <span class="report-stat-note">Currently underway</span>
            </article>

            <article class="report-stat-card report-stat-completed">
                <span class="report-stat-label">Completed</span>
                <strong class="report-stat-number">
                    {{ $completedProjects }}
                </strong>
                <span class="report-stat-note">Finished projects</span>
            </article>
        </div>
    </section>

    {{-- Team statistics --}}
    <section class="report-section">
        <div class="report-section-heading">
            <h3>Team Summary</h3>
            <p>Overview of registered accounts</p>
        </div>

        <div class="report-team-grid">
            <div class="report-team-card">
                <div class="report-team-icon report-team-icon-users">
                    U
                </div>
                <div>
                    <span>Total Users</span>
                    <strong>{{ $totalUsers }}</strong>
                </div>
            </div>

            <div class="report-team-card">
                <div class="report-team-icon report-team-icon-employees">
                    E
                </div>
                <div>
                    <span>Employees</span>
                    <strong>{{ $totalEmployees }}</strong>
                </div>
            </div>

            <div class="report-team-card">
                <div class="report-team-icon report-team-icon-admins">
                    A
                </div>
                <div>
                    <span>Administrators</span>
                    <strong>{{ $totalAdmins }}</strong>
                </div>
            </div>
        </div>
    </section>

    {{-- Project report table --}}
    <section class="report-section">
        <div class="report-section-heading report-table-heading">
            <div>
                <h3>Project Report</h3>
                <p>Project details, clients, and scheduled dates</p>
            </div>

            <span class="report-record-count">
                {{ $projects->total() }} records
            </span>
        </div>

        <div class="report-table-wrapper">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>Due Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($projects as $project)
                        @php
                            $statusLabels = [
                                'planning' => 'Planning',
                                'in_progress' => 'In Progress',
                                'completed' => 'Completed',
                            ];

                            $statusClasses = [
                                'planning' => 'report-status-planning',
                                'in_progress' => 'report-status-progress',
                                'completed' => 'report-status-completed',
                            ];
                        @endphp

                        <tr>
                            <td>
                                <span class="report-project-name">
                                    {{ $project->name }}
                                </span>
                                @if ($project->description)
                                    <span class="report-project-description">
                                        {{ $project->description }}
                                    </span>
                                @endif
                            </td>

                            <td>{{ $project->client }}</td>

                            <td>
                                <span class="report-status-badge {{ $statusClasses[$project->status] ?? '' }}">
                                    {{ $statusLabels[$project->status] ?? ucfirst($project->status) }}
                                </span>
                            </td>

                            <td>
                                {{ $project->start_date?->format('M d, Y') ?? '—' }}
                            </td>

                            <td>
                                {{ $project->due_date?->format('M d, Y') ?? '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="report-table-empty">
                                No projects are available to report yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($projects->hasPages())
            <div class="report-pagination">
                {{ $projects->links() }}
            </div>
        @endif
    </section>

</div>
@endsection
