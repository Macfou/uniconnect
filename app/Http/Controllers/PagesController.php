<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Facility;
use App\Models\Announcement;

 class PagesController extends Controller
{

    //home
    public function home () {
        return view ('pages.home');
    }

    public function borrow () {
        return view ('pages.borrow');
    }

    //venue
    public function facility()
    {
        $facilities = Facility::all();
        return view('pages.facility', compact('facilities'));
    }

    //announcement
    public function announcement()
{
    $announcements = Announcement::with('user')->orderBy('created_at', 'desc')->get();

    return view('pages.announcement', [
        'announcements' => $announcements,
    ]);
}


    public function editaccount () {
        return view ('users.editaccount');
    }

    public function studentsattendance () {
        return view ('pages.studentsattendance');
    }

    public function students () {
        return view ('pages.students');
    }

    public function announce () {
        return view ('pages.announce');
    }

    public function requests () {
        return view ('pages.requests');
    }

    public function draft()
    {
        $drafts = Listing::where('is_draft', 1)->orderBy('created_at', 'desc')->get();
        return view('listings.draft', compact('drafts'));
    }
    

    

    // about us 
    public function aboutUs() {
        return view ('pages.about');
    }
    
    // event attended

    public function eventattended() {
        return view ('pages.eventattended');
    }
   
     
    public function showTryView()
    {
        // You can pass data if needed, e.g., an array or model data
        return view('pages.tryview');
    }

    public function gsouser() {
        return view('admin.admin_users.gsouser');
    }

    public function ufmouser() {
        return view('admin.admin_users.ufmouser');
    }

    public function afterevent() {
        return view('pages.afterevent');
    }
  
       

    public function calendar() {
        return view('pages.calendar');
    }
}