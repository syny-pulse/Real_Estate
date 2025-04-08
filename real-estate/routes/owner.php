<?php
use App\Http\Controllers\owner\PropertyController;
use Illuminate\Support\Facades\Route;

    Route::get('/property-owner', [PropertyController::class, 'benefits'])->name('property.owner.benefits');
