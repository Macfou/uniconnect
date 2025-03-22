<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class OTPController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
    
        $otp = rand(100000, 999999);
        Session::put('otp', $otp);
        Session::put('otp_email', $request->email);
    
        // Send OTP using Mailable
        Mail::to($request->email)->send(new OtpMail($otp));
    
        return response()->json(['success' => true, 'message' => 'OTP sent to email.']);
    }
    

    public function verifyOtp(Request $request)
    {
        if ($request->otp == Session::get('otp') && $request->email == Session::get('otp_email')) {
            $user = User::where('email', $request->email)->first();
            Auth::login($user);
            Session::forget(['otp', 'otp_email']);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
    }
}

