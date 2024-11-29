<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\EventAttendee;
use Illuminate\Support\Facades\Auth;

class EventattendedController extends Controller
{
    public function showEventsAttended()
    {
        $user = Auth::user(); // Get the authenticated user
        $fname = $user->fname; // Replace with your user model's first name field
        $lname = $user->lname; // Replace with your user model's last name field

        $events = Listing::all();
    
        $eventsAttended = EventAttendee::with(['event'])
            ->where('fname', $fname)
            ->where('lname', $lname)
            ->get();
    
        return view('pages.eventattended', compact('eventsAttended'));
    }

    public function submitFeedback(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:listings,id',
            'feedback' => 'required|string|max:1000',
        ]);
    
        $userId = Auth::id();
    
        // Check if the user has already submitted feedback for the event
        $existingFeedback = Feedback::where('listing_id', $request->event_id)
            ->where('user_id', $userId)
            ->first();
    
        if ($existingFeedback) {
            return response()->json(['message' => 'You have already submitted feedback for this event.'], 400);
        }
    
        // Save the feedback
        Feedback::create([
            'listing_id' => $request->event_id,
            'user_id' => $userId,
            'feedback' => $request->feedback,
        ]);
    
        return response()->json(['message' => 'Feedback submitted successfully.'], 200);
    }

    public function showEventDetails($id)
{
    $event = Listing::findOrFail($id); // Assuming 'Listing' is your event model
    return view('pages.eventattended', compact('event'));
}

}
