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
        $fname = $user->fname;
        $lname = $user->lname;
    
        $eventsAttended = EventAttendee::with('event')
            ->where('fname', $fname)
            ->where('lname', $lname)
            ->get();
    
        return view('pages.eventattended', compact('eventsAttended', 'user'));
    }
    
    
    

    
    public function submitFeedback(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:listings,id',
            'feedback' => 'required|string|max:1000',
            'feedback_venue' => 'required|string|max:1000',
            'feedback_speaker' => 'required|string|max:1000',
            'feedback_time' => 'required|string|max:1000',
        ]);

        $userId = Auth::id();

        $existingFeedback = Feedback::where('listing_id', $request->event_id)
            ->where('user_id', $userId)
            ->first();

        if ($existingFeedback) {
            return response()->json(['message' => 'You have already submitted feedback for this event.'], 400);
        }

        // Analyze using your trained model
        function analyzeSentiment($text)
        {
            // Correct path and safe argument
            $pythonScript = "C:\\xampp\\htdocs\\dashboard\\umak_event\\python\\sentiment.py";
            $escapedText = escapeshellarg($text); // safely quotes and escapes
            $command = "python {$pythonScript} {$escapedText}";

            Log::info("Sentiment command: " . $command);

            $output = shell_exec($command);

            Log::info("Output: " . $output);

            return is_null($output) || trim($output) === '' ? 0 : (int) trim($output);
        }

        $sentimentMain = analyzeSentiment($request->feedback);
        $sentimentVenue = analyzeSentiment($request->feedback_venue);
        $sentimentSpeaker = analyzeSentiment($request->feedback_speaker);
        $sentimentTime = analyzeSentiment($request->feedback_time);

        Feedback::create([
            'listing_id' => $request->event_id,
            'user_id' => $userId,
            'feedback' => $request->feedback,
            'feedback_venue' => $request->feedback_venue,
            'feedback_speaker' => $request->feedback_speaker,
            'feedback_time' => $request->feedback_time,
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
