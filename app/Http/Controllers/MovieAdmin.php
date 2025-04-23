<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use \Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MovieAdmin extends Controller
{
    public function index()
    {
        // Fetch all movies from the database
        $movies = Movies::all();

        // Pass the movies to the view
        return view('admin.dashboard', compact('movies'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        // Fetch movies based on the search term
        $movies = Movies::where('title', 'LIKE', "%{$search}%")->get();

        // Return the same view with search results
        return view('admin.dashboard', compact('movies'));
    }

    public function addMovie(Request $request)
    {
        $mv = new Movies();
        $mv->title = $request->title;
        $mv->thumbnail = $request->thumbnail;
        $mv->description = $request->description;
        $mv->production_year = $request->production_year;
        $mv->duration = $request->duration;
        $mv->genre = $request->genre;
        $mv->synopsis = $request->synopsis;
        $mv->save();

        return redirect()->back()->with('success', 'Movie added successfully!');
    }

    public function deleteMovie($id)
    {
        $movie = Movies::find($id);

        if (!$movie) {
            return redirect()->back()->with('error', 'Movie not found!');
        }

        // Delete the movie
        $movie->delete();

        return redirect()->back()->with('success', 'Movie deleted successfully!');
    }
    public function logout()
    {
        // Perform logout logic here
        // For example, you might want to invalidate the session or token
        Auth::logout();
        // Redirect to the login page
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
