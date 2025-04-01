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

    public function showprevious(Listing $listing) {
        // Get the author of the listing
        $author = $listing->user;
    
        // Get the organization of the author
        $organization = null;
        if ($author && $author->org) {
            $organization = Organization::where('orgNameAbbv', $author->org)->first();
        }
    
        // Pass the listing and the author's organization to the view
        return view('listings.showprevious', [
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
       
       
        // Validate the request
        $formFields = $request->validate([
            'tags' => ['required', Rule::unique('listings', 'tags')],  
            'title' => 'required',
            'venue' => 'required', // This is the facility_id
            'event_date' => 'required',
            'event_time' => 'required',
            'organization' => 'required|array',
            'description' => 'required',
            'image' => 'required|image',
            'classifications' => 'required'
        ]);
    
        // Convert organization array to a comma-separated string
        $formFields['organization'] = implode(', ', $request->input('organization'));
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }
    
        // Fetch facility details using facility_id
        $facility = Facility::where('facility_name', $formFields['venue'])->first();
    
        if (!$facility) {
            return redirect()->back()->with('error', 'The selected facility does not exist.');
        }
    
        // Store facility details
        $formFields['venue_id'] = $facility->id;
        $formFields['venue'] = $facility->facility_name; // Store facility name instead of ID
    
        // Check if the event time slot is already booked (only if it's not a draft)
        if ($request->input('is_draft') != 1) {
            $existingEvent = Listing::where('venue_id', $formFields['venue_id'])
                                    ->where('event_date', $formFields['event_date'])
                                    ->where('event_time', $formFields['event_time'])
                                    ->exists();
    
            if ($existingEvent) {
                return redirect()->back()->with('error', 'This time slot is already booked for the selected venue and date.');
            }
        }
    
        // Add user_id to the form fields
        $formFields['user_id'] = auth()->id();
    
        // Add is_draft (1 for drafts, 0 for published)
        $formFields['is_draft'] = $request->input('is_draft', 0);
    
        // Create the listing and save it
        Listing::create($formFields);
    
        return redirect('/')->with('message', $formFields['is_draft'] ? 'Event saved as draft!' : 'Event posted successfully!');
    }
    


    // Show update form
    public function edit(Listing $listing)
    {
        return view('listings.edit', compact('listing'));
    }
    

       
    public function update(Request $request, Listing $listing)
    {
        dd($request->all);
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
    
        // Validate input fields
        $formFields = $request->validate([
            'tags' => 'required|string',
            'organization' => 'required|string',
            'description' => 'required',
            'image' => 'nullable|image',
            
        ]);
    
        // Ensure read-only fields remain unchanged
        $formFields['venue'] = $listing->venue;
        $formFields['event_date'] = $listing->event_date;
        $formFields['event_time'] = $listing->event_time;
    
        // Handle image upload if a new file is provided
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }
    
        // Update the listing
        $listing->update($formFields);
    
        return redirect()->route('listings.draft')->with('message', 'Draft updated successfully!');
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
    
        // Get today's date as Carbon object (only date, no time)
        $today = Carbon::today();
    
        // Initialize arrays to hold categorized events
        $upcomingEvents = [];
        $todaysEvents = [];
        $previousEvents = [];
    
        // Categorize events based on event_date
        foreach ($events as $event) {
            // Convert event_date to Carbon instance for accurate comparison
            $eventDate = Carbon::parse($event->event_date)->startOfDay();
    
            if ($eventDate->greaterThan($today)) {
                $upcomingEvents[] = $event;
            } elseif ($eventDate->equalTo($today)) {
                $todaysEvents[] = $event;
            } else {
                $previousEvents[] = $event;
            }
        }
    
        // Return view with categorized events
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
 
  


    
}
