<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Listing;
use App\Models\EventTiming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StartEventController extends Controller
{
    public function startevent() {
        return view('listings.startevent');
    }

    // Starting of event 
    public function sEvent($id)
    {
        // Retrieve the event details using the ID
        $listing = Listing::findOrFail($id); // Adjust the model name accordingly

        // Pass the event data to your view
        return view('listings.startevent', compact('listing'));
    }

   

    // Saving
    public function saveEvent(Request $request)
{
    Log::info('Request received at saveEvent method', ['request' => $request->all()]);

    // Validate the request
    $validatedData = $request->validate([
        'listing_id' => 'required|integer',
        'time_start' => 'required|string',
        'time_end' => 'required|string',
        'event_duration' => 'required|integer',
    ]);

    try {
        // Log the validated data for debugging
        Log::info('Validated data:', $validatedData);

        $event = new EventTiming(); // Ensure this is the correct model name
        $event->listing_id = $validatedData['listing_id'];
        $event->time_start = $validatedData['time_start'];
        $event->time_end = $validatedData['time_end'];
        $event->event_duration = $validatedData['event_duration'];
        $event->save();

        Log::info('Event saved successfully', ['event' => $event]);

        return response()->json(['success' => true, 'event' => $event]);
    } catch (\Exception $e) {
        Log::error('Failed to save event:', ['error' => $e->getMessage()]);
        return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
    }
}

    /////
 

public function showTimes($id)
{
    $listing = Listing::with('eventTimings')->findOrFail($id); // Fetch listing and its associated event timings
    return view('listings.index', compact('listing'));
}



    


}
