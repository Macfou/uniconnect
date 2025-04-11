<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UscApproval;

class UscApprovalController extends Controller
{
    public function index()
    {
        $approvals = UscApproval::with(['user', 'listing'])
                        ->where('status', 'Pending')
                        ->get();
    
        return view('admin.admin_pages.eventrequests', compact('approvals'));
    }
    

    public function approveRequest($id)
    {
        // Find the event by ID
        $approvals = UscApproval::findOrFail($id);
    
        // Update status to 'approved'
        $approvals->status = 'Approve';  
        $approvals->save();
    
        // Redirect back with a success message
       
      
            return redirect()->route('eventrequests.index')
    ->with('message', 'Event approved!');

    }

    public function rejectRequest($id)
    {
        $approvals = \App\Models\UscApproval::findOrFail($id);
        $approvals->status = 'Reject';
        $approvals->save();
    
        return redirect()->back()->with('message', 'Request rejected successfully.');
    }

    public function showApproved()
    {
        $approvals = UscApproval::where('status', 'Approve')->get();
        return view('admin.admin_pages.usc_approved', compact('approvals'));
    }
    
    public function showRejected()
    {
        $approvals = UscApproval::where('status', 'Reject')->get();
        return view('admin.admin_pages.usc_rejected', compact('approvals'));
    }
    
}
