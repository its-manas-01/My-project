<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, proceed with your logic
            return view('home', ['user' => Auth::user()]);
        } else {
            // User is not authenticated, redirect to login page or show a message
            return redirect()->route('login')->with('message', 'Please log in to access this page.');
        }
    }
    public function login(Request $request)
    {
        // Handle the login logic here
        // For example, validate the credentials and log in the user
        // Redirect to the home page after successful login
        return redirect()->route('home')->with('message', 'Login successful!');
    }
}