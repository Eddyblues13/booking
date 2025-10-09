<?php
// [file name]: AdminFlightController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class AdminFlightController extends Controller
{
    public function index()
    {
        $flights = Flight::latest()->paginate(10);
        return view('admin.flights.index', compact('flights'));
    }

    public function create()
    {
        return view('admin.flights.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'flight_number' => 'required|unique:flights',
            'airline' => 'required',
            'departure_airport' => 'required',
            'arrival_airport' => 'required',
            'departure_city' => 'required',
            'arrival_city' => 'required',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'duration' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'seats_available' => 'required|integer|min:0',
            'class' => 'required',
            'status' => 'required'
        ]);

        Flight::create($validated);

        return redirect()->route('admin.flights.index')
            ->with('success', 'Flight created successfully.');
    }

    public function edit(Flight $flight)
    {
        return view('admin.flights.edit', compact('flight'));
    }

    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'flight_number' => 'required|unique:flights,flight_number,' . $flight->id,
            'airline' => 'required',
            'departure_airport' => 'required',
            'arrival_airport' => 'required',
            'departure_city' => 'required',
            'arrival_city' => 'required',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'duration' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'seats_available' => 'required|integer|min:0',
            'class' => 'required',
            'status' => 'required'
        ]);

        $flight->update($validated);

        return redirect()->route('admin.flights.index')
            ->with('success', 'Flight updated successfully.');
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();

        return redirect()->route('admin.flights.index')
            ->with('success', 'Flight deleted successfully.');
    }
}
