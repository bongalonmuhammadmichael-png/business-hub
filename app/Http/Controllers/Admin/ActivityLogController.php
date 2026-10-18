<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'type' => ['nullable', 'in:project,user'],
        ]);

        $search = trim($validated['search'] ?? '');
        $typeFilter = $validated['type'] ?? null;

        $query = ActivityLog::query();

        // Filter by activity category
        if ($typeFilter === 'project') {
            $query->where('subject_type', 'Project');
        } elseif ($typeFilter === 'user') {
            $query->where('subject_type', 'User');
        }

        // Search activity descriptions, actor names, and action types
        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder->where('description', 'like', "%{$search}%")
                    ->orWhere('actor_name', 'like', "%{$search}%")
                    ->orWhere('action', 'like', "%{$search}%");
            });
        }

        // Show 10 records per page and preserve search/filter settings
        $activities = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.activity-logs.index', compact(
            'activities',
            'search',
            'typeFilter'
        ));
    }
}