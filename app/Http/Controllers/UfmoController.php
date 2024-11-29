<?php

namespace App\Http\Controllers;

use App\Models\Ufmo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UfmoController extends Controller
{
    public function index()
    {
        $ufmoUsers = Ufmo::all();
        return view('admin.admin_users.ufmouser', compact('ufmoUsers'));
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

        Ufmo::create($validated);

        return redirect()->back()->with('success', 'UFMO Officer added successfully!');
    }

    // Update an existing GSO officer
    public function update(Request $request, $id)
    {
        $ufmo = Ufmo::findOrFail($id);

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:ufmo,email,' . $id,
        ]);

        $ufmo->update($validated);

        return redirect()->back()->with('success', 'UFMO Officer updated successfully!');
    }

    // Delete a GSO officer
    public function destroy($id)
    {
        $ufmo = Ufmo::findOrFail($id);
        $ufmo->delete();

        return redirect()->back()->with('success', 'UFMo Officer deleted successfully!');
    }
}
