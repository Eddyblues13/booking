<?php
// app/Http/Controllers/FlightController.php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Airport;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FlightController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'from' => 'required|string',
            'to' => 'required|string',
            'departure_date' => 'nullable|string',
            'return_date' => 'nullable|string',
        ]);

        $from = $request->input('from');
        $to = $request->input('to');
        $departureDate = $request->input('departure_date');
        $returnDate = $request->input('return_date');
        $tripType = $request->input('tripType', 'return');

        // Convert date format
        $parsedDate = null;
        if ($departureDate) {
            try {
                $parsedDate = Carbon::parse($departureDate)->format('Y-m-d');
            } catch (\Exception $e) {
                $parsedDate = Carbon::today()->format('Y-m-d');
            }
        }

        // Build the query
        $flights = Flight::with(['airline', 'departureAirport', 'arrivalAirport'])
            ->available()
            ->search([
                'from' => $from,
                'to' => $to,
                'date' => $parsedDate,
            ])
            ->orderBy('departure_time', 'asc')
            ->orderBy('price', 'asc')
            ->get();

        // Search for departure flights
        $departureFlights = Flight::with(['airline', 'departureAirport', 'arrivalAirport'])
            ->where('departure_airport_id', $request->id)
            ->where('arrival_airport_id', $request->id)
            ->whereDate('departure_time', Carbon::parse($request->departure_date)->format('Y-m-d'))
            ->where('class', $request->class)
            ->where('available_seats', '>=', ($request->adults + $request->children))
            ->where('departure_time', '>', now())
            ->orderBy('price', 'asc')
            ->get();

        $returnFlights = Flight::with(['airline', 'departureAirport', 'arrivalAirport'])
            ->where('departure_airport_id', $request->id)
            ->where('arrival_airport_id', $request->id)
            ->whereDate('departure_time', Carbon::parse($request->return_date)->format('Y-m-d'))
            ->where('class', $request->class)
            ->where('available_seats', '>=', ($request->adults + $request->children))
            ->where('departure_time', '>', now())
            ->orderBy('price', 'asc')
            ->get();

        return view('flights.search', compact('flights', 'from', 'to', 'departureDate', 'departureFlights', 'returnFlights', 'returnDate', 'tripType'));
    }

    public function getAirports(Request $request)
    {
        $search = $request->input('search', '');

        $airports = Airport::active()
            ->when($search, function ($query) use ($search) {
                $query->search($search);
            })
            ->limit(20)
            ->get()
            ->map(function ($airport) {
                return [
                    'code' => $airport->code,
                    'name' => $airport->name,
                    'city' => $airport->city,
                    'country' => $airport->country,
                    'display' => "{$airport->city}, {$airport->country}",
                ];
            });

        return response()->json($airports);
    }

    public function book(Flight $flight)
    {
        return view('book', compact('flight'));
    }
}
