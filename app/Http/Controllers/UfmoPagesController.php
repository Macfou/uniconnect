<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UfmoPagesController extends Controller
{
    public function ufmodashboard() {
        $pendingCount = Listing::where('status', 'pending')->count();
        $approvedCount = Listing::where('status', 'approved')->count();
        $rejectedCount = Listing::where('status', 'rejected')->count();

        $feedbacks = DB::table('feedback')
        ->select('feedback_venue', 'sentiment_venue')
        ->get();

        return view('ufmo.ufmo_pages.ufmo_dashboard', compact('pendingCount', 'approvedCount', 'rejectedCount', 'feedbacks'));
    }

   public function ufmopending() {
    $pendingEvents = Listing::with([
        'adviserapproval.adviser', 
        'deanapproval.dean'
    ])
    ->where('status', 'Pending')
    ->get();

    return view('ufmo.ufmo_pages.ufmo_pending', compact('pendingEvents'));
}

public function approval($id)
{
    // Get the Listing based on the listing_id
    $listing = Listing::findOrFail($id);

    // Get the related AdviserApproval and DeanApproval, including their status and loading adviser/dean if available
    $adviserApproval = $listing->adviserapproval ? $listing->adviserapproval->load('adviser') : null;  
    $deanApproval = $listing->deanapproval ? $listing->deanapproval->load('dean') : null;  

    // Get the status of both approvals
    $adviserStatus = $adviserApproval ? $adviserApproval->status : null;
    $deanStatus = $deanApproval ? $deanApproval->status : null;

    // Return the view with all the data, including the status and the names of adviser and dean
    return view('ufmo.ufmo_pages.ufmo_approval', compact('listing', 'adviserApproval', 'deanApproval', 'adviserStatus', 'deanStatus'));
}




    

    public function ufmoapproved() {
        $approvedEvents = Listing::where('status', 'Approve')->get();

        return view('ufmo.ufmo_pages.ufmo_approved', compact('approvedEvents'));
    
    }



    
    public function ufmoreject() {
        $rejectedEvents = Listing::where('status', 'Reject')->get();
    
        return view('ufmo.ufmo_pages.ufmo_rejected', compact('rejectedEvents'));
    }
    

    public function ufmocancelled() {

        $rejectedEvents = Listing::where('status', 'rejected')->get();
        return view('ufmo.ufmo_pages.ufmo_cancelled', compact('rejectedEvents'));
    }

    public function ufmocalendar() {
        return view('ufmo.ufmo_pages.ufmo_calendar');
    }

 
    
    

    
}
