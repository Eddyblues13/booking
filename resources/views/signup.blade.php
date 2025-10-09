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
                    <a class="nav-link text-white active" href="{{ url('/login') }}"><i class="bi bi-person-circle"></i>
                        Log in | Sign up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Sign Up Section -->
<section class="auth-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="auth-card">
                    <div class="auth-header text-center mb-4">
                        <h2>Join Privilege Club</h2>
                        <p class="text-muted">Create your Qatar Airways account and start earning Qmiles</p>
                    </div>

                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" class="form-control form-control-lg" id="firstName"
                                    placeholder="First name">
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control form-control-lg" id="lastName"
                                    placeholder="Last name">
                            </div>

                            <div class="col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control form-control-lg" id="email"
                                    placeholder="Enter your email">
                            </div>

                            <div class="col-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control form-control-lg" id="password"
                                    placeholder="Create a password">
                                <div class="form-text">Must be at least 8 characters with numbers and letters</div>
                            </div>

                            <div class="col-12">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control form-control-lg" id="confirmPassword"
                                    placeholder="Confirm your password">
                            </div>

                            <div class="col-12">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control form-control-lg" id="phone"
                                    placeholder="Phone number">
                            </div>

                            <div class="col-12">
                                <label for="country" class="form-label">Country of Residence</label>
                                <select class="form-select form-control-lg" id="country">
                                    <option selected>Select country</option>
                                    <option>United States</option>
                                    <option>United Kingdom</option>
                                    <option>Qatar</option>
                                    <option>United Arab Emirates</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms">
                                    <label class="form-check-label" for="terms">
                                        I agree to the <a href="#" class="text-decoration-none">Terms and Conditions</a>
                                        and <a href="#" class="text-decoration-none">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="newsletter">
                                    <label class="form-check-label" for="newsletter">
                                        Send me exclusive offers and travel inspiration
                                    </label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">Create Account</button>

                        <div class="text-center mt-3">
                            <p class="mb-0">Already have an account? <a href="{{ url('/login') }}"
                                    class="text-decoration-none fw-bold">Sign in</a></p>
                        </div>
                    </form>
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
@endsections