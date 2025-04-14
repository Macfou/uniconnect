<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventAdmin;

class EventAdminController extends Controller
{
    public function create()
    {
        return view('ufmo.ufmo_pages.ufmo_addevent');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'venue' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required',
        ]);
    
        EventAdmin::create([
            'title' => $request->title,
            'description' => $request->description,
            'venue' => $request->venue,
            'date' => $request->date,
            'time' => $request->time,
        ]);
    
        return redirect()->back()->with('success', 'Event created successfully!');
    }
    
}

