@extends('layouts.app')

@section('title', 'Adibiyas Tour - Premium Flight & Tour Booking')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<!-- Hero Section with Animated Background -->
<section class="hero-section">
    <div class="hero-background">
        <div class="floating-elements">
            <div class="floating-plane"></div>
            <div class="floating-cloud"></div>
            <div class="floating-cloud"></div>
        </div>
    </div>

    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    <span class="title-line">Explore The World</span>
                    <span class="title-line highlight">With Confidence</span>
                </h1>
                <p class="hero-subtitle">Book flights to 500+ destinations worldwide. Premium service, competitive
                    prices, unforgettable experiences.</p>

                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">50K+</div>
                        <div class="stat-label">Happy Travelers</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">500+</div>
                        <div class="stat-label">Destinations</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support</div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Booking Form -->
            <div class="booking-form-wrapper">
                <div class="booking-form-card">
                    <div class="form-header">
                        <div class="form-tabs">
                            <button class="form-tab active" data-tab="flight">
                                <i class="fas fa-plane"></i>
                                <span>Flights</span>
                            </button>
                            <button class="form-tab" data-tab="hotel">
                                <i class="fas fa-hotel"></i>
                                <span>Hotels</span>
                            </button>
                            <button class="form-tab" data-tab="tour">
                                <i class="fas fa-umbrella-beach"></i>
                                <span>Tours</span>
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('flights.search') }}" method="GET" class="booking-form active"
                        id="flight-form">
                        <div class="trip-type-selector">
                            <div class="trip-options">
                                <label class="trip-option">
                                    <input type="radio" name="trip_type" value="oneway" checked>
                                    <span class="option-content">
                                        <i class="fas fa-arrow-right"></i>
                                        One Way
                                    </span>
                                </label>
                                <label class="trip-option">
                                    <input type="radio" name="trip_type" value="roundtrip">
                                    <span class="option-content">
                                        <i class="fas fa-exchange-alt"></i>
                                        Round Trip
                                    </span>
                                </label>
                                <label class="trip-option">
                                    <input type="radio" name="trip_type" value="multicity">
                                    <span class="option-content">
                                        <i class="fas fa-route"></i>
                                        Multi City
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group location-group">
                                <label class="form-label">
                                    <i class="fas fa-plane-departure"></i>
                                    From
                                </label>
                                <div class="location-input">
                                    <input type="text" name="from" class="form-control" placeholder="City or airport"
                                        value="Dhaka" required>
                                    <span class="location-code">DAC</span>
                                </div>
                            </div>

                            <button type="button" class="swap-locations" id="swapLocations">
                                <i class="fas fa-exchange-alt"></i>
                            </button>

                            <div class="form-group location-group">
                                <label class="form-label">
                                    <i class="fas fa-plane-arrival"></i>
                                    To
                                </label>
                                <div class="location-input">
                                    <input type="text" name="to" class="form-control" placeholder="City or airport"
                                        value="Doha" required>
                                    <span class="location-code">DOH</span>
                                </div>
                            </div>

                            <div class="form-group date-group">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    Departure
                                </label>
                                <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}"
                                    required>
                            </div>

                            <div class="form-group date-group return-date">
                                <label class="form-label">
                                    <i class="fas fa-calendar-check"></i>
                                    Return
                                </label>
                                <input type="date" name="return_date" class="form-control" disabled>
                            </div>

                            <div class="form-group passenger-group">
                                <label class="form-label">
                                    <i class="fas fa-users"></i>
                                    Travelers
                                </label>
                                <div class="passenger-selector" id="passengerSelector">
                                    <div class="passenger-display">
                                        <span>1 Adult</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                    <div class="passenger-dropdown">
                                        <div class="passenger-type">
                                            <span>Adults</span>
                                            <div class="passenger-controls">
                                                <button type="button" class="passenger-btn minus">-</button>
                                                <span class="passenger-count">1</span>
                                                <button type="button" class="passenger-btn plus">+</button>
                                            </div>
                                        </div>
                                        <div class="passenger-type">
                                            <span>Children</span>
                                            <div class="passenger-controls">
                                                <button type="button" class="passenger-btn minus">-</button>
                                                <span class="passenger-count">0</span>
                                                <button type="button" class="passenger-btn plus">+</button>
                                            </div>
                                        </div>
                                        <div class="passenger-type">
                                            <span>Infants</span>
                                            <div class="passenger-controls">
                                                <button type="button" class="passenger-btn minus">-</button>
                                                <span class="passenger-count">0</span>
                                                <button type="button" class="passenger-btn plus">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="passengers" value="1">
                            </div>

                            <div class="form-group class-group">
                                <label class="form-label">
                                    <i class="fas fa-couch"></i>
                                    Class
                                </label>
                                <select class="form-control" name="class">
                                    <option value="economy">Economy</option>
                                    <option value="premium_economy">Premium Economy</option>
                                    <option value="business">Business</option>
                                    <option value="first">First Class</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                            Search Flights
                            <div class="btn-shine"></div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="scroll-indicator">
        <span>Explore More</span>
        <div class="scroll-arrow"></div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Why Choose Adibiyas Tour?</h2>
            <p class="section-subtitle">Experience travel redefined with our premium services</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Secure Booking</h3>
                <p>Your transactions are protected with bank-level security encryption</p>
                <div class="feature-wave"></div>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>24/7 Support</h3>
                <p>Round-the-clock customer service for all your travel needs</p>
                <div class="feature-wave"></div>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tag"></i>
                </div>
                <h3>Best Prices</h3>
                <p>Guaranteed lowest prices with our price match promise</p>
                <div class="feature-wave"></div>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-plane"></i>
                </div>
                <h3>Global Coverage</h3>
                <p>Access to 500+ airlines and thousands of destinations worldwide</p>
                <div class="feature-wave"></div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Destinations -->
