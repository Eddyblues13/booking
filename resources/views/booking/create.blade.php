@extends('layouts.app')

@section('title', 'Book Flight - Aero Trova')

@section('content')
<!-- Navigation Bar -->

<section class="auth-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="auth-card">
                    <div class="text-center mb-4">
                        <h2>Complete Your Booking</h2>
                        <p class="text-muted">Flight: {{ $flight->flight_number }}</p>
                    </div>

                    <!-- Flight Summary -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5>{{ $flight->departureAirport->city }} to {{ $flight->arrivalAirport->city }}
                                    </h5>
                                    <div class="row">
                                        <div class="col-4">
                                            <strong>{{ $flight->departure_time->format('H:i') }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $flight->departureAirport->code }}</small>
                                        </div>
                                        <div class="col-4 text-center">
                                            <small class="text-muted">{{ floor($flight->duration / 60) }}h {{
                                                $flight->duration % 60 }}m</small>
                                            <div class="flight-line-horizontal"></div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <strong>{{ $flight->arrival_time->format('H:i') }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $flight->arrivalAirport->code }}</small>
                                        </div>
                                    </div>
                                    <small class="text-muted">{{ $flight->airline->name }} • {{ ucfirst($flight->class)
                                        }} Class</small>
                                </div>
                                <div class="col-md-4 text-end">
                                    <h4 class="text-primary">${{ number_format($flight->price, 2) }}</h4>
                                    <small class="text-muted">per passenger</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('booking.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="flight_id" value="{{ $flight->id }}">

                        <!-- Passenger Information -->
                        <div class="mb-4">
                            <h4 class="mb-3">Passenger Information</h4>
                            <div class="passenger-form">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" name="passengers[0][first_name]"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" name="passengers[0][last_name]"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" name="passengers[0][date_of_birth]"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="passengers[0][email]" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone</label>
                                        <input type="tel" class="form-control" name="passengers[0][phone]" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="mb-4">
                            <h4 class="mb-3">Contact Information</h4>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="contact_email"
                                        value="{{ Auth::user()->email }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" name="contact_phone"
                                        value="{{ Auth::user()->phone }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="mb-4">
                            <h4 class="mb-3">Payment Information</h4>
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Card Number</label>
                                    <input type="text" class="form-control" placeholder="1234 5678 9012 3456" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Expiry Date</label>
                                    <input type="text" class="form-control" placeholder="MM/YY" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">CVV</label>
                                    <input type="text" class="form-control" placeholder="123" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Cardholder Name</label>
                                    <input type="text" class="form-control" placeholder="John Doe" required>
                                </div>
                            </div>
                        </div>

                        <!-- Price Summary -->
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Price Summary</h5>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Base Fare (1 passenger)</span>
                                    <span>${{ number_format($flight->price, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Taxes & Fees</span>
                                    <span>${{ number_format($flight->price * 0.15, 2) }}</span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <strong>Total Amount</strong>
                                    <strong class="text-primary">${{ number_format($flight->price * 1.15, 2) }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Complete Booking & Pay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection