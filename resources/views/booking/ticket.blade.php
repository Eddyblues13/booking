@extends('layouts.app')

@section('title', 'E-Ticket - Aero Trova')

@section('content')
<!-- Navigation Bar -->

<section class="auth-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="auth-card">
                    <!-- Ticket Header -->
                    <div class="text-center mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <img src="https://via.placeholder.com/120x40?text=AERO+TROVA" alt="Aero Trova"
                                class="img-fluid">
                            <div class="text-end">
                                <h4 class="text-success mb-0">CONFIRMED</h4>
                                <small class="text-muted">E-Ticket</small>
                            </div>
                        </div>
                        <h2>Electronic Ticket</h2>
                        <p class="text-muted">Booking Reference: <strong>{{ $booking->booking_reference }}</strong></p>
                    </div>

                    <!-- Flight Information -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Flight Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Flight:</strong> {{ $booking->flight->flight_number }}<br>
                                    <strong>Airline:</strong> {{ $booking->flight->airline->name }}<br>
                                    <strong>Class:</strong> {{ ucfirst($booking->flight->class) }}<br>
                                    <strong>Date:</strong> {{ $booking->flight->departure_time->format('M d, Y') }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Departure:</strong> {{ $booking->flight->departure_time->format('H:i')
                                    }}<br>
                                    <strong>Arrival:</strong> {{ $booking->flight->arrival_time->format('H:i') }}<br>
                                    <strong>Duration:</strong> {{ floor($booking->flight->duration / 60) }}h {{
                                    $booking->flight->duration % 60 }}m
                                </div>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col-5">
                                    <h4>{{ $booking->flight->departureAirport->code }}</h4>
                                    <small class="text-muted">{{ $booking->flight->departureAirport->city }}</small>
                                </div>
                                <div class="col-2">
                                    <i class="bi bi-arrow-right text-primary"></i>
                                </div>
                                <div class="col-5">
                                    <h4>{{ $booking->flight->arrivalAirport->code }}</h4>
                                    <small class="text-muted">{{ $booking->flight->arrivalAirport->city }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Passenger Information -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Passenger Information</h5>
                        </div>
                        <div class="card-body">
                            @foreach($booking->passengers as $passenger)
                            <div class="row mb-3 {{ !$loop->last ? 'border-bottom pb-3' : '' }}">
                                <div class="col-md-6">
                                    <strong>Name:</strong> {{ $passenger->first_name }} {{ $passenger->last_name }}<br>
                                    <strong>Email:</strong> {{ $passenger->email }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Phone:</strong> {{ $passenger->phone }}<br>
                                    <strong>Date of Birth:</strong> {{ $passenger->date_of_birth->format('M d, Y') }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Booking Details -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Booking Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Booking Reference:</strong> {{ $booking->booking_reference }}<br>
                                    <strong>Booking Date:</strong> {{ $booking->created_at->format('M d, Y H:i') }}<br>
                                    <strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($booking->status)
                                        }}</span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Total Amount:</strong> ${{ number_format($booking->total_amount, 2) }}<br>
                                    <strong>Payment Method:</strong> Credit Card<br>
                                    <strong>Payment Status:</strong> <span class="badge bg-success">Paid</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Important Information -->
                    <div class="alert alert-info">
                        <h6><i class="bi bi-info-circle"></i> Important Information</h6>
                        <ul class="mb-0">
                            <li>Please arrive at the airport at least 2 hours before departure</li>
                            <li>Carry a valid government-issued photo ID</li>
                            <li>Check-in online or at the airport counter</li>
                            <li>Baggage allowance: 1 cabin bag + 1 personal item</li>
                        </ul>
                    </div>

                    <div class="text-center mt-4">
                        <button onclick="window.print()" class="btn btn-primary me-2">
                            <i class="bi bi-printer"></i> Print Ticket
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                            <i class="bi bi-house"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @media print {

        .navbar,
        .footer,
        .btn {
            display: none !important;
        }

        .auth-card {
            border: none !important;
            box-shadow: none !important;
        }
    }
</style>
@endsection