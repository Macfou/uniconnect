<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Listing;
use App\Models\Facility;
use Endroid\QrCode\QrCode;
use App\Models\EventTiming;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Endroid\QrCode\Writer\PngWriter;



class ListingController extends Controller
{
    public function index()
    {
        // Fetch all listings for the authenticated user
        $events = Listing::all();

        // Get today's date
        $today = Carbon::today();

        /////////////try

        
        
        
        //////////////////////
        $events = Listing::where('status', 'approved')->get();
        // Initialize arrays to hold categorized events
        $upcomingEvents = [];
        $todaysEvents = [];
        $previousEvents = [];

        // Categorize events based on event_date
        foreach ($events as $event) {
            if ($event->event_date > $today) {
                $upcomingEvents[] = $event;
            } elseif ($event->event_date == $today) {
                $todaysEvents[] = $event;
            } else {
                $previousEvents[] = $event;
            }
        }

        // Return views with categorized events
        return view('listings.index', [
            'upcomingEvents' => $upcomingEvents,
            'todaysEvents' => $todaysEvents,
            'previousEvents' => $previousEvents,
           
        ]);
    }

    // Show single listing
    public function show(Listing $listing) {
        // Get the author of the listing
        $author = $listing->user;
    
        // Get the organization of the author
        $organization = null;
        if ($author && $author->org) {
            $organization = Organization::where('orgNameAbbv', $author->org)->first();
        }
    
        // Pass the listing and the author's organization to the view
        return view('listings.show', [
            'listing' => $listing,
            'organization' => $organization, // Pass the author's organization to the view
        ]);
    }
    
    
    
    //create
    public function create() {
        return view('listings.create');
    }

    
   

 
    // Store listing
    public function store(Request $request)
    {
        // Map event time to time_id
        $timeSlots = [
            '8:00 AM - 10:00 AM' => 1,
            '10:00 AM - 12:00 PM' => 2,
            '12:00 PM - 2:00 PM' => 3,
            '2:00 PM - 4:00 PM' => 4,
            '4:00 PM - 6:00 PM' => 5,
        ];
    
        // Now validate the incoming request data
        $formFields = $request->validate([
            'tags' => ['required', Rule::unique('listings', 'tags')],
            'title' => 'required',
            'venue' => 'required',
            'event_date' => 'required', // validate it now after conversion
            'event_time' => 'required',
            'organization' => 'required|array',
            'description' => 'required',
            'image' => 'required|image',
        ]);
    
        // Convert the organization array into a comma-separated string
        $formFields['organization'] = implode(', ', $request->input('organization'));
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }
    
        // Get the venue based on facility name
        $facilityName = $formFields['venue']; // This should be the facility name
        $facility = Facility::where('facility_name', $facilityName)->first();
    
        // Check if facility exists, and set the venue_id
        if ($facility) {
            $formFields['venue_id'] = $facility->id;  // Store the venue_id based on the facility_name
        }
    
        // Map event time to the corresponding time_id
        $formFields['time_id'] = $timeSlots[$request->input('event_time')] ?? null;
    
        // Check if the selected time slot for the given venue and event date is already booked
        $existingEvent = Listing::where('venue_id', $formFields['venue_id'])
                                ->where('event_date', $formFields['event_date'])
                                ->where('time_id', $formFields['time_id'])
                                ->exists();
    
        if ($existingEvent) {
            // If an event is already booked at the same time and venue, return an error message
            return redirect()->back()->with('error', 'This time slot is already booked for the selected venue and date.');
        }
    
        // Add user_id to the form fields to associate the listing with the authenticated user
        $formFields['user_id'] = auth()->id();
    
        // Create the listing with user_id and time_id, then save it to the database
        Listing::create($formFields);
    
        // Redirect with a success message
        return redirect('/')->with('message', 'Event posted successfully!');
    }
    


    // Show update form
    public function edit(Listing $listing) {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update listing
    public function update(Request $request, Listing $listing) {
        // make sure login user is owner
        if($listing->user_id != auth()->id()) { // Use method call for id()
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate( [
            'tags' => 'required',
            'title' => 'required',
            'venue' => 'required', 
            
            'event_date' => 'required',
            'event_time' => 'required',
            
            'organization' => 'required',
            'description' => 'required',
            'image' => 'required'
        ]);

        if($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        
        $listing->update($formFields);

        return redirect('/')->with('message', 'Event updated successfully!');
    }

    // Delete listing
    public function destroy(Listing $listing) {
        if($listing->user_id != auth()->id()) { // Use method call for id()
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Event deleted successfully!');
    }

    // Manage function
  


    ///ytytt


    ////////////////////triall


    public function manageEvents()
{
    // Fetch all listings for the authenticated user
    $events = auth()->user()->listings()->get();

    // Get today's date
    $today = Carbon::today();

    // Initialize arrays to hold categorized events
    $upcomingEvents = [];
    $todaysEvents = [];
    $previousEvents = [];

    // Categorize events based on event_date
    foreach ($events as $event) {
        if ($event->event_date > $today) {
            $upcomingEvents[] = $event;
        } elseif ($event->event_date == $today) {
            $todaysEvents[] = $event;
        } else {
            $previousEvents[] = $event;
        }
    }

    // Return views with categorized events
    return view('listings.manage_all', [
        'upcomingEvents' => $upcomingEvents,
        'todaysEvents' => $todaysEvents,
        'previousEvents' => $previousEvents,
        'events' => $events, // Pass all events for use in the view
    ]);
}


    
// organization involve
    public function orgInvolve() {
        $organizations = Organization::all(); // Fetch all organizations
        return view('listings.create', compact('organizations'));
    }

    ///////////////  start eventtt

   // ListingController.php

   
 
   

   



    
}
