<?php

namespace App\Http\Controllers;

use App\Models\Spmo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SpmoLoginController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::guard('spmo')->attempt($credentials)) {
        return redirect('/spmo/spmo_pages/spmo_dashboard');
    }

    return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
}

    public function logout()
    {
        Auth::guard('spmo')->logout();
        return redirect('spmologin');
    }
}
