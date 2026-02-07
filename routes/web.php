<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehiclePageController;
use App\Http\Controllers\GalleryPageController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\RentalTypeController;
use App\Http\Controllers\Admin\DestinationController;

// Public Routes
Route::get('/', [VehiclePageController::class, 'index']);

Route::get('/gallery', [GalleryPageController::class, 'index']);

Route::get('/calculator', [CalculatorController::class, 'index']);

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Admin Routes (Protected) - Must be logged in
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
        
        // Change Password
        Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('change-password');
        Route::post('/change-password', [AuthController::class, 'updatePassword'])->name('update-password');

        // Vehicles Management
        Route::resource('vehicles', VehicleController::class);

        // Gallery Management (General Gallery - not vehicle images)
        Route::resource('gallery', GalleryController::class);
        Route::post('/gallery/sort', [GalleryController::class, 'updateSort'])->name('gallery.sort');

        // Rental Types Management
        Route::resource('rental-types', RentalTypeController::class);

        // Destinations Management (Travel Destinations)
        Route::resource('destinations', DestinationController::class);
    });
});
