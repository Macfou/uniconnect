<?php

namespace App\Http\Controllers;

use id;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function create() {
        return view('pages.post_announcement');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'org' => 'required|string|max:255',
            'end_date' => 'required|date|after:today',
            'description' => 'required|string',
            'organization' => 'nullable|array',
        ]);

        Announcement::create([
            'title' => $validated['title'],
            'org' => $validated['org'],
            'end_date' => $validated['end_date'],
            'organizations_involved' => json_encode($validated['organization'] ?? []),
            'description' => $validated['description'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Announcement posted successfully!');
    }

}
