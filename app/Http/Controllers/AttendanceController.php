<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\EventAttendee; // Make sure this is the correct path to your model

class AttendanceController extends Controller
{
   // Add this method to your controller
   public function submitAttendance(Request $request)
   {
       $validated = $request->validate([
           'student_id' => 'required|string',
           'event_id' => 'required|exists:listings,id',
       ]);
   
       $student = User::where('idnumber', $validated['student_id'])->first();
   
       if (!$student) {
           return response()->json(['success' => false, 'message' => 'Student not found.'], 404);
       }
   
       // Save attendance
       EventAttendee::create([
           'event_id' => $validated['event_id'],
           'fname' => $student->fname,
           'lname' => $student->lname,
           'org' => $student->org,
       ]);
   
       return response()->json(['success' => true, 'message' => 'Attendance submitted successfully!']);
   }
   
   //show the atendees
   public function showAttendance(Listing $listing)
   {
       $attendees = EventAttendee::where('event_id', $listing->id)
           ->with('user') // Eager load user relationship
           ->get();
   
       return view('pages.tryview', [
           'listing' => $listing,
           'attendees' => $attendees
       ]);
   }
   
   
}
 

    
    
