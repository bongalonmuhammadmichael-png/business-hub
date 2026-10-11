<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalEmployees = User::where('role', 'employee')->count();

        $totalProjects = Project::count();

        $completedProjects = Project::where('status', 'completed')->count();

        $recentProjects = Project::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalEmployees',
            'totalProjects',
            'completedProjects',
            'recentProjects'
        ));
    }
}