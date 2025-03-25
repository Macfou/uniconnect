<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;




class CertificateController extends Controller
{
    public function certificate(Request $request)
    {
        $selectedEvent = $request->input('selected_event');
    $certificates = [];

    if ($selectedEvent) {
        $certificates = Certificate::where('event_id', $selectedEvent)->get();
    }

    return view('pages.certificate', compact('certificates'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'event_id' => 'required|exists:listings,id',
            'certificates' => 'required|array', // Ensure multiple files are received as an array
            'certificates.*' => 'image|mimes:jpeg,png,jpg|max:20480', // 20MB limit (20480 KB)
        ]);
        

        // Process each uploaded file
        if ($request->hasFile('certificates')) {
            foreach ($request->file('certificates') as $file) {
                $path = $file->store('certificates', 'public'); // Store file in "storage/app/public/certificates"

                // Save file details in the database
                Certificate::create([
                    'event_id' => $request->event_id,
                    'file_path' => $path,
                ]);
            }
        }

        return back()->with('success', 'Certificates uploaded successfully!');
    }

    public function destroy($id)
{
    $certificate = Certificate::findOrFail($id);

    // Delete the file from storage
    Storage::delete('public/certificates/' . $certificate->filename);

    // Delete from database
    $certificate->delete();

    return back()->with('success', 'Certificate deleted successfully.');
}
    
}
