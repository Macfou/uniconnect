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
            'images.*' => 'nullable|image',  // Validate each image (if applicable)
        ]);

        // Store the equipment data
        BringIn::create([
            'user_id' => $request->user_id,
            'listings_id' => $request->listings_id,
            'equipment' => $request->equipment, // Store the array as JSON
            'quantity' => $request->quantity,   // Store the array as JSON
            'images' => $request->images,       // Store the array as JSON
        ]);

        return redirect()->back()->with('success', 'Equipment request submitted successfully!');
    }

}
