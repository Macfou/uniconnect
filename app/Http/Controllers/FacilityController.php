<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class FacilityController extends Controller
{
    // Store a new facility

    // Display a list of facilities
    public function index()
    {
        $facilities = Facility::all();
        return view('admin.admin_pages.facility', compact('facilities'));
    }
    

// Show the edit form for a specific facility
public function edit($id)
{
    $facility = Facility::findOrFail($id); // Find facility by ID
    return view('admin.admin_pages.facility.edit', compact('facility')); // Pass facility to your edit view
}

    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'facilityName' => 'required|string|max:255',
            'facilityImage' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'facilityCapacity' => 'required|integer|max:10000',
        ]);

        // Handle file upload
        $path = $request->file('facilityImage')->store('facilities', 'public');

        // Create new facility
        Facility::create([
            'facilityName' => $request->facilityName,
            'facilityImage' => $path,
            'facilityCapacity' => $request->facilityCapacity,
        ]);

        return redirect()->route('facilities.index')->with('success', 'Facility added successfully!');
    }

    // Update an existing facility
    public function update(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);

        // Validate incoming request
        $request->validate([
            'facilityName' => 'required|string|max:255',
            'facilityImage' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'facilityCapacity' => 'required|integer|max:10000',
        ]);

        // Update facility details
        $facility->facilityName = $request->facilityName;
        $facility->facilityCapacity = $request->facilityCapacity;

        // Handle file upload if a new image is provided
        if ($request->hasFile('facilityImage')) {
            // Delete old image if necessary
            Storage::disk('public')->delete($facility->facilityImage);

            $path = $request->file('facilityImage')->store('facilities', 'public');
            $facility->facilityImage = $path;
        }

        $facility->save();

        return redirect()->route('facilities.index')->with('success', 'Facility updated successfully!');
    }

    // Destroy a facility
    public function destroy($id)
    {
        $facility = Facility::findOrFail($id);

        // Delete the facility image from storage
        Storage::disk('public')->delete($facility->facilityImage);

        // Delete the facility record
        $facility->delete();

        return redirect()->route('facilities.index')->with('success', 'Facility deleted successfully!');
    }
}
