<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->payment_status === 'completed') {
            return redirect()->route('booking.confirmation', $booking);
        }

        $booking->load(['flight.departureAirport', 'flight.arrivalAirport', 'flight.airline']);

        return view('payment.show', compact('booking'));
    }

    public function process(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_method' => 'required|string|in:credit_card,debit_card,paypal,bank_transfer',
            'card_number' => 'required_if:payment_method,credit_card,debit_card',
            'expiry_date' => 'required_if:payment_method,credit_card,debit_card',
            'cvv' => 'required_if:payment_method,credit_card,debit_card',
            'card_holder' => 'required_if:payment_method,credit_card,debit_card',
            'paypal_email' => 'required_if:payment_method,paypal',
            'bank_name' => 'required_if:payment_method,bank_transfer',
            'account_number' => 'required_if:payment_method,bank_transfer'
        ]);

        // Process payment (in real app, integrate with payment gateway)
        $paymentSuccess = $this->processPaymentGateway($request, $booking);

        if ($paymentSuccess) {
            // Create payment record
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'amount' => $booking->total_amount,
                'payment_method' => $request->payment_method,
                'transaction_id' => 'TXN_' . uniqid(),
                'status' => 'completed',
                'payment_details' => $this->getPaymentDetails($request)
            ]);

            // Update booking status
            $booking->update([
                'status' => 'confirmed',
                'payment_status' => 'completed',
                'payment_id' => $payment->id
            ]);

            // Send confirmation email
            $this->sendConfirmationEmail($booking);

            return redirect()->route('booking.confirmation', $booking)
                ->with('success', 'Payment processed successfully!');
        } else {
            return back()->withErrors(['payment' => 'Payment failed. Please try again.'])->withInput();
        }
    }

    private function processPaymentGateway($request, $booking)
    {
        // Simulate payment processing
        // In real application, integrate with Stripe, PayPal, etc.
        sleep(2); // Simulate processing time

        // For demo purposes, assume all payments are successful
        return true;
    }

    private function getPaymentDetails($request)
    {
        $details = [
            'payment_method' => $request->payment_method,
            'timestamp' => now()->toDateTimeString()
        ];

        switch ($request->payment_method) {
            case 'credit_card':
            case 'debit_card':
                $details['card_last_four'] = substr($request->card_number, -4);
                $details['card_holder'] = $request->card_holder;
                break;
            case 'paypal':
                $details['paypal_email'] = $request->paypal_email;
                break;
            case 'bank_transfer':
                $details['bank_name'] = $request->bank_name;
                $details['account_last_four'] = substr($request->account_number, -4);
                break;
        }

        return $details;
    }

    private function sendConfirmationEmail($booking)
    {
        // Send email to user
        // Implementation depends on your email service
        // Mail::to($booking->contact_email)->send(new BookingConfirmation($booking));
    }
}
