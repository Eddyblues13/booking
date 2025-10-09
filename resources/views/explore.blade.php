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
                    <a class="nav-link text-white fw-medium active" href="{{ url('/explore') }}">Explore</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="{{ url('/book') }}">Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium" href="{{ url('/experience') }}">Experience</a>
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
<section class="explore-hero-section">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title">Discover the World</h1>
                <p class="hero-subtitle">Explore over 160 destinations across six continents with Qatar Airways</p>
                <button class="btn btn-outline-light btn-lg rounded-pill px-4 mt-3">Start Exploring</button>
            </div>
        </div>
    </div>
</section>

<!-- Destinations Grid -->
<section class="destinations-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Popular Destinations</h2>
            <p class="section-subtitle">Find inspiration for your next journey</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="destination-card-large">
                    <img src="https://images.unsplash.com/photo-1523059623039-a9ed027e7fad?w=600&q=80" alt="Asia">
                    <div class="destination-content">
                        <h3>Asia</h3>
                        <p>Explore ancient cultures and modern marvels</p>
                        <a href="#" class="btn btn-outline-light">View Destinations</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="destination-card-large">
                    <img src="https://images.unsplash.com/photo-1502602898536-47ad22581b52?w=600&q=80" alt="Europe">
                    <div class="destination-content">
                        <h3>Europe</h3>
                        <p>Discover historic cities and scenic landscapes</p>
                        <a href="#" class="btn btn-outline-light">View Destinations</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="destination-card-large">
                    <img src="https://images.unsplash.com/photo-1485738422979-f5c462d49f74?w=600&q=80" alt="Americas">
                    <div class="destination-content">
                        <h3>Americas</h3>
                        <p>From vibrant cities to natural wonders</p>
                        <a href="#" class="btn btn-outline-light">View Destinations</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Travel Inspiration -->
<section class="inspiration-section bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Travel Inspiration</h2>
            <p class="section-subtitle">Latest travel guides and tips</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="inspiration-card">
                    <img src="https://images.unsplash.com/photo-1526481280693-3bfa7568e0f3?w=400&q=80"
                        alt="Travel Guide">
                    <div class="inspiration-content">
                        <h5>Top 10 Must-Visit Cities in 2024</h5>
                        <p>Discover the most exciting destinations for your next trip</p>
                        <a href="#" class="btn-link">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="inspiration-card">
                    <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=400&q=80" alt="Nature">
                    <div class="inspiration-content">
                        <h5>Natural Wonders Around the World</h5>
                        <p>Explore breathtaking landscapes and natural beauty</p>
                        <a href="#" class="btn-link">Read More <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="inspiration-card">
                    <img src="https://images.unsplash.com/photo-1555400113-7b7d0e4b1c36?w=400&q=80" alt="Culture">
                    <div class="inspiration-content">
                        <h5>Cultural Experiences to Remember</h5>
                        <p>Immerse yourself in diverse cultures and traditions</p>
                        <a href="#" class="btn-link">Read More <i class="bi bi-arrow-right"></i></a>
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
@endsection