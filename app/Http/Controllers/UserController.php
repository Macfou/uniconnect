<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AdminUser;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        $organizations = Organization::all();
       
        return view('users.register', compact('organizations'));
    }
    

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'lname' => ['required', 'string', 'min:2'],
            'fname' => ['required', 'string', 'min:2'],
            'miname' => ['nullable', 'string', 'max:5'], // Middle Initial is optional
            'org' => 'required',
            'status' => ['required', 'string'], // Must be 'student' or 'faculty'
            'yearlevel' => ['nullable', 'string'], // Only required if status is student
            'section' => ['nullable', 'string', 'max:50'], // Optional for both status types
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);
        

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User
        $user = User::create($formFields);

        // Login
        Auth::login($user);

        

        return redirect('/')->with('message', 'User created and logged in');
    }

    // Logout
    public function logout(Request $request) {
        Auth::logout(); // Changed auth()->logout() to Auth::logout()

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out');
    }

    // Show login form
    public function login() {
        return view('users.login');
    }

    // Authenticate user
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (Auth::attempt($formFields)) { // Changed auth()->attempt() to Auth::attempt()
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    //tryy

    public function admin_user(){
    $isAdmin = AdminUser::where('user_id', Auth::id())->exists();

    // Pass this value to the view
    return view('/components/layout', compact('isAdmin'));
    }

    //get the organizations value
   
}
