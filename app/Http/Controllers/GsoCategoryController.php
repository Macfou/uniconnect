<?php

namespace App\Http\Controllers;

use App\Models\GsoCategory;
use Illuminate\Http\Request;

class GsoCategoryController extends Controller
{
    public function index()
    {
        // Fetch all categories
        $categories = GsoCategory::all();
        return view('gso.gso_pages.gso_category', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0', // Validate quantity as an integer >= 0
        ]);
    
        // Create a new category with quantity
        GsoCategory::create([
            'name' => $request->name,
            'quantity' => $request->quantity, // Save the quantity
        ]);
    
        // Return back with a success message
        return redirect()->route('gso.gso_pages.gso_category')->with('success', 'Supply added successfully!');
    }
    

    public function showInventory()
{
    $categories = GsoCategory::all(); // Fetch all categories
    return view('gso.gso_pages.gso_inventory', ['categories' => $categories]);
}

}
