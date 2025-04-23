<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieAdmin;
use App\Http\Middleware\Admin;

Route::get('/', function () {
    return view('LoginPage');
})->name('loginsign');
Route::get('/register', function () {
    return view('SignUpPage');
})->name('signup');



use App\Http\Controllers\SignupandLogin;
use App\Http\Controllers\ClientDashboardController;
use Illuminate\Support\Facades\Auth;

// Public routes — no middleware
Route::post('/signup', [SignupandLogin::class, 'signup'])->name('signup');
Route::post('/login', [SignupandLogin::class, 'login'])->name('login');

// Admin-only routes — protected by Admin middleware
Route::middleware(['auth', 'Admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\MovieAdmin::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/search', [App\Http\Controllers\MovieAdmin::class, 'search'])->name('admin.search');
    Route::post('/admin/add', [App\Http\Controllers\MovieAdmin::class, 'addMovie'])->name('admin.add');
    Route::delete('/admin/delete/{id}', [App\Http\Controllers\MovieAdmin::class, 'deleteMovie'])->name('admin.delete');
    Route::post('/admin/logout', function () {
        Auth::logout();
        
        return redirect('/')->with('success', 'Logged out successfully!');
    })->name('admin.logout')->middleware(['auth', 'Admin']);
});


Route::middleware(['auth', 'Client'])->group(function () {
    Route::get('/client/dashboard', [ClientDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/client/search', [ClientDashboardController::class, 'search'])->name('user.search');
});