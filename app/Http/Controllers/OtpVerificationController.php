<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OtpVerificationController extends Controller
{
    public function showOtpForm()
    {
        return view('auth.verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);

        if ($request->otp == session('otp')) {
            // Retrieve stored user data
            $formFields = session('formFields');

            // Create the user
            $user = User::create($formFields);

            // Clear OTP session
            session()->forget(['otp', 'otp_email', 'formFields']);

            // Redirect to login with success message
            return redirect('/login')->with('success', 'Congrats! Your account has been created.');
        }

        return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
    }
}
