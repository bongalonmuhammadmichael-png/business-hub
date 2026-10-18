<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display all users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->query('role') === 'employee') {
            $query->where('role', 'employee');
        }

        $users = $query->latest()->get();

        $roleFilter = $request->query('role');

        return view('admin.users.index', compact(
            'users',
            'roleFilter'
        ));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:admin,employee'],
        ]);

        
        $user = User::create($validated);

        ActivityLog::create([
            'user_id' => auth()->id(),
            'actor_name' => auth()->user()->name,
            'action' => 'user.created',
            'subject_type' => 'User',
            'subject_id' => $user->id,
            'description' => 'Created user account: ' . $user->name,
            'metadata' => [
                'role' => $user->role,
                'email' => $user->email,
            ],
        ]);


        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing a user.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update an existing user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],
            'role' => ['required', 'in:admin,employee'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);
        
        ActivityLog::create([
            'user_id' => auth()->id(),
            'actor_name' => auth()->user()->name,
            'action' => 'user.updated',
            'subject_type' => 'User',
            'subject_id' => $user->id,
            'description' => 'Updated user account: ' . $user->name,
            'metadata' => [
                'role' => $user->role,
                'email' => $user->email,
            ],
        ]);


        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     */
    
    public function destroy(User $user)
    {
        // Prevent the administrator from deleting their own account
        if ($user->id === auth()->id()) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Preserve the account details before deletion
        $userId = $user->id;
        $userName = $user->name;
        $userEmail = $user->email;
        $userRole = $user->role;

        // Delete the user account
        $user->delete();

        // Record the deletion
        ActivityLog::create([
            'user_id' => auth()->id(),
            'actor_name' => auth()->user()->name,
            'action' => 'user.deleted',
            'subject_type' => 'User',
            'subject_id' => $userId,
            'description' => 'Deleted user account: ' . $userName,
            'metadata' => [
                'name' => $userName,
                'email' => $userEmail,
                'role' => $userRole,
            ],
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

}