<?php

namespace App\Http\Controllers;

use App\Models\Ufmo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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
        return redirect('/ufmologin');
    }

    public function showForgotPasswordForm()
    {
        return view('ufmo.ufmo_pages.forgot-password');
    }

    // Step 1: Send OTP to Email
    public function sendOtpfp (Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = Ufmo::where('email', $request->email)->first();
        $otp = rand(100000, 999999); // Generate 6-digit OTP

        Session::put('otp', $otp);
        Session::put('otp_email', $user->email);
        Session::put('otp_expires_at', now()->addMinutes(5)); // OTP expires in 5 minutes

        // Send OTP via email
        Mail::raw("Your OTP for password reset is: $otp", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Password Reset OTP');
        });

        return redirect()->route('forgot.password.form')->with('otp_sent', 'OTP sent to your email.');
    }

    // Step 2: Verify OTP and Reset Password
    public function verifyOtpfp (Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'new_password' => 'required|min:8|same:new_password_confirmation',
            'new_password_confirmation' => 'required'
        ]);
        

        if (!Session::has('otp') || now()->greaterThan(Session::get('otp_expires_at'))) {
            return back()->withErrors(['otp' => 'The OTP has expired. Request a new one.']);
        }

        if ($request->otp != Session::get('otp')) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        $user = Ufmo::where('email', Session::get('otp_email'))->first();
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Clear OTP session
        Session::forget(['otp', 'otp_email', 'otp_expires_at']);

        return redirect('/login')->with('success', 'Password reset successfully. You can now log in.');
    }
}
