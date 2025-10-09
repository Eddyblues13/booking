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

<!-- Hero Section -->
<section class="hero-section">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title">Save up to 20%*</h1>
                <p class="hero-subtitle">Secure your travel online now</p>
                <button class="btn btn-outline-light btn-lg rounded-pill px-4 mt-3">Book now</button>
            </div>
        </div>
    </div>
</section>

<!-- Booking Form Section -->
<section class="booking-section">
    <div class="container">
        <div class="booking-card">
            <!-- Tabs - Only one tab now -->
            <ul class="nav nav-tabs booking-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#book-flight" type="button">
                        <i class="bi bi-airplane"></i> Book a Flight
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="book-flight">
                    <form action="{{ route('flights.search') }}" method="GET" id="searchForm">
                        @csrf
                        <!-- Trip Type -->
                        <div class="trip-type">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tripType" id="return" value="return"
                                    checked>
                                <label class="form-check-label" for="return">Return</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tripType" id="oneway" value="oneway">
                                <label class="form-check-label" for="oneway">One way</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tripType" id="multicity"
                                    value="multicity">
                                <label class="form-check-label" for="multicity">Multi-city</label>
                            </div>
                        </div>

                        <!-- Flight Search Form -->
                        <div class="booking-form-grid">
                            <!-- From Input -->
                            <div class="form-group position-relative">
                                <label class="form-label">From</label>
                                <div class="search-input-wrapper">
                                    <input type="text" name="from" class="form-control search-input"
                                        placeholder="City or airport" required value="Doha, Qatar" id="fromInput">
                                    <i class="bi bi-geo-alt search-input-icon"></i>
                                    <div class="airport-dropdown" id="fromDropdown">
                                        <!-- Airports will be populated by JavaScript -->
                                    </div>
                                </div>
                            </div>

                            <!-- To Input -->
                            <div class="form-group position-relative">
                                <label class="form-label">To</label>
                                <div class="search-input-wrapper">
                                    <input type="text" name="to" class="form-control search-input"
                                        placeholder="City or airport" required value="London, UK" id="toInput">
                                    <i class="bi bi-geo-alt search-input-icon"></i>
                                    <div class="airport-dropdown" id="toDropdown">
                                        <!-- Airports will be populated by JavaScript -->
                                    </div>
                                </div>
                            </div>

                            <!-- Swap Button -->
                            <div class="btn-swap-container">
                                <button class="btn-swap" type="button" aria-label="Swap destinations">
                                    <i class="bi bi-arrow-left-right"></i>
                                </button>
                            </div>

                            <!-- Departure Date -->
                            <div class="form-group position-relative">
                                <label class="form-label">Departure</label>
                                <div class="date-input-wrapper">
                                    <input type="text" name="departure_date" class="form-control date-input"
                                        value="{{ date('d M Y', strtotime('+7 days')) }}" readonly
                                        data-bs-toggle="modal" data-bs-target="#departureCalendar">
                                    <i class="bi bi-calendar date-input-icon"></i>
                                </div>
                            </div>

                            <!-- Return Date -->
                            <div class="form-group position-relative return-date-field">
                                <label class="form-label">Return</label>
                                <div class="date-input-wrapper">
                                    <input type="text" name="return_date" class="form-control date-input"
                                        value="{{ date('d M Y', strtotime('+14 days')) }}" readonly
                                        data-bs-toggle="modal" data-bs-target="#returnCalendar">
                                    <i class="bi bi-calendar date-input-icon"></i>
                                </div>
                            </div>

                            <!-- Passengers & Class -->
                            <div class="form-group position-relative">
                                <label class="form-label">Passengers / Class</label>
                                <div class="passenger-input-wrapper">
                                    <input type="text" class="form-control passenger-input" value="1 Passenger, Economy"
                                        readonly data-bs-toggle="modal" data-bs-target="#passengerModal">
                                    <i class="bi bi-chevron-down passenger-input-icon"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="search-btn-container">
                            <button type="submit" class="btn btn-primary search-btn" id="searchButton">
                                <i class="bi bi-search me-2"></i> Search Flights
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Special Offers Section -->
<section class="offers-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Special Offers & Deals</h2>
            <p class="section-subtitle">Exclusive promotions and limited-time offers</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="offer-card">
                    <div class="offer-image">
                        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=400&h=300&fit=crop"
                            alt="Flight Offers">
                        <div class="offer-badge">Save 20%</div>
                    </div>
                    <div class="offer-content">
                        <h3>Europe Sale</h3>
                        <p>Explore European destinations with special fares</p>
                        <div class="offer-price">
                            <span class="current-price">From $499</span>
                            <span class="original-price">$624</span>
                        </div>
                        <a href="#" class="btn btn-outline-primary btn-sm">View Deal</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="offer-card">
                    <div class="offer-image">
                        <img src="https://images.unsplash.com/photo-1549294413-26f195200c16?w=400&h=300&fit=crop"
                            alt="Hotel Offers">
                        <div class="offer-badge">Free Night</div>
                    </div>
                    <div class="offer-content">
                        <h3>Hotel Packages</h3>
                        <p>Get free nights at luxury hotels worldwide</p>
                        <div class="offer-price">
                            <span class="current-price">Book 3, Get 1 Free</span>
                        </div>
                        <a href="#" class="btn btn-outline-primary btn-sm">View Deal</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="offer-card">
                    <div class="offer-image">
                        <img src="https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?w=400&h=300&fit=crop"
                            alt="Business Class">
                        <div class="offer-badge">Upgrade</div>
                    </div>
                    <div class="offer-content">
                        <h3>Business Class</h3>
                        <p>Special upgrade offers for premium travel</p>
                        <div class="offer-price">
                            <span class="current-price">50% Off Upgrade</span>
                        </div>
                        <a href="#" class="btn btn-outline-primary btn-sm">View Deal</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="offer-card">
                    <div class="offer-image">
                        <img src="https://images.unsplash.com/photo-1539635278303-d4002c07eae3?w=400&h=300&fit=crop"
                            alt="Family Packages">
                        <div class="offer-badge">Family Deal</div>
                    </div>
                    <div class="offer-content">
                        <h3>Family Packages</h3>
                        <p>Special rates for family vacations</p>
                        <div class="offer-price">
                            <span class="current-price">Kids Fly Free</span>
                        </div>
                        <a href="#" class="btn btn-outline-primary btn-sm">View Deal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Planning Section -->
