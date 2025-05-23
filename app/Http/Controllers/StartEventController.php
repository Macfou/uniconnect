<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Listing;
use App\Models\EventTiming;
use Illuminate\Http\Request;
use App\Models\EventAttendee;
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



    // scan

    public function searchStudent(Request $request)
    {
        // Validate that 'idnumber' was provided in the request
        $request->validate([
            'idnumber' => 'required|string'
        ]);

        // Search for the student in the users table by 'idnumber'
        $student = User::where('idnumber', $request->idnumber)->first();

        if ($student) {
            // Return student details as JSON response
            return response()->json([
                'success' => true,
                'student' => [
                    'fname' => $student->fname,
                    'lname' => $student->lname,
                    'org' => $student->org,
                    'photo' => $student->photo,
                    
                ]
            ]);
        } else {
            // Return error if student not found
            return response()->json([
                'success' => false,
                'error' => 'Student not found'
            ], 404);
        }
    }

    //submit attendance

    public function submitAttendance(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'student_id' => 'required|exists:users,idnumber',  // Make sure the student ID exists in users table
            'event_id'   => 'required|exists:listings,id',     // Make sure the event ID exists in listings table
        ]);

        // Check if the student is already registered for the event
        $existingAttendance = EventAttendee::table('event_attendees')
                                ->where('user_id', $validatedData['student_id'])
                                ->where('event_id', $validatedData['event_id'])
                                ->first();

        if ($existingAttendance) {
            return response()->json(['error' => 'Student has already registered for this event'], 400);
        }

        // Insert the attendance record into the event_attendees table
        EventAttendee::table('event_attendees')->insert([
            'user_id'  => $validatedData['student_id'],
            'event_id' => $validatedData['event_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Return a success response
        return response()->json(['success' => true]);
    }


}
