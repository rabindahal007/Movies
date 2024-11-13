<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Ensure you have the User model imported
use Illuminate\Support\Facades\Auth; // For authentication handling
use Illuminate\Support\Facades\Validator; // For validating input data

class MovieController extends Controller
{
    // Show the signup form
    public function signup()
    {
        return view('signup'); // This will return the signup view
    }

    // Handle the signup form submission and store user data
    public function register(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Ensure the password matches confirmation
        ]);

        // If validation fails, return with errors
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create a new user record in the database with plain text password
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Store the password as plain text
        ]);

        // Log the creation of the user (optional)
        \Log::info('User created: ', ['email' => $request->email]);

        // Redirect to login page after successful registration
        return redirect()->route('logins')->with('status', 'Registration successful! Please login.');
    }

    // Show the login form
    public function login()
    {
        return view('logins'); // Return the login view
    }

    // Handle the login form submission and authenticate the user
    public function authenticate(Request $request)
    {
        // Validate the login credentials
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        
        // Find the user by email
        $user = User::where('email', $request->email)->first();
        
        // Check if user exists
        if ($user) {
            // Show entered email and password (for debugging)
            

            // Check if password matches
            if ($request->password == $user->password) {
                // Password matches, log the user in
                Auth::login($user);
                return redirect()->route('home');
            } else {
                // Password doesn't match, show error
                return back()->withErrors(['email' => 'Invalid credentials.']);
            }
        } else {
            // If no user is found
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }
    }

    // Show the home page after successful login
    public function home()
    {
        // Ensure the user is logged in before accessing the home page
        if (Auth::check()) {
            return view('home'); // This should return the home view
        }

        // Redirect to the login page if not logged in
        return redirect()->route('logins');
    }

    // Handle logout and redirect to login page
    public function logout()
    {
        Auth::logout(); // Log out the user
        return redirect()->route('logins'); // Redirect to the login page
    }
    public function main(){
        return view('main');
    }
    
}
