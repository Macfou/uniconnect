<?php

namespace App\Http\Controllers;

use App\Models\SavedSection;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SavedSectionController extends Controller
{
    // Show the page with saved sections for Blade view
    public function index()
    {
        $facultyId = Auth::id();
    
        // Retrieve saved sections with their associated organizations
        $savedSections = SavedSection::with('organization')
            ->where('faculty_id', $facultyId)
            ->get();
    
        // Retrieve all organizations
        $organizations = Organization::all();
    
        // Pass the data to the view
        return view('pages.students', compact('savedSections', 'organizations'));
    }
    

    // Return saved sections as JSON (for frontend use)
    public function fetchSavedSections()
    {
        $facultyId = Auth::id();
        return response()->json(SavedSection::where('faculty_id', $facultyId)->get());
    }

    // Return students of a given section/year/org
    public function getStudents($section, $year, $org)
    {
        $students = User::where('section', $section)
            ->where('year_level', $year)
            ->where('org', $org)
            ->get(['fname', 'lname']);

        return response()->json($students);
    }

    // Save a new section
    public function store(Request $request)
    {
        try {
            $request->validate([
                'organization_id' => 'required|exists:organizations,id',
                'year_level' => 'required|string',
                'section_name' => 'required|string',
            ]);

            $facultyId = Auth::id();

            $exists = SavedSection::where([
                'faculty_id' => $facultyId,
                'organization_id' => $request->organization_id,
                'year_level' => $request->year_level,
                'section_name' => $request->section_name
            ])->exists();

            if (!$exists) {
                SavedSection::create([
                    'faculty_id' => $facultyId,
                    'organization_id' => $request->organization_id,
                    'year_level' => $request->year_level,
                    'section_name' => $request->section_name
                ]);
            }

            return response()->json(['message' => 'Section saved successfully']);
        } catch (\Exception $e) {
            Log::error('Save Section Error: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong!'], 500);
        }
    }

    // Delete a saved section
    public function destroy($id)
    {
        $section = SavedSection::where('id', $id)
            ->where('faculty_id', Auth::id())
            ->first();

        if ($section) {
            $section->delete();
            return response()->json(['message' => 'Section removed successfully']);
        }

        return response()->json(['message' => 'Section not found'], 404);
    }
}
