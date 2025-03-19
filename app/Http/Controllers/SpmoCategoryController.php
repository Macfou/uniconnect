<?php

namespace App\Http\Controllers;

use App\Models\SpmoCategory;
use Illuminate\Http\Request;

class SpmoCategoryController extends Controller
{
    public function index()
    {
        // Fetch all categories
        $categories = SpmoCategory::all();
        return view('spmo.spmo_pages.spmo_category', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0', // Validate quantity as an integer >= 0
        ]);
    
        // Create a new category with quantity
        SpmoCategory::create([
            'name' => $request->name,
            'quantity' => $request->quantity, // Save the quantity
        ]);
    
        // Return back with a success message
        return redirect()->route('spmo.spmo_pages.spmo_category')->with('success', 'Supply added successfully!');
    }
    

    public function showInventory()
{
    $categories = SpmoCategory::all(); // Fetch all categories
    return view('spmo.spmo_pages.spmo_inventory', ['categories' => $categories]);
}

}
