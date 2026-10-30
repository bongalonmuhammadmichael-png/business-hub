<?php

use App\Models\User;
use App\Models\Project;

test('administrators can access the reports page', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('admin.reports.index'))
        ->assertOk();
});

test('employees cannot access the reports page', function () {
    $employee = User::factory()->create(['role' => 'employee']);

    $this->actingAs($employee)
        ->get(route('admin.reports.index'))
        ->assertForbidden();
});

test('guests are redirected to login when accessing reports', function () {
    $this->get(route('admin.reports.index'))
        ->assertRedirect(route('login'));
});


test('administrators can download the CSV report', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)
        ->get(route('admin.reports.export'));

    $response->assertOk();
    $response->assertDownload();
});


test('employees cannot download the CSV report', function () {
    $employee = User::factory()->create(['role' => 'employee']);

    $this->actingAs($employee)
        ->get(route('admin.reports.export'))
        ->assertForbidden();
});


test('CSV report contains the correct project data', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    Project::create([
        'name' => 'CSV Test Project',
        'client' => 'CSV Test Client',
        'description' => 'Project for CSV export testing.',
        'status' => 'planning',
        'start_date' => '2026-11-01',
        'due_date' => '2026-11-15',
    ]);

    $response = $this->actingAs($admin)
        ->get(route('admin.reports.export'));

    $response->assertOk();
    $response->assertDownload();

    $content = $response->streamedContent();

    expect($content)->toContain('CSV Test Project');
    expect($content)->toContain('CSV Test Client');
});


test('CSV export neutralizes spreadsheet formula values', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    Project::create([
        'name' => '=1+1',
        'client' => '@SUM(1,1)',
        'description' => '+Formula Test',
        'status' => 'planning',
        'start_date' => '2026-11-01',
        'due_date' => '2026-11-15',
    ]);

    $response = $this->actingAs($admin)
        ->get(route('admin.reports.export'));

    $response->assertOk();

    $content = $response->streamedContent();

    expect($content)->toContain("'=1+1");
    expect($content)->toContain("'@SUM(1,1)");
    expect($content)->toContain("'+Formula Test");
});


test('reports page displays the latest project records', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    Project::create([
        'name' => 'Reports Test Project',
        'client' => 'Reports Test Client',
        'description' => 'Testing project display on the reports page.',
        'status' => 'planning',
        'start_date' => '2026-11-01',
        'due_date' => '2026-11-15',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.reports.index'))
        ->assertOk()
        ->assertSee('Reports Test Project')
        ->assertSee('Reports Test Client');
});