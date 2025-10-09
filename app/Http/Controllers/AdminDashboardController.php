<?php
// [file name]: AdminDashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'total_flights' => Flight::count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_amount'),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
        ];

        $recentBookings = Booking::with(['user', 'flight'])
            ->latest()
            ->take(10)
            ->get();

        $recentFlights = Flight::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentBookings', 'recentFlights'));
    }
}
