<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{

    public function index()
{
    $organizations = Organization::all();  // Get all organizations
    return view('admin.admin_pages.organization', compact('organizations'));
}


    public function store(Request $request)
{
    // Validate input data
     $request->validate( [
        'orgNameAbbv' => 'required|max:255',
        'orgName' => 'required|max:255',
        'orgLogo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Handle file upload
    if ($request->hasFile('orgLogo')) {
        $logoPath = $request->file('orgLogo')->store('logos', 'public');
    }

    // Create new organization record
    Organization::create([
        'orgNameAbbv' => strtoupper($request->orgNameAbbv),
        'orgName' => $request->orgName,
        'orgLogo' => $logoPath ?? null,
    ]);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Organization added successfully!');
}

///////update///
public function update(Request $request, $id)
{
    // Validate input data
    $request->validate([
        'orgNameAbbv' => 'required|max:255',
        'orgName' => 'required|max:255',
        'orgLogo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Find the organization by id
    $organization = Organization::findOrFail($id);

    // Handle file upload
    if ($request->hasFile('orgLogo')) {
        $logoPath = $request->file('orgLogo')->store('logos', 'public');
        $organization->orgLogo = $logoPath;
    }

    // Update the organization details
    $organization->orgNameAbbv = $request->orgNameAbbv;
    $organization->orgName = $request->orgName;
    
    $organization->save();

    // Redirect back with success message
    return redirect()->back()->with('success', 'Organization updated successfully!');
}

//////delete
public function destroy($id)
{
    // Find the organization by ID and delete it
    $organization = Organization::findOrFail($id);
    $organization->delete();

    // Redirect to the organizations index page with a success message
    return redirect()->route('admin.admin_pages.organization.index')->with('success', 'Organization deleted successfully!');
}




}
