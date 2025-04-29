<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EndEvent;
use Illuminate\Support\Facades\Auth;

class EndEventController extends Controller
{
    public function endEvent($listing_id)
    {
        // Check if this event is already ended by this user
        $existing = EndEvent::where('listings_id', $listing_id)
            ->where('users_id', Auth::id())
            ->first();

        if ($existing) {
            return redirect()->back()->with('info', 'You have already ended this event.');
        }

        // Save the end event record
        EndEvent::create([
            'listings_id' => $listing_id,
            'users_id' => Auth::id(),
            'end_event' => 1,
        ]);

        return redirect()->back()->with('success', 'Event ended successfully.');
    }
}
