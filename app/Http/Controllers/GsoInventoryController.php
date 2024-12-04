<?php

namespace App\Http\Controllers;

use App\Models\GsoCategory;
use App\Models\GsoInventory;
use Illuminate\Http\Request;

class GsoInventoryController extends Controller
{
    public function index()
{
    $categories = GsoCategory::all();
    $inventories = GsoInventory::with('category')->get();
    return view('gso.gso_pages.gso_inventory', compact('categories', 'inventories'));
}

public function storeInventory(Request $request)
{
    $request->validate([
        'name' => 'required|unique:gso_inventories',
        'quantity' => 'required|integer|min:1',
        'gso_category_id' => 'required|exists:gso_categories,id',
    ]);

    GsoInventory::create($request->only('name', 'quantity', 'gso_category_id', 'status'));
    return redirect()->back()->with('success', 'Supply added successfully!');
}
}
