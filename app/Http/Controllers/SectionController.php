<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Organization;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function create()
    {
        $organizations = Organization::all();
        return view('admin.admin_pages.section', compact('organizations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'organization_id' => 'required|exists:organizations,id',
            'section_name' => 'required|string|max:255',
            'classification' => 'nullable|string|max:255',
            'year_levels' => 'required|array', // Expecting multiple years
        ]);

        foreach ($request->year_levels as $year) {
            Section::create([
                'organization_id' => $request->organization_id,
                'section_name' => $request->section_name,
                'classification' => $request->classification,
                'year_level' => $year,
            ]);
        }

        return redirect()->back()->with('success', 'Section added successfully!');
    }

    public function filter(Request $request)
{
    $query = Section::query();

    if ($request->has('organization_id') && $request->organization_id) {
        $query->where('organization_id', $request->organization_id);
    }

    if ($request->has('year_level') && $request->year_level) {
        $query->where('year_level', $request->year_level);
    }

    return response()->json($query->get());
}

}

