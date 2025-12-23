<?php

namespace App\Http\Controllers;

use App\Models\Custom_user;
use App\Models\Custom_user_role;
use Illuminate\Http\Request;
use App\Models\Role;
use Hash;
use Auth;
class RegisterController extends Controller
{
    public function show()
    {
        $roles = Role::all();
        return view('register', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:custom_users,email',
            'password' => 'required|min:6',
            'role' => 'required|array',
        ]);

        // Create user the way you like
        $user = new Custom_user;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $userId = $user->id;

        foreach ($request->role as $role) {
            $userRole = new Custom_user_role;
            $userRole->roleId = $role;
            $userRole->userId = $userId;
            $userRole->save();

        }


        return redirect('/login')->with('status', 'Registration successful! Please log in now.');
    }

}