<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\hairoineUser;

class SignupController extends Controller
{
    // Show the sign-up form
    public function showSignupForm()
    {
        return view('signup');
    }

    // Store the user in the database
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:hairoine_users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user in the database
        hairoineUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        
        return redirect()->route('login')->with('success', 'Account created successfully! Please log in.');
    }
}
