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
        $selectedYear = $request->input('year', date('Y'));
        $selectedMonth = $request->input('month', date('n'));
        $selectedDate = $request->input('date', date('Y-m-d')); // Get the selected date
        $selectedFacility = $request->input('facility'); 
        $facilities = Facility::all(); // Fetch all facilities
    
        $bookedSlots = [];
    
        if ($selectedFacility) {
            // Get booked slots from ufmo_pending
            $ufmoSlots = DB::table('ufmo_pending')
                ->where('event_date', $selectedDate)
                ->where('venue', $selectedFacility)
                ->pluck('event_time') // Format: "7:00 AM - 9:00 AM"
                ->toArray();
    
            // Get booked slots from listings
            $listingSlots = DB::table('listings')
                ->where('event_date', $selectedDate)
                ->where('venue', $selectedFacility)
                ->pluck('event_time') // Format: "1:00 PM - 6:00 PM"
                ->toArray();
    
            // Merge booked slots from both tables
            $bookedSlots = array_merge($ufmoSlots, $listingSlots);
        }
    
        return view('pages.calendar', compact('facilities', 'selectedYear', 'selectedMonth', 'selectedDate', 'bookedSlots'));
    }

    public function getBookedSlots(Request $request)
{
    $venue = $request->input('venue');
    $eventDate = $request->input('event_date');

    $bookedSlots = Listing::where('venue', $venue)
        ->where('event_date', $eventDate)
        ->pluck('event_time') // Assuming event_time is stored as "7:00 AM - 3:00 PM"
        ->toArray();

    return response()->json($bookedSlots);
}
    
  
    
}
