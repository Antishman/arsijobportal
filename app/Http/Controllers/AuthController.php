<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->username)->first();

        // Auto-create default users
        if (!$user && in_array($request->username, ['admin', 'employer'])) {
            $user = User::create([
                'name' => ucfirst($request->username),
                'email' => $request->username,
                'role' => $request->username,
                'password' => Hash::make('password'),
            ]);
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['login' => 'Invalid credentials']);
        }

        Auth::login($user);

        return match($user->role) {
            'admin' => redirect('/admin/dashboard'),
            'employer' => redirect('/employer/dashboard'),
            default => redirect('/jobseeker/dashboard'),
        };
    }


    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'jobseeker',
            'password' => Hash::make($request->password),
        ]);
    
        Auth::login($user);
    
        // Flash session variable to show popup
        session()->flash('show_profile_popup', true);
    
        return redirect('/jobseeker/dashboard');
    }
    

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
