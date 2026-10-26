<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;

class ReportController extends Controller
{
    public function index()
    {
        // Project statistics
        $totalProjects = Project::count();

        $planningProjects = Project::where(
            'status',
            'planning'
        )->count();

        $inProgressProjects = Project::where(
            'status',
            'in_progress'
        )->count();

        $completedProjects = Project::where(
            'status',
            'completed'
        )->count();

        // User statistics
        $totalUsers = User::count();

        $totalEmployees = User::where(
            'role',
            'employee'
        )->count();

        $totalAdmins = User::where(
            'role',
            'admin'
        )->count();

        // Recent projects for the report table
        $projects = Project::latest()->paginate(10);

        return view('admin.reports.index', compact(
            'totalProjects',
            'planningProjects',
            'inProgressProjects',
            'completedProjects',
            'totalUsers',
            'totalEmployees',
            'totalAdmins',
            'projects'
        ));
    }

    
    public function export()
    {
        $projects = Project::query()->latest()->get();

        return response()->streamDownload(
            function () use ($projects) {
                $handle = fopen('php://output', 'w');

                if ($handle === false) {
                    return;
                }

                // Help Excel recognize UTF-8 text.
                fwrite($handle, "\xEF\xBB\xBF");

                fputcsv($handle, [
                    'Project ID',
                    'Project Name',
                    'Client',
                    'Description',
                    'Status',
                    'Start Date',
                    'Due Date',
                    'Created At',
                ], ',', '"', '');

                foreach ($projects as $project) {
                    fputcsv($handle, [
                        $project->id,
                        $this->safeCsvValue($project->name),
                        $this->safeCsvValue($project->client),
                        $this->safeCsvValue($project->description),
                        $project->status,
                        $project->start_date?->format('Y-m-d') ?? '',
                        $project->due_date?->format('Y-m-d') ?? '',
                        $project->created_at?->format('Y-m-d H:i:s') ?? '',
                    ], ',', '"', '');
                }

                fclose($handle);
            },
            'business-hub-project-report-' . now()->format('Y-m-d') . '.csv',
            ['Content-Type' => 'text/csv; charset=UTF-8']
        );
    }

    /**
     * Reduce spreadsheet formula-injection risk in text fields.
     */
    private function safeCsvValue(?string $value): string
    {
        $value = (string) $value;

        if (preg_match('/^[\t\r\n ]*[=+\-@]/', $value) === 1) {
            return "'" . $value;
        }

        return $value;
    }

}