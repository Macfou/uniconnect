<?php

namespace App\Http\Controllers;

 class PagesController extends Controller
{

    //home
    public function home () {
        return view ('pages.home');
    }

    //venue
    public function facility () {
        return view ('pages.facility');
    }

    //announcement
    public function announcement () {
        return view ('pages.announcement');
    }

    public function editaccount () {
        return view ('users.editaccount');
    }

    // about us 
    public function aboutUs() {
        return view ('pages.about');
    }
    
    
}