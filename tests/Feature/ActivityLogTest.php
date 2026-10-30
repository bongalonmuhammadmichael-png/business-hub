<?php

use App\Models\User;
use App\Models\ActivityLog;


test('administrators can access the activity log page', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('admin.activity-logs.index'))
        ->assertOk();
});

test('employees cannot access the activity log page', function () {
    $employee = User::factory()->create(['role' => 'employee']);

    $this->actingAs($employee)
        ->get(route('admin.activity-logs.index'))
        ->assertForbidden();
});

test('guests are redirected to login when accessing the activity log', function () {
    $this->get(route('admin.activity-logs.index'))
        ->assertRedirect(route('login'));
});


test('administrators can see activity records', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    ActivityLog::create([
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'project.created',
        'subject_type' => 'Project',
        'subject_id' => 1,
        'description' => 'Created project: Activity Log Test Project',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.activity-logs.index'))
        ->assertOk()
        ->assertSee('Activity Log Test Project')
        ->assertSee($admin->name);
});


test('administrators can search activity records', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    ActivityLog::create([
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'project.created',
        'subject_type' => 'Project',
        'subject_id' => 1,
        'description' => 'Created project: Search Test Project',
    ]);

    ActivityLog::create([
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'user.created',
        'subject_type' => 'User',
        'subject_id' => 2,
        'description' => 'Created employee: Another Test User',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.activity-logs.index', [
            'search' => 'Search Test Project',
        ]))
        ->assertOk()
        ->assertSee('Search Test Project')
        ->assertDontSee('Another Test User');
});


test('administrators can filter project activities', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    ActivityLog::create([
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'project.created',
        'subject_type' => 'Project',
        'subject_id' => 1,
        'description' => 'Created project: Filter Test Project',
    ]);

    ActivityLog::create([
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'user.created',
        'subject_type' => 'User',
        'subject_id' => 2,
        'description' => 'Created employee: Filter Test User',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.activity-logs.index', [
            'type' => 'project',
        ]))
        ->assertOk()
        ->assertSee('Filter Test Project')
        ->assertDontSee('Filter Test User');
});


test('administrators can filter user activities', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    ActivityLog::create([
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'project.created',
        'subject_type' => 'Project',
        'subject_id' => 1,
        'description' => 'Created project: Filter Test Project',
    ]);

    ActivityLog::create([
        'user_id' => $admin->id,
        'actor_name' => $admin->name,
        'action' => 'user.created',
        'subject_type' => 'User',
        'subject_id' => 2,
        'description' => 'Created employee: Filter Test User',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.activity-logs.index', [
            'type' => 'user',
        ]))
        ->assertOk()
        ->assertSee('Filter Test User')
        ->assertDontSee('Filter Test Project');
});


test('activity log pagination displays the remaining records', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    for ($i = 1; $i <= 11; $i++) {
        ActivityLog::create([
            'user_id' => $admin->id,
            'actor_name' => $admin->name,
            'action' => 'project.created',
            'subject_type' => 'Project',
            'subject_id' => $i,
            'description' => $i === 11
                ? 'Second Page Activity'
                : "First Page Activity {$i}",
            'created_at' => now()->subMinutes($i),
            'updated_at' => now()->subMinutes($i),
        ]);
    }

    $this->actingAs($admin)
        ->get(route('admin.activity-logs.index', [
            'type' => 'project',
            'page' => 2,
        ]))
        ->assertOk()
        ->assertSee('Second Page Activity')
        ->assertDontSee('First Page Activity');
});