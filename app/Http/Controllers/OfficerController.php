<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Officer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OfficerController extends Controller
{
    public function officer() {
        return view('pages.officers');
    }

    public function searchUser(Request $request)
{
    $email = $request->input('email');
    $user = User::where('email', $email)->first();

    if ($user) {
        return response()->json([
            'success' => true,
            'user' => $user,
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'User not found',
        ]);
    }
}



public function addOfficer(Request $request)
{
    try {
        // Validate the request data
        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'section' => 'required|string|max:255',
             'yearlevel' => 'required|string|max:255',
            'email' => 'required|email|unique:officers,email',
        ]);

        // Create the officer record
        Officer::create($validated);

        // Return a successful response
        return response()->json(['success' => true, 'message' => 'Officer added successfully']);

    } catch (\Throwable $e) {
        // Log the error to the Laravel log file
        Log::error('Error adding officer: ' . $e->getMessage());

        // Return an error response with the exception message
        return response()->json(['success' => false, 'message' => 'Error adding officer: ' . $e->getMessage()], 500);
    }
}

public function showOfficers() {
    $officers = Officer::all(); // Fetch all officers
    return view('pages.officers', compact('officers')); // Pass to the view
}



}
