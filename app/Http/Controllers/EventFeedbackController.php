<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\EventAttendee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class EventFeedbackController extends Controller
{
   public function showForm($listings_id)
{
    return view('pages.event_feedback', ['event_id' => $listings_id]);
}

public function showForm_comment($listings_id)
{
    return view('pages.event_comments', ['event_id' => $listings_id]);
}
    


public function submitFeedback(Request $request)
{
    Log::info('Feedback submission started.', [
        'user_id' => Auth::id(),
        'request_data' => $request->all()
    ]);

    $request->validate([
        'listings_id' => 'required|exists:listings,id',
        'event_rating' => 'required|array',
        'venue_rating' => 'required|array',
        'presentation_rating' => 'required|array',
        'time_rating' => 'required|array',
    ]);

    Log::info('Validation passed.');

    $questions = [
        // Section A: Event
        'Overall quality of the event',
        'Engagement of the event from start to finish',
        'Satisfaction with the event\'s organization',
        'Relevance of the event content to your interests',
        'Likelihood of attending a similar event in the future',

        // Section B: Venue
        'Comfort of the seating and space',
        'Accessibility of the venue location',
        'Suitability of the venue for the event',
        'Cleanliness and maintenance of the venue',
        'Audio/Visual setup of the venue',

        // Section C: Presentation
        'Clarity and understandability of presenters',
        'Effectiveness of visual aids (slides, videos)',
        'Organization of the presentations',
        'Speaker knowledge and expertise',
        'Engagement and interactivity of the presentations',

        // Section D: Time Management
        'Timeliness of event start and end',
        'Pacing of each session or activity',
        'Reasonableness of break durations',
        'Efficiency of time allocation per speaker/topic',
        'Management of the overall event schedule',
    ];

    $ratings = array_merge(
        $request->event_rating,
        $request->venue_rating,
        $request->presentation_rating,
        $request->time_rating
    );

    Log::info('Merged ratings:', $ratings);

    $ratingData = [
        'listings_id' => $request->listings_id,
        'users_id' => Auth::id(),
    ];

    for ($i = 0; $i < 20; $i++) {
        $questionKey = 'q_' . $this->numToWord($i + 1);
        $ratingKey = 'r_' . $this->numToWord($i + 1);
        $ratingData[$questionKey] = $questions[$i];
        $ratingData[$ratingKey] = $ratings[$i];
    }

    Log::info('Final data to be stored in Rating:', $ratingData);

    Rating::create($ratingData);

    Log::info('Feedback successfully saved for user.', [
        'user_id' => Auth::id(),
        'listings_id' => $request->listings_id
    ]);
    Log::info('Received listings_id:', ['listings_id' => $request->listings_id]);

    return redirect()->route('submit.comments', ['listings_id' => $request->listings_id])
        ->with('success', 'Thank you for your feedback!');
}


// Helper function to convert numbers to words
private function numToWord($num)
{
    $map = [
        1 => 'one', 2 => 'two', 3 => 'three', 4 => 'four', 5 => 'five',
        6 => 'six', 7 => 'seven', 8 => 'eight', 9 => 'nine', 10 => 'ten',
        11 => 'eleven', 12 => 'twelve', 13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen', 19 => 'nineteen', 20 => 'twenty',
    ];

    return $map[$num];
}




public function showComments($id)
{
    $event = \App\Models\Listing::findOrFail($id); // assuming your events model is Listing
    return view('pages.event_comments', compact('event'));
}



}
