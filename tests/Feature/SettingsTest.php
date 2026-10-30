<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;


test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('users can update their profile information', function () {
    $user = User::factory()->create([
        'name' => 'Original Test User',
        'email' => 'original@example.com',
    ]);

    $this->actingAs($user)
        ->put(route('user-profile-information.update'), [
            'name' => 'Updated Test User',
            'email' => 'updated@example.com',
        ]);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Updated Test User',
        'email' => 'updated@example.com',
    ]);
});


test('users can update their passwords', function () {
    $user = User::factory()->create([
        'password' => Hash::make('OldPassword123!'),
    ]);

    $this->actingAs($user)
        ->put(route('user-password.update'), [
            'current_password' => 'OldPassword123!',
            'password' => 'NewStrongPassword123!',
            'password_confirmation' => 'NewStrongPassword123!',
        ]);

    $user->refresh();

    expect(Hash::check('NewStrongPassword123!', $user->password))->toBeTrue();
    expect(Hash::check('OldPassword123!', $user->password))->toBeFalse();
});

test('users cannot update passwords with an incorrect current password', function () {
    $user = User::factory()->create([
        'password' => Hash::make('OldPassword123!'),
    ]);

    $this->actingAs($user)
        ->put(route('user-password.update'), [
            'current_password' => 'WrongPassword123!',
            'password' => 'NewStrongPassword123!',
            'password_confirmation' => 'NewStrongPassword123!',
        ])
        ->assertSessionHasErrorsIn('updatePassword', 'current_password');

    $user->refresh();

    expect(Hash::check('OldPassword123!', $user->password))->toBeTrue();
});


test('users cannot update their profile with an existing email address', function () {
    $user = User::factory()->create([
        'email' => 'first@example.com',
    ]);

    User::factory()->create([
        'email' => 'existing@example.com',
    ]);

    $this->actingAs($user)
        ->put(route('user-profile-information.update'), [
            'name' => 'Updated Test User',
            'email' => 'existing@example.com',
        ])
        ->assertSessionHasErrorsIn(
            'updateProfileInformation',
            'email'
        );

    $user->refresh();

    expect($user->email)->toBe('first@example.com');
});


test('administrators can access the settings page', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('admin.settings.index'))
        ->assertOk();
});

test('employees cannot access the settings page', function () {
    $employee = User::factory()->create(['role' => 'employee']);

    $this->actingAs($employee)
        ->get(route('admin.settings.index'))
        ->assertForbidden();
});

test('guests are redirected to login when accessing settings', function () {
    $this->get(route('admin.settings.index'))
        ->assertRedirect(route('login'));
});