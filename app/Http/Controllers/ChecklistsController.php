<?php

namespace App\Http\Controllers;

use App\Models\BringIn;
use App\Models\Listing;
use App\Models\UscApproval;
use App\Models\DeanApproval;
use Illuminate\Http\Request;
use App\Models\BorrowRequest;
use App\Models\PermitTransfer;
use App\Models\AdviserApproval;

class ChecklistsController extends Controller
{
    public function index($id)
    {
        $event = Listing::findOrFail($id);
    
        // Get the approval records for each type, if they exist
        $adviserRequest = AdviserApproval::where('listings_id', $id)->first();
        $deanRequest = DeanApproval::where('listings_id', $id)->first();
        $uscRequest = UscApproval::where('listings_id', $id)->first();
        $bringInRequest = BringIn::where('listings_id', $id)->first();
        $transferRequest = PermitTransfer::where('listings_id', $id)->first();
        $permitBorrow = BorrowRequest::where('listing_id', $id)->first();
    
        // Pass these to the view
        return view('listings.checklists', compact(
            'event',
            'adviserRequest',
            'deanRequest',
            'uscRequest',
            'bringInRequest',
            'transferRequest',
            'permitBorrow'
        ));
    }
    
    
    public function checkListsBorrow($id)
    {
        if (auth()->user()->is_admin) {
            $requests = BorrowRequest::with('equipment')->where('listing_id', $id)->get();
        } else {
            $requests = BorrowRequest::where('user_id', auth()->id())
                                     ->where('listing_id', $id)
                                     ->with('equipment')
                                     ->get();
        }
    
        // Debugging to ensure requests are fetched
      
    
        return view('listings.checklists', compact('requests'));
    }
    
    

}
