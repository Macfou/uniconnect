<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\AdviserApproval;

class AdviserRequestController extends Controller
{
    public function showForm($id)
    {
        // Retrieve the event by its ID
        $event = Listing::findOrFail($id); // Make sure to replace Event with the actual model name if it's different

        // Pass the event data to the view
        return view('listings.request_adviser', compact('event'));
    }
    
    public function searchUser(Request $request)
{
    $user = User::where('email', $request->email)->first();

    if ($user) {
        return response()->json([
            'id' => $user->id,          // <- make sure this is here
            'fname' => $user->fname,
            'lname' => $user->lname,
            'org' => $user->org,
        ]);
    } else {
        return response()->json(['error' => 'User not found'], 404);
    }
}


public function store(Request $request)
{
    // Validation
    $request->validate([
        'adviser_id' => 'required|exists:users,id',
        'user_id' => 'required|exists:users,id',
        'listings_id' => 'required|exists:listings,id',
    ]);

    // Check if the adviser was already assigned for this user & event
    $exists = AdviserApproval::where('user_id', $request->user_id)
                ->where('listings_id', $request->listings_id)
                ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'You have already assigned an adviser for this event.');
    }

    // Store the adviser approval
    AdviserApproval::create([
        'adviser_id' => $request->adviser_id,
        'user_id' => $request->user_id,
        'listings_id' => $request->listings_id,
    ]);

    return redirect()->back()->with('success', 'Adviser successfully assigned!');
}


    
}
