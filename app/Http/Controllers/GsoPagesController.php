<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GsoPagesController extends Controller
{
    public function gsodashboard() {
        return view('gso.gso_pages.gso_dashboard');
    } 

    public function gsocategory() {
        return view('gso.gso_pages.gso_category');
    }

    public function gsoinventory() {
        return view('gso.gso_pages.gso_inventory');
    }

    public function gsoborrowed() {
        return view('gso.gso_pages.gso_borrowed');
    }

    public function gsopending() {
        return view('gso.gso_pages.gso_pending');
    }

    public function gsoapproved() {
        return view('gso.gso_pages.gso_approved');
    }

    public function gsocancelled() {
        return view('gso.gso_pages.gso_cancelled');
    }
}
