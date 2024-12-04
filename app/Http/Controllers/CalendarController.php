<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Facility;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function calendarPage()
{
    // Fetch all facilities
    $facilities = Facility::all(); // Adjust query as needed

    

    // Pass to the view
    return view('pages.calendar', ['facilities' => $facilities]);
}


}
