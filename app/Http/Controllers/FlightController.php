<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Flight;
use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function search(Request $request)
    {
        // Simply get ALL available flights without any filtering based on search criteria
        $flights = Flight::with(['airline', 'departureAirport', 'arrivalAirport'])
            ->where('available_seats', '>', 0)
            ->where('departure_time', '>', now())
            ->where('status', 'scheduled')
            ->orderBy('departure_time', 'asc')
            ->orderBy('price', 'asc')
            ->get();

        // Get search parameters for display purposes only (not used for filtering)
        $from = $request->input('from', 'Any');
        $to = $request->input('to', 'Any');
        $departureDate = $request->input('departure_date', 'Any Date');
        $returnDate = $request->input('return_date');
        $tripType = $request->input('tripType', 'return');

        // For the view structure, we'll show all flights as departure flights
        $departureFlights = $flights;
        $returnFlights = collect([]); // Empty collection for return flights

        return view('flights.search', compact(
            'flights',
            'from',
            'to',
            'departureDate',
            'departureFlights',
            'returnFlights',
            'returnDate',
            'tripType'
        ));
    }

    public function getAirports(Request $request)
    {
        $search = $request->input('search', '');

        $airports = Airport::where('is_active', true)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('code', 'LIKE', "%{$search}%")
                        ->orWhere('name', 'LIKE', "%{$search}%")
                        ->orWhere('city', 'LIKE', "%{$search}%")
                        ->orWhere('country', 'LIKE', "%{$search}%");
                });
            })
            ->limit(20)
            ->get()
            ->map(function ($airport) {
                return [
                    'code' => $airport->code,
                    'name' => $airport->name,
                    'city' => $airport->city,
                    'country' => $airport->country,
                    'display' => "{$airport->city}, {$airport->country} ({$airport->code})",
                ];
            });

        return response()->json($airports);
    }



    public function book(Request $request, Flight $flight)
    {
        // Check if user is authenticated
        // if (!Auth::check()) {
        //     return redirect()->route('login')->with('error', 'Please log in to book a flight.');
        // }

        // Load relationships to avoid N+1 queries
        $flight->load(['airline', 'departureAirport', 'arrivalAirport']);

        // Get passenger counts from request or default to 1 adult
        $adults = $request->input('adults', 1);
        $children = $request->input('children', 0);
        $infants = $request->input('infants', 0);
        $class = $request->input('class', 'economy');
        $tripType = $request->input('trip_type', 'oneway');

        // Calculate price breakdown
        $baseFare = $flight->price;
        $taxesAndFees = $baseFare * 0.15; // 15% taxes and fees
        $fuelSurcharge = $baseFare * 0.05; // 5% fuel surcharge
        $serviceCharge = 15.00; // Fixed service charge

        $totalPassengers = $adults + $children;
        $subtotal = $baseFare * $totalPassengers;
        $totalTaxes = ($taxesAndFees + $fuelSurcharge) * $totalPassengers + $serviceCharge;
        $totalAmount = $subtotal + $totalTaxes;

        return view('booking', compact(
            'flight',
            'adults',
            'children',
            'infants',
            'class',
            'tripType',
            'baseFare',
            'taxesAndFees',
            'fuelSurcharge',
            'serviceCharge',
            'subtotal',
            'totalTaxes',
            'totalAmount',
            'totalPassengers'
        ));
    }


    // public function book(Flight $flight)
    // {
    //     // Load relationships to avoid N+1 queries
    //     $flight->load(['airline', 'departureAirport', 'arrivalAirport']);

    //     return view('booking', compact('flight'));
    // }

}
