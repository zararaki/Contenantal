<?php

namespace App\Http\Controllers;
use App\Models\Custom_user_role;
use Illuminate\Http\Request;
use App\Models\Role;
use Auth;


class LoginController extends Controller
{

    public function show()
    {
        return view('logindashboard');
    }
    public function authLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();


            $user = Auth::user();
            $userId = $user->id;

            $userRoles = Custom_user_role::where('userId', $userId)->get();
            $hasAdmin = false;
            $hasHunter = false;
            $hasClient = false;

            foreach ($userRoles as $r) {
                $role = Role::where('id', $r->roleId)->first();

                if ($role) {
                    if ($role->name === 'Admin') {
                        $hasAdmin = true;
                    } elseif ($role->name === 'Hunter') {
                        $hasHunter = true;
                    } elseif ($role->name === 'Client') {
                        $hasClient = true;
                    }
                }
            }


            if ($hasAdmin) {
                return redirect('/admin/dashboard');
            } elseif ($hasHunter) {
                return redirect('/hunter/dashboard');
            } elseif ($hasClient) {
                return redirect('/client/dashboard');
            } else {

                return redirect('/quests')->with('error', 'No role assigned.');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ])->withInput();
    }
}