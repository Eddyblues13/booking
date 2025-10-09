<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->with('flight')->latest()->take(5)->get();

        $stats = [
            'total_bookings' => $user->bookings()->count(),
            'upcoming_trips' => $user->bookings()->where('status', 'confirmed')->count(),
            'pending_bookings' => $user->bookings()->where('status', 'pending')->count(),
            'total_spent' => $user->bookings()->sum('total_amount'),
        ];

        return view('dashboard', compact('user', 'bookings', 'stats'));
    }
}
