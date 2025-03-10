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
    
        $user = Gso::where('email', $request->email)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('gso')->login($user);
            return redirect('/gso/gso_pages/gso_dashboard');
        }
    
        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }
    
    public function logout()
    {
        Auth::guard('gso')->logout();
        return redirect('/gso/gso_pages/gsologin');
    }
}
