<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\BorrowRequest;

class ChecklistsController extends Controller
{
    public function index($id)
    {
        $event = Listing::findOrFail($id); // Fetch specific event
        return view('listings.checklists', compact('event'));
    }
    
    public function checkListsBorrow($id)
    {
        if (auth()->user()->is_admin) {
            $requests = BorrowRequest::with('equipment')->where('listing_id', $id)->get();
        } else {
            $requests = BorrowRequest::where('user_id', auth()->id())
                                     ->where('listing_id', $id)
                                     ->with('equipment')
                                     ->get();
        }
    
        // Debugging to ensure requests are fetched
        dd($requests);  // This will dump the $requests variable and stop the execution
    
        return view('listings.checklists', compact('requests'));
    }
    

}
