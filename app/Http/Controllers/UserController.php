<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\OtpMail;
use App\Models\Section;
use App\Models\AdminUser;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        $organizations = Organization::all();
       
        return view('users.register', compact('organizations'));
    }
    
    public function verifyOtp(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric'
        ]);
    
        if (session('otp') == $request->otp) {
            $userData = session('pending_user');
    
            if (!$userData || $userData['email'] !== $request->email) {
                return response()->json(['success' => false, 'message' => 'Session expired. Please register again.']);
            }
    
            // Create the user in the database
            $user = User::create($userData);
            
            // Log in the user
            Auth::login($user);
    
            // Clear session
            session()->forget(['otp', 'pending_user']);
    
            return response()->json(['success' => true, 'redirect' => url('/')]);
        }
    
        return response()->json(['success' => false, 'message' => 'Invalid OTP.']);
    }
    

    // Create New User
    public function store(Request $request) {
        $formFields = $request->validate([
            'lname' => ['required', 'string', 'min:2'],
            'fname' => ['required', 'string', 'min:2'],
            'miname' => ['nullable', 'string', 'max:5'],
            'org' => 'required',
            'status' => ['required', 'string'],
            'idnumber' => ['required', 'string'],
            'yearlevel' => ['nullable', 'string'],
            'section' => ['nullable', 'string', 'max:50'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email'),
                'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|umak\.edu\.ph)$/'
            ],
            'password' => 'required|confirmed|min:6'
        ], [
            'email.regex' => 'Please use a valid Gmail or Umak email to register.',
        ]);
    
        $organization = Organization::where('id', $request->org)->first();
        if ($organization) {
            $formFields['org'] = $organization->orgNameAbbv;
        } else {
            return back()->withErrors(['org' => 'Invalid organization selected.']);
        }
    
        // Store user data in session (without saving to database yet)
        $formFields['password'] = bcrypt($formFields['password']); 
        session(['pending_user' => $formFields]);
    
        // Generate OTP
        $otp = rand(100000, 999999);
        session(['otp' => $otp]);
    
        // Send OTP to the user's email
        Mail::to($request->email)->send(new OtpMail($otp));
    
        return response()->json(['success' => true, 'message' => 'OTP sent.']);
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

    public function filter(Request $request)
    {
        $query = Section::query();
    
        if ($request->has('organization_id') && $request->organization_id) {
            $query->where('organization_id', $request->organization_id);
        }
    
        if ($request->has('year_level') && $request->year_level) {
            $query->where('year_level', $request->year_level);
        }
    
        return response()->json($query->get());
    }
   
    
}
