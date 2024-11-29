<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UfmoPagesController extends Controller
{
    public function ufmodashboard() {
        return view('ufmo.ufmo_pages.ufmo_dashboard');
    }

    public function ufmopending() {
        return view('ufmo.ufmo_pages.ufmo_pending');
    }

    public function ufmoapproved() {
        return view('ufmo.ufmo_pages.ufmo_approved');
    }

    public function ufmocancelled() {
        return view('ufmo.ufmo_pages.ufmo_cancelled');
    }

    public function ufmocalendar() {
        return view('ufmo.ufmo_pages.ufmo_calendar');
    }

    
}
