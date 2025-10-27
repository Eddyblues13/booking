@extends('layouts.app')

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
                    <a class="nav-link text-white fw-medium" href="/explore">Explore</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium active" href="/book">Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="/experience">Experience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="/privilege">Privilege Club</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="/help">Help</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#"><i class="bi bi-search"></i></a>
                </li>
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link text-white d-flex align-items-center dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <li><a class="dropdown-item" href="#">My Bookings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}"><i class="bi bi-person-circle"></i> Log in | Sign up</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="book-hero-section">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title">Find Your Perfect Flight</h1>
                <p class="hero-subtitle">Search and book flights to over 160 destinations worldwide</p>
            </div>
        </div>
    </div>
</section>

<!-- Available Flights Section -->
<section class="flights-section py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="section-title">Available Flights</h2>
                <p class="section-subtitle">Book your next journey with confidence</p>
            </div>
        </div>

        <div class="row">
            @foreach($flights as $flight)
            <div class="col-lg-6 mb-4">
                <div class="flight-card">
                    <div class="flight-header">
                        <div class="airline-info">
                            <div class="airline-logo">
                                @if($flight->airline->logo)
                                <img src="{{ asset('storage/' . $flight->airline->logo) }}" alt="{{ $flight->airline->name }}">
                                @else
                                <div class="airline-initials">{{ substr($flight->airline->name, 0, 2) }}</div>
                                @endif
                            </div>
                            <div class="flight-details">
                                <h5 class="flight-number">{{ $flight->airline->code }}{{ $flight->flight_number }}</h5>
                                <p class="airline-name">{{ $flight->airline->name }}</p>
                            </div>
                        </div>
                        <div class="flight-price">
                            <span class="price">${{ number_format($flight->price, 2) }}</span>
                            <span class="class-badge {{ $flight->class }}">{{ ucfirst($flight->class) }}</span>
                        </div>
                    </div>

                    <div class="flight-route">
                        <div class="route-section">
                            <div class="time">{{ $flight->departure_time->format('H:i') }}</div>
                            <div class="airport">
                                <strong>{{ $flight->departureAirport->code }}</strong>
                                <small>{{ $flight->departureAirport->city }}</small>
                            </div>
                        </div>

                        <div class="route-middle">
                            <div class="duration">{{ floor($flight->duration / 60) }}h {{ $flight->duration % 60 }}m</div>
                            <div class="route-line"></div>
                        </div>

                        <div class="route-section">
                            <div class="time">{{ $flight->arrival_time->format('H:i') }}</div>
                            <div class="airport">
                                <strong>{{ $flight->arrivalAirport->code }}</strong>
                                <small>{{ $flight->arrivalAirport->city }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="flight-footer">
                        <div class="flight-meta">
                            <span class="seats-available">
                                <i class="bi bi-people"></i>
                                {{ $flight->available_seats }} seats left
                            </span>
                            <span class="flight-date">
                                <i class="bi bi-calendar"></i>
                                {{ $flight->departure_time->format('M d, Y') }}
                            </span>
                        </div>
                        
                        @auth
                        <a href="{{ route('booking.create', $flight) }}" class="btn btn-primary btn-book">
                            <i class="bi bi-airplane"></i>
                            Book Now
                        </a>
                        @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-book">
                            <i class="bi bi-person"></i>
                            Login to Book
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($flights->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-airplane display-1 text-muted"></i>
            <h3 class="mt-3">No flights available</h3>
            <p class="text-muted">Please check back later for available flights.</p>
        </div>
        @endif
    </div>
</section>

<!-- Special Offers Section remains the same -->
<section class="offers-section bg-light py-5">
    <!-- ... keep the existing offers section ... -->
</section>

<!-- Footer remains the same -->
<footer class="footer">
    <!-- ... keep the existing footer ... -->
</footer>

<!-- Feedback Button -->
<button class="feedback-btn">
    <i class="bi bi-chat-left-text"></i> Feedback
</button>
@endsection

@push('styles')
<style>
.flight-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    transition: transform 0.2s, box-shadow 0.2s;
    border: 1px solid #e9ecef;
}

.flight-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.flight-header {
    display: flex;
    justify-content: between;
    align-items: start;
    margin-bottom: 1.5rem;
}

.airline-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.airline-logo {
    width: 40px;
    height: 40px;
    background: #f8f9fa;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #5c0931;
}

.airline-logo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.flight-number {
    margin: 0;
    font-size: 1.1rem;
    color: #333;
}

.airline-name {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
}

.flight-price {
    text-align: right;
}

.price {
    display: block;
    font-size: 1.5rem;
    font-weight: bold;
    color: #5c0931;
}

.class-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.class-badge.economy {
    background: #e3f2fd;
    color: #1976d2;
}

.class-badge.business {
    background: #f3e5f5;
    color: #7b1fa2;
}

.class-badge.first {
    background: #fff3e0;
    color: #f57c00;
}

.flight-route {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.route-section {
    text-align: center;
    flex: 1;
}

.route-section .time {
    font-size: 1.25rem;
    font-weight: bold;
    color: #333;
}

.route-section .airport strong {
    display: block;
    font-size: 1.1rem;
    color: #5c0931;
}

.route-section .airport small {
    color: #6c757d;
}

.route-middle {
    flex: 2;
    text-align: center;
    position: relative;
}

.duration {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 0.5rem;
}

.route-line {
    height: 2px;
    background: #dee2e6;
    position: relative;
}

.route-line::before {
    content: '✈';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 0 0.5rem;
    color: #5c0931;
}

.flight-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #e9ecef;
}

.flight-meta {
    display: flex;
    gap: 1rem;
}

.seats-available, .flight-date {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6c757d;
    font-size: 0.9rem;
}

.btn-book {
    padding: 0.5rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
}

@media (max-width: 768px) {
    .flight-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .flight-price {
        text-align: left;
    }
    
    .flight-route {
        flex-direction: column;
        gap: 1rem;
    }
    
    .route-middle {
        order: -1;
    }
    
    .flight-footer {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .flight-meta {
        justify-content: space-between;
    }
}
</style>
@endpush