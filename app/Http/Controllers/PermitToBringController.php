<?php

namespace App\Http\Controllers;

use App\Models\BringIn;
use App\Models\Listing;
use Illuminate\Http\Request;

class PermitToBringController extends Controller
{
    public function showForm($id)
    {
        // Retrieve the event by its ID
        $event = Listing::findOrFail($id); // Make sure to replace Event with the actual model name if it's different

        // Pass the event data to the view
        return view('listings.bringin', compact('event'));
    }

     public function store(Request $request)
    {
        // Validation
        
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'listings_id' => 'required|exists:listings,id',
            'equipment' => 'required|array', // Validate that it's an array
            'quantity' => 'required|array',  // Validate that it's an array
            'images' => 'nullable|array',    // Validate that it's an array
            'image' => 'nullable|image', // Validate each image (if applicable)
            'date_in' => 'required|date',
            'date_out' => 'required|date|after_or_equal:date_in',
        ]);

        // Process uploaded images
        $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads', 'public');
    }

        // Store the equipment data
        BringIn::create([
            'user_id' => $request->user_id,
            'listings_id' => $request->listings_id,
            'equipment' => $request->equipment,
            'quantity' => $request->quantity,
            'image' => $imagePath, // now proper array of paths
            'date_in' => $request->date_in,
            'date_out' => $request->date_out,
        ]);
        

        return redirect()->back()->with('success', 'Equipment request submitted successfully!');
    }

}
