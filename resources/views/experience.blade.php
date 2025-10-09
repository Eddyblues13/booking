@extends('layouts.app')

@section('content')
<!-- Top Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark transparent-nav">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
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
                    <a class="nav-link text-white fw-medium" href="{{ url('/explore') }}">Explore</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="{{ url('/book') }}">Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium active" href="{{ url('/experience') }}">Experience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="{{ url('/privilege') }}">Privilege Club</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="{{ url('/help') }}">Help</a>
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
                    <a class="nav-link text-white" href="{{ url('/login') }}"><i class="bi bi-person-circle"></i> Log in
                        | Sign up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="experience-hero-section">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title">The Qatar Airways Experience</h1>
                <p class="hero-subtitle">Discover world-class service and luxury in the skies</p>
                <button class="btn btn-outline-light btn-lg rounded-pill px-4 mt-3">Discover More</button>
            </div>
        </div>
    </div>
</section>

<!-- Cabin Classes -->
<section class="cabins-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Our Cabin Classes</h2>
            <p class="section-subtitle">Experience comfort and luxury at every level</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="cabin-card">
                    <img src="https://images.unsplash.com/photo-1556388158-158ea5ccacbd?w=600&q=80" alt="Economy Class">
                    <div class="cabin-content">
                        <h3>Economy Class</h3>
                        <p>Comfortable seating, delicious meals, and award-winning service</p>
                        <ul class="cabin-features">
                            <li><i class="bi bi-check-circle"></i> Spacious legroom</li>
                            <li><i class="bi bi-check-circle"></i> Gourmet meals</li>
                            <li><i class="bi bi-check-circle"></i> Personal entertainment</li>
                        </ul>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cabin-card featured">
                    <img src="https://images.unsplash.com/photo-1444201983204-c43cbd584d93?w=600&q=80"
                        alt="Business Class">
                    <div class="cabin-content">
                        <h3>Business Class</h3>
                        <p>Fully flat beds and premium service for the ultimate comfort</p>
                        <ul class="cabin-features">
                            <li><i class="bi bi-check-circle"></i> Fully flat beds</li>
                            <li><i class="bi bi-check-circle"></i> Premium dining</li>
                            <li><i class="bi bi-check-circle"></i> Priority services</li>
                        </ul>
                        <a href="#" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cabin-card">
                    <img src="https://images.unsplash.com/photo-1589010588553-46e8f7b1b88a?w=600&q=80"
                        alt="First Class">
                    <div class="cabin-content">
                        <h3>First Class</h3>
                        <p>Unparalleled luxury and privacy in our exclusive suites</p>
                        <ul class="cabin-features">
                            <li><i class="bi bi-check-circle"></i> Private suites</li>
                            <li><i class="bi bi-check-circle"></i> Fine dining</li>
                            <li><i class="bi bi-check-circle"></i> Personal service</li>
                        </ul>
                        <a href="#" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Onboard Experience -->
<section class="onboard-section bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title">World-Class Dining</h2>
                <p class="lead">Enjoy gourmet cuisine crafted by award-winning chefs, featuring both international and
                    regional specialties.</p>
                <div class="dining-features">
                    <div class="feature-item">
                        <i class="bi bi-star-fill"></i>
                        <span>Award-winning menus</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-cup-straw"></i>
                        <span>Premium beverages</span>
                    </div>
                    <div class="feature-item">
                        <i class="bi bi-heart"></i>
                        <span>Special dietary options</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&q=80" alt="Dining"
                    class="img-fluid rounded-3">
            </div>
        </div>
    </div>
</section>

<!-- Entertainment -->
<section class="entertainment-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2">
                <h2 class="section-title">Oryx One Entertainment</h2>
                <p class="lead">Access thousands of hours of entertainment with our award-winning in-flight system.</p>
                <ul class="entertainment-list">
                    <li>Latest movies and TV shows</li>
                    <li>Music from around the world</li>
                    <li>Games and interactive content</li>
                    <li>Wi-Fi connectivity</li>
                </ul>
            </div>
            <div class="col-lg-6 order-lg-1">
                <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=600&q=80" alt="Entertainment"
                    class="img-fluid rounded-3">
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
@endsection