<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AdminUser;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    

    public function index()
    {
        $admin_users = AdminUser::all();  // Get all organizations
        return view('admin.admin_users.admin_adduser', compact('admin_users'));
    }

    public function save(Request $request)
    {
        $validated = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|email|unique:admin_users',
            'organization' => 'required|string',
            'status' => 'required|string',
        ]);
    
        // Save admin user
        $adminUser = new AdminUser();
        $adminUser->fname = $validated['fname'];
        $adminUser->lname = $validated['lname'];
        $adminUser->email = $validated['email'];
        $adminUser->organization = $validated['organization'];
        $adminUser->status = $validated['status'];
        $adminUser->save();
    
        return response()->json([
            'success' => true,
            'user' => $adminUser
        ]);
    }
   // Controller Method to store admin users
public function addAdminUser(Request $request)
{
    try {
        // Validate incoming data
        $data = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'organization' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|email|unique:admin_users,email',
        ]);

        // Save to the admin_users table
        $user = AdminUser::create($data);

        // Return success response with user data
        return response()->json(['success' => true, 'user' => $user]);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}


    // Delete an admin user by email
    public function deleteAdminUser(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'email' => 'required|email|exists:admin_users,email', // Assuming your table is admin_users
        ]);

        try {
            // Find and delete the user from the admin_users table
            $user = AdminUser::where('email', $request->email)->first();
            if ($user) {
                $user->delete();
                return response()->json(['success' => true, 'message' => 'User deleted successfully.']);
            } else {
                return response()->json(['success' => false, 'message' => 'User not found.']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting user: ' . $e->getMessage()]);
        }
    }
    public function store(Request $request)
{
    try {
        $data = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'organization' => 'required|string',
            'status' => 'required|string',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = User::create($data);  // Store the user
        return response()->json(['success' => true, 'user' => $user]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}




public function fetchAdminUsers()
{
    try {
        // Get all admin users
        $adminUsers = AdminUser::all();

        // Return success response with users data
        return response()->json(['success' => true, 'admin_users' => $adminUsers]);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}

public function showAdminPage()
{
    // Fetch all admin users from the database
    $admin_users = AdminUser::all(); // Assuming you have an AdminUser model

    // Pass the data to the Blade view
    return view('admin.admin_users.admin_adduser', compact('admin_users'));
}

public function destroy($id)
{
    // Find the organization by ID and delete it
    $admin_users = AdminUser::findOrFail($id);
    $admin_users->delete();

    // Redirect to the organizations index page with a success message
    return redirect()->route('admin.admin_users.admin_adduser.index')->with('success', 'an Admin User Remove successfully!');
}
    


}
    
