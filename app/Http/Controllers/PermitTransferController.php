<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\PermitTransfer;

class PermitTransferController extends Controller
{

    public function showForm($id)
    {
        // Retrieve the event by its ID
        $event = Listing::findOrFail($id); // Make sure to replace Event with the actual model name if it's different

        // Pass the event data to the view
        return view('listings.permit_transfer', compact('event'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'listings_id' => 'required|exists:listings,id',
            'equipment' => 'required|string',
            'quantity' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'from' => 'required|string',
            'to' => 'required|string',
            'date_transfer' => 'required|date',
            'remarks' => 'nullable|string',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('permit_images', 'public');
        }
    
        PermitTransfer::create([
            'user_id' => $request->user_id,
            'listings_id' => $request->listings_id,
            'equipment' => json_encode(explode(',', $request->equipment)),
            'quantity' => json_encode(explode(',', $request->quantity)),
            'image' => $imagePath,
            'from' => $request->from,
            'to' => $request->to,
            'date_transfer' => $request->date_transfer,
            'remarks' => $request->remarks,
            'gso_id' => null,  // optional
        ]);
    
        return redirect()->back()->with('success', 'Permit transfer submitted!');
    }
    

    
    public function pending()
    {
        $requests = PermitTransfer::with('user')->where('status', 'Pending')->get();
        return view('transfer.pending', compact('requests'));
    }

    public function approved()
    {
        $requests = PermitTransfer::with('user')->where('status', 'Approved')->get();
        return view('transfer.approve', compact('requests'));
    }

    public function rejected()
    {
        $requests = PermitTransfer::with('user')->where('status', 'Rejected')->get();
        return view('transfer.rejected', compact('requests'));
    }

    public function updateStatus($id, $status)
    {
        $request = PermitTransfer::findOrFail($id);
        $request->status = $status;
        $request->save();

        return back()->with('success', 'Request ' . strtolower($status));
    }
}
