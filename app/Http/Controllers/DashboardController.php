<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        try {
            // Get bookings with proper relationship loading and error handling
            $bookings = $user->bookings()
                ->with([
                    'flight.airline',
                    'flight.departureAirport',
                    'flight.arrivalAirport'
                ])
                ->latest()
                ->take(5)
                ->get();

            // Calculate stats with safe checks
            $stats = [
                'total_bookings' => $user->bookings()->count(),
                'upcoming_trips' => $user->bookings()
                    ->whereHas('flight', function ($query) {
                        $query->where('departure_time', '>', now());
                    })
                    ->where('status', 'confirmed')
                    ->count(),
                'pending_bookings' => $user->bookings()->where('status', 'pending')->count(),
                'total_spent' => $user->bookings()->sum('total_amount') ?? 0,
            ];

            return view('dashboard', compact('user', 'bookings', 'stats'));
        } catch (\Exception $e) {
            // Fallback if relationships aren't properly set up
            $stats = [
                'total_bookings' => 0,
                'upcoming_trips' => 0,
                'pending_bookings' => 0,
                'total_spent' => 0,
            ];

            $bookings = collect(); // empty collection

            return view('dashboard', compact('user', 'bookings', 'stats'));
        }
    }
}
