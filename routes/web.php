<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AvailabilityManagementController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Landing Page & Ticket Pass)
|--------------------------------------------------------------------------
*/

// Landing Page Route
Route::get('/', function () {
    return view('index');
})->name('home');

// Availability & Time Slot API Endpoints
Route::get('/api/event-dates', [AvailabilityController::class, 'getEventDates'])
    ->name('api.event-dates');
Route::get('/api/availability', [AvailabilityController::class, 'getAvailability'])
    ->name('api.availability');

// Automatic Migration & Seeder Setup Route for cPanel Production DB
Route::get('/setup-availability-db', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'Database\Seeders\EventDateSeeder', '--force' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Event dates and 12 daily consultation slots successfully migrated and seeded!',
            'artisan_output' => \Illuminate\Support\Facades\Artisan::output(),
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
})->name('setup-availability-db');

// Consultation Form Submission Route (POST)
Route::post('/consultation', [ConsultationController::class, 'store'])
    ->name('consultation.store');

// Manage Booking Lookup Route (POST)
Route::post('/booking/manage/lookup', [ConsultationController::class, 'manageLookup'])
    ->name('booking.manage.lookup');

// Ticket Confirmation Pass Retrieval Route (GET by Booking Number)
Route::get('/ticket/{booking_number}', [ConsultationController::class, 'show'])
    ->name('ticket.show');

// Ticket Pass Dedicated PDF Export Route (GET by Booking Number)
Route::get('/ticket/{booking_number}/pdf', [ConsultationController::class, 'exportPdf'])
    ->name('ticket.pdf');

// Ticket Pass Cancel Booking Route (POST)
Route::post('/ticket/{booking_number}/cancel', [ConsultationController::class, 'cancel'])
    ->name('ticket.cancel');

// Ticket Pass Reschedule Booking Route (POST)
Route::post('/ticket/{booking_number}/reschedule', [ConsultationController::class, 'reschedule'])
    ->name('ticket.reschedule');

/*
|--------------------------------------------------------------------------
| Native Admin Authentication Routes (Guest)
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

/*
|--------------------------------------------------------------------------
| Native Admin Panel Routes (Protected by Auth Middleware)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->as('admin.')->group(function () {

    // Default /admin redirect to /admin/dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Admin Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Exports (Must be before {booking} wildcard parameter)
    Route::get('/bookings/export/csv', [BookingController::class, 'exportCsv'])
        ->name('bookings.export.csv');

    Route::get('/bookings/export/pdf', [BookingController::class, 'exportPdf'])
        ->name('bookings.export.pdf');

    // Reset All Data & Availability
    Route::post('/bookings/reset-all', [BookingController::class, 'resetAll'])
        ->name('bookings.reset-all');

    // Consultation / Booking Management
    Route::get('/bookings', [BookingController::class, 'index'])
        ->name('bookings.index');

    Route::get('/bookings/{booking}', [BookingController::class, 'show'])
        ->name('bookings.show');

    Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])
        ->name('bookings.edit');

    Route::put('/bookings/{booking}', [BookingController::class, 'update'])
        ->name('bookings.update');

    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])
        ->name('bookings.destroy');

    Route::get('/bookings/{booking}/pdf', [BookingController::class, 'pdf'])
        ->name('bookings.pdf');

    // Slot Availability Management & Controls
    Route::get('/availability', [AvailabilityManagementController::class, 'index'])
        ->name('availability.index');

    Route::post('/availability/dates/{eventDate}/toggle', [AvailabilityManagementController::class, 'toggleDate'])
        ->name('availability.toggle-date');

    Route::post('/availability/slots/{slot}/toggle', [AvailabilityManagementController::class, 'toggleSlot'])
        ->name('availability.toggle-slot');

    // Admin Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('logout');
});
