<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\UscApproval;

class RequestUscController extends Controller
{
    public function showForm($id)
    {
        // Retrieve the event by its ID
        $event = Listing::findOrFail($id); // Make sure to replace Event with the actual model name if it's different

        // Pass the event data to the view
        return view('listings.request_usc', compact('event'));
    }
    
    

public function store(Request $request)
{
    // Validation
    $request->validate([
        
        'user_id' => 'required|exists:users,id',
        'listings_id' => 'required|exists:listings,id',
    ]);

    // Check if the  was already assigned for this user & event
    $exists = UscApproval::where('user_id', $request->user_id)
                ->where('listings_id', $request->listings_id)
                ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'You have already requested   for this event.');
    }

    // Store the approval
    UscApproval::create([
        
        'user_id' => $request->user_id,
        'listings_id' => $request->listings_id,
    ]);

    return redirect()->back()->with('success', ' successfully requested !');
}


    
}
