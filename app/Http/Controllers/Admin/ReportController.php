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
}