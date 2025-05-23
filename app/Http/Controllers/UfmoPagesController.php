<?php

namespace App\Http\Controllers;

use App\Models\BringIn;
use App\Models\Listing;
use App\Models\Facility;
use App\Models\UscApproval;
use App\Models\DeanApproval;
use Illuminate\Http\Request;
use App\Models\BorrowRequest;
use App\Models\PermitTransfer;
use App\Models\AdviserApproval;
use App\Models\SpmoBorrowRequest;
use Illuminate\Support\Facades\DB;

class UfmoPagesController extends Controller
{
    public function ufmodashboard() {
        $pendingCount = Listing::where('status', 'pending')->count();
        $approvedCount = Listing::where('status', 'approved')->count();
        $rejectedCount = Listing::where('status', 'rejected')->count();
         $facilities = Facility::all(); 

        $feedbacks = DB::table('feedback')
        ->select('feedback_venue', 'sentiment_venue')
        ->get();

        return view('ufmo.ufmo_pages.ufmo_dashboard', compact('pendingCount', 'approvedCount', 'rejectedCount', 'feedbacks', 'facilities'));
    }

public function ufmopending() {
    $pendingEvents = Listing::with([
        'adviserapproval.adviser', 
        'deanapproval.dean'
    ])
    ->where('status', 'Pending')
    ->whereNotNull('user_id') // Exclude entries with null user_i
    ->get();

    return view('ufmo.ufmo_pages.ufmo_pending', compact('pendingEvents'));
}


public function approval($id)
{
    // Get the Listing based on the ID
    $listing = Listing::findOrFail($id);

    // Load related approval models with user relationships if applicable
    $adviserApproval = AdviserApproval::with('adviser')->where('listings_id', $id)->first();
    $deanApproval = DeanApproval::with('dean')->where('listings_id', $id)->first();
    $uscRequest = UscApproval::where('listings_id', $id)->first();
    $bringInRequest = BringIn::where('listings_id', $id)->first();
    $transferRequest = PermitTransfer::where('listings_id', $id)->first();
    $permitBorrow = BorrowRequest::where('listing_id', $id)->first();
    $spmoBorrowRequest = SpmoBorrowRequest::where('listing_id', $id)->first();

    // Return all data to the view
    return view('ufmo.ufmo_pages.ufmo_approval', compact(
        'listing',
        'adviserApproval',
        'deanApproval',
        'uscRequest',
        'bringInRequest',
        'transferRequest',
        'permitBorrow',
        'spmoBorrowRequest'
    ));
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

   
    public function requestsadviser($id)
    {
        $event = Listing::findOrFail($id); // Get the event
        $requests = AdviserApproval::with('adviser')->where('listings_id', $id)->get(); // Get adviser requests for this event
        
    
        return view('ufmo.ufmo_pages.ufmo_adviser', compact('event', 'requests'));
    }
 
    public function requestsdean($id)
    {
        $event = Listing::findOrFail($id); // Get the event
        $requests = DeanApproval::with('dean')->where('listings_id', $id)->get(); // Get adviser requests for this event
    
        return view('ufmo.ufmo_pages.ufmo_dean', compact('event', 'requests'));
    }
    
    public function requestsusc($id)
    {
        $event = Listing::findOrFail($id);
        $requests = UscApproval::where('listings_id', $id)->get();
    
        return view('ufmo.ufmo_pages.ufmo_usc', compact('event', 'requests'));
    }

    public function requestgso($id)
{
    if (auth()->user()->is_admin) {
        $requests = BorrowRequest::with('equipment')->where('listing_id', $id)->get();
    } else {
        $requests = BorrowRequest::where('user_id', auth()->id())
                                 ->where('listing_id', $id)
                                 ->with('equipment')
                                 ->get();
    }

    return view('ufmo.ufmo_pages.ufmo_gso', compact('requests'));
}

public function spmoborrow($id)
{
    $event = Listing::findOrFail($id);
    
    $requests = SpmoBorrowRequest::where('listing_id', $id)->get();

    return view('ufmo.ufmo_pages.ufmo_spmo', compact('event', 'requests'));
}

public function requestsbringin($id)
{
    $event = Listing::findOrFail($id);
    $requests = BringIn::where('listings_id', $id)->get();

    return view('ufmo.ufmo_pages.ufmo_bringin', compact('event', 'requests'));
}

public function requeststransfer($id)
{
    $event = Listing::findOrFail($id);
    
    $requests = PermitTransfer::where('listings_id', $id)->get();

    return view('ufmo.ufmo_pages.ufmo_transfer', compact('event', 'requests'));
}

}
