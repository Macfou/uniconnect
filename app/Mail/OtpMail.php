<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; // Add logging

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp; // Store OTP

    public function __construct($otp)
    {
        $this->otp = $otp;
        Log::info("OtpMail Constructor - OTP: " . $otp); // Debugging
    }

    public function build()
    {
        Log::info("OtpMail Build Method - Sending OTP: " . $this->otp); // Debugging

        return $this->subject('Your OTP Code')
                    ->view('emails.otp')
                    ->with(['otp' => $this->otp]);
    }
}
