<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
{
    // Count the total events
    $eventCount = Listing::count();

    $userCount = User::count();

    $adminuserCount = AdminUser::count();

    // Pass the count to the view
    return view('admin.admin_pages.admin_index', compact('eventCount', 'userCount', 'adminuserCount'));

}

}
