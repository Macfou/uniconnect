<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\OtpMail;
use App\Models\Section;
use App\Models\AdminUser;
use App\Models\Organization;

use App\Events\UserRegistered;
use Illuminate\Validation\Rule;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show Register/Create Form
    public function create() {
        $organizations = Organization::all();
       
        return view('users.register', compact('organizations'));
    }
    
    public function verifyRegistrationOtp(Request $request) {
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
    public function store(Request $request)
    {
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
                
            ],
            'password' => 'required|confirmed|min:6'
        ], [
            'email.regex' => 'Please use a valid Gmail or Umak email to register.',
        ]);
    
        $formFields['password'] = bcrypt($formFields['password']);
    
        // Generate OTP
        $otp = rand(100000, 999999);
    
        // Store OTP in session
        session(['otp' => $otp, 'otp_email' => $formFields['email'], 'formFields' => $formFields]);
    
        // Send OTP via email
        Mail::to($formFields['email'])->send(new OtpMail($otp));
    
        // Redirect to OTP verification page
        return redirect('/verify-otp')->with('message', 'An OTP has been sent to your email.');
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
   
    public function sendOtp(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
    
        $user = Auth::user();
    
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => 'Current password is incorrect.'], 400);
        }
    
        $otp = rand(100000, 999999); // Generate 6-digit OTP
    
        // Store OTP and password temporarily in session
        Session::put('otp', $otp);
        Session::put('otp_expires_at', now()->addMinutes(5)); 
        Session::put('password_update_data', ['new_password' => bcrypt($request->new_password)]); // Hash password before storing
    
        // Send OTP via email
        Mail::raw("Your OTP for password change is: $otp", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Password Change OTP');
        });
    
        return response()->json(['success' => true, 'message' => 'OTP has been sent to your email.']);
    }
    // Step 2: Verify OTP and change the password
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        $user = Auth::user();
        $storedOtp = Session::get('otp');
        $otpExpiresAt = Session::get('otp_expires_at');
        $passwordUpdateData = Session::get('password_update_data');

        if (!$storedOtp || now()->greaterThan($otpExpiresAt)) {
            return response()->json(['error' => 'The OTP has expired. Request a new one.'], 400);
        }

        if ($request->otp != $storedOtp) {
            return response()->json(['error' => 'Invalid OTP.'], 400);
        }

        // Update password
        $user->password = Hash::make($passwordUpdateData['new_password']);
        $user->save();

        // Clear session
        Session::forget(['otp', 'otp_expires_at', 'password_update_data']);

        return response()->json(['success' => 'Password updated successfully.']);
    }

    //forgot password

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // Step 1: Send OTP to Email
    public function sendOtpfp (Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        $otp = rand(100000, 999999); // Generate 6-digit OTP

        Session::put('otp', $otp);
        Session::put('otp_email', $user->email);
        Session::put('otp_expires_at', now()->addMinutes(5)); // OTP expires in 5 minutes

        // Send OTP via email
        Mail::raw("Your OTP for password reset is: $otp", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Password Reset OTP');
        });

        return redirect()->route('forgot.password.form')->with('otp_sent', 'OTP sent to your email.');
    }

    public function verifyOtpfp(Request $request)
{       
    $request->validate([
        'otp' => 'required',
        'new_password' => [
            'required',
            'min:8',
            'regex:/[a-z]/',
            'regex:/[A-Z]/',
            'regex:/[0-9]/',
            'regex:/[@$!%*#?&]/',
            'confirmed'
        ]
    ], [
        'new_password.regex' => 'Password must include uppercase, lowercase, number, and special character.',
        'new_password.confirmed' => 'Passwords do not match.'
    ]);

    if (!Session::has('otp') || now()->greaterThan(Session::get('otp_expires_at'))) {
        return back()->with('error', 'The OTP has expired. Request a new one.');
    }

    if ($request->otp != Session::get('otp')) {
        // OTP is wrong, stay on OTP form
        return back()->with('error', 'Wrong OTP entered.');
    }

    $user = User::where('email', Session::get('otp_email'))->first();

    if (!$user) {
        return back()->with('error', 'User not found.');
    }

    $user->password = Hash::make($request->new_password);
    $user->save();

    // Clear OTP session
    Session::forget(['otp', 'otp_email', 'otp_expires_at']);

    return redirect('/login')->with('success', 'Password reset successfully. You can now log in.');
}
public function uploadPhoto(Request $request)
{
    $request->validate([
        'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = Auth::user();

    $file = $request->file('photo');
    $path = $file->store('user_photos', 'public');

    $user->photo = $path;
    $user->save();

    return back()->with('success', 'Profile photo updated.');
}

}



