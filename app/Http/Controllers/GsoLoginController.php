<?php

namespace App\Http\Controllers;

use App\Models\Gso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GsoLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Use the GSO guard for authentication
        if (Auth::guard('gso')->attempt($credentials)) {
            return redirect('/gso/gso_pages/gso_dashboard.blade.php');
        }
        

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }

    public function logout()
    {
        Auth::guard('gso')->logout();
        return redirect('/admin/admin_users/gsologin.blade.php');
    }
}
