
@extends('layouts.admin')

@section('title', 'Activity Log | Business Hub')
@section('page-heading', 'Activity Log')

@section('content')
<div class="activity-page">

    <div class="activity-page-intro">
        <div>
            <h2>Workspace Activity</h2>
            <p>Review user and project actions across Business Hub.</p>
        </div>

        <div class="activity-total">
            {{ $activities->total() }} records
        </div>
    </div>

    <form
        method="GET"
        action="{{ route('admin.activity-logs.index') }}"
        class="activity-filters"
    >
        <div class="activity-search-field">
            <label for="search">Search activity</label>
            <input
                type="text"
                id="search"
                name="search"
                value="{{ $search }}"
                placeholder="Search descriptions or users..."
                maxlength="100"
            >
        </div>

        <div class="activity-type-field">
            <label for="type">Activity category</label>
            <select id="type" name="type">
                <option value="">All activities</option>
                <option value="project" @selected($typeFilter === 'project')>
                    Projects
                </option>
                <option value="user" @selected($typeFilter === 'user')>
                    Users
                </option>
            </select>
        </div>

        <button type="submit" class="activity-filter-button">
            Apply filters
        </button>

        <a
            href="{{ route('admin.activity-logs.index') }}"
            class="activity-clear-button"
        >
            Clear
        </a>
    </form>

    <div class="activity-history-card">
        @forelse ($activities as $activity)
            <div class="activity-history-row">

                <div class="activity-mark {{ $activity->subject_type === 'Project' ? 'activity-mark-project' : 'activity-mark-user' }}">
                    {{ $activity->subject_type === 'Project' ? 'P' : 'U' }}
                </div>

                <div class="activity-history-details">
                    <p class="activity-history-description">
                        {{ $activity->description }}
                    </p>

                    <p class="activity-history-meta">
                        <span>{{ $activity->actor_name }}</span>
                        <span aria-hidden="true">·</span>
                        <time datetime="{{ $activity->created_at->toIso8601String() }}">
                            {{ $activity->created_at->format('M d, Y · h:i A') }}
                        </time>
                    </p>
                </div>

                <span class="activity-history-type">
                    {{ ucwords(str_replace('.', ' ', $activity->action)) }}
                </span>

            </div>
        @empty
            <div class="activity-history-empty">
                <h3>No activities found</h3>
                <p>Try changing your search or category filter.</p>
            </div>
        @endforelse
    </div>

    @if ($activities->hasPages())
        <div class="activity-pagination">
            {{ $activities->links() }}
        </div>
    @endif

</div>
@endsection
