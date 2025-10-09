<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminFlightController;
use App\Http\Controllers\AdminBookingController;
use App\Http\Controllers\AdminDashboardController;








Route::get('/', function () {
    return view('index');
});

Route::get('/explore', function () {
    return view('explore');
});



Route::get('/experience', function () {
    return view('experience');
});

Route::get('/privilege', function () {
    return view('privilege');
});

Route::get('/help', function () {
    return view('help');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('signup');
});





// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/explore', [HomeController::class, 'explore'])->name('explore');
Route::get('/book', [HomeController::class, 'book'])->name('book');
Route::get('/experience', [HomeController::class, 'experience'])->name('experience');
Route::get('/privilege', [HomeController::class, 'privilege'])->name('privilege');
Route::get('/help', [HomeController::class, 'help'])->name('help');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Flight Routes
Route::get('/flights/search', [FlightController::class, 'search'])->name('flights.search');
Route::get('/flights/{flight}', [FlightController::class, 'show'])->name('flights.show');
Route::get('/flights/{flight}/book', [FlightController::class, 'book'])->name('flights.book');


// API endpoint for airport autocomplete
Route::get('/api/airports', [FlightController::class, 'getAirports'])->name('api.airports');

// Flight booking
Route::get('/flights/{flight}/book', [FlightController::class, 'book'])->name('flights.book');


// Booking Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking}/ticket', [BookingController::class, 'ticket'])->name('booking.ticket');
    Route::get('/booking/{booking}/receipt', [BookingController::class, 'receipt'])->name('booking.receipt');
});




// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Authentication
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

        // Flight Management
        Route::get('/flights', [AdminFlightController::class, 'index'])->name('flights.index');
        Route::get('/flights/create', [AdminFlightController::class, 'create'])->name('flights.create');
        Route::post('/flights', [AdminFlightController::class, 'store'])->name('flights.store');
        Route::get('/flights/{flight}/edit', [AdminFlightController::class, 'edit'])->name('flights.edit');
        Route::put('/flights/{flight}', [AdminFlightController::class, 'update'])->name('flights.update');
        Route::delete('/flights/{flight}', [AdminFlightController::class, 'destroy'])->name('flights.destroy');

        // Booking Management
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('bookings.show');
        Route::put('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.update-status');
        Route::delete('/bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

        // User Management
        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
        Route::put('/users/{user}/status', [AdminUserController::class, 'updateStatus'])->name('users.update-status');
    });
});
