<?php

namespace App\Http\Controllers;

use App\Models\EventTiming;
use Carbon\Carbon;
use App\Models\Listing;
use Endroid\QrCode\QrCode;
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
    public function store(Request $request) {
        // Validate the incoming request data
        $formFields = $request->validate([
            'tags' => ['required', Rule::unique('listings', 'tags')],
            'title' => 'required',
            'venue' => 'required', 
            'event_date' => 'required',
            'event_time' => 'required',
            'organization' => 'required|array',
            'description' => 'required',
            'image' => 'required|image'
        ]);
    
        // Convert the organization array into a comma-separated string
        $formFields['organization'] = implode(', ', $request->input('organization'));
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }
    
        // Add user_id to the form fields to associate the listing with the authenticated user
        $formFields['user_id'] = auth()->id();
    
        // Create the listing with user_id and save it to the database
        $listing = Listing::create($formFields);  // Now $listing contains the saved event
    
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
            'previousEvents' => $previousEvents
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
