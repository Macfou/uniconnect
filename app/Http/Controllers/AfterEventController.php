<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AfterEventController extends Controller
{
    public function showEventAttendees($id)
    {
        // Fetch attendees for the given event
        $attendees = DB::table('event_attendees')
            ->select('fname', 'lname', 'org')
            ->where('event_id', $id)
            ->get();
    
        // Fetch feedback and sentiment data for the event
        $feedbacks = DB::table('feedback')
            ->select('feedback', 'sentiment', 'feedback_venue', 'sentiment_venue', 'feedback_speaker', 'sentiment_speaker', 'feedback_time', 'sentiment_time')
            ->where('listing_id', $id)
            ->get();
    
        $totalAttendees = count($attendees);
    
        // Count positive, neutral, and negative feedback for each type of sentiment
        $positiveFeedback = $feedbacks->where('sentiment', 1)->count();
        $neutralFeedback = $feedbacks->where('sentiment', 0)->count();
        $negativeFeedback = $feedbacks->where('sentiment', -1)->count();
    
        $positiveVenueFeedback = $feedbacks->where('sentiment_venue', 1)->count();
        $neutralVenueFeedback = $feedbacks->where('sentiment_venue', 0)->count();
        $negativeVenueFeedback = $feedbacks->where('sentiment_venue', -1)->count();
    
        $positiveSpeakerFeedback = $feedbacks->where('sentiment_speaker', 1)->count();
        $neutralSpeakerFeedback = $feedbacks->where('sentiment_speaker', 0)->count();
        $negativeSpeakerFeedback = $feedbacks->where('sentiment_speaker', -1)->count();
    
        $positiveTimeFeedback = $feedbacks->where('sentiment_time', 1)->count();
        $neutralTimeFeedback = $feedbacks->where('sentiment_time', 0)->count();
        $negativeTimeFeedback = $feedbacks->where('sentiment_time', -1)->count();
    
        // Calculate the percentages for each feedback type
        $positivePercentage = $totalAttendees > 0 ? ($positiveFeedback / $totalAttendees) * 100 : 0;
        $neutralPercentage = $totalAttendees > 0 ? ($neutralFeedback / $totalAttendees) * 100 : 0;
        $negativePercentage = $totalAttendees > 0 ? ($negativeFeedback / $totalAttendees) * 100 : 0;
    
        $positiveVenuePercentage = $totalAttendees > 0 ? ($positiveVenueFeedback / $totalAttendees) * 100 : 0;
        $neutralVenuePercentage = $totalAttendees > 0 ? ($neutralVenueFeedback / $totalAttendees) * 100 : 0;
        $negativeVenuePercentage = $totalAttendees > 0 ? ($negativeVenueFeedback / $totalAttendees) * 100 : 0;
    
        $positiveSpeakerPercentage = $totalAttendees > 0 ? ($positiveSpeakerFeedback / $totalAttendees) * 100 : 0;
        $neutralSpeakerPercentage = $totalAttendees > 0 ? ($neutralSpeakerFeedback / $totalAttendees) * 100 : 0;
        $negativeSpeakerPercentage = $totalAttendees > 0 ? ($negativeSpeakerFeedback / $totalAttendees) * 100 : 0;
    
        $positiveTimePercentage = $totalAttendees > 0 ? ($positiveTimeFeedback / $totalAttendees) * 100 : 0;
        $neutralTimePercentage = $totalAttendees > 0 ? ($neutralTimeFeedback / $totalAttendees) * 100 : 0;
        $negativeTimePercentage = $totalAttendees > 0 ? ($negativeTimeFeedback / $totalAttendees) * 100 : 0;

           $ratings = Rating::where('listings_id', $id)->get();
    $total = $ratings->count();

    $fields = [
        'r_one', 'r_two', 'r_three', 'r_four', 'r_five',
        'r_six', 'r_seven', 'r_eight', 'r_nine', 'r_ten',
        'r_eleven', 'r_twelve', 'r_thirteen', 'r_fourteen', 'r_fifteen',
        'r_sixteen', 'r_seventeen', 'r_eighteen', 'r_nineteen', 'r_twenty',
    ];

    $percentages = [];

    foreach ($fields as $field) {
        $acceptable = $ratings->whereIn($field, [1, 2])->count();
        $percentages[$field] = $total > 0 ? round(($acceptable / $total) * 100) : 0;
    }
    
        // Return the view with the calculated data
        return view('pages.afterevent', compact(
            'attendees', 
            'feedbacks', 
            'positivePercentage', 
            'neutralPercentage', 
            'negativePercentage',
            'positiveVenuePercentage',
            'neutralVenuePercentage',
            'negativeVenuePercentage',
            'positiveSpeakerPercentage',
            'neutralSpeakerPercentage',
            'negativeSpeakerPercentage',
            'positiveTimePercentage',
            'neutralTimePercentage',
            'negativeTimePercentage',
            'ratings',
            'percentages'
        ));
    }
    
    

}
