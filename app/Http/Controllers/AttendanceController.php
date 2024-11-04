<?php
namespace App\Http\Controllers;

use App\Models\EventAttendee; // Make sure this is the correct path to your model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        try {
            Log::info('Request Data:', $request->all());
    
            // Validate incoming data
            $validated = $request->validate([
                'event_id' => 'required|exists:listings,id',
                'user_id' => 'required|exists:users,id',
            ]);
    
            // Create an event attendee
            EventAttendee::create([
                'user_id' => $validated['user_id'],
                'event_id' => $validated['event_id'],
            ]);
    
            return response()->json(['success' => true]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error:', $e->errors());
            return response()->json(['success' => false, 'error' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error('Attendance submission error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    
    
    
    
    
    
    
    
}

    
    
