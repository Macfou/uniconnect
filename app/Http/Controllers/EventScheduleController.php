<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Listing;
use Illuminate\Http\Request;

class EventScheduleController extends Controller
{
    // In your ListingController or a dedicated service
      // Manage function
      

    public function manageUpcomming()
    {
        $today = \Carbon\Carbon::today();
    
    // Fetch only events with event_date greater than today (future events)
    $listings = auth()->user()->listings()
        ->whereDate('event_date', '>', $today)
        ->get();
        
    return view('listings.manage', ['listings' => $listings]);
}

    public function manageToday()
    {
        $today = \Carbon\Carbon::today();
    
        $listings = auth()->user()->listings()
        ->whereDate('event_date', $today)
        ->get();
        
    return view('listings.manage_realtime', ['listings' => $listings]);
}

    public function managePrevious()
    {
        $today = \Carbon\Carbon::today();
    
        $listings = auth()->user()->listings()
        ->whereDate('event_date', '<', $today)
        ->get();
        
    return view('listings.manage_previous', ['listings' => $listings]);
}
    
    
    }


