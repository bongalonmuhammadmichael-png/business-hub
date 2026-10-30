<?php

use App\Models\ActivityLog;
use App\Models\Project;
use App\Models\User;

test('administrators can create employee accounts and record activity', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $response = $this->actingAs($admin)
        ->post(route('admin.users.store'), [
            'name' => 'Automated Test Employee',
            'email' => 'automated.employee@example.com',
            'password' => 'StrongPassword123!',
            'password_confirmation' => 'StrongPassword123!',
            'role' => 'employee',
        ]);

    $response->assertRedirect(route('admin.users.index'));

    $user = User::where(
        'email',
        'automated.employee@example.com'
    )->firstOrFail();

    expect($user->role)->toBe('employee');

    $this->assertDatabaseHas('activity_logs', [
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'user.created',
        'subject_type' => 'User',
        'subject_id' => $user->id,
    ]);
});

test('administrators can create projects and record activity', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $response = $this->actingAs($admin)
        ->post(route('admin.projects.store'), [
            'name' => 'Automated Test Project',
            'client' => 'Test Client',
            'description' => 'Project created through automated testing.',
            'status' => 'planning',
            'start_date' => '2026-11-01',
            'due_date' => '2026-11-15',
        ]);

    $response->assertRedirect(route('admin.projects.index'));

    $project = Project::where(
        'name',
        'Automated Test Project'
    )->firstOrFail();

    $this->assertDatabaseHas('activity_logs', [
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'project.created',
        'subject_type' => 'Project',
        'subject_id' => $project->id,
    ]);
});

test('projects with due dates before start dates are rejected', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $response = $this->actingAs($admin)
        ->post(route('admin.projects.store'), [
            'name' => 'Invalid Date Test',
            'client' => 'Test Client',
            'description' => 'Testing invalid project dates.',
            'status' => 'planning',
            'start_date' => '2026-11-15',
            'due_date' => '2026-11-10',
        ]);

    $response->assertSessionHasErrors('due_date');

    $this->assertDatabaseMissing('projects', [
        'name' => 'Invalid Date Test',
    ]);

    expect(
        ActivityLog::where('action', 'project.created')->count()
    )->toBe(0);
});


test('administrators can update employee accounts and record activity', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $employee = User::factory()->create(['role' => 'employee']);

    $response = $this->actingAs($admin)->put(
        route('admin.users.update', $employee),
        [
            'name' => 'Updated Test Employee',
            'email' => 'updated.employee@example.com',
            'role' => 'employee',
        ]
    );

    $response->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'id' => $employee->id,
        'name' => 'Updated Test Employee',
        'email' => 'updated.employee@example.com',
        'role' => 'employee',
    ]);

    $this->assertDatabaseHas('activity_logs', [
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'user.updated',
        'subject_type' => 'User',
        'subject_id' => $employee->id,
    ]);
});


test('administrators can delete employee accounts and record activity', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $employee = User::factory()->create(['role' => 'employee']);

    $response = $this->actingAs($admin)->delete(
        route('admin.users.destroy', $employee)
    );

    $response->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseMissing('users', [
        'id' => $employee->id,
    ]);

    $this->assertDatabaseHas('activity_logs', [
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'user.deleted',
        'subject_type' => 'User',
        'subject_id' => $employee->id,
    ]);
});


test('administrators can update projects and record activity', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $project = Project::create([
        'name' => 'Original Test Project',
        'client' => 'Original Client',
        'description' => 'Original project description.',
        'status' => 'planning',
        'start_date' => '2026-11-01',
        'due_date' => '2026-11-15',
    ]);

    $response = $this->actingAs($admin)->put(
        route('admin.projects.update', $project),
        [
            'name' => 'Updated Test Project',
            'client' => 'Updated Client',
            'description' => 'Updated project description.',
            'status' => 'in_progress',
            'start_date' => '2026-11-01',
            'due_date' => '2026-11-20',
        ]
    );

    $response->assertRedirect(route('admin.projects.index'));

    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'name' => 'Updated Test Project',
        'client' => 'Updated Client',
        'status' => 'in_progress',
    ]);

    $this->assertDatabaseHas('activity_logs', [
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'project.updated',
        'subject_type' => 'Project',
        'subject_id' => $project->id,
    ]);
});


test('administrators can delete projects and record activity', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $project = Project::create([
        'name' => 'Project to Delete',
        'client' => 'Test Client',
        'description' => 'This project will be deleted during testing.',
        'status' => 'planning',
        'start_date' => '2026-11-01',
        'due_date' => '2026-11-15',
    ]);

    $response = $this->actingAs($admin)->delete(
        route('admin.projects.destroy', $project)
    );

    $response->assertRedirect(route('admin.projects.index'));

    $this->assertDatabaseMissing('projects', [
        'id' => $project->id,
    ]);

    $this->assertDatabaseHas('activity_logs', [
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'project.deleted',
        'subject_type' => 'Project',
        'subject_id' => $project->id,
    ]);
});


test('administrators cannot delete their own accounts', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->delete(
        route('admin.users.destroy', $admin)
    );

    $response->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'id' => $admin->id,
        'email' => $admin->email,
        'role' => 'admin',
    ]);
});