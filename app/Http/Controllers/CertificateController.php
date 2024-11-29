<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
   

    public function create()
{
    return view('pages.certificate');
}

public function show($id)
{
    $certificate = Certificate::findOrFail($id);

    return view('pages.certificate_review', compact('certificate'));
}




public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|json',
        'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $backgroundPath = null;
    if ($request->hasFile('background_image')) {
        $backgroundPath = $request->file('background_image')->store('certificates/backgrounds', 'public');
    }

    $certificate = Certificate::create([
        'title' => $validated['title'],
        'content' => $validated['content'],
        'background_image' => $backgroundPath,
    ]);

    return redirect()->route('certificates.show', $certificate->id)
        ->with('success', 'Certificate created successfully!');
}


}
