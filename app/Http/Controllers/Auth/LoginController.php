<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // VULNERABLE: SQL Injection di email
        // Query dibangun langsung dari input user tanpa sanitasi
        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $users = DB::select($query);

        if (!empty($users)) {
            $user = $users[0];
            
            // Password check menggunakan Hash::check
            if (Hash::check($password, $user->password)) {
                Auth::loginUsingId($user->id, $request->boolean('remember'));
                $request->session()->regenerate();

                ActivityLog::create([
                    'user_id' => Auth::id(),
                    'action' => 'login',
                    'details' => 'User logged in',
                    'ip_address' => $request->ip(),
                ]);

                if (Auth::user()->isAdmin()) {
                    return redirect()->intended('/admin/dashboard');
                }

                return redirect()->intended('/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'logout',
            'details' => 'User logged out',
            'ip_address' => $request->ip(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}