@extends('layouts.app')

@section('title', 'Booking Confirmation - Adibiyas Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/confirmation.css') }}">
@endpush

@section('content')
<div class="confirmation-container">
    <div class="container">
        <!-- Success Header -->
        <div class="success-header">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1>Booking Confirmed!</h1>
            <p>Your flight has been successfully booked. Your e-ticket has been sent to your email.</p>
            <div class="booking-reference">
                <strong>Booking Reference:</strong>
                <span class="ref-number">{{ $booking->booking_reference }}</span>
            </div>
        </div>

        <div class="confirmation-content">
            <div class="confirmation-main">
                <!-- Quick Actions -->
                <div class="quick-actions-card">
                    <h3>Next Steps</h3>
                    <div class="action-buttons">
                        <a href="{{ route('booking.ticket', $booking) }}" class="action-btn primary">
                            <i class="fas fa-ticket-alt"></i>
                            View E-Ticket
                        </a>
                        <a href="{{ route('booking.receipt', $booking) }}" class="action-btn secondary">
                            <i class="fas fa-receipt"></i>
                            Download Receipt
                        </a>
                        <a href="#" class="action-btn secondary">
                            <i class="fas fa-envelope"></i>
                            Resend Email
                        </a>
                        <a href="{{ route('dashboard') }}" class="action-btn secondary">
                            <i class="fas fa-user-circle"></i>
                            My Bookings
                        </a>
                    </div>
                </div>

                <!-- Flight Details -->
                <div class="details-card">
                    <div class="card-header">
                        <h2><i class="fas fa-plane"></i> Flight Details</h2>
                    </div>
                    <div class="flight-details-confirm">
                        <div class="airline-section">
                            <div class="airline-info">
                                <img src="{{ $booking->flight->airline->logo }}"
                                    alt="{{ $booking->flight->airline->name }}">
                                <div>
                                    <h4>{{ $booking->flight->airline->name }}</h4>
                                    <p>Flight {{ $booking->flight->flight_number }} • {{ $booking->flight->aircraft_type
                                        }}</p>
                                </div>
                            </div>
                            <div class="flight-status confirmed">
                                <i class="fas fa-check"></i>
                                Confirmed
                            </div>
                        </div>

                        <div class="route-details-confirm">
                            <div class="route-segment">
                                <div class="time">{{ $booking->flight->departure_time->format('h:i A') }}</div>
                                <div class="date">{{ $booking->flight->departure_time->format('D, M d, Y') }}</div>
                                <div class="airport">
                                    <strong>{{ $booking->flight->departureAirport->code ?? 'N/A' }}</strong>
                                    {{ $booking->flight->departureAirport->name ?? 'Airport information not available'
                                    }}
                                </div>
                                <div class="city">{{ $booking->flight->departureAirport->city ?? 'N/A' }}, {{
                                    $booking->flight->departureAirport->country ?? 'N/A' }}</div>
                            </div>

                            <div class="route-middle">
                                <div class="duration">
                                    <i class="fas fa-plane"></i>
                                    {{ floor($booking->flight->duration / 60) }}h {{ $booking->flight->duration % 60 }}m
                                </div>
                                <div class="stops">Non-stop</div>
                            </div>

                            <div class="route-segment">
                                <div class="time">{{ $booking->flight->arrival_time->format('h:i A') }}</div>
                                <div class="date">{{ $booking->flight->arrival_time->format('D, M d, Y') }}</div>
                                <div class="airport">
                                    <strong>{{ $booking->flight->arrivalAirport->code ?? 'N/A' }}</strong>
                                    {{ $booking->flight->arrivalAirport->name ?? 'Airport information not available' }}
                                </div>
                                <div class="city">{{ $booking->flight->arrivalAirport->city ?? 'N/A' }}, {{
                                    $booking->flight->arrivalAirport->country ?? 'N/A' }}</div>
                            </div>
                        </div>

                        <div class="flight-features-confirm">
                            <div class="feature">
                                <i class="fas fa-suitcase"></i>
                                <span>Baggage: {{ $booking->flight->baggage_allowance }}</span>
                            </div>
                            <div class="feature">
                                <i class="fas fa-utensils"></i>
                                <span>Meals: {{ $booking->flight->meals ? 'Included' : 'Available for purchase'
                                    }}</span>
                            </div>
                            <div class="feature">
                                <i class="fas fa-wifi"></i>
                                <span>WiFi: {{ $booking->flight->wifi ? 'Available' : 'Not available' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Passengers Details -->
                <div class="details-card">
                    <div class="card-header">
                        <h2><i class="fas fa-users"></i> Passenger Details</h2>
                    </div>
                    <div class="passengers-confirm">
                        @foreach($booking->passengers as $passenger)
                        <div class="passenger-card">
                            <div class="passenger-header">
                                <h4>Passenger {{ $loop->iteration }}</h4>
                                <span class="seat-number">Seat {{ $passenger->seat_number }}</span>
                            </div>
                            <div class="passenger-details">
                                <div class="detail-row">
                                    <span class="label">Name:</span>
                                    <span class="value">{{ $passenger->title }} {{ $passenger->first_name }} {{
                                        $passenger->last_name }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="label">Date of Birth:</span>
                                    <span class="value">{{ \Carbon\Carbon::parse($passenger->date_of_birth)->format('M
                                        d, Y') }}</span>
                                </div>
                                <div class="detail-row">
                                    <span class="label">Passport:</span>
                                    <span class="value">{{ $passenger->passport_number }} (Expires: {{
                                        \Carbon\Carbon::parse($passenger->passport_expiry)->format('M d, Y') }})</span>
                                </div>
                                <div class="detail-row">
                                    <span class="label">Nationality:</span>
                                    <span class="value">{{ $passenger->nationality }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Important Information -->
                <div class="details-card">
                    <div class="card-header">
                        <h2><i class="fas fa-info-circle"></i> Important Information</h2>
                    </div>
                    <div class="important-info">
                        <div class="info-item">
                            <i class="fas fa-passport"></i>
                            <div>
                                <h4>Travel Documents</h4>
                                <p>Ensure you have a valid passport and any required visas for your destination.</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>Check-in Time</h4>
                                <p>Check-in opens 3 hours before departure and closes 45 minutes before departure.</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-suitcase"></i>
                            <div>
                                <h4>Baggage Policy</h4>
                                <p>Each passenger is allowed {{ $booking->flight->baggage_allowance }} checked baggage
                                    and one cabin bag.</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-shield-alt"></i>
                            <div>
                                <h4>Travel Insurance</h4>
                                <p>Consider purchasing travel insurance for unexpected events during your trip.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Sidebar -->
            <div class="confirmation-sidebar">
                <!-- Booking Summary -->
                <div class="summary-card">
                    <h3>Booking Summary</h3>
                    <div class="summary-details">
                        <div class="summary-item">
                            <span>Booking Reference</span>
                            <strong>{{ $booking->booking_reference }}</strong>
                        </div>
                        <div class="summary-item">
                            <span>Booking Date</span>
                            <strong>{{ $booking->created_at->format('M d, Y - h:i A') }}</strong>
                        </div>
                        <div class="summary-item">
                            <span>Total Passengers</span>
                            <strong>{{ $booking->passenger_count }}</strong>
                        </div>
                        <div class="summary-item">
                            <span>Payment Method</span>
                            <strong>
                                @if($booking->payment)
                                {{ ucfirst(str_replace('_', ' ', $booking->payment->payment_method)) }}
                                @else
                                Not specified
                                @endif
                            </strong>
                        </div>
                        <div class="summary-item total">
                            <span>Total Paid</span>
                            <strong class="total-amount">${{ number_format($booking->total_amount, 2) }}</strong>
                        </div>
                    </div>
                </div>

                <!-- Support Card -->
                <div class="support-card">
                    <h4><i class="fas fa-headset"></i> Need Help?</h4>
                    <p>Our support team is available 24/7 to assist you.</p>
                    <div class="support-contacts">
                        <a href="tel:+15551234567" class="support-link">
                            <i class="fas fa-phone"></i>
                            +1 (555) 123-4567
                        </a>
                        <a href="mailto:support@adibiyastour.com" class="support-link">
                            <i class="fas fa-envelope"></i>
                            support@adibiyastour.com
                        </a>
                        <a href="https://wa.me/15551234567" class="support-link">
                            <i class="fab fa-whatsapp"></i>
                            WhatsApp Support
                        </a>
                    </div>
                </div>

                <!-- Download Card -->
                <div class="download-card">
                    <h4><i class="fas fa-download"></i> Download</h4>
                    <p>Save your travel documents for easy access.</p>
                    <div class="download-buttons">
                        <a href="{{ route('booking.ticket', $booking) }}" class="download-btn" target="_blank">
                            <i class="fas fa-ticket-alt"></i>
                            E-Ticket
                        </a>
                        <a href="{{ route('booking.receipt', $booking) }}" class="download-btn" target="_blank">
                            <i class="fas fa-receipt"></i>
                            Receipt
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Next Trip Section -->
        <div class="next-trip-section">
            <h2>Ready for Your Next Adventure?</h2>
            <p>Explore more destinations and great deals for your future travels.</p>
            <div class="trip-actions">
                <a href="{{ route('home') }}" class="btn-primary">
                    <i class="fas fa-search"></i>
                    Search More Flights
                </a>

            </div>
        </div>
    </div>
</div>
@endsection