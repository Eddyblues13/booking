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
Route::get('/signup', [AuthController::class, 'showRegister'])->name('register');
Route::post('/signup', [AuthController::class, 'register']);
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
// routes/web.php
Route::middleware(['auth'])->group(function () {
    Route::get('/flight/{flight}/book', [BookingController::class, 'book'])->name('booking.show');
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking}/payment', [BookingController::class, 'payment'])->name('booking.payment');
    Route::post('/booking/{booking}/process-payment', [BookingController::class, 'processPayment'])->name('booking.process-payment');
    Route::get('/booking/{booking}/confirmation', [BookingController::class, 'confirmation'])->name('booking.confirmation');
    Route::get('/booking/{booking}/receipt', [BookingController::class, 'receipt'])->name('booking.receipt');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
});
