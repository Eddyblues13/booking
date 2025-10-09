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
                    <a class="nav-link text-white fw-medium" href="{{ url('/experience') }}">Experience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-medium active" href="{{ url('/privilege') }}">Privilege Club</a>
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
<section class="privilege-hero-section">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="hero-title">Privilege Club</h1>
                <p class="hero-subtitle">Earn Qmiles and enjoy exclusive benefits as a member</p>
                <button class="btn btn-light btn-lg rounded-pill px-4 mt-3">Join Now</button>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="benefits-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Member Benefits</h2>
            <p class="section-subtitle">Enjoy exclusive privileges and rewards</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="benefit-card text-center">
                    <div class="benefit-icon">
                        <i class="bi bi-airplane"></i>
                    </div>
                    <h4>Earn Qmiles</h4>
                    <p>Accumulate Qmiles on every Qatar Airways flight and with our partners</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="benefit-card text-center">
                    <div class="benefit-icon">
                        <i class="bi bi-star"></i>
                    </div>
                    <h4>Tier Benefits</h4>
                    <p>Enjoy enhanced benefits as you progress through Burgundy, Silver, Gold and Platinum tiers</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="benefit-card text-center">
                    <div class="benefit-icon">
                        <i class="bi bi-gift"></i>
                    </div>
                    <h4>Redeem Rewards</h4>
                    <p>Use your Qmiles for flights, upgrades, hotel stays, and more</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Membership Tiers -->
<section class="tiers-section bg-light py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Membership Tiers</h2>
            <p class="section-subtitle">Progress through our tiers and unlock greater benefits</p>
        </div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="tier-card">
                    <div class="tier-header burgundy">
                        <h4>Burgundy</h4>
                        <div class="tier-level">Entry Level</div>
                    </div>
                    <div class="tier-content">
                        <ul>
                            <li>Earn Qmiles on flights</li>
                            <li>Exclusive member offers</li>
                            <li>Online booking benefits</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="tier-card">
                    <div class="tier-header silver">
                        <h4>Silver</h4>
                        <div class="tier-level">Premium</div>
                    </div>
                    <div class="tier-content">
                        <ul>
                            <li>All Burgundy benefits</li>
                            <li>Extra baggage allowance</li>
                            <li>Priority check-in</li>
                            <li>Lounge access (when flying Business)</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="tier-card featured">
                    <div class="tier-header gold">
                        <h4>Gold</h4>
                        <div class="tier-level">Elite</div>
                    </div>
                    <div class="tier-content">
                        <ul>
                            <li>All Silver benefits</li>
                            <li>Complimentary lounge access</li>
                            <li>Priority boarding</li>
                            <li>Additional Qmiles earning</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="tier-card">
                    <div class="tier-header platinum">
                        <h4>Platinum</h4>
                        <div class="tier-level">Exclusive</div>
                    </div>
                    <div class="tier-content">
                        <ul>
                            <li>All Gold benefits</li>
                            <li>Exclusive Platinum services</li>
                            <li>Highest priority on upgrades</li>
                            <li>Dedicated support</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Avios Section -->
<section class="avios-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="display-5 fw-bold mb-4">Collect Avios</h2>
                <p class="lead mb-4">Earn Avios every time you fly with us and our partners, and redeem them for
                    flights, upgrades, and more.</p>
                <div class="d-flex gap-3">
                    <button class="btn btn-light btn-lg px-4">Join Privilege Club</button>
                    <button class="btn btn-outline-light btn-lg px-4">Learn More</button>
                </div>
            </div>
            <div class="col-md-6 text-center">
                <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600&q=80" alt="Avios"
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