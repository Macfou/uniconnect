<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\GsoCategory;
use Illuminate\Http\Request;
use App\Models\BorrowRequest;

class BorrowEquipmentController extends Controller
{
    public function borrow($listing_id)
    {
        // Get the event details
        $event = Listing::findOrFail($listing_id);
    
        // Get all equipment with calculated available quantity
        $equipments = GsoCategory::all()->map(function ($equipment) {
            // Calculate borrowed equipment quantity (Pending/Approved)
            $borrowedQuantity = BorrowRequest::where('equipment_id', $equipment->id)
                ->whereIn('status', ['Pending', 'Approved'])
                ->sum('quantity');
    
            // Calculate returned equipment quantity
            $returnedQuantity = BorrowRequest::where('equipment_id', $equipment->id)
                ->where('status', 'Returned')
                ->sum('quantity');
    
            // Adjust available quantity
            $equipment->available_quantity = max(0, ($equipment->quantity - $borrowedQuantity) + $returnedQuantity);
    
            return $equipment;
        });
    
        return view('pages.borrow', compact('event', 'equipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'equipment_id' => 'required|exists:gsocategory,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Fetch the equipment
        $equipment = GsoCategory::findOrFail($request->equipment_id);
    
        // Calculate current available quantity
        $borrowedQuantity = BorrowRequest::where('equipment_id', $equipment->id)
            ->whereIn('status', ['Pending', 'Approved'])
            ->sum('quantity');
    
        $returnedQuantity = BorrowRequest::where('equipment_id', $equipment->id)
            ->where('status', 'Returned')
            ->sum('quantity');
    
        $availableQuantity = max(0, ($equipment->quantity - $borrowedQuantity) + $returnedQuantity);
    
        // Check if enough quantity is available
        if ($availableQuantity < $request->quantity) {
            return redirect()->back()->with('error', 'Not enough equipment available.');
        }
    
        // Create the borrow request (don't decrease equipment quantity here)
        BorrowRequest::create([
            'listing_id' => $request->listing_id,
            'equipment_id' => $request->equipment_id,
            'quantity' => $request->quantity,
            'status' => 'Pending', // Initial status
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->route('listings.create')->with('success', 'Borrow request submitted. Status: Pending, waiting for approval from GSO.');
    }
    

// pending

public function pendingRequests()
{
    // Fetch borrow requests with related user and listing data
    $pendingRequests = BorrowRequest::with(['user', 'listing', 'equipment'])->where('status', 'pending')->get();

    return view('gso.gso_pages.gso_pending', compact('pendingRequests'));
}




public function approve($id)
{
    $borrowRequest = BorrowRequest::findOrFail($id);
    $borrowRequest->status = 'approved';
    $borrowRequest->save();

    return redirect()->route('gso.gso_pages.gso_approved')->with('success', 'Borrow request approved.');
}

public function approvedRequests()
{
    $approvedRequests = BorrowRequest::where('status', 'approved')->with('user', 'equipment', 'listing')->get();
    return view('gso/gso_pages/gso_approved', compact('approvedRequests'));
}


public function reject($id)
{
    $borrowRequest = BorrowRequest::findOrFail($id);
    $borrowRequest->update(['status' => 'rejected']);

    return back()->with('success', 'Request rejected.');
}

public function requestView()
{
    if (auth()->user()->is_admin) {
        // Admin can see all requests
        $requests = BorrowRequest::with('equipment')->get();
    } else {
        // User can see only their requests
        $requests = BorrowRequest::where('user_id', auth()->id())->with('equipment')->get();
    }

    return view('pages.requestview', compact('requests'));
}

public function cancelRequest($id)
{
    $borrowRequest = BorrowRequest::findOrFail($id);
    
    // Optional: Restore the quantity back to inventory if necessary
    $equipment = GsoCategory::find($borrowRequest->equipment_id);
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
    $borrowRequests = BorrowRequest::where('status', 'Borrowed')->with(['user', 'listing', 'equipment'])->get();

    // Return the view with all borrowed requests
    return view('gso.gso_pages.gso_borrowed', compact('borrowRequests'));
}

public function markAsBorrowed($id)
{
    // Find the approved request
    $borrowRequest = BorrowRequest::findOrFail($id);

    // Update status to "Borrowed"
    $borrowRequest->status = 'Borrowed';
    $borrowRequest->save();

    // Redirect back to the list of borrowed equipment
    return redirect()->route('gso.borrowed')->with('success', 'Equipment marked as borrowed.');
}


public function markAsReturned($id)
{
    // Find the borrowed request
    $borrowRequest = BorrowRequest::findOrFail($id);

    // Update status to "Returned"
    $borrowRequest->status = 'Returned';
    $borrowRequest->save();

    // Redirect to the returned page with a success message
    return redirect()->route('gso.returned')->with('success', 'Equipment marked as returned.');
}


public function showReturnedRequests()
{
    // Fetch all returned requests
    $borrowRequests = BorrowRequest::where('status', 'Returned')->with(['user', 'listing', 'equipment'])->get();

    // Return the view with all returned requests
    return view('gso.gso_pages.gso_returned', compact('borrowRequests'));
}



}

