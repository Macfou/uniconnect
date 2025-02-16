<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function calendarPage(Request $request)
    {
        // Fetch all facilities
        $facilities = Facility::all(); // Adjust query as needed
        
        // Get the year and month from the request, or use the current year and month as default
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));
        
        // Fetch events from listings based on the selected year, month, and venue
        $events = DB::table('listings')
            ->whereYear('event_date', $year)
            ->whereMonth('event_date', $month)
            ->get();
        
        // Check if a specific facility and date are selected
        $selectedFacilityId = $request->input('facility_id');
        $selectedDate = $request->input('date');
    
        // Fetch booked time slots for the selected facility and date
        $bookedSlots = Listing::where('venue_id', $selectedFacilityId)
        ->where('event_date', $selectedDate)
        ->pluck('time_id')
        ->toArray();
    
    
    
        // Pass the facilities, events, and booked slots data to the view
        return view('pages.calendar', [
            'facilities' => $facilities,
            'events' => $events,
            'bookedSlots' => $bookedSlots,
            'selectedFacilityId' => $selectedFacilityId,
            'selectedDate' => $selectedDate,
        ]);
    }
    
}
