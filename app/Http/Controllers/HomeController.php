<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $featuredFlights = Flight::with(['departureAirport', 'arrivalAirport', 'airline'])
            ->where('departure_time', '>', now())
            ->orderBy('price', 'asc')
            ->take(6)
            ->get();

        return view('index', compact('featuredFlights'));
    }

    public function explore()
    {
        return view('explore');
    }

    public function book(Flight $flight)
    {
        return view('book', compact('flight'));
    }

    public function experience()
    {
        return view('experience');
    }

    public function privilege()
    {
        return view('privilege');
    }

    public function help()
    {
        return view('help');
    }
}
