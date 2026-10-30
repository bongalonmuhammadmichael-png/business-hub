
@extends('layouts.admin')

@section('title', 'Project Management | Business Hub')
@section('page-heading', 'Project Management')

@section('content')

<div class="projects-page">

    {{-- Page heading --}}
    <div class="projects-page-header">
        <div>
            <h1>Manage Projects</h1>
            <p>View and manage Business Hub projects.</p>
        </div>

        <a
            href="{{ route('admin.projects.create') }}"
            class="btn btn-primary projects-add-button"
        >
            + Add Project
        </a>
    </div>

    {{-- Project status filters --}}
    <div class="project-filters">

        <a
            href="{{ route('admin.projects.index') }}"
            class="project-filter {{ $statusFilter === null ? 'active' : '' }}"
        >
            All Projects
        </a>

        <a
            href="{{ route('admin.projects.index', ['status' => 'planning']) }}"
            class="project-filter {{ $statusFilter === 'planning' ? 'active' : '' }}"
        >
            Planning
        </a>

        <a
            href="{{ route('admin.projects.index', ['status' => 'in_progress']) }}"
            class="project-filter {{ $statusFilter === 'in_progress' ? 'active' : '' }}"
        >
            In Progress
        </a>

        <a
            href="{{ route('admin.projects.index', ['status' => 'completed']) }}"
            class="project-filter {{ $statusFilter === 'completed' ? 'active' : '' }}"
        >
            Completed
        </a>

    </div>

    {{-- Project search --}}
    <form
        method="GET"
        action="{{ route('admin.projects.index') }}"
        class="project-search"
    >

        @if ($statusFilter !== null)
            <input type="hidden" name="status" value="{{ $statusFilter }}">
        @endif

        <input
            type="search"
            name="search"
            value="{{ $search }}"
            placeholder="Search by project name or client..."
            aria-label="Search projects by name or client"
        >

        <button type="submit" class="project-search-button">
            Search
        </button>

        @if ($search !== '')
            <a
                href="{{ route('admin.projects.index', $statusFilter ? ['status' => $statusFilter] : []) }}"
                class="project-search-reset"
            >
                Clear
            </a>
        @endif

    </form>

    {{-- Success message --}}
    @if (session('success'))
        <div class="projects-alert projects-alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error message --}}
    @if (session('error'))
        <div class="projects-alert projects-alert-error">
            {{ session('error') }}
        </div>
    @endif

    {{-- Projects table --}}
    <div class="projects-table-card">

        <div class="projects-table-wrapper">

            <table class="projects-table">

                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($projects as $project)

                        <tr>

                            {{-- Project information --}}
                            <td class="project-name-cell">
                                <strong>{{ $project->name }}</strong>

                                @if ($project->description)
                                    <span class="project-description">
                                        {{ Str::limit($project->description, 60) }}
                                    </span>
                                @endif
                            </td>

                            {{-- Client --}}
                            <td>
                                {{ $project->client }}
                            </td>

                            {{-- Project status --}}
                            <td>
                                @if ($project->status === 'planning')
                                    <span class="project-status-badge project-status-planning">
                                        Planning
                                    </span>

                                @elseif ($project->status === 'in_progress')
                                    <span class="project-status-badge project-status-progress">
                                        In Progress
                                    </span>

                                @elseif ($project->status === 'completed')
                                    <span class="project-status-badge project-status-completed">
                                        Completed
                                    </span>
                                @endif
                            </td>

                            {{-- Start date --}}
                            <td>
                                {{ $project->start_date?->format('M d, Y') ?? '—' }}
                            </td>

                            {{-- Due date --}}
                            <td>
                                {{ $project->due_date?->format('M d, Y') ?? '—' }}
                            </td>

                            {{-- Actions --}}
                            <td>
                                <div class="projects-table-actions">

                                    <a
                                        href="{{ route('admin.projects.edit', $project) }}"
                                        class="projects-edit-link"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        method="POST"
                                        action="{{ route('admin.projects.destroy', $project) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this project?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="projects-delete-button"
                                        >
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="projects-empty-state">
                                No projects found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="projects-table-footer">
            Showing {{ $projects->count() }} projects
        </div>

    </div>

</div>

@endsection
