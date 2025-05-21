<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\AdviserApproval;

class AdviserRequestController extends Controller
{
    public function showForm($id)
    {
        // Retrieve the event by its ID
        $event = Listing::findOrFail($id); // Make sure to replace Event with the actual model name if it's different

         $approval = AdviserApproval::where('user_id', auth()->id())
        ->where('listings_id', $id)
        ->first();

    $uploadedFilePath = $approval ? $approval->pdf_file : null;
        // Pass the event data to the view
        return view('listings.request_adviser', compact('event', 'uploadedFilePath'));
    }
    
  

    public function searchUser(Request $request)
{
    $user = User::where('email', $request->email)->first();

    if ($user) {
        return response()->json([
            'id' => $user->id,          // <- make sure this is her
            'fname' => $user->fname,
            'lname' => $user->lname,
            'org' => $user->org,
        ]);
    } else {
        return response()->json(['error' => 'User not found'], 404);
    }
}


public function store(Request $request)
{
    // Validate the request to ensure it's a PDF
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'listings_id' => 'required|exists:listings,id',
        'pdf_file' => 'required|mimes:pdf|max:10240', // max 10MB
    ]);

    // Check if the approval already exists
    $exists = AdviserApproval::where('user_id', $request->user_id)
                ->where('listings_id', $request->listings_id)
                ->exists();

    if ($exists) {
        return redirect()->back()->with('error', 'You have already submitted approval for this event.');
    }

    // Store PDF
    $pdfPath = $request->file('pdf_file')->store('adviser_approvals', 'public');

    // Save to DB
    AdviserApproval::create([
        'user_id' => $request->user_id,
        'listings_id' => $request->listings_id,
        'pdf_file' => $pdfPath,
    ]);

    return redirect()->back()->with('success', 'PDF successfully uploaded!');
}




    
}