<section class="planning-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Start Planning Your Trip</h2>
            <p class="section-subtitle">Thinking of travelling somewhere soon? Here are some options to help you get
                started.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card planning-card h-100">
                    <div class="card-image-container">
                        <img src="https://images.unsplash.com/photo-1518684079-3c830dcef090?w=400&h=250&fit=crop"
                            class="card-img-top" alt="Destinations">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Destinations</h5>
                        <p class="card-text">Discover over 160 destinations worldwide with Qatar Airways.</p>
                        <a href="#" class="btn-link">Explore destinations <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card planning-card h-100">
                    <div class="card-image-container">
                        <img src="https://images.unsplash.com/photo-1556388158-158ea5ccacbd?w=400&h=250&fit=crop"
                            class="card-img-top" alt="Experience">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Experience</h5>
                        <p class="card-text">From our award-winning service to our world-class lounges.</p>
                        <a href="#" class="btn-link">Learn more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card planning-card h-100">
                    <div class="card-image-container">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=250&fit=crop"
                            class="card-img-top" alt="Privilege Club">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Privilege Club</h5>
                        <p class="card-text">Join our loyalty program and earn Qmiles on every flight.</p>
                        <a href="#" class="btn-link">Join now <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Destinations Section -->
<section class="destinations-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Popular Destinations</h2>
            <p class="section-subtitle">Top cities our customers love to visit</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1523059623039-a9ed027e7fad?w=400&h=300&fit=crop"
                            alt="Bangkok">
                        <div class="destination-overlay">
                            <h4>Bangkok</h4>
                            <p>Starting from $450</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1502602898536-47ad22581b52?w=400&h=300&fit=crop"
                            alt="Paris">
                        <div class="destination-overlay">
                            <h4>Paris</h4>
                            <p>Starting from $520</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1485738422979-f5c462d49f74?w=400&h=300&fit=crop"
                            alt="New York">
                        <div class="destination-overlay">
                            <h4>New York</h4>
                            <p>Starting from $680</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1541336032412-2048a678540d?w=400&h=300&fit=crop"
                            alt="Dubai">
                        <div class="destination-overlay">
                            <h4>Dubai</h4>
                            <p>Starting from $380</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="features-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Why Choose Qatar Airways</h2>
            <p class="section-subtitle">Experience world-class service and unmatched comfort</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-award"></i>
                    </div>
                    <h4>Award-Winning</h4>
                    <p>World's Best Business Class 2024 and multiple Skytrax awards</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-globe"></i>
                    </div>
                    <h4>Global Network</h4>
                    <p>Fly to over 160 destinations across 6 continents</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h4>24/7 Support</h4>
                    <p>Round-the-clock customer service and support</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4>Safe & Secure</h4>
                    <p>Industry-leading safety standards and protocols</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Travel Inspiration Section -->
