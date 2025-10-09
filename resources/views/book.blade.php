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

<!-- Booking Form Section -->
<section class="booking-section">
    <div class="container">
        <div class="booking-card">
            <!-- Added collapsible header for mobile view -->
            <div class="booking-header d-md-none" data-bs-toggle="collapse" data-bs-target="#bookingForm">
                <h3>
                    <i class="bi bi-airplane text-danger"></i>
                    Book a flight
                </h3>
                <i class="bi bi-chevron-up collapse-icon"></i>
            </div>

            <!-- Tabs - Hidden on mobile -->
            <ul class="nav nav-tabs booking-tabs d-none d-md-flex" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#book-flight" type="button">
                        <i class="bi bi-airplane"></i> Book a flight
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#manage-booking" type="button">
                        <i class="bi bi-ticket-perforated"></i> Manage Booking
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#flight-status" type="button">
                        <i class="bi bi-clock"></i> Flight Status
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <!-- Made form collapsible on mobile -->
            <div class="tab-content p-4 collapse show" id="bookingForm">
                <div class="tab-pane fade show active" id="book-flight">
                    <form action="{{ route('flights.search') }}" method="GET" id="searchForm">
                        @csrf
                        <!-- Trip Type -->
                        <div class="trip-type mb-4">
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
                                    <input type="text" name="from" class="form-control search-input airport-input"
                                        placeholder="City or airport" required id="fromInput" autocomplete="off">
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
                                    <input type="text" name="to" class="form-control search-input airport-input"
                                        placeholder="City or airport" required id="toInput" autocomplete="off">
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

                        <!-- Hidden passenger data -->
                        <input type="hidden" name="adults" value="1">
                        <input type="hidden" name="children" value="0">
                        <input type="hidden" name="infants" value="0">
                        <input type="hidden" name="class" value="economy">

                        <!-- Promo Code and Search Button -->
                        <div class="search-btn-container mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="#" class="promo-link text-decoration-none">
                                    <i class="bi bi-tag me-1"></i> Add promo code
                                </a>
                                <button type="submit" class="btn btn-primary search-btn" id="searchButton">
                                    <i class="bi bi-search me-2"></i> Search Flights
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="manage-booking">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="manage-booking-form">
                                <h4 class="mb-4">Manage Your Booking</h4>
                                <form>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Booking Reference</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter your booking reference" required>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="Enter your last name" required>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 btn-lg">Retrieve Booking</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="flight-status">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="flight-status-form">
                                <h4 class="mb-4">Check Flight Status</h4>
                                <form>
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Flight Number</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="e.g., QR123" required>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control form-control-lg" required>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100 btn-lg">Check Status</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Special Offers -->
<section class="offers-section bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Special Offers</h2>
            <p class="section-subtitle">Don't miss these exclusive deals</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="offer-card">
                    <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?w=600&q=80"
                        alt="Flight Offers">
                    <div class="offer-content">
                        <h3>Flight offers</h3>
                        <p>Save up to 20% on selected destinations</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="offer-card">
                    <img src="https://images.unsplash.com/photo-1549294413-26f195200c16?w=600&q=80" alt="Hotel Offers">
                    <div class="offer-content">
                        <h3>Hotel offers</h3>
                        <p>Get exclusive discounts on hotel bookings</p>
                    </div>
                </div>
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
    // Current passenger selection
    let passengerSelection = {
        adults: 1,
        children: 0,
        infants: 0,
        class: 'economy'
    };

    // Airport search functionality
    const setupAirportSearch = (inputElement, dropdownElement) => {
        let debounceTimer;
        
        inputElement.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();
            
            if (query.length < 2) {
                dropdownElement.classList.remove('show');
                return;
            }
            
            debounceTimer = setTimeout(() => {
                searchAirports(query, dropdownElement);
            }, 300);
        });
        
        inputElement.addEventListener('focus', function() {
            const query = this.value.trim();
            if (query.length >= 2) {
                searchAirports(query, dropdownElement);
            }
        });
        
        // Select airport from dropdown
        dropdownElement.addEventListener('click', function(e) {
            if (e.target.closest('.airport-item')) {
                const item = e.target.closest('.airport-item');
                const airportCode = item.getAttribute('data-code');
                const airportName = item.getAttribute('data-name');
                const airportCity = item.getAttribute('data-city');
                const airportCountry = item.getAttribute('data-country');
                
                inputElement.value = `${airportCity}, ${airportCountry} (${airportCode})`;
                dropdownElement.classList.remove('show');
            }
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-input-wrapper')) {
                dropdownElement.classList.remove('show');
            }
        });
    };
    
    async function searchAirports(query, dropdownElement) {
        try {
            const response = await fetch(`/api/airports?query=${encodeURIComponent(query)}`);
            const airports = await response.json();
            
            let html = '';
            if (airports.length > 0) {
                airports.forEach(airport => {
                    html += `
                        <div class="airport-item" data-code="${airport.code}" data-name="${airport.name}" data-city="${airport.city}" data-country="${airport.country}">
                            <div>
                                <div class="airport-name">${airport.name}</div>
                                <div class="airport-city">${airport.city}, ${airport.country}</div>
                            </div>
                            <span class="airport-code">${airport.code}</span>
                        </div>
                    `;
                });
            } else {
                html = '<div class="airport-item no-results">No airports found</div>';
            }
            
            dropdownElement.innerHTML = html;
            dropdownElement.classList.add('show');
        } catch (error) {
            console.error('Error fetching airports:', error);
            dropdownElement.innerHTML = '<div class="airport-item no-results">Error loading airports</div>';
            dropdownElement.classList.add('show');
        }
    }
    
    // Initialize airport search for both from and to inputs
    const fromInput = document.getElementById('fromInput');
    const toInput = document.getElementById('toInput');
    const fromDropdown = document.getElementById('fromDropdown');
    const toDropdown = document.getElementById('toDropdown');
    
    if (fromInput && fromDropdown) {
        setupAirportSearch(fromInput, fromDropdown);
    }
    
    if (toInput && toDropdown) {
        setupAirportSearch(toInput, toDropdown);
    }

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

    // Calendar functionality
    let selectedDate = null;
    let currentModalType = null;
    
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
            const isPast = currentDate < today.setHours(0, 0, 0, 0);
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
                    currentModalType = modalType;
                }
            });
        });
    };
    
    // Initialize calendars when modals are shown
    document.getElementById('departureCalendar')?.addEventListener('show.bs.modal', function() {
        const today = new Date();
        generateCalendar(today.getMonth(), today.getFullYear(), 'departure');
    });
    
    document.getElementById('returnCalendar')?.addEventListener('show.bs.modal', function() {
        const today = new Date();
        generateCalendar(today.getMonth(), today.getFullYear(), 'return');
    });
    
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
            
            // Update hidden inputs
            document.querySelector('input[name="adults"]').value = passengerSelection.adults;
            document.querySelector('input[name="children"]').value = passengerSelection.children;
            document.querySelector('input[name="infants"]').value = passengerSelection.infants;
        });
    });
    
    // Travel class selection
    document.getElementById('travelClass')?.addEventListener('change', function() {
        passengerSelection.class = this.value;
        document.querySelector('input[name="class"]').value = this.value;
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
            
            // Submit the form
            this.submit();
        });
    }

    // Mobile collapsible functionality
    const bookingHeader = document.querySelector('.booking-header');
    if (bookingHeader) {
        bookingHeader.addEventListener('click', function() {
            const icon = this.querySelector('.collapse-icon');
            icon.classList.toggle('collapsed');
        });
    }
});
</script>
@endpush