<section class="destinations-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Popular Destinations</h2>
            <p class="section-subtitle">Discover amazing places around the world</p>
        </div>

        <div class="destinations-slider">
            <div class="destination-card">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=400&h=500&fit=crop"
                        alt="Dubai">
                    <div class="destination-overlay">
                        <div class="destination-info">
                            <h3>Dubai</h3>
                            <p>United Arab Emirates</p>
                            <div class="destination-price">From $450</div>
                        </div>
                    </div>
                </div>
                <button class="destination-btn">Explore</button>
            </div>

            <div class="destination-card">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1539037116277-4db20889f2d4?w=400&h=500&fit=crop"
                        alt="London">
                    <div class="destination-overlay">
                        <div class="destination-info">
                            <h3>London</h3>
                            <p>United Kingdom</p>
                            <div class="destination-price">From $380</div>
                        </div>
                    </div>
                </div>
                <button class="destination-btn">Explore</button>
            </div>

            <div class="destination-card">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1546436836-07a91091f160?w=400&h=500&fit=crop"
                        alt="Singapore">
                    <div class="destination-overlay">
                        <div class="destination-info">
                            <h3>Singapore</h3>
                            <p>Singapore</p>
                            <div class="destination-price">From $320</div>
                        </div>
                    </div>
                </div>
                <button class="destination-btn">Explore</button>
            </div>

            <div class="destination-card">
                <div class="destination-image">
                    <img src="https://images.unsplash.com/photo-1502602898536-47ad22581b52?w=400&h=500&fit=crop"
                        alt="Paris">
                    <div class="destination-overlay">
                        <div class="destination-info">
                            <h3>Paris</h3>
                            <p>France</p>
                            <div class="destination-price">From $410</div>
                        </div>
                    </div>
                </div>
                <button class="destination-btn">Explore</button>
            </div>
        </div>
    </div>
</section>

<!-- Special Offers -->
<section class="offers-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Special Offers</h2>
            <p class="section-subtitle">Limited time deals you don't want to miss</p>
        </div>

        <div class="offers-grid">
            <div class="offer-card premium-offer">
                <div class="offer-badge">HOT DEAL</div>
                <div class="offer-content">
                    <h3>Summer Escape</h3>
                    <p>Up to 40% off on beach destinations</p>
                    <div class="offer-price">
                        <span class="old-price">$899</span>
                        <span class="new-price">$539</span>
                    </div>
                    <button class="offer-btn">Book Now</button>
                </div>
                <div class="offer-image">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=300&h=200&fit=crop"
                        alt="Summer Escape">
                </div>
            </div>

            <div class="offer-card">
                <div class="offer-badge">SAVE 25%</div>
                <div class="offer-content">
                    <h3>Business Class</h3>
                    <p>Luxury travel at affordable prices</p>
                    <div class="offer-price">
                        <span class="old-price">$1,200</span>
                        <span class="new-price">$900</span>
                    </div>
                    <button class="offer-btn">Book Now</button>
                </div>
                <div class="offer-image">
                    <img src="https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?w=300&h=200&fit=crop"
                        alt="Business Class">
                </div>
            </div>

            <div class="offer-card">
                <div class="offer-badge">FLASH SALE</div>
                <div class="offer-content">
                    <h3>Weekend Gateway</h3>
                    <p>Quick trips to nearby cities</p>
                    <div class="offer-price">
                        <span class="old-price">$350</span>
                        <span class="new-price">$199</span>
                    </div>
                    <button class="offer-btn">Book Now</button>
                </div>
                <div class="offer-image">
                    <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=300&h=200&fit=crop"
                        alt="Weekend Gateway">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Airlines Section -->
<section class="airlines-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Our Airline Partners</h2>
            <p class="section-subtitle">Fly with the world's best airlines</p>
        </div>

        <div class="airlines-slider">
            @foreach(['Biman Bangladesh', 'Qatar Airways', 'Emirates', 'Singapore Airlines', 'Turkish Airlines', 'Etihad
            Airways'] as $airline)
            <div class="airline-logo">
                <div class="logo-container">
                    <i class="fas fa-plane"></i>
                </div>
                <span>{{ $airline }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Mobile App Section -->
<section class="app-section">
    <div class="container">
        <div class="app-content">
            <div class="app-info">
                <h2>Travel Smarter with Our Mobile App</h2>
                <p>Get real-time flight updates, exclusive mobile-only deals, and manage your bookings on the go.</p>

                <div class="app-features">
                    <div class="app-feature">
                        <i class="fas fa-bell"></i>
                        <span>Real-time Notifications</span>
                    </div>
                    <div class="app-feature">
                        <i class="fas fa-qrcode"></i>
                        <span>Digital Boarding Pass</span>
                    </div>
                    <div class="app-feature">
                        <i class="fas fa-percentage"></i>
                        <span>Exclusive Deals</span>
                    </div>
                </div>

                <div class="app-download">
                    <button class="download-btn">
                        <i class="fab fa-apple"></i>
                        <div>
                            <span>Download on the</span>
                            <strong>App Store</strong>
                        </div>
                    </button>
                    <button class="download-btn">
                        <i class="fab fa-google-play"></i>
                        <div>
                            <span>Get it on</span>
                            <strong>Google Play</strong>
                        </div>
                    </button>
                </div>
            </div>

            <div class="app-preview">
                <div class="phone-mockup">
                    <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=300&h=600&fit=crop"
                        alt="App Preview">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/home.js') }}"></script>
@endpush