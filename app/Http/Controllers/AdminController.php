<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Listing;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //index 
    
    public function admin_index() {
          
   return view('admin.admin_pages.admin_index');
}

//organization
public function organization() {
   return view('admin.admin_pages.organization');
}

public function eventrequests() {
    return view('admin.admin_pages.eventrequests');
 }

public function section() {
    return view('admin.admin_pages.section');
 }
//facility
public function facility() {
    return view('admin.admin_pages.facility');
}

public function events() {
    return view('admin.admin_pages.events');
}
//adduser

    public function showRegistrationForm()
    {
        return view('admin.admin_users.admin_register');
    }

    public function admin_register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admin_users.admin_login')->with('success', 'Admin account created successfully');
    }

    public function showLoginForm()
    {
        return view('admin.admin_users.admin_login');
    }

    public function admin_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('admin/admin_pages/admin_index');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    //logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin_login');
    }

    //adding user
    public function admin_adduser()
    {
        // Fetch all users from the Admin model
        $users = Admin::all();
        
        // Pass the $users variable to the view
        return view('admin.admin_users.admin_adduser', compact('users'));
    }

    public function searchUser(Request $request)
    {
        $email = $request->input('email');
        $user = DB::connection('umak_event')
                  ->table('users')
                  ->where('email', $email)
                  ->first();

        return response()->json($user);
    }

    public function addUser(Request $request)
    {
        $userData = $request->all();
        $user = Admin::create($userData);
        return response()->json($user);
    }

    public function deleteUser($id)
    {
        $user = Admin::find($id);
        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

    //events
    public function showEvents()
{
    $events = Listing::join('users', 'listings.user_id', '=', 'users.id')
        ->select('listings.tags', 'users.fname as author', 'users.org as organization')
        ->get();

    return view('admin.admin_pages.events', compact('events'));
}

//modal viewing





}