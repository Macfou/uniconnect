<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\EventAttendee;

class StudentAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Listing::query();
    
        // Filter by organization
        if ($request->has('organization') && $request->organization != '') {
            $query->where('organization', $request->organization);
        }
    
        // Search by tags (event title)
        if ($request->has('search')) {
            $query->where('tags', 'like', '%' . $request->search . '%');
        }
    
        // Get list of unique organizations for dropdown
        $organizations = Listing::select('organization')->distinct()->pluck('organization');
    
        $listings = $query->paginate(10);
    
        return view('pages.student_attendance', compact('listings', 'organizations'));
    }
    

    public function viewAttendees($eventId)
{
    // Get the event based on ID
    $event = Listing::findOrFail($eventId);

    // Get the attendees of this event
    $attendees = EventAttendee::where('event_id', $eventId)->get();

    // Return the view with attendees data
    return view('pages.attendees', compact('event', 'attendees'));
}
    

}