<section class="inspiration-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Travel Inspiration</h2>
            <p class="section-subtitle">Latest travel guides and tips from our experts</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="inspiration-card">
                    <div class="inspiration-image">
                        <img src="https://images.unsplash.com/photo-1526481280693-3bfa7568e0f3?w=400&h=250&fit=crop"
                            alt="Travel Guide">
                    </div>
                    <div class="inspiration-content">
                        <span class="category">Travel Guide</span>
                        <h5>Top 10 Must-Visit Cities in 2024</h5>
                        <p>Discover the most exciting destinations for your next trip around the world.</p>
                        <a href="#" class="btn-link">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="inspiration-card">
                    <div class="inspiration-image">
                        <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=400&h=250&fit=crop"
                            alt="Nature">
                    </div>
                    <div class="inspiration-content">
                        <span class="category">Adventure</span>
                        <h5>Natural Wonders Around the World</h5>
                        <p>Explore breathtaking landscapes and natural beauty across continents.</p>
                        <a href="#" class="btn-link">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="inspiration-card">
                    <div class="inspiration-image">
                        <img src="https://images.unsplash.com/photo-1555400113-7b7d0e4b1c36?w=400&h=250&fit=crop"
                            alt="Culture">
                    </div>
                    <div class="inspiration-content">
                        <span class="category">Culture</span>
                        <h5>Cultural Experiences to Remember</h5>
                        <p>Immerse yourself in diverse cultures and traditions around the globe.</p>
                        <a href="#" class="btn-link">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mobile App Section -->
<section class="app-section py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4">Fly Better with Our Mobile App</h2>
                <p class="lead mb-4">Download the Qatar Airways app for exclusive mobile-only deals, easy booking, and
                    seamless travel management.</p>
                <div class="app-features mb-4">
                    <div class="feature-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Exclusive mobile-only deals</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Easy flight booking & management</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Digital boarding passes</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Real-time flight updates</span>
                    </div>
                </div>
                <div class="app-download-buttons">
                    <a href="#" class="btn btn-light me-3 mb-2">
                        <i class="bi bi-google-play me-2"></i> Google Play
                    </a>
                    <a href="#" class="btn btn-light mb-2">
                        <i class="bi bi-apple me-2"></i> App Store
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=400&h=500&fit=crop"
                    alt="Mobile App" class="img-fluid rounded-3">
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter-section py-5 bg-dark text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mb-3">Stay Updated with Our Latest Offers</h2>
                <p class="mb-4">Subscribe to our newsletter and be the first to know about exclusive deals and
                    promotions.</p>
                <form class="newsletter-form">
                    <div class="input-group input-group-lg">
                        <input type="email" class="form-control" placeholder="Enter your email address" required>
                        <button class="btn btn-primary" type="submit">Subscribe</button>
                    </div>
                    <div class="form-text mt-2">
                        By subscribing, you agree to our Privacy Policy and consent to receive updates.
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer bg-dark text-light py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-3">
                <h5 class="footer-title">Discover</h5>
                <ul class="footer-links list-unstyled">
                    <li><a href="#" class="text-light text-decoration-none">Our story</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Our network</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Qatar Airways Group</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Sponsorships</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Careers</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="footer-title">Travel Info</h5>
                <ul class="footer-links list-unstyled">
                    <li><a href="#" class="text-light text-decoration-none">Travel requirements</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Baggage</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Visas & passports</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Special assistance</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Health & travel advice</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5 class="footer-title">Privilege Club</h5>
                <ul class="footer-links list-unstyled">
                    <li><a href="#" class="text-light text-decoration-none">Join now</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Earn Qmiles</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Spend Qmiles</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Tier benefits</a></li>
                    <li><a href="#" class="text-light text-decoration-none">Partners</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <div class="award-badge text-center">
                    <div class="skytrax-badge">
                        <div class="skytrax-circle bg-light text-dark p-3 rounded-circle">
                            <div>World's Best<br>Business Class<br>2024</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="social-icons mb-4 text-center">
                    <a href="#" class="social-icon text-light mx-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon text-light mx-2"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-icon text-light mx-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon text-light mx-2"><i class="bi bi-youtube"></i></a>
                </div>
                <div class="footer-legal text-center">
                    <p class="text-muted small">© 2024 Qatar Airways. All rights reserved.</p>
                    <div class="d-flex justify-content-center flex-wrap gap-3 mt-2">
                        <a href="#" class="text-light text-decoration-none">Conditions of Carriage</a>
                        <a href="#" class="text-light text-decoration-none">Privacy Policy</a>
                        <a href="#" class="text-light text-decoration-none">Cookie Policy</a>
                        <a href="#" class="text-light text-decoration-none">Site Map</a>
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

