<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    // Display all facilities
    public function index()
    {
        $facilities = Facility::all(); // Fetch all facilities from the database
        return view('admin.admin_pages.facility', compact('facilities'));
    }
    

    // Store a new facility
    public function store(Request $request)
    {
        // Validate the form inputs
        $validatedData = $request->validate([
            'facility_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sitting_capacity' => 'required|integer',
            'classification' => 'required|array', // Fix: Allow multiple selections
            'classification.*' => 'in:University Event, Class Events,College Events,Organization Events,Sports Events', // Fix: Validate each selected item
            'status' => 'required|in:Available,Unavailable',
        ]);
    
        // Convert classification array to JSON for storage
        $validatedData['classification'] = json_encode($validatedData['classification']);
    
        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('facility_images', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        // Save the facility to the database
        Facility::create($validatedData);
    
        return redirect()->back()->with('success', 'Facility added successfully!');
    }
    

    public function update(Request $request, $id)
    {
        $facility = Facility::findOrFail($id);

        $request->validate([
            'facility_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sitting_capacity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update facility fields
        $facility->facility_name = $request->facility_name;
        $facility->description = $request->description;
        $facility->sitting_capacity = $request->sitting_capacity;

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('facility_images', 'public');
            $facility->image = $imagePath;
        }

        $facility->save();

        return redirect()->back()->with('success', 'Organization updated successfully!');
    }
    
    
    

    // Delete a facility
    public function destroy($id)
    {
        $facility = Facility::findOrFail($id);
        
        if ($facility->image) {
            Storage::disk('public')->delete($facility->image);
        }
    
        $facility->delete();
    
        return redirect()->back()->with('success', 'Facility deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
{
    $facility = Facility::findOrFail($id);
    $facility->update([
        'status' => $request->status
    ]);

    return back()->with('success', 'Facility status updated successfully!');
}

public function toggleStatus($id)
{
    $facility = Facility::findOrFail($id);
    $facility->status = $facility->status === 'Available' ? 'Unavailable' : 'Available';
    $facility->save();

    return response()->json(['success' => true, 'new_status' => $facility->status]);
}

   
    
}

