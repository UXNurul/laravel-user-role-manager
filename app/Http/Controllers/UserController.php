<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign the "subscriber" role to the newly created user
        $subscriberRole = Role::where('name', 'subscriber')->first();
        if ($subscriberRole) {
            $user->roles()->attach($subscriberRole);
        }

        return redirect()->back()->with('success', 'User registered successfully.');
    }

    public function showAssignRoleForm()
    {
        $users = User::all();
        $roles = Role::all();
        return view('assign_role', compact('users', 'roles'));
    }

    public function assignRole(Request $request)
    {
        $userId = $request->input('user_id');
        $roleName = $request->input('role');

        $user = User::find($userId); // Find user by ID
        $role = Role::where('name', $roleName)->first(); // Find role by name

        if ($user && $role) {
            $user->roles()->detach(); // Remove any existing roles
            $user->roles()->attach($role); // Assign the new role
            return redirect()->back()->with('success', 'Role assigned successfully.');
        }
        return redirect()->back()->with('error', 'User or role not found.');
    }

}