<!-- Modals -->
<!-- Calendar Modal for Departure -->
<div class="modal fade calendar-modal" id="departureCalendar" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Departure Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <button class="btn btn-sm btn-outline-secondary prev-month"><i
                                class="bi bi-chevron-left"></i></button>
                        <h6 class="mb-0 current-month">October 2024</h6>
                        <button class="btn btn-sm btn-outline-secondary next-month"><i
                                class="bi bi-chevron-right"></i></button>
                    </div>
                    <div class="calendar-grid">
                        <!-- Calendar days will be populated by JavaScript -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confirmDepartureDate">Select
                    Date</button>
            </div>
        </div>
    </div>
</div>

<!-- Calendar Modal for Return -->
<div class="modal fade calendar-modal" id="returnCalendar" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Return Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <button class="btn btn-sm btn-outline-secondary prev-month"><i
                                class="bi bi-chevron-left"></i></button>
                        <h6 class="mb-0 current-month">October 2024</h6>
                        <button class="btn btn-sm btn-outline-secondary next-month"><i
                                class="bi bi-chevron-right"></i></button>
                    </div>
                    <div class="calendar-grid">
                        <!-- Calendar days will be populated by JavaScript -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="confirmReturnDate">Select
                    Date</button>
            </div>
        </div>
    </div>
</div>

