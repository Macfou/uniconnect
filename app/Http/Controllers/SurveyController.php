<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function showForm($id)
{
    $event = Listing::findOrFail($id);

    $existingSurvey = Survey::where('user_id', Auth::id())
        ->where('listings_id', $id)
        ->first();

    return view('listings.survey', compact('event', 'existingSurvey'));
}

    public function store(Request $request)
    {
        $request->validate([
            'listings_id' => 'required',
            'overall' => 'required|string',
            'venue' => 'required|string',
            'time' => 'required|string',
            'speaker1' => 'required|string',
            'speaker2' => 'nullable|string',
            'speaker3' => 'nullable|string',
            'speaker4' => 'nullable|string',
            'speaker5' => 'nullable|string',
        ]);

        Survey::create([
            'user_id' => Auth::id(),
            'listings_id' => $request->listings_id,
            'overall' => $request->overall,
            'venue' => $request->venue,
            'time' => $request->time,
            'speaker1' => $request->speaker1,
            'speaker2' => $request->speaker2,
            'speaker3' => $request->speaker3,
            'speaker4' => $request->speaker4,
            'speaker5' => $request->speaker5,
        ]);

        return redirect()->back()->with('success', 'Survey questions created successfully.');
    }

    public function edit($id)
{
    $survey = Survey::findOrFail($id);
    return view('listings.edit_survey', compact('survey'));
}

public function update(Request $request, $id)
{
    $survey = Survey::findOrFail($id);

    $survey->update($request->only([
        'overall', 'venue', 'time',
        'speaker1', 'speaker2', 'speaker3', 'speaker4', 'speaker5'
    ]));

    return redirect()->route('create.survey', $survey->listings_id)
                     ->with('success', 'Survey updated successfully!');
}


    
}
