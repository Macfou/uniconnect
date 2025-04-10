<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdviserApproval;

class RequestAdviserController extends Controller
{
    public function index()
    {
        $requests = AdviserApproval::with(['user', 'listing'])
                        ->where('status', 'Pending')
                        ->get();
    
        return view('pages.requestadviser', compact('requests'));
    }
    
    

    // Check if email exists in the adviser_approval table
    public function checkEmail($email)
    {
        $adviser = AdviserApproval::where('email', $email)->first(); // Check if email exists in dean_approval

        if ($adviser) {
            return response()->json(['status' => 'exists', 'adviser' => $adviser]);
        } else {
            return response()->json(['status' => 'not_exists']);
        }
    }

    public function approveRequest($id)
    {
        // Find the event by ID
        $event = AdviserApproval::findOrFail($id);
    
        // Update status to 'approved'
        $event->status = 'Approve';  
        $event->save();
    
        // Redirect back with a success message
       
      
            return redirect()->route('pages.requests')
    ->with('message', 'Event approved!');

    }
    
    public function rejectRequest($id)
    {
        $request = \App\Models\AdviserApproval::findOrFail($id);
        $request->status = 'Reject';
        $request->save();
    
        return redirect()->back()->with('message', 'Request rejected successfully.');
    }

    public function showApproved()
{
    $approvedRequests = AdviserApproval::where('status', 'Approve')->get();
    return view('pages.adviser_approve', compact('approvedRequests'));
}

public function showRejected()
{
    $rejectedRequests = AdviserApproval::where('status', 'Reject')->get();
    return view('pages.adviser_reject', compact('rejectedRequests'));
}

}
