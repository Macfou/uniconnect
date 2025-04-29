<?php

namespace App\Http\Controllers;

use App\Models\BringIn;
use App\Models\Listing;
use App\Models\UscApproval;
use App\Models\DeanApproval;
use App\Models\SpmoCategory;
use Illuminate\Http\Request;
use App\Models\BorrowRequest;
use App\Models\PermitTransfer;
use App\Models\AdviserApproval;
use App\Models\SpmoBorrowRequest;

class ViewRequestsController extends Controller
{
    public function requestsadviser($id)
    {
        $event = Listing::findOrFail($id); // Get the event
        $requests = AdviserApproval::with('adviser')->where('listings_id', $id)->get(); // Get adviser requests for this event
        
    
        return view('pages.view_adviser', compact('event', 'requests'));
    }

    public function requestsdean($id)
    {
        $event = Listing::findOrFail($id); // Get the event
        $requests = DeanApproval::with('dean')->where('listings_id', $id)->get(); // Get adviser requests for this event
    
        return view('pages.view_dean', compact('event', 'requests'));
    }

    public function requestsusc($id)
{
    $event = Listing::findOrFail($id);
    $requests = UscApproval::where('listings_id', $id)->get();

    return view('pages.view_usc', compact('event', 'requests'));
}



public function requestsbringin($id)
{
    $event = Listing::findOrFail($id);
    $requests = BringIn::where('listings_id', $id)->get();

    return view('pages.view_bringin', compact('event', 'requests'));
}

public function requeststransfer($id)
{
    $event = Listing::findOrFail($id);
    
    $requests = PermitTransfer::where('listings_id', $id)->get();

    return view('pages.view_transfer', compact('event', 'requests'));
}
    
public function spmoborrow($id)
{
    $event = Listing::findOrFail($id);
    
    $requests = SpmoBorrowRequest::where('listings_id', $id)->get();

    return view('pages.view_transfer', compact('event', 'spmoborrow'));
}

   
}
