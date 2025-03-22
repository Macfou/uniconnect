<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SavedSection;
use Illuminate\Support\Facades\Auth;

class SavedSectionController extends Controller
{
    // Fetch saved sections
    public function index()
    {
        $facultyId = Auth::id();
        return response()->json(SavedSection::where('faculty_id', $facultyId)->get());
    }

    // Save a section
    public function store(Request $request)
    {
        $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'year_level' => 'required|string',
            'section_name' => 'required|string',
        ]);

        $facultyId = Auth::id();

        // Prevent duplicates
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
    }

    // Remove a section
    public function destroy($id)
    {
        $section = SavedSection::where('id', $id)->where('faculty_id', Auth::id())->first();
        if ($section) {
            $section->delete();
            return response()->json(['message' => 'Section removed successfully']);
        }
        return response()->json(['message' => 'Section not found'], 404);
    }
}

