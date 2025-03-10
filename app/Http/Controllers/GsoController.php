<?php

namespace App\Http\Controllers;

use App\Models\Gso;
use Illuminate\Http\Request;
use App\Models\BorrowRequest;
use Illuminate\Support\Facades\Auth;
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
    
        // Hash the password before saving
        $validated['password'] = Hash::make($validated['password']);
    
        // Create new GSO user
        Gso::create([
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
    
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

    public function profile()
    {
        $gsoUser = Auth::guard('gso')->user(); // Ensure you are using the correct authentication guard
        return view('gso.gso_pages.gso_profile', compact('gsoUser'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $gsoUser = Auth::guard('gso')->user();

        if (!Hash::check($request->current_password, $gsoUser->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $gsoUser->password = Hash::make($request->new_password);
        $gsoUser->save();

        return back()->with('success', 'Password updated successfully.');
    }

    public function create()
    {
        return view('gso.gso_pages.gso_adduser');
    }

    public function dashboard()
{
    $pendingRequests = BorrowRequest::where('status', 'Pending')->count();
    $approvedRequests = BorrowRequest::where('status', 'Approved')->count();
    $cancelledRequests = BorrowRequest::where('status', 'Cancelled')->count();

    return view('gso.gso_pages.gso_dashboard', compact('pendingRequests', 'approvedRequests', 'cancelledRequests'));
}

}
