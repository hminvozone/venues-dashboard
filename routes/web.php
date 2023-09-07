<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Auth/Register', [
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
        Route::resource('/venues', VenueController::class);
        Route::resource('/users', UserController::class);
        Route::resource('/roles', RoleController::class);
        Route::get('/venues/assign/{id}', [VenueController::class, 'assign'])->name('venues.assign');
        Route::post('/venues/assign', [VenueController::class, 'assignVenues'])->name('venues.assign');
        Route::get('/staff/venue/list', [StaffController::class, 'list'])->name('staff.venues.list');
        Route::get('/staff/venue/view', [StaffController::class, 'view'])->name('staff.venues.view');

});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
