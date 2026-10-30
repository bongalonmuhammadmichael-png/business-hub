<?php

use App\Models\User;

test('public registration always assigns the employee role', function () {
    $response = $this->post('/register', [
        'name' => 'Registration Test',
        'email' => 'registration@example.com',
        'password' => 'StrongPassword123!',
        'password_confirmation' => 'StrongPassword123!',
        'role' => 'admin',
    ]);

    $response->assertRedirect('/');

    $this->assertDatabaseHas('users', [
        'email' => 'registration@example.com',
        'role' => 'employee',
    ]);

    $user = User::where(
        'email',
        'registration@example.com'
    )->firstOrFail();

    expect($user->role)->toBe('employee');
});
