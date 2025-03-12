<?php

namespace App\Http\Controllers;

use App\Models\Ufmo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UfmoLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $user = Ufmo::where('email', $request->email)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::guard('ufmo')->login($user);
            return redirect('/ufmo/ufmo_pages/ufmo_dashboard');
        }
    
        return back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }
    
    public function logout()
    {
        Auth::guard('ufmo')->logout();
        return redirect('/ufmo/ufmo_pages/ufmologin');
    }
}
