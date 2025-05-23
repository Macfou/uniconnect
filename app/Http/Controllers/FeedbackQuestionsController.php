<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\FeedbackQuestion;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class FeedbackQuestionsController extends Controller
{
   
    public function create($id)
    {
        // Get the event/listing
        $event = Listing::findOrFail($id);
        
        // Check if feedback questions already exist for this listing and user
        $existingFeedback = FeedbackQuestion::where('listings_id', $id)
            ->where('users_id', Auth::id())
            ->first();
        
        // Return view with event and existing feedback (if any)
        return view('listings.create_rating', compact('event', 'existingFeedback'));
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'listings_id' => 'required|exists:listings,id',
            'q_one' => 'required|string|max:255',
            'q_two' => 'required|string|max:255',
            'q_three' => 'required|string|max:255',
            'q_four' => 'required|string|max:255',
            'q_five' => 'required|string|max:255',
            'q_six' => 'required|string|max:255',
            'q_seven' => 'required|string|max:255',
            'q_eight' => 'required|string|max:255',
            'q_nine' => 'required|string|max:255',
            'q_ten' => 'required|string|max:255',
            'q_eleven' => 'required|string|max:255',
            'q_twelve' => 'required|string|max:255',
            'q_thirteen' => 'required|string|max:255',
            'q_fourteen' => 'required|string|max:255',
            'q_fifteen' => 'required|string|max:255',
            'q_sixteen' => 'required|string|max:255',
            'q_seventeen' => 'required|string|max:255',
            'q_eighteen' => 'required|string|max:255',
            'q_nineteen' => 'required|string|max:255',
            'q_twenty' => 'required|string|max:255',
        ]);

        try {
            // Add the user ID to the validated data
            $validated['users_id'] = Auth::id();

            // Create a new FeedbackQuestion record
            $feedbackQuestion = FeedbackQuestion::create($validated);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Feedback questions created successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Failed to create feedback questions: ' . $e->getMessage());
            
            // Return with error message
            return redirect()->back()->with('error', 'Failed to create feedback questions. Please try again.');
        }
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

        // Check if the current user owns this feedback
        if ($feedback->users_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to update these feedback questions.');
        }

        // Validate the update data
        $validated = $request->validate([
            'q_one' => 'required|string|max:255',
            'q_two' => 'required|string|max:255',
            'q_three' => 'required|string|max:255',
            'q_four' => 'required|string|max:255',
            'q_five' => 'required|string|max:255',
            'q_six' => 'required|string|max:255',
            'q_seven' => 'required|string|max:255',
            'q_eight' => 'required|string|max:255',
            'q_nine' => 'required|string|max:255',
            'q_ten' => 'required|string|max:255',
            'q_eleven' => 'required|string|max:255',
            'q_twelve' => 'required|string|max:255',
            'q_thirteen' => 'required|string|max:255',
            'q_fourteen' => 'required|string|max:255',
            'q_fifteen' => 'required|string|max:255',
            'q_sixteen' => 'required|string|max:255',
            'q_seventeen' => 'required|string|max:255',
            'q_eighteen' => 'required|string|max:255',
            'q_nineteen' => 'required|string|max:255',
            'q_twenty' => 'required|string|max:255',
        ]);

        try {
            $feedback->update($validated);
            return redirect()->back()->with('success', 'Feedback questions updated successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to update feedback questions: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update feedback questions. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $feedback = FeedbackQuestion::where('listings_id', $id)
                ->where('users_id', Auth::id())
                ->firstOrFail();

            $feedback->delete();

            return redirect()->back()->with('success', 'Feedback questions deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to delete feedback questions: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete feedback questions. Please try again.');
        }
    }
}