<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\EventAttendee;
use Illuminate\Support\Facades\Log;
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
        // Validate the request data
        $request->validate([
            'event_id' => 'required|exists:listings,id',
            'feedback' => 'required|string|max:1000',
            'feedback_venue' => 'required|string|max:1000',
            'feedback_speaker' => 'required|string|max:1000',
            'feedback_time' => 'required|string|max:1000',
        ]);
    
        $userId = Auth::id();
    
        // Check if the user has already submitted feedback for the event
        $existingFeedback = Feedback::where('listing_id', $request->event_id)
            ->where('user_id', $userId)
            ->first();
    
        if ($existingFeedback) {
            return response()->json(['message' => 'You have already submitted feedback for this event.'], 400);
        }
    
        // Get the feedback data from the request
        $feedback = $request->feedback;
        $venueFeedback = $request->feedback_venue;
        $speakerFeedback = $request->feedback_speaker;
        $timeFeedback = $request->feedback_time;
    
        // Function to run sentiment analysis on a given text
        function analyzeSentiment($text)
        {
            $command = escapeshellcmd("python " . base_path("python/sentiment.py") . " " . escapeshellarg($text));
            Log::info("Executing command: " . $command);
    
            $sentiment = shell_exec($command);
            Log::info("Shell Output: " . $sentiment);
            Log::info("Last Error: " . print_r(error_get_last(), true));
            Log::info("Sentiment raw output: " . $sentiment);
    
            // Check if sentiment output is empty
            if (empty($sentiment)) {
                Log::error("Sentiment analysis failed: No output from Python script.");
                return null;
            }
    
            // Convert the sentiment output to an integer
            return (int) trim($sentiment);
        }
    
        // Analyze sentiment for each feedback field
        $sentimentMain = analyzeSentiment($feedback);
        $sentimentVenue = analyzeSentiment($venueFeedback);
        $sentimentSpeaker = analyzeSentiment($speakerFeedback);
        $sentimentTime = analyzeSentiment($timeFeedback);
    
        // Save the feedback along with its sentiment analysis results
        Feedback::create([
            'listing_id' => $request->event_id,
            'user_id' => $userId,
            'feedback' => $feedback,
            'feedback_venue' => $venueFeedback,
            'feedback_speaker' => $speakerFeedback,
            'feedback_time' => $timeFeedback,
            'sentiment' => $sentimentMain,
            'sentiment_venue' => $sentimentVenue,
            'sentiment_speaker' => $sentimentSpeaker,
            'sentiment_time' => $sentimentTime,
        ]);
    
        return response()->json(['message' => 'Feedback submitted successfully.'], 200);
    }
    
    

    public function showEventDetails($id)
{
    $event = Listing::findOrFail($id); // Assuming 'Listing' is your event model
    return view('pages.eventattended', compact('event'));
}

}
