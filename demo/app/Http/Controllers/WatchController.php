<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    public function index(Request $request)
    {
        // Check if the user is authenticated
        if ($request->user()) {
            // User is authenticated, proceed with your logic
            return view('watch.index', ['user' => $request->user()]);
        } else {
            // User is not authenticated, redirect to login page or show a message
            return redirect()->route('login')->with('message', 'Please log in to access this page.');
        }
    }
}