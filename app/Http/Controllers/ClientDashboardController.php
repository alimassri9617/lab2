<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientDashboardController extends Controller
{
    /**
     * Show the client dashboard with all available movies.
     */
    public function index()
    {
        // This middleware already restricts access to clients, no need to re-check
        $movies = Movies::all();
        return view('client.dashboard', compact('movies'));
    }
    public function search(Request $request)
    {
        $searchTerm = $request->text;
        $movies = Movies::where('title', 'LIKE', "%{$searchTerm}%")->get();
        return view('client.dashboard', compact('movies'));
    }
}
