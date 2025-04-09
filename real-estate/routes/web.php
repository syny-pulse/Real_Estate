<?php

use App\Http\Controllers\HomeController;
// use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\owner\PropertyController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/property-owner', [PropertyController::class, 'benefits'])->name('property.owner.benefits');

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

// // Register route
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/store', [RegisterController::class, 'store'])->name('register.store');

// // Login route
Route::get('/login', [LoginController::class, 'login'])->name('login');

// // Include admin and owner route files
require __DIR__.'/admin.php';

