<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
{
    // Count the total events
    $eventCount = Listing::count();

    $userCount = User::count();

    $adminuserCount = AdminUser::count();

    $events = Listing::all();  // Replace with the appropriate query if you want to filter events

    // Prepare an array to store event data (attendees count and positive feedback percentage)
    $eventData = [];

    foreach ($events as $event) {
        // Get attendees for the event
        $attendees = DB::table('event_attendees')
            ->where('event_id', $event->id)
            ->get();

        // Get feedback for the event
        $feedbacks = DB::table('feedback')
            ->where('listing_id', $event->id)
            ->get();

        // Calculate total attendees and positive feedback percentage
        $totalAttendees = $attendees->count();
        $positiveFeedback = $feedbacks->where('sentiment', 1)->count();
        $positivePercentage = $totalAttendees > 0 ? ($positiveFeedback / $totalAttendees) * 100 : 0;

        // Add event data to the array
        $eventData[] = [
            'event' => $event,
            'attendees' => $totalAttendees,
            'positivePercentage' => number_format($positivePercentage, 2),
        ];
    }

    // Pass the count to the view
    return view('admin.admin_pages.admin_index', compact('eventCount', 'userCount', 'adminuserCount', 'eventData'));

}

}
