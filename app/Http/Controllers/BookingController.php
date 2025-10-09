<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use App\Models\Passenger;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function create(Flight $flight)
    {
        $flight->load(['departureAirport', 'arrivalAirport', 'airline']);

        // Calculate prices
        $baseFare = $flight->price;
        $taxes = $baseFare * 0.1; // 10% tax
        $serviceFee = 20;
        $totalAmount = $baseFare + $taxes + $serviceFee;

        return view('booking.create', compact('flight', 'baseFare', 'taxes', 'serviceFee', 'totalAmount'));
    }

    public function store(Request $request, Flight $flight)
    {
        $request->validate([
            'passengers' => 'required|array|min:1|max:9',
            'passengers.*.title' => 'required|string|in:Mr,Mrs,Ms,Dr',
            'passengers.*.first_name' => 'required|string|max:100',
            'passengers.*.last_name' => 'required|string|max:100',
            'passengers.*.date_of_birth' => 'required|date|before:today',
            'passengers.*.nationality' => 'required|string|size:2',
            'passengers.*.passport_number' => 'required|string|max:20',
            'passengers.*.passport_expiry' => 'required|date|after:today',
            'passengers.*.gender' => 'required|string|in:male,female,other',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'emergency_contact_name' => 'required|string|max:100',
            'emergency_contact_phone' => 'required|string|max:20',
            'special_requests' => 'nullable|string|max:500'
        ]);

        // Check seat availability
        if ($flight->available_seats < count($request->passengers)) {
            return back()->withErrors(['error' => 'Not enough seats available.'])->withInput();
        }

        // Calculate total amount
        $baseFare = $flight->price * count($request->passengers);
        $taxes = $baseFare * 0.1;
        $serviceFee = 20 * count($request->passengers);
        $totalAmount = $baseFare + $taxes + $serviceFee;

        // Create booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'flight_id' => $flight->id,
            'booking_reference' => Str::upper(Str::random(8)),
            'passenger_count' => count($request->passengers),
            'total_amount' => $totalAmount,
            'base_fare' => $baseFare,
            'taxes' => $taxes,
            'service_fee' => $serviceFee,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_phone' => $request->emergency_contact_phone,
            'special_requests' => $request->special_requests,
            'status' => 'pending_payment',
            'payment_status' => 'pending'
        ]);

        // Create passengers
        foreach ($request->passengers as $index => $passengerData) {
            Passenger::create([
                'booking_id' => $booking->id,
                'seat_number' => $this->generateSeatNumber($flight, $index + 1),
                'title' => $passengerData['title'],
                'first_name' => $passengerData['first_name'],
                'last_name' => $passengerData['last_name'],
                'date_of_birth' => $passengerData['date_of_birth'],
                'nationality' => $passengerData['nationality'],
                'passport_number' => $passengerData['passport_number'],
                'passport_expiry' => $passengerData['passport_expiry'],
                'gender' => $passengerData['gender']
            ]);
        }

        // Update available seats
        $flight->decrement('available_seats', count($request->passengers));

        return redirect()->route('booking.payment', $booking);
    }

    public function payment(Booking $booking)
    {
        $booking->load(['flight.departureAirport', 'flight.arrivalAirport', 'flight.airline', 'passengers']);

        return view('booking.payment', compact('booking'));
    }

    public function confirmation(Booking $booking)
    {
        $booking->load(['flight.departureAirport', 'flight.arrivalAirport', 'flight.airline', 'passengers']);

        return view('booking.confirmation', compact('booking'));
    }

    public function ticket(Booking $booking)
    {
        $booking->load(['flight.departureAirport', 'flight.arrivalAirport', 'flight.airline', 'passengers']);

        return view('booking.ticket', compact('booking'));
    }

    public function receipt(Booking $booking)
    {
        $booking->load(['flight.departureAirport', 'flight.arrivalAirport', 'flight.airline', 'passengers', 'payment']);

        return view('booking.receipt', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Restore seats
        $booking->flight->increment('available_seats', $booking->passenger_count);

        $booking->delete();

        return redirect()->route('dashboard')->with('success', 'Booking cancelled successfully.');
    }

    private function generateSeatNumber($flight, $passengerIndex)
    {
        $rows = range(1, 30);
        $columns = ['A', 'B', 'C', 'D', 'E', 'F'];

        $row = $rows[($passengerIndex - 1) % count($rows)];
        $column = $columns[($passengerIndex - 1) % count($columns)];

        return $row . $column;
    }
}
