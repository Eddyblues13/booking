<!-- [file name]: admin/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Admin Login - Adibiyas Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-auth.css') }}">
@endpush

@section('content')
<div class="admin-auth-container">
    <div class="container">
        <div class="admin-auth-card">
            <div class="row g-0">
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="admin-auth-left">
                        <div class="auth-logo">
                            <i class="fas fa-plane"></i>
                            <h2>Adibiyas Tour</h2>
                        </div>
                        <h3>Admin Portal</h3>
                        <p>Manage flights, bookings, and users with our comprehensive admin dashboard.</p>
                        <img src="https://illustrations.popsy.co/amber/security.svg" alt="Admin Security"
                            class="auth-illustration">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="admin-auth-right">
                        <h1 class="auth-title">Admin Login</h1>
                        <p class="auth-subtitle">Enter your credentials to access the admin panel</p>

                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <div class="input-group">
                                    <i class="fas fa-envelope input-icon"></i>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="admin@adibiyastour.com" value="{{ old('email') }}" required
                                        autofocus>
                                </div>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <i class="fas fa-lock input-icon"></i>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Enter your password" required>
                                    <i class="fas fa-eye password-toggle" onclick="togglePassword()"></i>
                                </div>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="remember-forgot">
                                <label class="remember-me">
                                    <input type="checkbox" name="remember">
                                    <span>Remember me</span>
                                </label>
                            </div>

                            <button type="submit" class="btn-admin-auth">
                                <i class="fas fa-sign-in-alt me-2"></i> Login to Admin
                            </button>
                        </form>

                        <div class="auth-footer">
                            <a href="{{ route('home') }}"><i class="fas fa-arrow-left me-2"></i>Back to Main Site</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.password-toggle');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
@endpush