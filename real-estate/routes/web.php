<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/about', function() { return view('about'); })->name('about');
Route::get('/contact', function() { return view('contact'); })->name('contact');

// Auth routes are handled by Laravel's authentication scaffolding

// Protected routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function() {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } elseif (auth()->user()->isOwner()) {
            return redirect()->route('owner.dashboard');
        } else {
            return redirect()->route('customer.dashboard');
        }
    })->name('dashboard');

    // Customer routes
    Route::middleware(['customer'])->prefix('customer')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
        Route::resource('wishlist', WishlistController::class)->only(['index', 'store', 'destroy']);
        Route::resource('bookings', BookingController::class);
    });
});

// Register route
Route::get('/register', [RegisterController::class, 'register'])->name('registration');

// Login route
Route::get('/login', [LoginController::class, 'login'])->name('login');

// Include admin and owner route files
require __DIR__.'/admin.php';
require __DIR__.'/owner.php';
