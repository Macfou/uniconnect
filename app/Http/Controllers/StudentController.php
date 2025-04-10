<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Section;
use App\Models\Organization;
use App\Models\SavedSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{


    public function index()
    {
        $facultyId = Auth::id();
    
        // Retrieve saved sections associated with the faculty
        $savedSections = SavedSection::with('organization')
            ->where('faculty_id', $facultyId)
            ->get();
    
        // Retrieve all organizations
        $organizations = Organization::select('id', 'orgNameAbbv')->get();
    
        // Pass data to the view
        return view('pages.students', compact('savedSections', 'organizations'));
    }
    
    public function getStudentsByCriteria(Request $request)
    {
        $organizationId = $request->query('organization');
        $yearLevel = $request->query('yearLevel');
        $sectionName = $request->query('sectionName');
    
        $students = User::where('org', $organizationId)
                        ->where('yearlevel', $yearLevel)
                        ->where('section', $sectionName)
                        ->get();
    
        return view('pages.students_table', compact('students'));
    }
    
    
    
    
    


   
    
    public function filterStudents(Request $request)
    {
        $query = User::query();
    
        if ($request->has('organization') && $request->organization) {
            $query->where('org', intval($request->organization)); // Ensure it's an integer
        }
        
    
        if ($request->has('year_level') && $request->year_level) {
            $query->where('yearlevel', $request->year_level);
        }
    
        if ($request->has('section') && $request->section) {
            $query->whereRaw('LOWER(section) = ?', [strtolower($request->section)]);
        }
        
    
        return response()->json($query->select('fname', 'lname')->get());
    }
    public function filterSections(Request $request)
{
    $query = Section::query();

    if ($request->has('organization') && $request->organization) {
        // Assuming 'organization_id' is the correct column name in the 'sections' table
        $query->where('organization_id', $request->organization);
    }

    if ($request->has('year_level') && $request->year_level) {
        $query->where('year_level', $request->year_level);
    }

    return response()->json($query->select('section_name')->get());
}

}
