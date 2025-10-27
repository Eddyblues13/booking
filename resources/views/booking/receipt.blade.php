@extends('layouts.app')

@section('title', 'Receipt - ' . $booking->booking_reference)

@section('content')
<div class="receipt-container">
    <div class="container">
        <div class="receipt-card">
            <div class="receipt-header">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Aero Trova</h1>
                        <p class="mb-0">Flight Booking Receipt</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <h2 class="text-primary">RECEIPT</h2>
                        <p class="mb-0"><strong>Date:</strong> {{ $booking->created_at->format('d M Y') }}</p>
                        <p class="mb-0"><strong>Booking Ref:</strong> {{ $booking->booking_reference }}</p>
                    </div>
                </div>
            </div>

            <div class="receipt-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Flight Details</h5>
                        <p class="mb-1"><strong>{{ $booking->flight->departureAirport->city }} to {{
                                $booking->flight->arrivalAirport->city }}</strong></p>
                        <p class="mb-1">{{ $booking->flight->airline->name }} - {{ $booking->flight->flight_number }}
                        </p>
                        <p class="mb-1"><strong>Departure:</strong> {{ $booking->flight->departure_time->format('d M Y,
                            H:i') }}</p>
                        <p class="mb-1"><strong>Arrival:</strong> {{ $booking->flight->arrival_time->format('d M Y,
                            H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Passenger Details</h5>
                        @foreach($booking->passengers as $passenger)
                        <p class="mb-1">{{ $passenger->title }} {{ $passenger->first_name }} {{ $passenger->last_name }}
                        </p>
                        @endforeach
                        <p class="mb-1"><strong>Total Passengers:</strong> {{ $booking->passenger_count }}</p>
                    </div>
                </div>

                <div class="price-breakdown">
                    <h5>Payment Details</h5>
                    <div class="price-row">
                        <span>Base Fare</span>
                        <span>${{ number_format($booking->base_fare, 2) }}</span>
                    </div>
                    <div class="price-row">
                        <span>Taxes & Fees</span>
                        <span>${{ number_format($booking->taxes, 2) }}</span>
                    </div>
                    <div class="price-row">
                        <span>Service Fee</span>
                        <span>${{ number_format($booking->service_fee, 2) }}</span>
                    </div>
                    <div class="price-row price-total">
                        <span>Total Amount</span>
                        <span>${{ number_format($booking->total_amount, 2) }}</span>
                    </div>
                </div>

                @if($booking->payment)
                <div class="payment-info mt-4">
                    <h5>Payment Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $booking->payment_method))
                            }}<br>
                            <strong>Transaction ID:</strong> {{ $booking->payment->transaction_id }}
                        </div>
                        <div class="col-md-6">
                            <strong>Payment Date:</strong> {{ $booking->payment->paid_at->format('d M Y, H:i') }}<br>
                            <strong>Status:</strong> <span class="text-success">Completed</span>
                        </div>
                    </div>
                </div>
                @endif

                <div class="receipt-footer mt-5 pt-4 border-top">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Contact Information</h6>
                            <p class="mb-1">Aero Trova Airlines</p>
                            <p class="mb-1">Email: support@aerotrova.com</p>
                            <p class="mb-1">Phone: +1 (555) 123-4567</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <h6>Thank you for choosing Aero Trova!</h6>
                            <p class="mb-0 text-muted">Safe travels with Aero Trova Airlines</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print me-2"></i>Print Receipt
            </button>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary ms-2">
                <i class="fas fa-tachometer-alt me-2"></i>Back to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    @media print {

        .navbar,
        .footer,
        .btn {
            display: none !important;
        }

        .receipt-container {
            margin: 0;
            padding: 0;
        }

        .receipt-card {
            border: none;
            box-shadow: none;
        }
    }
</style>
@endsection