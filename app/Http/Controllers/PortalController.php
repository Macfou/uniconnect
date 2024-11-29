<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalController extends Controller
{
    public  function portal() {
        return view('admin.admin_users.portal');
    }

    public function gso () {
        return view('admin.admin_users.gsologin');
    }

    public function ufmo () {
        return view('admin.admin_users.ufmologin');
    }

}
