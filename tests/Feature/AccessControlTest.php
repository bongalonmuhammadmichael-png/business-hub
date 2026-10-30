<?php

use App\Models\User;
use App\Models\Project;


test('visitors can access public pages', function () {
    $pages = [
        '/',
        '/about',
        '/contact',
        '/login',
        '/register',
    ];

    foreach ($pages as $page) {
        $this->get($page)->assertOk();
    }
});

test('guests are redirected to login when accessing the admin dashboard', function () {
    $this->get('/admin')
        ->assertRedirect(route('login'));
});

test('employees cannot access the admin dashboard', function () {
    $employee = User::factory()->create([
        'role' => 'employee',
    ]);

    $this->actingAs($employee)
        ->get('/admin')
        ->assertForbidden();
});

test('administrators can access the admin dashboard', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $this->actingAs($admin)
        ->get('/admin')
        ->assertOk();
});


test('administrators can access users and projects pages', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('admin.users.index'))
        ->assertOk();

    $this->actingAs($admin)
        ->get(route('admin.projects.index'))
        ->assertOk();
});

test('employees cannot access users and projects pages', function () {
    $employee = User::factory()->create(['role' => 'employee']);

    $this->actingAs($employee)
        ->get(route('admin.users.index'))
        ->assertForbidden();

    $this->actingAs($employee)
        ->get(route('admin.projects.index'))
        ->assertForbidden();
});

test('guests are redirected when accessing users and projects pages', function () {
    $this->get(route('admin.users.index'))
        ->assertRedirect(route('login'));

    $this->get(route('admin.projects.index'))
        ->assertRedirect(route('login'));
});


test('employees cannot perform administrative management actions', function () {
    $employee = User::factory()->create(['role' => 'employee']);

    $targetUser = User::factory()->create(['role' => 'employee']);

    $project = Project::create([
        'name' => 'Security Test Project',
        'client' => 'Test Client',
        'description' => 'Testing employee permissions.',
        'status' => 'planning',
        'start_date' => '2026-11-01',
        'due_date' => '2026-11-15',
    ]);

    $this->actingAs($employee)
        ->post(route('admin.users.store'), [
            'name' => 'Unauthorized User',
            'email' => 'unauthorized@example.com',
            'password' => 'StrongPassword123!',
            'password_confirmation' => 'StrongPassword123!',
            'role' => 'admin',
        ])
        ->assertForbidden();

    $this->post(route('admin.projects.store'), [
        'name' => 'Unauthorized Project',
        'client' => 'Test Client',
        'status' => 'planning',
        'start_date' => '2026-11-01',
        'due_date' => '2026-11-15',
    ])->assertForbidden();

    $this->put(route('admin.users.update', $targetUser), [
        'name' => 'Unauthorized Update',
        'email' => 'unauthorized.update@example.com',
        'role' => 'admin',
    ])->assertForbidden();

    $this->delete(route('admin.users.destroy', $targetUser))
        ->assertForbidden();

    $this->put(route('admin.projects.update', $project), [
        'name' => 'Unauthorized Project Update',
        'client' => 'Test Client',
        'status' => 'completed',
        'start_date' => '2026-11-01',
        'due_date' => '2026-11-15',
    ])->assertForbidden();

    $this->delete(route('admin.projects.destroy', $project))
        ->assertForbidden();

    $this->assertDatabaseHas('users', [
        'id' => $targetUser->id,
        'name' => $targetUser->name,
    ]);

    $this->assertDatabaseHas('projects', [
        'id' => $project->id,
        'name' => 'Security Test Project',
    ]);

    $this->assertDatabaseMissing('users', [
        'email' => 'unauthorized@example.com',
    ]);
});