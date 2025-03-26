<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use App\Mail\OtpMail;

class OtpController extends Controller
{
    // Generate OTP and send email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Generate OTP
        $otp = rand(100000, 999999); // 6-digit OTP

        // Store OTP in cache with expiration time (10 minutes)
        Cache::put('otp_' . $request->email, $otp, now()->addMinutes(10));

        // Send OTP to user email
        Mail::to($request->email)->send(new OtpMail($otp));

        return response()->json(['success' => true, 'message' => 'OTP sent to your email']);
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|numeric',
        ]);

        $storedOtp = Cache::get('otp_' . $request->email);

        if ($storedOtp && $storedOtp == $request->otp) {
            // OTP is correct, you can proceed with account verification or login
            Cache::forget('otp_' . $request->email);
            return response()->json(['success' => true, 'message' => 'OTP verified']);
        }

        return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    }
}