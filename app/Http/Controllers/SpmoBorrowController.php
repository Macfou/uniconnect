<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\SpmoCategory;
use Illuminate\Http\Request;
use App\Models\BorrowRequest;
use App\Models\SpmoBorrowRequest;

class SpmoBorrowController extends Controller
{
    public function borrow($listing_id)
{
    // Get the event details
    $event = Listing::findOrFail($listing_id);

    // Get all equipment with calculated available quantity
    $equipments = SpmoCategory::all()->map(function ($equipment) {
        // Calculate borrowed equipment quantity (Pending/Approved)
        $borrowedQuantity = SpmoBorrowRequest::where('equipment_id', $equipment->id)
            ->whereIn('status', ['Pending', 'Approved'])
            ->sum('quantity');

        // Calculate returned equipment quantity
        $returnedQuantity = SpmoBorrowRequest::where('equipment_id', $equipment->id)
            ->where('status', 'Returned')
            ->sum('quantity');

        // Adjust available quantity
        $equipment->available_quantity = max(0, ($equipment->quantity - $borrowedQuantity) + $returnedQuantity);

        return $equipment;
    });

    return view('pages.spmo_borrow', compact('event', 'equipments'));
}


    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'equipment_id' => 'required|exists:spmocategory,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Fetch the equipment
        $equipment = SpmoCategory::findOrFail($request->equipment_id);
    
        // Calculate current available quantity
        $borrowedQuantity = SpmoBorrowRequest::where('equipment_id', $equipment->id)
            ->whereIn('status', ['Pending', 'Approved'])
            ->sum('quantity');
    
        $returnedQuantity = SpmoBorrowRequest::where('equipment_id', $equipment->id)
            ->where('status', 'Returned')
            ->sum('quantity');
    
        $availableQuantity = max(0, ($equipment->quantity - $borrowedQuantity) + $returnedQuantity);
    
        // Check if enough quantity is available
        if ($availableQuantity < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough equipment available.');
        }
    
        // Create the borrow request (don't decrease equipment quantity here)
        SpmoBorrowRequest::create([
            'listing_id' => $request->listing_id,
            'equipment_id' => $request->equipment_id,
            'quantity' => $request->quantity,
            'status' => 'Pending', // Initial status
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->route('listing.spmo_borrow', ['listing_id' => $request->listing_id])
        ->with('success', 'Borrow request submitted. Status: Pending, waiting for approval from SPMO.');
    

    }
    

// pending

public function pendingRequests()
{
    // Fetch borrow requests with related user and listing data
    $pendingRequests = SpmoBorrowRequest::with(['user', 'listing', 'equipment'])->where('status', 'Pending')->get();

    return view('spmo.spmo_pages.pending_borrow', compact('pendingRequests'));
}



public function approve($id)
{
    $borrowRequest = SpmoBorrowRequest::findOrFail($id);
    $borrowRequest->status = 'Approved';
    $borrowRequest->save();

    // Redirect to a GET route instead of PATCH
    return redirect()->route('spmo.spmo_pages.approved_borrow')
        ->with('success', 'Borrow request approved.');
}







public function approvedRequests()
{
    $approvedRequests = SpmoBorrowRequest::where('status', 'Approved')
    ->whereHas('listing') // ensure it has a valid related listing
    ->with('user', 'equipment', 'listing')
    ->get();

    return view('spmo/spmo_pages/approved_borrow', compact('approvedRequests'));
}


public function reject($id)
{
    $borrowRequest = SpmoBorrowRequest::findOrFail($id);
    $borrowRequest->update(['status' => 'rejected']);

    return back()->with('success', 'Request rejected.');
}

public function requestView($id)
{
    if (auth()->user()->is_admin) {
        $requests = SpmoBorrowRequest::with('equipment')->where('listing_id', $id)->get();
    } else {
        $requests = SpmoBorrowRequest::where('user_id', auth()->id())
                                 ->where('listing_id', $id)
                                 ->with('equipment')
                                 ->get();
    }

    return view('pages.spmo_requests', compact('requests'));
}



public function cancelRequest($id)
{
    $borrowRequest = SpmoBorrowRequest::findOrFail($id);
    
    // Optional: Restore the quantity back to inventory if necessary
    $equipment = SpmoCategory::find($borrowRequest->equipment_id);
    if ($equipment) {
        $equipment->quantity += $borrowRequest->quantity;
        $equipment->save();
    }

    $borrowRequest->delete(); // Cancel request (delete the record)

    return redirect()->back()->with('success', 'Request has been canceled.');
}

public function showBorrowedRequests()
{
    // Fetch all borrowed requests
    $borrowRequests = SpmoBorrowRequest::where('status', 'Borrowed')->with(['user', 'listing', 'equipment'])->get();

    // Return the view with all borrowed requests
    return view('spmo.spmo_pages.spmo_borrowed', compact('borrowRequests'));
}

public function markAsBorrowed($id)
{
    // Find the approved request
    $borrowRequest = SpmoBorrowRequest::findOrFail($id);

    // Update status to "Borrowed"
    $borrowRequest->status = 'Borrowed';
    $borrowRequest->save();

    // Redirect back to the list of borrowed equipment
    return redirect()->route('spmo.borrowedshow')->with('success', 'Equipment marked as borrowed.');
}


public function markAsReturned($id)
{
    // Find the borrowed request
    $borrowRequest = SpmoBorrowRequest::findOrFail($id);

    // Update status to "Returned"
    $borrowRequest->status = 'Returned';
    $borrowRequest->save();

    // Redirect to the returned page with a success message
    return redirect()->route('spmo.returned')->with('success', 'Equipment marked as returned.');
}


public function showReturnedRequests()
{
    // Fetch all returned requests
    $borrowRequests = SpmoBorrowRequest::where('status', 'Returned')->with(['user', 'listing', 'equipment'])->get();

    // Return the view with all returned requests
    return view('spmo.spmo_pages.spmo_returned', compact('borrowRequests'));
}



}

