<?php

namespace App\Http\Controllers;

use App\Models\Gso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GsoController extends Controller
{
    public function index()
    {
        $gsoUsers = Gso::all();
        return view('admin.admin_users.gsouser', compact('gsoUsers'));
    }

    // Store a new GSO officer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:gso,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Gso::create($validated);

        return redirect()->back()->with('success', 'GSO Officer added successfully!');
    }

    // Update an existing GSO officer
    public function update(Request $request, $id)
    {
        $gso = Gso::findOrFail($id);

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:gso,email,' . $id,
        ]);

        $gso->update($validated);

        return redirect()->back()->with('success', 'GSO Officer updated successfully!');
    }

    // Delete a GSO officer
    public function destroy($id)
    {
        $gso = Gso::findOrFail($id);
        $gso->delete();

        return redirect()->back()->with('success', 'GSO Officer deleted successfully!');
    }
}
