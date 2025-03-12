<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class UfmoRequestController extends Controller
{
    public function approveEvent($id)
    {
        // Find the event by ID
        $event = Listing::findOrFail($id);
    
        // Update status to 'approved'
        $event->status = 'approved';  
        $event->save();
    
        // Redirect back with a success message
        return redirect()->route('ufmo.ufmo_pages.ufmo_approved')
            ->with('message', 'Event approved!');
    }
    
    
    public function rejectEvent($id)
    {
        // Find the event by id
        $event = Listing::findOrFail($id);
        
        // Update the status to 'rejected'
        $event->status = 'rejected';  
        $event->save();
    
        // Fetch the updated list of cancelled events (or pending ones)
        $cancelledEvents = Listing::where('status', 'rejected')->get(); // Adjust based on your logic
    
        // Redirect to the list of cancelled events (without the id) and pass data
        return redirect()->route('ufmo.ufmo_pages.ufmo_cancelled')
            ->with('message', 'Event rejected!')
            ->with('cancelledEvents', $cancelledEvents);
    }
    
    
}