<!-- Passenger Selection Modal -->
<div class="modal fade passenger-modal" id="passengerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Passengers & Travel Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="passenger-selection">
                    <!-- Adults -->
                    <div class="passenger-control">
                        <div>
                            <div class="fw-bold">Adults</div>
                            <small class="text-muted">12 years and above</small>
                        </div>
                        <div class="passenger-counter">
                            <button type="button" class="counter-btn decrease" data-type="adults">-</button>
                            <span class="counter-value" data-type="adults">1</span>
                            <button type="button" class="counter-btn increase" data-type="adults">+</button>
                        </div>
                    </div>

                    <!-- Children -->
                    <div class="passenger-control">
                        <div>
                            <div class="fw-bold">Children</div>
                            <small class="text-muted">2 - 11 years</small>
                        </div>
                        <div class="passenger-counter">
                            <button type="button" class="counter-btn decrease" data-type="children">-</button>
                            <span class="counter-value" data-type="children">0</span>
                            <button type="button" class="counter-btn increase" data-type="children">+</button>
                        </div>
                    </div>

                    <!-- Infants -->
                    <div class="passenger-control">
                        <div>
                            <div class="fw-bold">Infants</div>
                            <small class="text-muted">Under 2 years</small>
                        </div>
                        <div class="passenger-counter">
                            <button type="button" class="counter-btn decrease" data-type="infants">-</button>
                            <span class="counter-value" data-type="infants">0</span>
                            <button type="button" class="counter-btn increase" data-type="infants">+</button>
                        </div>
                    </div>

                    <!-- Travel Class -->
                    <div class="passenger-control">
                        <div>
                            <div class="fw-bold">Travel Class</div>
                            <small class="text-muted">Select your preferred class</small>
                        </div>
                        <select class="form-select class-select" id="travelClass">
                            <option value="economy">Economy Class</option>
                            <option value="premium_economy">Premium Economy</option>
                            <option value="business">Business Class</option>
                            <option value="first">First Class</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                    id="confirmPassengers">Apply</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Comprehensive airport data
    const airports = [
        { code: 'DOH', name: 'Hamad International Airport', city: 'Doha, Qatar' },
        { code: 'DXB', name: 'Dubai International Airport', city: 'Dubai, UAE' },
        { code: 'AUH', name: 'Abu Dhabi International Airport', city: 'Abu Dhabi, UAE' },
        { code: 'LHR', name: 'Heathrow Airport', city: 'London, UK' },
        { code: 'LGW', name: 'Gatwick Airport', city: 'London, UK' },
        { code: 'JFK', name: 'John F. Kennedy Airport', city: 'New York, USA' },
        { code: 'LAX', name: 'Los Angeles International Airport', city: 'Los Angeles, USA' },
        { code: 'CDG', name: 'Charles de Gaulle Airport', city: 'Paris, France' },
        { code: 'FRA', name: 'Frankfurt Airport', city: 'Frankfurt, Germany' },
        { code: 'SIN', name: 'Changi Airport', city: 'Singapore' },
        { code: 'BKK', name: 'Suvarnabhumi Airport', city: 'Bangkok, Thailand' },
        { code: 'SYD', name: 'Sydney Airport', city: 'Sydney, Australia' },
        { code: 'MEL', name: 'Melbourne Airport', city: 'Melbourne, Australia' },
        { code: 'IST', name: 'Istanbul Airport', city: 'Istanbul, Turkey' },
        { code: 'HND', name: 'Haneda Airport', city: 'Tokyo, Japan' },
        { code: 'ICN', name: 'Incheon International Airport', city: 'Seoul, South Korea' },
        { code: 'PEK', name: 'Beijing Capital International Airport', city: 'Beijing, China' },
        { code: 'PVG', name: 'Shanghai Pudong Airport', city: 'Shanghai, China' },
        { code: 'BOM', name: 'Chhatrapati Shivaji Maharaj Airport', city: 'Mumbai, India' },
        { code: 'DEL', name: 'Indira Gandhi International Airport', city: 'Delhi, India' },
        { code: 'MAD', name: 'Adolfo Suárez Madrid–Barajas Airport', city: 'Madrid, Spain' },
        { code: 'FCO', name: 'Leonardo da Vinci–Fiumicino Airport', city: 'Rome, Italy' },
        { code: 'AMS', name: 'Amsterdam Airport Schiphol', city: 'Amsterdam, Netherlands' },
        { code: 'ZRH', name: 'Zurich Airport', city: 'Zurich, Switzerland' },
        { code: 'CPH', name: 'Copenhagen Airport', city: 'Copenhagen, Denmark' }
    ];

    // Current passenger selection
    let passengerSelection = {
        adults: 1,
        children: 0,
        infants: 0,
        class: 'economy'
    };

    // Populate airport dropdowns
    function populateAirportDropdown(dropdownElement) {
        let html = '';
        airports.forEach(airport => {
            html += `
                <div class="airport-item" data-code="${airport.code}" data-name="${airport.name}" data-city="${airport.city}">
                    <div>
                        <div class="airport-name">${airport.name}</div>
                        <div class="airport-city">${airport.city}</div>
                    </div>
                    <span class="airport-code">${airport.code}</span>
                </div>
            `;
        });
        dropdownElement.innerHTML = html;
    }

    // Initialize airport dropdowns
    const fromDropdown = document.getElementById('fromDropdown');
    const toDropdown = document.getElementById('toDropdown');
    
    if (fromDropdown) populateAirportDropdown(fromDropdown);
    if (toDropdown) populateAirportDropdown(toDropdown);

    // Swap from/to locations
    const swapBtn = document.querySelector('.btn-swap');
    if (swapBtn) {
        swapBtn.addEventListener('click', function() {
            const fromInput = document.getElementById('fromInput');
            const toInput = document.getElementById('toInput');
            const temp = fromInput.value;
            fromInput.value = toInput.value;
            toInput.value = temp;
        });
    }

    // Handle trip type changes
    const tripTypeRadios = document.querySelectorAll('input[name="tripType"]');
    const returnDateField = document.querySelector('.return-date-field');
    
    tripTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'oneway') {
                returnDateField.classList.add('oneway');
                returnDateField.querySelector('input').disabled = true;
            } else {
                returnDateField.classList.remove('oneway');
                returnDateField.querySelector('input').disabled = false;
            }
        });
    });

    // Airport search functionality
    const setupAirportSearch = (inputElement, dropdownElement) => {
        inputElement.addEventListener('focus', function() {
            dropdownElement.classList.add('show');
            filterAirports(inputElement, dropdownElement);
        });
        
        inputElement.addEventListener('input', function() {
            filterAirports(inputElement, dropdownElement);
        });
        
        // Select airport from dropdown
        dropdownElement.querySelectorAll('.airport-item').forEach(item => {
            item.addEventListener('click', function() {
                const airportCity = this.getAttribute('data-city');
                const airportName = this.getAttribute('data-name');
                inputElement.value = airportCity;
                dropdownElement.classList.remove('show');
            });
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-input-wrapper')) {
                dropdownElement.classList.remove('show');
            }
        });
    };
    
    function filterAirports(inputElement, dropdownElement) {
        const searchTerm = inputElement.value.toLowerCase();
        const items = dropdownElement.querySelectorAll('.airport-item');
        
        items.forEach(item => {
            const airportName = item.querySelector('.airport-name').textContent.toLowerCase();
            const airportCity = item.querySelector('.airport-city').textContent.toLowerCase();
            const airportCode = item.querySelector('.airport-code').textContent.toLowerCase();
            
            if (airportName.includes(searchTerm) || airportCity.includes(searchTerm) || airportCode.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }
    
    // Initialize airport search for both from and to inputs
    const fromInput = document.getElementById('fromInput');
    const toInput = document.getElementById('toInput');
    
    if (fromInput && fromDropdown) {
        setupAirportSearch(fromInput, fromDropdown);
    }
    
    if (toInput && toDropdown) {
        setupAirportSearch(toInput, toDropdown);
    }

    // Calendar functionality
    let selectedDate = null;
    
    const generateCalendar = (month, year, modalType) => {
        const calendarGrid = document.querySelector(`#${modalType}Calendar .calendar-grid`);
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        
        document.querySelector(`#${modalType}Calendar .current-month`).textContent = `${monthNames[month]} ${year}`;
        
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();
        
        let calendarHTML = '';
        
        // Add day headers
        const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        dayNames.forEach(day => {
            calendarHTML += `<div class="calendar-day text-muted small fw-bold">${day}</div>`;
        });
        
        // Add empty cells for days before the first day of the month
        for (let i = 0; i < firstDay; i++) {
            calendarHTML += '<div class="calendar-day"></div>';
        }
        
        // Add days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const currentDate = new Date(year, month, day);
            const isToday = currentDate.toDateString() === today.toDateString();
            const isPast = currentDate < today;
            const isSelected = selectedDate && currentDate.toDateString() === selectedDate.toDateString();
            
            let dayClass = 'calendar-day';
            if (isToday) dayClass += ' today';
            if (isPast) dayClass += ' disabled';
            if (isSelected) dayClass += ' selected';
            
            calendarHTML += `<div class="${dayClass}" data-day="${day}" data-month="${month}" data-year="${year}">${day}</div>`;
        }
        
        calendarGrid.innerHTML = calendarHTML;
        
        // Add click event to calendar days
        calendarGrid.querySelectorAll('.calendar-day:not(.disabled)').forEach(day => {
            day.addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    // Remove selected class from all days
                    calendarGrid.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
                    // Add selected class to clicked day
                    this.classList.add('selected');
                    
                    const day = this.getAttribute('data-day');
                    const month = this.getAttribute('data-month');
                    const year = this.getAttribute('data-year');
                    selectedDate = new Date(year, month, day);
                }
            });
        });
    };
    
    // Initialize calendars
    const today = new Date();
    generateCalendar(today.getMonth(), today.getFullYear(), 'departure');
    generateCalendar(today.getMonth(), today.getFullYear(), 'return');
    
    // Calendar navigation
    document.querySelectorAll('.prev-month').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.calendar-modal');
            const currentMonthEl = modal.querySelector('.current-month');
            const [monthName, year] = currentMonthEl.textContent.split(' ');
            const monthIndex = new Date(Date.parse(monthName + " 1, " + year)).getMonth();
            let newMonth = monthIndex - 1;
            let newYear = parseInt(year);
            
            if (newMonth < 0) {
                newMonth = 11;
                newYear--;
            }
            
            const modalType = modal.id.replace('Calendar', '');
            generateCalendar(newMonth, newYear, modalType);
        });
    });
    
    document.querySelectorAll('.next-month').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.calendar-modal');
            const currentMonthEl = modal.querySelector('.current-month');
            const [monthName, year] = currentMonthEl.textContent.split(' ');
            const monthIndex = new Date(Date.parse(monthName + " 1, " + year)).getMonth();
            let newMonth = monthIndex + 1;
            let newYear = parseInt(year);
            
            if (newMonth > 11) {
                newMonth = 0;
                newYear++;
            }
            
            const modalType = modal.id.replace('Calendar', '');
            generateCalendar(newMonth, newYear, modalType);
        });
    });
    
    // Confirm date selection
    document.getElementById('confirmDepartureDate')?.addEventListener('click', function() {
        if (selectedDate) {
            const formattedDate = selectedDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
            document.querySelector('input[name="departure_date"]').value = formattedDate;
        }
    });
    
    document.getElementById('confirmReturnDate')?.addEventListener('click', function() {
        if (selectedDate) {
            const formattedDate = selectedDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
            document.querySelector('input[name="return_date"]').value = formattedDate;
        }
    });
    
    // Passenger counter functionality
    document.querySelectorAll('.counter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const valueElement = document.querySelector(`.counter-value[data-type="${type}"]`);
            let value = parseInt(valueElement.textContent);
            
            if (this.classList.contains('increase')) {
                value++;
                // Business rules
                if (type === 'infants' && value > passengerSelection.adults) {
                    value = passengerSelection.adults;
                }
                if (type === 'adults' && value < passengerSelection.infants) {
                    passengerSelection.infants = value;
                    document.querySelector('.counter-value[data-type="infants"]').textContent = value;
                }
            } else if (this.classList.contains('decrease') && value > 0) {
                value--;
                // Business rules
                if (type === 'adults' && value < passengerSelection.infants) {
                    passengerSelection.infants = value;
                    document.querySelector('.counter-value[data-type="infants"]').textContent = value;
                }
            }
            
            valueElement.textContent = value;
            passengerSelection[type] = value;
        });
    });
    
    // Travel class selection
    document.getElementById('travelClass')?.addEventListener('change', function() {
        passengerSelection.class = this.value;
    });
    
    // Confirm passenger selection
    document.getElementById('confirmPassengers')?.addEventListener('click', function() {
        const totalPassengers = passengerSelection.adults + passengerSelection.children;
        const classNames = {
            economy: 'Economy',
            premium_economy: 'Premium Economy',
            business: 'Business',
            first: 'First'
        };
        
        const passengerText = totalPassengers === 1 ? '1 Passenger' : `${totalPassengers} Passengers`;
        const classText = classNames[passengerSelection.class];
        
        document.querySelector('.passenger-input').value = `${passengerText}, ${classText}`;
    });
    
    // Form validation and submission
    const searchForm = document.getElementById('searchForm');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const fromInput = document.getElementById('fromInput');
            const toInput = document.getElementById('toInput');
            
            if (!fromInput.value.trim() || !toInput.value.trim()) {
                alert('Please select both departure and arrival locations.');
                return false;
            }
            
            if (fromInput.value === toInput.value) {
                alert('Departure and arrival airports cannot be the same.');
                return false;
            }
            
            // Show loading state
            const submitButton = this.querySelector('#searchButton');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="bi bi-search me-2"></i> Searching...';
            submitButton.disabled = true;
            submitButton.classList.add('btn-loading');
            
            // Simulate API call
            setTimeout(() => {
                // In a real application, you would submit the form here
                console.log('Form submitted with data:', {
                    from: fromInput.value,
                    to: toInput.value,
                    departure_date: document.querySelector('input[name="departure_date"]').value,
                    return_date: document.querySelector('input[name="return_date"]').value,
                    passengers: passengerSelection
                });
                
                // Reset button state (in real app, this would happen after response)
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
                submitButton.classList.remove('btn-loading');
                
                // Show success message (in real app, redirect to results page)
                alert('Search completed! Redirecting to results...');
            }, 2000);
        });
    }
});
</script>
@endpush