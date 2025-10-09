@extends('layouts.app')

@section('title', 'Search Results - Adibiyas Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/search-results.css') }}">
@endpush

@section('content')
<div class="search-results-container">
    <!-- Search Header -->
    <div class="search-header">
        <div class="container">
            <div class="search-summary-card">
                <div class="search-info">
                    <h1>Flights from {{ request('from', 'Dhaka') }} to {{ request('to', 'Doha') }}</h1>
                    <div class="search-details">
                        <div class="detail-item">
                            <i class="fas fa-calendar"></i>
                            <span>{{ \Carbon\Carbon::parse(request('date'))->format('M d, Y') }}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-users"></i>
                            <span>{{ request('passengers', 1) }} Passenger(s)</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-couch"></i>
                            <span>{{ ucfirst(request('class', 'economy')) }} Class</span>
                        </div>
                    </div>
                </div>
                <div class="search-actions">
                    <button class="btn-filter" id="filterToggle">
                        <i class="fas fa-sliders-h"></i>
                        Filters
                    </button>
                    <button class="btn-sort" id="sortToggle">
                        <i class="fas fa-sort"></i>
                        Sort
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="results-layout">
            <!-- Filters Sidebar -->
            <aside class="filters-sidebar" id="filtersSidebar">
                <div class="filter-section">
                    <h3>Price Range</h3>
                    <div class="price-filter">
                        <div class="price-inputs">
                            <input type="number" id="minPrice" placeholder="Min" value="0">
                            <span>-</span>
                            <input type="number" id="maxPrice" placeholder="Max" value="5000">
                        </div>
                        <div class="price-slider">
                            <input type="range" id="priceRange" min="0" max="5000" value="5000">
                        </div>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Stops</h3>
                    <div class="stop-filters">
                        <label class="filter-option">
                            <input type="checkbox" name="stops" value="0" checked>
                            <span class="checkmark"></span>
                            Non-stop
                        </label>
                        <label class="filter-option">
                            <input type="checkbox" name="stops" value="1">
                            <span class="checkmark"></span>
                            1 Stop
                        </label>
                        <label class="filter-option">
                            <input type="checkbox" name="stops" value="2">
                            <span class="checkmark"></span>
                            2+ Stops
                        </label>
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Airlines</h3>
                    <div class="airline-filters">
                        @foreach($airlines as $airline)
                        <label class="filter-option">
                            <input type="checkbox" name="airlines" value="{{ $airline->id }}">
                            <span class="checkmark"></span>
                            {{ $airline->name }}
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="filter-section">
                    <h3>Departure Time</h3>
                    <div class="time-filters">
                        <label class="filter-option">
                            <input type="checkbox" name="departure_time" value="morning">
                            <span class="checkmark"></span>
                            Morning (6AM - 12PM)
                        </label>
                        <label class="filter-option">
                            <input type="checkbox" name="departure_time" value="afternoon">
                            <span class="checkmark"></span>
                            Afternoon (12PM - 6PM)
                        </label>
                        <label class="filter-option">
                            <input type="checkbox" name="departure_time" value="evening">
                            <span class="checkmark"></span>
                            Evening (6PM - 12AM)
                        </label>
                    </div>
                </div>

                <button class="btn-apply-filters">Apply Filters</button>
            </aside>

            <!-- Results Main Content -->
            <main class="results-main">
                <!-- Results Header -->
                <div class="results-header">
                    <div class="results-count">
                        <h2>{{ $flights->count() }} Flights Found</h2>
                        <p>Prices include taxes and fees</p>
                    </div>
                    <div class="results-sort">
                        <select id="sortSelect" class="sort-select">
                            <option value="price_asc">Price: Low to High</option>
                            <option value="price_desc">Price: High to Low</option>
                            <option value="duration_asc">Duration: Shortest</option>
                            <option value="departure_asc">Departure: Earliest</option>
                            <option value="departure_desc">Departure: Latest</option>
                        </select>
                    </div>
                </div>

                <!-- Flight Results -->
                <div class="flight-results">
                    @forelse($flights as $flight)
                    <div class="flight-card" data-price="{{ $flight->price }}" data-duration="{{ $flight->duration }}"
                        data-departure="{{ $flight->departure_time->timestamp }}"
                        data-airline="{{ $flight->airline->id }}" data-stops="{{ $flight->stops }}">
                        <div class="flight-card-header">
                            <div class="airline-info">
                                <div class="airline-logo">
                                    <img src="{{ $flight->airline->logo }}" alt="{{ $flight->airline->name }}">
                                </div>
                                <div class="airline-details">
                                    <h4>{{ $flight->airline->name }}</h4>
                                    <span class="flight-number">{{ $flight->flight_number }}</span>
                                </div>
                            </div>
                            <div class="flight-price">
                                <div class="price-amount">${{ number_format($flight->price, 2) }}</div>
                                <div class="price-label">per person</div>
                            </div>
                        </div>

                        <div class="flight-card-body">
                            <div class="flight-route">
                                <div class="route-segment">
                                    <div class="time">{{ $flight->departure_time->format('h:i A') }}</div>
                                    <div class="airport">{{ $flight->departure_airport->code }}</div>
                                    <div class="city">{{ $flight->departure_airport->city }}</div>
                                </div>

                                <div class="route-duration">
                                    <div class="duration-line">
                                        <div class="duration-dot start"></div>
                                        <div class="duration-line-inner"></div>
                                        <div class="duration-dot end"></div>
                                    </div>
                                    <div class="duration-info">
                                        <span class="duration">{{ floor($flight->duration / 60) }}h {{ $flight->duration
                                            % 60 }}m</span>
                                        <span class="stops">
                                            @if($flight->stops == 0)
                                            Non-stop
                                            @else
                                            {{ $flight->stops }} stop(s)
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="route-segment">
                                    <div class="time">{{ $flight->arrival_time->format('h:i A') }}</div>
                                    <div class="airport">{{ $flight->arrival_airport->code }}</div>
                                    <div class="city">{{ $flight->arrival_airport->city }}</div>
                                </div>
                            </div>

                            <div class="flight-details">
                                <div class="detail-item">
                                    <i class="fas fa-suitcase"></i>
                                    <span>Baggage: {{ $flight->baggage_allowance }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-wifi"></i>
                                    <span>{{ $flight->wifi ? 'WiFi Available' : 'No WiFi' }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-utensils"></i>
                                    <span>{{ $flight->meals ? 'Meals Included' : 'No Meals' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flight-card-footer">
                            <div class="flight-features">
                                @if($flight->wifi)
                                <span class="feature-tag">WiFi</span>
                                @endif
                                @if($flight->entertainment)
                                <span class="feature-tag">Entertainment</span>
                                @endif
                                @if($flight->power_outlets)
                                <span class="feature-tag">Power Outlets</span>
                                @endif
                            </div>
                            <a href="{{ route('booking.create', $flight) }}" class="btn-select-flight">
                                Select Flight
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <!-- Expanded Details -->
                        <div class="flight-expanded-details">
                            <div class="expanded-content">
                                <h4>Flight Details</h4>
                                <div class="detail-grid">
                                    <div class="detail-column">
                                        <h5>Aircraft Information</h5>
                                        <p>Aircraft: {{ $flight->aircraft_type }}</p>
                                        <p>Seat Layout: {{ $flight->seat_layout }}</p>
                                    </div>
                                    <div class="detail-column">
                                        <h5>Services</h5>
                                        <ul>
                                            @if($flight->wifi)<li>WiFi Available</li>@endif
                                            @if($flight->entertainment)<li>In-flight Entertainment</li>@endif
                                            @if($flight->power_outlets)<li>Power Outlets</li>@endif
                                            @if($flight->usb_ports)<li>USB Ports</li>@endif
                                        </ul>
                                    </div>
                                    <div class="detail-column">
                                        <h5>Baggage Policy</h5>
                                        <p>Cabin: {{ $flight->cabin_baggage }}</p>
                                        <p>Checked: {{ $flight->baggage_allowance }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="no-results">
                        <div class="no-results-icon">
                            <i class="fas fa-plane-slash"></i>
                        </div>
                        <h3>No flights found</h3>
                        <p>Try adjusting your search criteria or filters</p>
                        <a href="{{ route('home') }}" class="btn-primary">Search Again</a>
                    </div>
                    @endforelse
                </div>

                <!-- Load More -->
                @if($flights->hasMorePages())
                <div class="load-more-section">
                    <button class="btn-load-more" id="loadMore">
                        Load More Flights
                        <i class="fas fa-spinner fa-spin" style="display: none;"></i>
                    </button>
                </div>
                @endif
            </main>
        </div>
    </div>
</div>

<!-- Sort Modal -->
<div class="modal-overlay" id="sortModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Sort Flights</h3>
            <button class="modal-close" id="closeSortModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="sort-options">
                <label class="sort-option">
                    <input type="radio" name="sort" value="price_asc">
                    <span class="radio-checkmark"></span>
                    Price: Low to High
                </label>
                <label class="sort-option">
                    <input type="radio" name="sort" value="price_desc">
                    <span class="radio-checkmark"></span>
                    Price: High to Low
                </label>
                <label class="sort-option">
                    <input type="radio" name="sort" value="duration_asc">
                    <span class="radio-checkmark"></span>
                    Duration: Shortest
                </label>
                <label class="sort-option">
                    <input type="radio" name="sort" value="departure_asc">
                    <span class="radio-checkmark"></span>
                    Departure: Earliest
                </label>
                <label class="sort-option">
                    <input type="radio" name="sort" value="departure_desc">
                    <span class="radio-checkmark"></span>
                    Departure: Latest
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-secondary" id="cancelSort">Cancel</button>
            <button class="btn-primary" id="applySort">Apply</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/search-results.js') }}"></script>
@endpush