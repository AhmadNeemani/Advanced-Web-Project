<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\hairoineUser;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login'); 
    }

    // Handle login logic
    public function login(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Determine if the input is an email or username
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // Attempt to find the user
        $user = hairoineUser::where($fieldType, $request->username)->first();

        // Verify the credentials
        if ($user && Hash::check($request->password, $user->password)) {
            // Log the user in
            Auth::login($user);

            // Redirect admins to the admin dashboard
            if ($user->name === 'admin') {
                return redirect()->route('admin'); // Admin-specific page
            }

            // Redirect non-admin users to the home page
            return redirect()->route('home'); // Non-admin users
        }

        // Invalid credentials - send back with error message
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

        // Redirect to login page with a success message
        return redirect('/login')->with('success', 'You have been logged out!');
    }
}
