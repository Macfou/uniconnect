<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\EventRegistration;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationThankYouMail;

class EventRegistrationController extends Controller {
    public function create($id) {
        $listing = Listing::findOrFail($id);
        return view('listings.eventregistration', compact('listing'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'full_name' => 'required|string',
            'year' => 'required|string',
            'college' => 'required|string',
        ]);

        // Get the event details
        $listing = Listing::findOrFail($id);

        // Create the event registration
        EventRegistration::create([
            'listing_id' => $id,
            'email' => $request->email,
            'full_name' => $request->full_name,
            'year' => $request->year,
            'college' => $request->college,
        ]);

        // Send the registration confirmation email
        Mail::to($request->email)->send(new RegistrationThankYouMail(
            $listing->tags, // Event Title
            $listing->event_date->format('F j, Y, g:i A'), // Event Date
            $request->full_name // User's Full Name
        ));

        // Redirect to event page with success message
        return redirect()->route('listings.show', $id)->with('success', 'Registration successful! A confirmation email has been sent.');
    }


    public function myRegistrations()
{
    $userEmail = auth()->user()->email; // Assuming user is logged in

    $registrations = EventRegistration::where('email', $userEmail)
        ->with('listing') // assuming you have relation listing() in EventRegistration model
        ->get();

    return view('pages.eventregistered', compact('registrations'));
}



}

