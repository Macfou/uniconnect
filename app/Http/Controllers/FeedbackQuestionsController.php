<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\FeedbackQuestion;
use Illuminate\Support\Facades\Auth;

class FeedbackQuestionsController extends Controller
{
    public function create($id)
    {
        $event = Listing::findOrFail($id);
        return view('listings.create_rating', compact('event'));
    }

    public function store(Request $request)
{
    // Validate the incoming data
    $validated = $request->validate([
        'listings_id' => 'required|exists:listings,id',
        'q_one' => 'required|string',
        'q_two' => 'required|string',
        'q_three' => 'required|string',
        'q_four' => 'required|string',
        'q_five' => 'required|string',
        'q_six' => 'required|string',
        'q_seven' => 'required|string',
        'q_eight' => 'required|string',
        'q_nine' => 'required|string',
        'q_ten' => 'required|string',
        'q_eleven' => 'required|string',
        'q_twelve' => 'required|string',
        'q_thirteen' => 'required|string',
        'q_fourteen' => 'required|string',
        'q_fifteen' => 'required|string',
        'q_sixteen' => 'required|string',
        'q_seventeen' => 'required|string',
        'q_eighteen' => 'required|string',
        'q_nineteen' => 'required|string',
        'q_twenty' => 'required|string',
    ]);

    // Gather the data from the request
    $data = $request->except('_token');
    $data['users_id'] = Auth::id();  // Ensure the user ID is attached to the data

    // Create a new FeedbackQuestion record
    FeedbackQuestion::create($data);

    // Redirect back with a success message
    return back()->with('success', 'Feedback questions created successfully.');
}


    public function edit($id)
    {
        $feedback = FeedbackQuestion::where('listings_id', $id)
            ->where('users_id', Auth::id())
            ->firstOrFail();

        $event = $feedback->listing;

        return view('listings.edit_ratings', compact('feedback', 'event'));
    }

    public function update(Request $request, $id)
    {
        $feedback = FeedbackQuestion::findOrFail($id);

        $feedback->update($request->except('_token'));

        return back()->with('success', 'Feedback questions updated successfully.');
    }
}
