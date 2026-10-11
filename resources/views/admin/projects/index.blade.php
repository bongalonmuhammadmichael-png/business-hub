@extends('layouts.admin')

@section('title', 'Project Management | Business Hub')

@section('page-heading', 'Project Management')

@section('content')

<div class="container" style="padding: 50px 0;">

    {{-- Page Header --}}
    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    ">

        <div>
            <h1 style="margin-bottom: 8px;">
                Manage Projects
            </h1>

            <p style="color: #64748b;">
                View and manage Business Hub projects.
            </p>
        </div>

        <a
            href="{{ route('admin.projects.create') }}"
            class="btn btn-primary"
        >
            + Add Project
        </a>

    </div>
    

    {{-- Project Status Filters --}}
    <div class="project-filters">

        <a href="{{ route('admin.projects.index') }}"
        class="project-filter {{ $statusFilter === null ? 'active' : '' }}">
            All Projects
        </a>

        <a href="{{ route('admin.projects.index', ['status' => 'planning']) }}"
        class="project-filter {{ $statusFilter === 'planning' ? 'active' : '' }}">
            Planning
        </a>

        <a href="{{ route('admin.projects.index', ['status' => 'in_progress']) }}"
        class="project-filter {{ $statusFilter === 'in_progress' ? 'active' : '' }}">
            In Progress
        </a>

        <a href="{{ route('admin.projects.index', ['status' => 'completed']) }}"
        class="project-filter {{ $statusFilter === 'completed' ? 'active' : '' }}">
            Completed
        </a>

    </div>


    {{-- Project Search --}}
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


    {{-- Success Message --}}
    @if (session('success'))

        <div style="
            margin-bottom: 24px;
            padding: 14px 18px;
            border-radius: 10px;
            background: #ecfdf5;
            border: 1px solid #a7f3d0;
            color: #047857;
            font-weight: 600;
        ">
            ✓ {{ session('success') }}
        </div>

    @endif


    {{-- Error Message --}}
    @if (session('error'))

        <div style="
            margin-bottom: 24px;
            padding: 14px 18px;
            border-radius: 10px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            font-weight: 600;
        ">
            {{ session('error') }}
        </div>

    @endif


    {{-- Projects Table --}}
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
                            Project
                        </th>

                        <th style="padding: 16px; text-align: left;">
                            Client
                        </th>

                        <th style="padding: 16px; text-align: left;">
                            Status
                        </th>

                        <th style="padding: 16px; text-align: left;">
                            Start Date
                        </th>

                        <th style="padding: 16px; text-align: left;">
                            Due Date
                        </th>

                        <th style="padding: 16px; text-align: left;">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($projects as $project)

                        <tr style="
                            border-top: 1px solid #e2e8f0;
                        ">

                            {{-- Project --}}
                            <td style="padding: 16px;">

                                <div style="
                                    font-weight: 600;
                                    color: #0f172a;
                                    margin-bottom: 4px;
                                ">
                                    {{ $project->name }}
                                </div>

                                @if ($project->description)

                                    <div style="
                                        color: #64748b;
                                        font-size: 13px;
                                    ">
                                        {{ Str::limit($project->description, 60) }}
                                    </div>

                                @endif

                            </td>


                            {{-- Client --}}
                            <td style="padding: 16px;">
                                {{ $project->client }}
                            </td>


                            {{-- Status --}}
                            <td style="padding: 16px;">

                                @if ($project->status === 'planning')

                                    <span style="
                                        display: inline-block;
                                        padding: 5px 10px;
                                        border-radius: 999px;
                                        background: #e0e7ff;
                                        color: #3730a3;
                                        font-size: 13px;
                                        font-weight: 600;
                                    ">
                                        Planning
                                    </span>

                                @elseif ($project->status === 'in_progress')

                                    <span style="
                                        display: inline-block;
                                        padding: 5px 10px;
                                        border-radius: 999px;
                                        background: #dbeafe;
                                        color: #1d4ed8;
                                        font-size: 13px;
                                        font-weight: 600;
                                    ">
                                        In Progress
                                    </span>

                                @elseif ($project->status === 'completed')

                                    <span style="
                                        display: inline-block;
                                        padding: 5px 10px;
                                        border-radius: 999px;
                                        background: #dcfce7;
                                        color: #15803d;
                                        font-size: 13px;
                                        font-weight: 600;
                                    ">
                                        Completed
                                    </span>

                                @elseif ($project->status === 'on_hold')

                                    <span style="
                                        display: inline-block;
                                        padding: 5px 10px;
                                        border-radius: 999px;
                                        background: #fef3c7;
                                        color: #b45309;
                                        font-size: 13px;
                                        font-weight: 600;
                                    ">
                                        On Hold
                                    </span>

                                @endif

                            </td>


                            {{-- Start Date --}}
                            <td style="padding: 16px;">

                                {{ $project->start_date
                                    ? $project->start_date->format('M d, Y')
                                    : '—'
                                }}

                            </td>


                            {{-- Due Date --}}
                            <td style="padding: 16px;">

                                {{ $project->due_date
                                    ? $project->due_date->format('M d, Y')
                                    : '—'
                                }}

                            </td>


                            {{-- Actions --}}
                            <td style="padding: 16px;">

                                <div style="
                                    display: flex;
                                    gap: 10px;
                                    align-items: center;
                                ">

                                    <a
                                        href="{{ route('admin.projects.edit', $project) }}"
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
                                        action="{{ route('admin.projects.destroy', $project) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this project?');"
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

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="6"
                                style="
                                    padding: 40px;
                                    text-align: center;
                                    color: #64748b;
                                "
                            >
                                No projects found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection