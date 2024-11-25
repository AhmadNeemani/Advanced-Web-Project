<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\hairoineUser;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); 
    }

    public function login(Request $request)
    {
        
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if the input is an email or a username
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Attempt to find the user
        $user = hairoineUser::where($fieldType, $request->username)->first();

        // Verify the user's credentials
        if ($user && Hash::check($request->password, $user->password)) {
            // Log the user in
            Auth::login($user);

            

            if ($user->name === 'admin') {
                // Redirect admin to a specific admin page
                return redirect('/admin-dashboard');
            }

            // Redirect all newly created users to the home page
            return redirect()->route('home');
        }

        // If credentials are invalid, return back with an error message
        return back()->withErrors([
            'login' => 'Invalid username or password.',
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token
        $request->session()->regenerateToken();

        // Redirect to login page
        return redirect('/login')->with('success', 'You have been logged out!');
    }
}
