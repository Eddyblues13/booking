<?php
// app/Http/Controllers/BookingController.php

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
    public function book(Request $request, Flight $flight)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to book a flight.');
        }

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

        // Adjust price based on class
        switch ($class) {
            case 'business':
                $baseFare *= 1.5;
                break;
            case 'first':
                $baseFare *= 2;
                break;
        }

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

    public function store(Request $request)
    {
        $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'adults' => 'required|integer|min:1',
            'children' => 'integer|min:0',
            'infants' => 'integer|min:0',
            'class' => 'required|in:economy,business,first',
            'passengers' => 'required|array|min:1',
            'passengers.*.title' => 'required|string|in:Mr,Mrs,Ms,Miss,Dr,Prof',
            'passengers.*.first_name' => 'required|string|max:50',
            'passengers.*.last_name' => 'required|string|max:50',
            'passengers.*.date_of_birth' => 'required|date|before:-12 years',
            'passengers.*.gender' => 'required|string|in:male,female,other',
            'passengers.*.nationality' => 'required|string|size:2',
            'passengers.*.passport_number' => 'required|string|max:20',
            'passengers.*.passport_expiry' => 'required|date|after:+6 months',
            'passengers.*.passport_country' => 'required|string|size:2',
            'passengers.*.email' => 'required|email',
            'passengers.*.phone' => 'required|string|max:20',
            'passengers.*.frequent_flyer' => 'nullable|string|max:20',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'contact_phone_secondary' => 'nullable|string|max:20',
            'special_requests' => 'nullable|string|max:500',
            'terms_accepted' => 'required|accepted'
        ]);

        $flight = Flight::findOrFail($request->flight_id);
        $passengerCount = count($request->passengers);

        // Check seat availability
        if ($flight->available_seats < $passengerCount) {
            return back()->withErrors(['error' => 'Not enough seats available. Only ' . $flight->available_seats . ' seats left.'])->withInput();
        }

        // Calculate total amount based on class and passenger count
        $baseFare = $flight->price;
        switch ($request->class) {
            case 'business':
                $baseFare *= 1.5;
                break;
            case 'first':
                $baseFare *= 2;
                break;
        }

        $totalBaseFare = $baseFare * $passengerCount;
        $taxes = $totalBaseFare * 0.15;
        $serviceFee = 15.00;
        $totalAmount = $totalBaseFare + $taxes + $serviceFee;

        // Create booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'flight_id' => $flight->id,
            'passenger_count' => $passengerCount,
            'total_amount' => $totalAmount,
            'base_fare' => $totalBaseFare,
            'taxes' => $taxes,
            'service_fee' => $serviceFee,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'contact_phone_secondary' => $request->contact_phone_secondary,
            'emergency_contact_name' => $request->passengers[0]['first_name'] . ' ' . $request->passengers[0]['last_name'],
            'emergency_contact_phone' => $request->passengers[0]['phone'],
            'special_requests' => $request->special_requests,
            'status' => 'pending_payment',
            'payment_status' => 'pending'
        ]);

        // Create passengers
        foreach ($request->passengers as $index => $passengerData) {
            Passenger::create([
                'booking_id' => $booking->id,
                'title' => $passengerData['title'],
                'first_name' => $passengerData['first_name'],
                'last_name' => $passengerData['last_name'],
                'date_of_birth' => $passengerData['date_of_birth'],
                'gender' => $passengerData['gender'],
                'nationality' => $passengerData['nationality'],
                'passport_number' => $passengerData['passport_number'],
                'passport_expiry' => $passengerData['passport_expiry'],
                'passport_country' => $passengerData['passport_country'],
                'email' => $passengerData['email'],
                'phone' => $passengerData['phone'],
                'frequent_flyer_number' => $passengerData['frequent_flyer'] ?? null,
            ]);
        }

        // Update available seats
        $flight->decrement('available_seats', $passengerCount);

        return redirect()->route('booking.payment', $booking);
    }

    public function payment(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->isConfirmed()) {
            return redirect()->route('booking.confirmation', $booking);
        }

        $booking->load(['flight.departureAirport', 'flight.arrivalAirport', 'flight.airline', 'passengers']);

        return view('booking.payment', compact('booking'));
    }

    public function processPayment(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_method' => 'required|in:credit_card,debit_card,paypal,bank_transfer,contact_agent'
        ]);

        $paymentMethod = $request->payment_method;

        if ($paymentMethod === 'contact_agent') {
            // Handle contact agent payment method
            $booking->update([
                'payment_method' => 'contact_agent',
                'status' => 'confirmed',
                'payment_status' => 'pending'
            ]);

            return redirect()->route('booking.confirmation', $booking)->with('success', 'An agent will contact you shortly to complete your payment.');
        }

        // For other payment methods, process the payment
        $booking->update([
            'payment_method' => $paymentMethod,
            'payment_status' => 'completed',
            'status' => 'confirmed'
        ]);

        // Create payment record
        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_amount,
            'payment_method' => $paymentMethod,
            'transaction_id' => 'TXN-' . strtoupper(Str::random(10)),
            'status' => 'completed',
            'paid_at' => now(),
        ]);

        return redirect()->route('booking.confirmation', $booking);
    }

    public function confirmation(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['flight.departureAirport', 'flight.arrivalAirport', 'flight.airline', 'passengers', 'payment']);

        return view('booking.confirmation', compact('booking'));
    }

    public function receipt(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['flight.departureAirport', 'flight.arrivalAirport', 'flight.airline', 'passengers', 'payment']);

        return view('booking.receipt', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Only allow cancellation for pending payments
        if ($booking->isPendingPayment()) {
            // Restore seats
            $booking->flight->increment('available_seats', $booking->passenger_count);

            $booking->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
                'cancellation_reason' => 'User cancelled'
            ]);

            return redirect()->route('dashboard')->with('success', 'Booking cancelled successfully.');
        }

        return back()->with('error', 'Cannot cancel confirmed booking.');
    }


    public function ticket(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['flight.departureAirport', 'flight.arrivalAirport', 'flight.airline', 'passengers', 'payment']);

        return view('booking.ticket', compact('booking'));
    }

    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['flight.departureAirport', 'flight.arrivalAirport', 'flight.airline'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('booking.index', compact('bookings'));
    }
}
