<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ProjectController extends Controller
{
    /**
     * Display all projects.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        $search = trim($validated['search'] ?? '');

        $requestedStatus = $request->query('status');

        $allowedStatuses = [
            'planning',
            'in_progress',
            'completed',
        ];

        $statusFilter = in_array($requestedStatus, $allowedStatuses, true)
            ? $requestedStatus
            : null;

        $query = Project::query();

        // Filter by project status.
        if ($statusFilter !== null) {
            $query->where('status', $statusFilter);
        }

        // Search by project name or client.
        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('name', 'like', "%{$search}%")
                    ->orWhere('client', 'like', "%{$search}%");
            });
        }

        $projects = $query->latest()->get();

        return view('admin.projects.index', compact(
            'projects',
            'statusFilter',
            'search'
        ));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created project.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'client' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:planning,in_progress,completed'],
            'start_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $project = Project::create($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'actor_name' => auth()->user()->name,
            'action' => 'project.created',
            'subject_type' => 'Project',
            'subject_id' => $project->id,
            'description' => 'Created project: ' . $project->name,
            'metadata' => [
                'status' => $project->status,
            ],
        ]);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Show the specified project.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing a project.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update an existing project.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'client' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:planning,in_progress,completed'],
            'start_date' => ['required', 'date'],
            'due_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $project->update($validated);
        
        ActivityLog::create([
            'user_id' => auth()->id(),
            'actor_name' => auth()->user()->name,
            'action' => 'project.updated',
            'subject_type' => 'Project',
            'subject_id' => $project->id,
            'description' => 'Updated project: ' . $project->name,
            'metadata' => [
                'status' => $project->status,
            ],
        ]);


        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Delete a project.
     */
    
    public function destroy(Project $project)
    {
        // Preserve the project details before deletion
        $projectName = $project->name;
        $projectId = $project->id;

        // Delete the project
        $project->delete();

        // Record the deletion in the activity log
        ActivityLog::create([
            'user_id' => auth()->id(),
            'actor_name' => auth()->user()->name,
            'action' => 'project.deleted',
            'subject_type' => 'Project',
            'subject_id' => $projectId,
            'description' => 'Deleted project: ' . $projectName,
            'metadata' => [
                'project_name' => $projectName,
            ],
        ]);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }

}