<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpmoPagesController extends Controller
{
    public function spmodashboard() {
        return view('spmo.spmo_pages.spmo_dashboard');
    } 

    public function spmocategory() {
        return view('spmo.spmo_pages.spmo_category');
    }

    public function spmoinventory() {
        return view('spmo.spmo_pages.spmo_inventory');
    }

    public function spmoborrowed() {
        return view('spmo.spmo_pages.spmo_borrowed');
    }

    public function spmopending() {
        return view('spmo.spmo_pages.spmo_pending');
    }

    public function spmoapproved() {
        return view('spmo.spmo_pages.spmo_approved');
    }

    public function spmocancelled() {
        return view('spmo.spmo_pages.spmo_cancelled');
    }
}
