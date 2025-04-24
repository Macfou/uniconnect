<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Listing;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
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

public function viewFeedback($listing_id)
    {
        // Fetch the listing by ID
        $listing = Listing::findOrFail($listing_id);

        // Fetch the feedback associated with the listing
        $feedbacks = Feedback::where('listing_id', $listing_id)->get();

        // Fetch the ratings associated with the listing
        $ratings = Rating::where('listings_id', $listing_id)->get();

        // Pass the data to the view
        return view('pages.viewfeedback', compact('listing', 'feedbacks', 'ratings'));
    }


}
