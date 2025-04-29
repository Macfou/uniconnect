<?php

namespace App\Http\Controllers;

use App\Models\Spmo;
use Illuminate\Http\Request;
use App\Models\BorrowRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SpmoController extends Controller
{
    public function index()
    {
        $spmoUsers = Spmo::all();
        return view('admin.admin_users.spmouser', compact('spmoUsers'));
    }

    public function show()
    {
        $spmoUser = Spmo::all();
        if (!$spmoUser) {
            return redirect()->route('login'); // or any other fallback logic
        }
    
        return view('components.spmo-layout', compact('spmoUser'));
    }
    


    // Store a new spmo officer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:spmo,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Hash the password before saving
        $validated['password'] = Hash::make($validated['password']);
    
        // Create new spmo user
        Spmo::create([
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
    
        return redirect()->back()->with('success', 'spmo Officer added successfully!');
    }
    

    // Update an existing spmo officer
    public function update(Request $request, $id)
    {
        $spmo = Spmo::findOrFail($id);

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:spmo,email,' . $id,
        ]);

        $spmo->update($validated);

        return redirect()->back()->with('success', 'spmo Officer updated successfully!');
    }

    // Delete a spmo officer
    public function destroy($id)
    {
        $spmo = Spmo::findOrFail($id);
        $spmo->delete();

        return redirect()->back()->with('success', 'Spmo Officer deleted successfully!');
    }

    public function profile()
    {
        $spmoUser = Auth::guard('spmo')->user(); // Ensure you are using the correct authentication guard
        return view('spmo.spmo_pages.spmo_profile', compact('spmoUser'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $spmoUser = Auth::guard('spmo')->user();

        if (!Hash::check($request->current_password, $spmoUser->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $spmoUser->password = Hash::make($request->new_password);
        $spmoUser->save();

        return back()->with('success', 'Password updated successfully.');
    }

    public function create()
    {
        return view('spmo.spmo_pages.spmo_adduser');
    }

    public function dashboard()
{
    $pendingRequests = BorrowRequest::where('status', 'Pending')->count();
    $approvedRequests = BorrowRequest::where('status', 'Approved')->count();
    $cancelledRequests = BorrowRequest::where('status', 'Cancelled')->count();

    return view('spmo.spmo_pages.spmo_dashboard', compact('pendingRequests', 'approvedRequests', 'cancelledRequests'));
}



}
