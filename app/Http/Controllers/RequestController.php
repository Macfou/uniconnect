<?php

// app/Http/Controllers/RequestController.php

namespace App\Http\Controllers;

use App\Models\Listing;



use App\Models\DeanApproval;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    // Show all requests in table
    public function index()
    {
        $requests = DeanApproval::with(['user', 'listing'])
                        ->where('status', 'Pending')
                        ->get();
    
        return view('pages.requests', compact('requests'));
    }
    

    // Check if email exists in the dean_approval table
    public function checkEmail($email)
    {
        $dean = DeanApproval::where('email', $email)->first(); // Check if email exists in dean_approval

        if ($dean) {
            return response()->json(['status' => 'exists', 'dean' => $dean]);
        } else {
            return response()->json(['status' => 'not_exists']);
        }
    }

    public function approveRequest($id)
    {
        // Find the event by ID
        $event = DeanApproval::findOrFail($id);
    
        // Update status to 'approved'
        $event->status = 'Approve';  
        $event->save();
    
        // Redirect back with a success message
       
      
            return redirect()->route('pages.requests')
    ->with('message', 'Event approved!');

    }
    
    public function rejectRequest($id)
    {
        $request = \App\Models\DeanApproval::findOrFail($id);
        $request->status = 'Reject';
        $request->save();
    
        return redirect()->back()->with('message', 'Request rejected successfully.');
    }

    public function showApproved()
{
    $approvedRequests = DeanApproval::where('status', 'Approve')->get();
    return view('pages.dean_approve', compact('approvedRequests'));
}

public function showRejected()
{
    $rejectedRequests = DeanApproval::where('status', 'Reject')->get();
    return view('pages.dean_reject', compact('rejectedRequests'));
}

}

