<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\WishlistController;

Route::get('/my-wishlist', [PropertiesController::class, 'myWishedProperties'])->name('my.wishlist');
use App\Http\Controllers\BookingController;

Route::get('/my-booked-properties', [PropertiesController::class, 'myBookedProperties'])->name('my.booked.properties');
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\owner\PropertyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ProfileController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
//Route::get('/properties/{property:slug}', [PropertyController::class, 'show'])->name('properties.show');

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

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.update-image');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Customer routes
    Route::middleware(['auth'])->prefix('customer')->group(function () {
        Route::resource('wishlist', \App\Http\Controllers\WishlistController::class)->only(['index', 'store', 'destroy']);
        Route::resource('bookings', \App\Http\Controllers\BookingController::class)->only(['store']);
        Route::resource('reviews', \App\Http\Controllers\ReviewController::class)->only(['store']);
        // Route::resource('bookings', BookingController::class); // Commented out until BookingController exists
    });
});

// Register routes
Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Login route
Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'check'])->name('login.check');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Reset password
Route::get('/forgot-password', [ResetPasswordController::class, 'show'])->name('password.request');
Route::post('/forgot-password', [ResetPasswordController::class, 'send'])->name('password.send');

// change password
Route::get('/change-password/{token}', [ChangePasswordController::class, 'show'])->name('password.reset');
Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('password.update');

// Properties routes
Route::middleware(['auth'])->group(function () {
    Route::get('/properties/create', [PropertiesController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertiesController::class, 'store'])->name('properties.store');
    Route::get('/properties/{property}/edit', [PropertiesController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [PropertiesController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertiesController::class, 'destroy'])->name('properties.destroy');
});

Route::get('/properties', [PropertiesController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertiesController::class, 'show'])->name('properties.show');


// Property owner routes
Route::get('/property-owner', [PropertyController::class, 'benefits'])->name('property.owner.benefits');
Route::get('/property-owner-dashboard', [PropertyController::class, 'dashboard'])->name('property.owner.dashboard');

//Booking routes
Route::get('/active-bookings', [App\Http\Controllers\BookingController::class, 'activeBookings'])
    ->name('bookings.active')
    ->middleware('auth');

// legal-terms
Route::get('/legal-terms', [PropertyController::class, 'terms'])->name('legal.terms');

// privacy policy
Route::get('/privacy-policy', [PropertyController::class, 'privacy'])->name('privacy.policy');

// Owner Message Routes

    Route::get('/messages', [App\Http\Controllers\Owner\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [App\Http\Controllers\Owner\MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages', [App\Http\Controllers\Owner\MessageController::class, 'store'])->name('messages.store');
    Route::post('/messages/reply/{user}', [App\Http\Controllers\Owner\MessageController::class, 'reply'])->name('messages.reply');





Route::get('/properties/{property}/edit', [PropertiesController::class, 'edit'])->name('properties.edit'); // Add this line
require __DIR__.'/admin.php';
