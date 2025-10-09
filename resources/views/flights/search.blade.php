@extends('layouts.app')

@section('title', 'Search Flights - Aero Trova')

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
                    <a class="nav-link text-white fw-medium" href="/book">Book</a>
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
                {{-- <li class="nav-item dropdown">
                    <a class="nav-link text-white d-flex align-items-center dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown">
                        <img src="https://flagcdn.com/w20/ng.png" alt="Nigeria" class="me-1"> EN
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">English</a></li>
                        <li><a class="dropdown-item" href="#">Arabic</a></li>
                        <li><a class="dropdown-item" href="#">French</a></li>
                    </ul>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link text-white" href="/login"><i class="bi bi-person-circle"></i> Log in | Sign
                        up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Search Results Section -->
<section class="booking-section" style="margin-top: 0; padding-top: 40px;">
    <div class="container">
        <div class="booking-card">
            <div class="tab-content p-4">
                <!-- Search Summary -->
                <div class="mb-4">
                    <h2 class="mb-3">Flight Search Results</h2>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title text-burgundy">Search Criteria</h5>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>From:</strong> {{ request('from') }}
                                </div>
                                <div class="col-md-3">
                                    <strong>To:</strong> {{ request('to') }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Departure:</strong> {{
                                    \Carbon\Carbon::parse(request('departure_date'))->format('M d, Y') }}
                                </div>
                                @if(request('return_date'))
                                <div class="col-md-3">
                                    <strong>Return:</strong> {{ \Carbon\Carbon::parse(request('return_date'))->format('M
                                    d, Y') }}
                                </div>
                                @endif
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <strong>Passengers:</strong>
                                    {{ request('adults', 1) }} Adult(s),
                                    {{ request('children', 0) }} Child(ren),
                                    {{ request('infants', 0) }} Infant(s)
                                </div>
                                <div class="col-md-6">
                                    <strong>Class:</strong> {{ ucfirst(request('class', 'economy')) }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modify Search Button -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a href="{{ route('book') }}" class="btn btn-outline-primary">
                            <i class="bi bi-arrow-left me-2"></i> Modify Search
                        </a>
                        <div class="text-muted">
                            Found <strong>{{ ($departureFlights->count() ?? 0) + ($returnFlights->count() ?? 0)
                                }}</strong> flight(s)
                        </div>
                    </div>
                </div>

                <!-- Flight Results -->
                @if(isset($departureFlights) && $departureFlights->count() > 0)
                <!-- Departure Flights -->
                <div class="mb-5">
                    <h4 class="text-burgundy mb-4">
                        <i class="bi bi-airplane-fill me-2"></i>
                        Departure Flights
                        <small class="text-muted fs-6">({{ request('from') }} to {{ request('to') }})</small>
                    </h4>

                    @foreach($departureFlights as $flight)
                    <div class="card flight-card mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <div class="airline-info">
                                        <h5 class="mb-1">{{ $flight->airline->name ?? 'Qatar Airways' }}</h5>
                                        <small class="text-muted">{{ $flight->flight_number }}</small>
                                        <div class="mt-2">
                                            <span
                                                class="badge bg-{{ $flight->class === 'business' ? 'warning' : ($flight->class === 'first' ? 'dark' : 'primary') }}">
                                                {{ ucfirst($flight->class) }} Class
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="flight-times">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="text-center">
                                                <strong class="h5">{{ $flight->departure_time->format('H:i') }}</strong>
                                                <div class="small text-muted">{{ $flight->departureAirport->code ??
                                                    'DOH' }}</div>
                                                <div class="small">{{ $flight->departureAirport->city ?? request('from')
                                                    }}</div>
                                            </div>
                                            <div class="flex-grow-1 text-center px-3">
                                                <div class="flight-duration">
                                                    <small>{{ $flight->formatted_duration ?? ($flight->duration ?
                                                        floor($flight->duration/60) . 'h ' . ($flight->duration%60) .
                                                        'm' : '2h 30m') }}</small>
                                                    <div class="flight-line"></div>
                                                </div>
                                                <small class="text-muted">Direct</small>
                                            </div>
                                            <div class="text-center">
                                                <strong class="h5">{{ $flight->arrival_time->format('H:i') }}</strong>
                                                <div class="small text-muted">{{ $flight->arrivalAirport->code ?? 'LHR'
                                                    }}</div>
                                                <div class="small">{{ $flight->arrivalAirport->city ?? request('to') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="flight-class text-center">
                                        <div class="small text-muted mt-1">
                                            <i class="bi bi-person-fill"></i>
                                            {{ $flight->available_seats ?? 20 }} seats left
                                        </div>
                                        @if(($flight->available_seats ?? 20) < 10) <div class="small text-danger mt-1">
                                            <i class="bi bi-exclamation-triangle"></i> Almost full
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="flight-price text-center">
                                    <strong class="h4 text-primary">${{ number_format($flight->price ?? 450, 2)
                                        }}</strong>
                                    <div class="small text-muted">per passenger</div>
                                    <form action="{{ route('flights.book', $flight->id ?? 1) }}" method="GET"
                                        class="mt-2">
                                        @csrf
                                        <input type="hidden" name="trip_type"
                                            value="{{ request('tripType', 'return') }}">
                                        <input type="hidden" name="departure_date"
                                            value="{{ request('departure_date') }}">
                                        @if(request('return_date'))
                                        <input type="hidden" name="return_date" value="{{ request('return_date') }}">
                                        @endif
                                        <input type="hidden" name="adults" value="{{ request('adults', 1) }}">
                                        <input type="hidden" name="children" value="{{ request('children', 0) }}">
                                        <input type="hidden" name="infants" value="{{ request('infants', 0) }}">
                                        <input type="hidden" name="class" value="{{ request('class', 'economy') }}">

                                        <button type="submit" class="btn btn-primary btn-sm w-100">
                                            <i class="bi bi-cart-check me-2"></i> Book Now
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Return Flights (if round trip) -->
            @if(request('tripType') === 'return' && isset($returnFlights) && $returnFlights->count() > 0)
            <div class="mb-5">
                <h4 class="text-burgundy mb-4">
                    <i class="bi bi-airplane-fill me-2"></i>
                    Return Flights
                    <small class="text-muted fs-6">({{ request('to') }} to {{ request('from') }})</small>
                </h4>

                @foreach($returnFlights as $flight)
                <div class="card flight-card mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="airline-info">
                                    <h5 class="mb-1">{{ $flight->airline->name ?? 'Qatar Airways' }}</h5>
                                    <small class="text-muted">{{ $flight->flight_number }}</small>
                                    <div class="mt-2">
                                        <span
                                            class="badge bg-{{ $flight->class === 'business' ? 'warning' : ($flight->class === 'first' ? 'dark' : 'primary') }}">
                                            {{ ucfirst($flight->class) }} Class
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="flight-times">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-center">
                                            <strong class="h5">{{ $flight->departure_time->format('H:i') }}</strong>
                                            <div class="small text-muted">{{ $flight->departureAirport->code ?? 'LHR' }}
                                            </div>
                                            <div class="small">{{ $flight->departureAirport->city ?? request('to') }}
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-center px-3">
                                            <div class="flight-duration">
                                                <small>{{ $flight->formatted_duration ?? ($flight->duration ?
                                                    floor($flight->duration/60) . 'h ' . ($flight->duration%60) . 'm' :
                                                    '2h 30m') }}</small>
                                                <div class="flight-line"></div>
                                            </div>
                                            <small class="text-muted">Direct</small>
                                        </div>
                                        <div class="text-center">
                                            <strong class="h5">{{ $flight->arrival_time->format('H:i') }}</strong>
                                            <div class="small text-muted">{{ $flight->arrivalAirport->code ?? 'DOH' }}
                                            </div>
                                            <div class="small">{{ $flight->arrivalAirport->city ?? request('from') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="flight-class text-center">
                                    <div class="small text-muted mt-1">
                                        <i class="bi bi-person-fill"></i>
                                        {{ $flight->available_seats ?? 15 }} seats left
                                    </div>
                                    @if(($flight->available_seats ?? 15) < 10) <div class="small text-danger mt-1">
                                        <i class="bi bi-exclamation-triangle"></i> Almost full
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="flight-price text-center">
                                <strong class="h4 text-primary">${{ number_format($flight->price ?? 450, 2) }}</strong>
                                <div class="small text-muted">per passenger</div>
                                <div class="mt-2">
                                    <small class="text-muted">Select departure flight first</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        @else
        <!-- No Flights Found -->
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="bi bi-search display-1 text-muted mb-3"></i>
                <h3 class="text-burgundy">No flights found</h3>
                <p class="text-muted mb-4">We couldn't find any flights matching your search criteria.</p>

                <!-- Search Tips -->
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-info">
                            <h5>Search Tips:</h5>
                            <ul class="text-start">
                                <li>Try different dates</li>
                                <li>Check nearby airports</li>
                                <li>Be flexible with your travel dates</li>
                                <li>Try one-way search instead of return</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <a href="{{ route('book') }}" class="btn btn-primary btn-lg mt-3">
                    <i class="bi bi-search me-2"></i> Search Again
                </a>
            </div>
        </div>
        @endif
    </div>
    </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-3">
                <h5 class="footer-title">Discover</h5>
                <ul class="footer-links">
                    <li><a href="#">Our story</a></li>
                    <li><a href="#">Our network</a></li>
                    <li><a href="#">Qatar Airways Group</a></li>
                    <li><a href="#">Sponsorships</a></li>
                    <li><a href="#">Careers</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="footer-title">Travel Info</h5>
                <ul class="footer-links">
                    <li><a href="#">Travel requirements</a></li>
                    <li><a href="#">Baggage</a></li>
                    <li><a href="#">Visas & passports</a></li>
                    <li><a href="#">Special assistance</a></li>
                    <li><a href="#">Health & travel advice</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="footer-title">Privilege Club</h5>
                <ul class="footer-links">
                    <li><a href="{{ url('/privilege') }}">Join now</a></li>
                    <li><a href="#">Earn Qmiles</a></li>
                    <li><a href="#">Spend Qmiles</a></li>
                    <li><a href="#">Tier benefits</a></li>
                    <li><a href="#">Partners</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <div class="award-badge text-center">
                    <div class="skytrax-badge">
                        <div class="skytrax-circle">
                            <div>World's Best<br>Business Class<br>2024</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="social-icons mb-4">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                </div>
                <div class="footer-legal text-center">
                    <p class="text-muted small">© 2024 Qatar Airways. All rights reserved.</p>
                    <div class="d-flex justify-content-center flex-wrap gap-3 mt-2">
                        <a href="#">Conditions of Carriage</a>
                        <a href="#">Privacy Policy</a>
                        <a href="#">Cookie Policy</a>
                        <a href="#">Site Map</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Feedback Button -->
<button class="feedback-btn">
    <i class="bi bi-chat-left-text"></i> Feedback
</button>

<style>
    .flight-card {
        transition: transform 0.2s;
        border: 1px solid #e9ecef;
        border-left: 4px solid var(--qatar-burgundy);
    }

    .flight-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border-left: 4px solid var(--qatar-dark);
    }

    .flight-line {
        height: 2px;
        background: var(--qatar-burgundy);
        margin: 5px 0;
        position: relative;
    }

    .flight-line::before {
        content: '➤';
        position: absolute;
        right: -5px;
        top: -8px;
        color: var(--qatar-burgundy);
        font-size: 12px;
    }

    .airline-info h5 {
        color: #2c3e50;
    }

    .text-burgundy {
        color: var(--qatar-burgundy) !important;
    }

    .bg-burgundy {
        background-color: var(--qatar-burgundy) !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .flight-card .card-body {
            padding: 1rem;
        }

        .flight-times {
            margin: 1rem 0;
        }

        .flight-price {
            margin-top: 1rem;
            border-top: 1px solid #e9ecef;
            padding-top: 1rem;
        }
    }
</style>
@endsection