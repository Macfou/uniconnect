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
    
    
    public function reject(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'rejection_reason' => 'required|string',
        ]);
    
        // Find the event
        $event = Listing::find($id);
    
        if (!$event) {
            return redirect()->back()->with('error', 'Event not found.');
        }
    
        // Update status and rejection reason
        $event->update([
            'status' => 'Rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);
    
        return redirect()->back()->with('success', 'Event rejected successfully.');
    }
    
    
    
    
    
}
