<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Listing;
use App\Models\EndEvent;
use App\Models\Facility;
use Endroid\QrCode\QrCode;
use App\Models\EventTiming;
use App\Models\GsoCategory;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\Writer\PngWriter;



class ListingController extends Controller
{
    public function index()
{
    $today = Carbon::today();

    $events = DB::table('listings')
        ->join('uscapproval', 'listings.id', '=', 'uscapproval.listings_id')
        ->where('uscapproval.status', 'Approve')
        ->select('listings.*')
        ->get();

    $upcomingEvents = [];
    $todaysEvents = [];
    $previousEvents = [];

    foreach ($events as $event) {
        $ended = EndEvent::where('listings_id', $event->id)
                         ->where('end_event', 1)
                         ->exists();

        if ($ended) {
            $previousEvents[] = $event;
            continue;
        }

        $eventDate = Carbon::parse($event->event_date)->startOfDay();

        if ($eventDate->greaterThan($today)) {
            $upcomingEvents[] = $event;
        } elseif ($eventDate->equalTo($today)) {
            $todaysEvents[] = $event;
        } else {
            $previousEvents[] = $event;
        }
    }

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
            'classifications' => 'required',
            'certificate' => 'nullable|boolean',
            'registration' => 'nullable|boolean',
            'attachPlan' => 'nullable|file|mimes:pdf|max:10240',
            
        ]);
        
        // Convert organization array to a comma-separated string
        $formFields['organization'] = implode(', ', $request->input('organization'));
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }
        
        // Handle attachPlan upload (PDF)
        if ($request->hasFile('attachPlan')) {
            $formFields['attachPlan'] = $request->file('attachPlan')->store('plans', 'public');
        }
        
        // Set certificate value (default to 0 if not present)
        $formFields['certificate'] = $request->input('certificate', 0);
        $formFields['registration'] = $request->input('registration', 0);
        
        // Fetch facility details using facility_id
        $facility = Facility::where('facility_name', $formFields['venue'])->first();
        
        if (!$facility) {
            return redirect()->back()->with('error', 'The selected facility does not exist.');
        }
        
        // Store facility details
        $formFields['venue_id'] = $facility->id;
        $formFields['venue'] = $facility->facility_name;
        
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
        
        // Add user_id and is_draft
        $formFields['user_id'] = auth()->id();
        $formFields['is_draft'] = $request->input('is_draft', 0);
        
        // Assign the adviser_id and dean_id if present
       
    
        // Create the listing
        $listing = Listing::create($formFields);
        
        // If equipment is selected, associate it with the listing
       
        
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
    
        // Get today's date as Carbon object
        $today = Carbon::today();
    
        // Initialize arrays
        $upcomingEvents = [];
        $todaysEvents = [];
        $previousEvents = [];
    
        // Loop through each event
        foreach ($events as $event) {
            // Check if this event is already ended by this user
            $ended = EndEvent::where('listings_id', $event->id)
                             ->where('users_id', auth()->id())
                             ->where('end_event', 1)
                             ->exists();
    
            if ($ended) {
                $previousEvents[] = $event;
                continue; // Skip date checks
            }
    
            // Normal date checks
            $eventDate = Carbon::parse($event->event_date)->startOfDay();
    
            if ($eventDate->greaterThan($today)) {
                $upcomingEvents[] = $event;
            } elseif ($eventDate->equalTo($today)) {
                $todaysEvents[] = $event;
            } else {
                $previousEvents[] = $event;
            }
        }
    
        // Return view
        return view('listings.manage_all', [
            'upcomingEvents' => $upcomingEvents,
            'todaysEvents' => $todaysEvents,
            'previousEvents' => $previousEvents,
            'events' => $events,
        ]);
    }
    

    
// organization involve
    public function orgInvolve() {
        $organizations = Organization::all(); // Fetch all organizations
        $gsocategories = GsoCategory::all(); 
        return view('listings.create', compact('organizations', 'gsocategories'));
    }

    ///////////////  start eventtt
   // In your controller, update the method to return more details
// Controller Method
public function searchUser(Request $request)
{
    // Get the email from the request
    $email = $request->get('email');

    // Find the user by email
    $user = User::where('email', $email)->first();

    // If the user is found, return the user data
    if ($user) {
        return response()->json([
            'success' => true,
            'user' => [
                'id' => $user->id,      // Include user ID in the response
                'email' => $user->email,
                'fname' => $user->fname,
                'lname' => $user->lname,
            ]
        ]);
    } else {
        // If no user is found, return a success flag with false
        return response()->json(['success' => false]);
    }
}




  


    
}
