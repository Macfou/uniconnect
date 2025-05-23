<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\EventAdmin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventAdminController extends Controller
{
    public function create()
    {
        return view('ufmo.ufmo_pages.ufmo_addevent');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tags' => ['required', Rule::unique('listings', 'tags')],
            'description' => 'nullable|string',
            'venue' => 'required', 
            'event_date' => 'required',
            'event_time' => 'required',
        ]);
    
        Listing::create([
            'tags' => $request->tags,
            'description' => $request->description,
            'venue' => $request->venue,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
        ]);
    
        return redirect()->back()->with('success', 'Event created successfully!');
    }
    
}

