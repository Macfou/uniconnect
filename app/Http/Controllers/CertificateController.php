<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Feedback;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\SentCertificate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;




class CertificateController extends Controller
{
   

    public function showFeedback(Request $request)
    {
        $events = Listing::all();
        $feedbacks = [];
    
        if ($request->has('listing_id')) {
            $feedbacks = Feedback::where('listing_id', $request->listing_id)->with('user')->get();

    
            // Check which users already have certificates sent
            foreach ($feedbacks as $feedback) {
                $feedback->certificate_sent = SentCertificate::where('user_id', $feedback->user->id)
    ->where('listing_id', $request->listing_id)
    ->exists();

            }
        }
    
        return view('pages.certificate', compact('events', 'feedbacks'));
    }
    
    public function storeSentCertificate(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'listing_id' => 'required|exists:listings,id', // Fix column name
        'certificate' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Store the uploaded certificate
    $certificatePath = $request->file('certificate')->store('sent_certificates', 'public');

    // Check if the certificate is already sent
    $alreadySent = SentCertificate::where('user_id', $request->user_id)
        ->where('listing_id', $request->listing_id)
        ->exists();

    if ($alreadySent) {
        return back()->with('error', 'Certificate already sent to this user!');
    }

    // Save the record in the sent_certificates table
    SentCertificate::create([
        'user_id' => $request->user_id,
        'listing_id' => $request->listing_id, // Fix column name
        'certificate_path' => $certificatePath,
    ]);

    return back()->with('success', 'Certificate stored successfully in Sent Certificates table!');
}

    public function myCertificates()
    {
        // Fetch certificates for the currently logged-in user
        $certificates = SentCertificate::where('user_id', Auth::id())->with('listing')->get();

        return view('pages.mycertificate', compact('certificates'));
    }
}


