<?php

namespace App\Http\Controllers;

use App\Models\Ufmo;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UfmoController extends Controller
{
    public function index()
    {
        $ufmoUsers = Ufmo::all();
        return view('admin.admin_users.ufmouser', compact('ufmoUsers'));
    }

  

    // Update an existing  officer
    public function update(Request $request, $id)
    {
        $ufmo = Ufmo::findOrFail($id);

        $validated = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:ufmo,email,' . $id,
        ]);

        $ufmo->update($validated);

        return redirect()->back()->with('success', 'UFMO Officer updated successfully!');
    }

    // Delete a  officer
    public function destroy($id)
    {
        $ufmo = Ufmo::findOrFail($id);
        $ufmo->delete();

        return redirect()->back()->with('success', 'UFMo Officer deleted successfully!');
    }

    public function ufmolayout()
    {
        // Get the count of pending requests
        $pendingCount = Listing::where('status', 'pending')->count();
    
        // Return the view and pass the variable
        return view('ufmo.ufmo_components.ufmolayout', compact('pendingCount'));
    }

    public function profile()
    {
        $ufmoUser = Auth::guard('ufmo')->user(); // Ensure you are using the correct authentication guard
        return view('ufmo.ufmo_pages.ufmo_profile', compact('ufmoUser'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $ufmoUser = Auth::guard('ufmo')->user();

        if (!Hash::check($request->current_password, $ufmoUser->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $ufmoUser->password = Hash::make($request->new_password);
        $ufmoUser->save();

        return back()->with('success', 'Password updated successfully.');
    }

    public function create()
    {
        return view('ufmo.ufmo_pages.ufmo_adduser');
    }
   
    public function sendOtp(Request $request)
{
    $request->validate([
        'fname' => 'required|string|max:255',
        'lname' => 'required|string|max:255',
        'email' => 'required|email|unique:ufmo,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $otp = rand(100000, 999999); // Generate 6-digit OTP

    // Store everything temporarily in session
    Session::put('ufmo_user', $request->only('fname', 'lname', 'email', 'password'));
    Session::put('ufmo_otp', $otp);

    // Send OTP to email
    Mail::raw("Your OTP code is: $otp", function ($message) use ($request) {
        $message->to($request->email)
                ->subject('UFMO Email Verification OTP');
    });

    return view('ufmo.otpverify'); // A blade view where user inputs OTP
}

public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => 'required|digits:6'
    ]);

    if ($request->otp != Session::get('ufmo_otp')) {
        return back()->with('error', 'Invalid OTP. Please try again.');
    }

    $data = Session::get('ufmo_user');
    $data['password'] = Hash::make($data['password']);

    Ufmo::create([
        'fname' => $data['fname'],
        'lname' => $data['lname'],
        'email' => $data['email'],
        'password' => $data['password'],
    ]);

    Session::forget(['ufmo_user', 'ufmo_otp']);

    return redirect()->route('ufmo.ufmo_pages.ufmo_adduser')->with('success', 'User created successfully!');
}
}
