<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class MyEventsController extends Controller
{
    public function myevents() {
        return view('pages.myevents');
    }
// realtime
  
}
