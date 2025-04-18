<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/properties', [AdminController::class, 'index'])->name('properties');
    Route::get('/properties/{id}', [AdminController::class, 'show'])->name('properties.show');
    Route::post('/properties/{id}/approve', [AdminController::class, 'approve'])->name('properties.approve');
    Route::post('/properties/{id}/reject', [AdminController::class, 'reject'])->name('properties.reject');

    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');
});
