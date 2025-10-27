@extends('layouts.app')

@section('title', 'Dashboard - Aero Trova')

@section('content')
<!-- Top Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark transparent-nav">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <svg width="140" height="50" viewBox="0 0 140 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <text x="10" y="30" font-family="Arial, sans-serif" font-size="20" font-weight="bold"
                    fill="#ffffff">AERO</text>
                <text x="10" y="45" font-family="Arial, sans-serif" font-size="12" fill="#ffffff">TROVA</text>
                <circle cx="120" cy="25" r="15" fill="#ffffff" />
                <path d="M115 25 L120 20 L125 25 L120 30 Z" fill="#5c0931" />
            </svg>
            <span class="oneworld-badge ms-2">oneworld</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="{{ route('explore') }}">Explore</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="{{ route('book') }}">Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="{{ route('experience') }}">Experience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="{{ route('privilege') }}">Privilege Club</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="{{ route('help') }}">Help</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white d-flex align-items-center dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->first_name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item active" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="#">My Bookings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Dashboard Section -->
<section class="auth-section py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="auth-card">
                    <div class="text-center mb-4">
                        <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                            style="width: 80px; height: 80px;">
                            <i class="bi bi-person-fill text-white" style="font-size: 2rem;"></i>
                        </div>
                        <h5 class="mb-1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h5>
                        <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                        @if(Auth::user()->phone)
                        <p class="text-muted small">{{ Auth::user()->phone }}</p>
                        @endif
                    </div>
                    <nav class="nav flex-column">
                        <a class="nav-link active" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2 me-2"></i> Dashboard
                        </a>
                        <a class="nav-link" href="#">
                            <i class="bi bi-ticket-perforated me-2"></i> My Bookings
                        </a>
                        <a class="nav-link" href="#">
                            <i class="bi bi-person me-2"></i> Profile
                        </a>
                        <a class="nav-link" href="#">
                            <i class="bi bi-credit-card me-2"></i> Payment Methods
                        </a>
                        <a class="nav-link" href="#">
                            <i class="bi bi-gear me-2"></i> Settings
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="auth-card text-center">
                            <h3 class="text-primary">{{ $stats['total_bookings'] }}</h3>
                            <p class="text-muted mb-0">Total Bookings</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="auth-card text-center">
                            <h3 class="text-success">{{ $stats['upcoming_trips'] }}</h3>
                            <p class="text-muted mb-0">Upcoming Trips</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="auth-card text-center">
                            <h3 class="text-warning">{{ $stats['pending_bookings'] }}</h3>
                            <p class="text-muted mb-0">Pending</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="auth-card text-center">
                            <h3 class="text-info">${{ number_format($stats['total_spent'], 2) }}</h3>
                            <p class="text-muted mb-0">Total Spent</p>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                <div class="auth-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">Recent Bookings</h4>
                        <a href="#" class="btn btn-outline-primary btn-sm">View All</a>
                    </div>

                    @if($bookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Booking Ref</th>
                                    <th>Flight</th>
                                    <th>Airline</th>
                                    <th>Date</th>
                                    <th>Passengers</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Payment Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                <tr>
                                    <td><strong>{{ $booking->booking_reference }}</strong></td>
                                    <td>
                                        @if($booking->flight && $booking->flight->departureAirport &&
                                        $booking->flight->arrivalAirport)
                                        {{ $booking->flight->departureAirport->code }} →
                                        {{ $booking->flight->arrivalAirport->code }}
                                        @else
                                        <span class="text-muted">Flight details unavailable</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->flight && $booking->flight->airline)
                                        {{ $booking->flight->airline->name }}
                                        @else
                                        <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($booking->flight)
                                        {{ $booking->flight->departure_time->format('M d, Y') }}
                                        @else
                                        <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $booking->passenger_count }}</td>
                                    <td>${{ number_format($booking->total_amount, 2) }}</td>
                                    <td>
                                        @php
                                        $statusClass = match($booking->status) {
                                        'confirmed' => 'success',
                                        'pending' => 'warning',
                                        'cancelled' => 'danger',
                                        default => 'secondary'
                                        };
                                        @endphp
                                        <span class="badge bg-{{ $statusClass }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                        $paymentStatusClass = match($booking->payment_status) {
                                        'completed' => 'success',
                                        'pending' => 'warning',
                                        'failed' => 'danger',
                                        default => 'secondary'
                                        };
                                        @endphp
                                        <span class="badge bg-{{ $paymentStatusClass }}">
                                            {{ ucfirst($booking->payment_status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($booking->flight)
                                            <a href="{{ route('booking.ticket', $booking) }}"
                                                class="btn btn-sm btn-outline-primary">Ticket</a>
                                            <a href="{{ route('booking.receipt', $booking) }}"
                                                class="btn btn-sm btn-outline-secondary">Receipt</a>
                                            @else
                                            <button class="btn btn-sm btn-outline-secondary" disabled>No Flight</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-4">
                        <i class="bi bi-ticket-perforated display-1 text-muted"></i>
                        <h4 class="mt-3">No bookings yet</h4>
                        <p class="text-muted">Start your journey by booking your first flight!</p>
                        <a href="{{ route('book') }}" class="btn btn-primary">Book a Flight</a>
                    </div>
                    @endif
                </div>

                <!-- Quick Actions -->
                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="auth-card text-center h-100">
                            <i class="bi bi-airplane display-4 text-primary mb-3"></i>
                            <h5>Book a Flight</h5>
                            <p class="text-muted">Find and book your next flight</p>
                            <a href="{{ route('book') }}" class="btn btn-primary">Book Now</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="auth-card text-center h-100">
                            <i class="bi bi-search display-4 text-success mb-3"></i>
                            <h5>Manage Booking</h5>
                            <p class="text-muted">View or modify existing bookings</p>
                            <a href="#" class="btn btn-outline-success">Manage</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="auth-card text-center h-100">
                            <i class="bi bi-person display-4 text-info mb-3"></i>
                            <h5>Update Profile</h5>
                            <p class="text-muted">Keep your information current</p>
                            <a href="#" class="btn btn-outline-info">Update</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <!-- Footer content same as before -->
</footer>
@endsection