<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');

Route::view('/about', 'about');

Route::view('/contact', 'contact');

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

    Route::get('/admin/users', [UserController::class, 'index'])
        ->name('admin.users.index');

    Route::get('/admin/users/create', [UserController::class, 'create'])
        ->name('admin.users.create');

    Route::post('/admin/users', [UserController::class, 'store'])
        ->name('admin.users.store');

    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])
        ->name('admin.users.edit');

    Route::put('/admin/users/{user}', [UserController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])
        ->name('admin.users.destroy');
    
    Route::resource('/admin/projects', ProjectController::class)
        ->names('admin.projects');
    
    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index'])
    ->name('admin.activity-logs.index');
});

