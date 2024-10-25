<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AddUserController extends Controller
{
    public function searchEmail(Request $request)
    {
        $request->validate([
            'searchEmail' => 'required|email',
        ]);
    
        $email = $request->input('searchEmail');
        $user = User::where('email', $email)->first();
    
        if ($user) {
            return response()->json([
                'success' => true,
                'user' => [
                    'lname' => $user->lname,
                    'fname' => $user->fname,
                    'organization' => $user->org,
                    'status' => $user->status,
                    'email' => $user->email,
                ],
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No user found with this email',
            ]);
        }
    }
    
}