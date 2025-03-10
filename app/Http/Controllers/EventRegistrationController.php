<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventRegistration;
use App\Models\Listing;

class EventRegistrationController extends Controller {
    public function create($id) {
        $listing = Listing::findOrFail($id);
        return view('listings.eventregistration', compact('listing'));
    }

    public function store(Request $request, $id) {
        $request->validate([
            'email' => 'required|email',
            'full_name' => 'required|string',
            'year' => 'required|string',
            'college' => 'required|string',
        ]);

        EventRegistration::create([
            'listing_id' => $id,
            'email' => $request->email,
            'full_name' => $request->full_name,
            'year' => $request->year,
            'college' => $request->college,
        ]);

        return redirect()->route('listings.show', $id)->with('success', 'Registration successful!');
    }
}

