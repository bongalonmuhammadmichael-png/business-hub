@extends('layouts.admin')

@section('title', 'Add Project | Business Hub')

@section('page-heading', 'Add Project')

@section('content')

<div class="container" style="padding: 50px 0; max-width: 900px;">

    <div style="
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 35px;
    ">

        <div>
            <h1 style="margin-bottom: 8px;">
                Add New Project
            </h1>

            <p style="color: #64748b;">
                Create a new Business Hub project.
            </p>
        </div>

        <a
            href="{{ route('admin.projects.index') }}"
            class="btn btn-primary"
        >
            ← Back to Projects
        </a>

    </div>


    {{-- Validation Errors --}}
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

        <form
            method="POST"
            action="{{ route('admin.projects.store') }}"
        >

            @csrf


            {{-- Project Name --}}
            <div style="margin-bottom: 22px;">

                <label for="name">
                    Project Name
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    placeholder="Enter project name"
                    style="
                        width: 100%;
                        padding: 13px;
                        margin-top: 8px;
                    "
                >

            </div>


            {{-- Client --}}
            <div style="margin-bottom: 22px;">

                <label for="client">
                    Client
                </label>

                <input
                    type="text"
                    id="client"
                    name="client"
                    value="{{ old('client') }}"
                    required
                    placeholder="Enter client or company name"
                    style="
                        width: 100%;
                        padding: 13px;
                        margin-top: 8px;
                    "
                >

            </div>


            {{-- Description --}}
            <div style="margin-bottom: 22px;">

                <label for="description">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="Describe the project..."
                    style="
                        width: 100%;
                        padding: 13px;
                        margin-top: 8px;
                        resize: vertical;
                    "
                >{{ old('description') }}</textarea>

            </div>


            {{-- Status --}}
            <div style="margin-bottom: 22px;">

                <label for="status">
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    required
                    style="
                        width: 100%;
                        padding: 13px;
                        margin-top: 8px;
                    "
                >

                    <option
                        value="planning"
                        {{ old('status', 'planning') === 'planning' ? 'selected' : '' }}
                    >
                        Planning
                    </option>

                    <option
                        value="in_progress"
                        {{ old('status') === 'in_progress' ? 'selected' : '' }}
                    >
                        In Progress
                    </option>

                    <option
                        value="completed"
                        {{ old('status') === 'completed' ? 'selected' : '' }}
                    >
                        Completed
                    </option>

                </select>

            </div>


            {{-- Start Date --}}
            <div style="margin-bottom: 22px;">

                <label for="start_date">
                    Start Date
                </label>

                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value="{{ old('start_date') }}"
                    required
                    style="
                        width: 100%;
                        padding: 13px;
                        margin-top: 8px;
                    "
                >

            </div>


            {{-- Due Date --}}
            <div style="margin-bottom: 30px;">

                <label for="due_date">
                    Due Date
                </label>

                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ old('due_date') }}"
                    required
                    style="
                        width: 100%;
                        padding: 13px;
                        margin-top: 8px;
                    "
                >

            </div>


            <button
                type="submit"
                class="btn btn-primary"
            >
                Create Project
            </button>

        </form>

    </div>

</div>

@endsection