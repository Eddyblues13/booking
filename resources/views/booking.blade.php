@extends('layouts.app')

@section('title', 'Book Flight - Aero Trova')

@section('content')
<div class="booking-container">
    <div class="container">
        <!-- Booking Steps -->
        <div class="booking-steps">
            <div class="step active">
                <div class="step-number">1</div>
                <div class="step-label">Passenger Details</div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-label">Review & Payment</div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-label">Confirmation</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                    <input type="hidden" name="adults" value="{{ $adults }}">
                    <input type="hidden" name="children" value="{{ $children }}">
                    <input type="hidden" name="infants" value="{{ $infants }}">
                    <input type="hidden" name="class" value="{{ $class }}">
                    <input type="hidden" name="trip_type" value="{{ $tripType }}">

                    <!-- Flight Details -->
                    <div class="booking-card">
                        <h2 class="card-title">
                            <i class="fas fa-plane-departure"></i>
                            Flight Details
                        </h2>
                        <div class="flight-summary">
                            <div class="summary-row">
                                <span class="summary-label">Flight Number</span>
                                <span class="summary-value">{{ $flight->flight_number }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Airline</span>
                                <span class="summary-value">{{ $flight->airline->name }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Route</span>
                                <span class="summary-value">
                                    {{ $flight->departureAirport->city }} ({{ $flight->departureAirport->code }})
                                    →
                                    {{ $flight->arrivalAirport->city }} ({{ $flight->arrivalAirport->code }})
                                </span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Departure</span>
                                <span class="summary-value">{{ $flight->departure_time->format('d M Y - h:i A')
                                    }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Arrival</span>
                                <span class="summary-value">{{ $flight->arrival_time->format('d M Y - h:i A') }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Duration</span>
                                <span class="summary-value">
                                    {{ floor($flight->duration / 60) }}h {{ $flight->duration % 60 }}m
                                </span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Class</span>
                                <span class="summary-value">{{ ucfirst($class) }} Class</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">Passengers</span>
                                <span class="summary-value">
                                    {{ $adults }} Adult(s), {{ $children }} Child(ren), {{ $infants }} Infant(s)
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Passenger Information -->
                    <div class="booking-card">
                        <h2 class="card-title">
                            <i class="fas fa-users"></i>
                            Passenger Information
                        </h2>

                        @for($i = 0; $i < $adults; $i++) <div class="passenger-form">
                            <div class="passenger-header">
                                <h3 class="passenger-title">
                                    <i class="fas fa-user"></i>
                                    Passenger {{ $i + 1 }} (Adult)
                                </h3>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Title *</label>
                                    <select name="passengers[{{ $i }}][title]" class="form-select" required>
                                        <option value="">Select Title</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Prof">Prof</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a title.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">First Name *</label>
                                    <input type="text" name="passengers[{{ $i }}][first_name]" class="form-control"
                                        placeholder="Enter first name" required maxlength="50">
                                    <div class="invalid-feedback">Please enter your first name.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Last Name *</label>
                                    <input type="text" name="passengers[{{ $i }}][last_name]" class="form-control"
                                        placeholder="Enter last name" required maxlength="50">
                                    <div class="invalid-feedback">Please enter your last name.</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Date of Birth *</label>
                                    <input type="date" name="passengers[{{ $i }}][date_of_birth]" class="form-control"
                                        required max="{{ date('Y-m-d', strtotime('-12 years')) }}">
                                    <div class="invalid-feedback">Please enter a valid date of birth.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Gender *</label>
                                    <select name="passengers[{{ $i }}][gender]" class="form-select" required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <div class="invalid-feedback">Please select your gender.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nationality *</label>
                                    <select name="passengers[{{ $i }}][nationality]" class="form-select" required>
                                        <option value="">Select Nationality</option>
                                        <option value="QA">Qatari</option>
                                        <option value="US">American</option>
                                        <option value="GB">British</option>
                                        <option value="AE">Emirati</option>
                                        <option value="SA">Saudi Arabian</option>
                                        <option value="IN">Indian</option>
                                        <option value="PK">Pakistani</option>
                                        <option value="BD">Bangladeshi</option>
                                        <option value="PH">Filipino</option>
                                        <option value="LK">Sri Lankan</option>
                                    </select>
                                    <div class="invalid-feedback">Please select your nationality.</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Passport Number *</label>
                                    <input type="text" name="passengers[{{ $i }}][passport_number]" class="form-control"
                                        placeholder="Enter passport number" required maxlength="20"
                                        pattern="[A-Z0-9]{6,20}"
                                        title="Passport number must be 6-20 alphanumeric characters">
                                    <div class="invalid-feedback">Please enter a valid passport number.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Passport Expiry *</label>
                                    <input type="date" name="passengers[{{ $i }}][passport_expiry]" class="form-control"
                                        required min="{{ date('Y-m-d', strtotime('+6 months')) }}">
                                    <div class="invalid-feedback">Passport must be valid for at least 6 months.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Country of Issue *</label>
                                    <select name="passengers[{{ $i }}][passport_country]" class="form-select" required>
                                        <option value="">Select Country</option>
                                        <option value="QA">Qatar</option>
                                        <option value="US">United States</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="IN">India</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="BD">Bangladesh</option>
                                    </select>
                                    <div class="invalid-feedback">Please select passport issue country.</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group form-group-full">
                                    <label class="form-label">Email Address *</label>
                                    <input type="email" name="passengers[{{ $i }}][email]" class="form-control"
                                        placeholder="email@example.com" required
                                        value="{{ auth()->user()->email ?? '' }}">
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Phone Number *</label>
                                    <input type="tel" name="passengers[{{ $i }}][phone]" class="form-control"
                                        placeholder="+974 1234 5678" required>
                                    <div class="invalid-feedback">Please enter a valid phone number.</div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Frequent Flyer Number</label>
                                    <input type="text" name="passengers[{{ $i }}][frequent_flyer]" class="form-control"
                                        placeholder="Optional">
                                </div>
                            </div>
                    </div>
                    @if($i < $adults - 1) <hr class="my-4">
                        @endif
                        @endfor
            </div>

            <!-- Contact Information -->
            <div class="booking-card">
                <h2 class="card-title">
                    <i class="fas fa-envelope"></i>
                    Contact Information
                </h2>
                <div class="form-row">
                    <div class="form-group form-group-full">
                        <label class="form-label">Email Address for Booking Confirmation *</label>
                        <input type="email" name="contact_email" class="form-control"
                            value="{{ auth()->user()->email ?? '' }}" required>
                        <div class="invalid-feedback">Please enter a valid email address for confirmation.</div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Primary Phone Number *</label>
                        <input type="tel" name="contact_phone" class="form-control" placeholder="+974 1234 5678"
                            required>
                        <div class="invalid-feedback">Please enter a valid phone number.</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Secondary Phone Number</label>
                        <input type="tel" name="contact_phone_secondary" class="form-control" placeholder="Optional">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group form-group-full">
                        <label class="form-label">Special Requests</label>
                        <textarea name="special_requests" class="form-control" rows="3"
                            placeholder="Any special requests, dietary requirements, or assistance needed..."></textarea>
                        <small class="text-muted">We'll do our best to accommodate your requests.</small>
                    </div>
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="booking-card">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="terms_accepted" id="termsAccepted" required>
                    <label class="form-check-label" for="termsAccepted">
                        I agree to the <a href="#" class="text-primary">Terms and Conditions</a>,
                        <a href="#" class="text-primary">Privacy Policy</a>, and
                        <a href="#" class="text-primary">Conditions of Carriage</a> *
                    </label>
                    <div class="invalid-feedback">You must agree to the terms and conditions.</div>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="marketing_emails" id="marketingEmails">
                    <label class="form-check-label" for="marketingEmails">
                        I would like to receive special offers and promotional emails
                    </label>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="d-flex gap-3 mt-4">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i> Back to Search
                </a>
                <button type="submit" class="btn-continue" id="submitButton">
                    Continue to Payment <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
            </form>
        </div>

        <!-- Price Breakdown Sidebar -->
        <div class="col-lg-4">
            <div class="price-breakdown">
                <h3 class="card-title mb-4">
                    <i class="fas fa-receipt"></i>
                    Price Summary
                </h3>

                <div class="price-row">
                    <span>Base Fare ({{ $totalPassengers }} {{ $totalPassengers > 1 ? 'Passengers' : 'Passenger'
                        }})</span>
                    <span>${{ number_format($subtotal, 2) }}</span>
                </div>
                <div class="price-row">
                    <span>Taxes & Fees</span>
                    <span>${{ number_format($taxesAndFees * $totalPassengers, 2) }}</span>
                </div>
                <div class="price-row">
                    <span>Fuel Surcharge</span>
                    <span>${{ number_format($fuelSurcharge * $totalPassengers, 2) }}</span>
                </div>
                <div class="price-row">
                    <span>Service Charge</span>
                    <span>${{ number_format($serviceCharge, 2) }}</span>
                </div>

                <div class="price-row price-total">
                    <span>Total Amount</span>
                    <span>${{ number_format($totalAmount, 2) }}</span>
                </div>

                <div class="alert alert-info mt-4" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <div>
                        <strong>Flexible Booking</strong>
                        <small class="d-block">Free changes within 24 hours of booking</small>
                        <small class="d-block">Cancel for credit up to 48 hours before departure</small>
                    </div>
                </div>

                <!-- Flight Summary in Sidebar -->
                <div class="mt-4 pt-4 border-top">
                    <h5 class="mb-3">Flight Summary</h5>
                    <div class="small">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <strong>{{ $flight->departureAirport->code }}</strong>
                                <div class="text-muted">{{ $flight->departure_time->format('H:i') }}</div>
                            </div>
                            <div class="text-center flex-grow-1 mx-3">
                                <div class="text-muted">{{ floor($flight->duration / 60) }}h {{ $flight->duration % 60
                                    }}m</div>
                                <div class="flight-route-line">
                                    <i class="fas fa-plane text-muted"></i>
                                </div>
                                <div class="text-muted small">Direct</div>
                            </div>
                            <div>
                                <strong>{{ $flight->arrivalAirport->code }}</strong>
                                <div class="text-muted">{{ $flight->arrival_time->format('H:i') }}</div>
                            </div>
                        </div>
                        <div class="text-muted">
                            <div>{{ $flight->departure_time->format('d M Y') }}</div>
                            <div>{{ $flight->airline->name }} · {{ $flight->flight_number }}</div>
                            <div>{{ ucfirst($class) }} Class</div>
                        </div>
                    </div>
                </div>

                <!-- Important Information -->
                <div class="mt-4 pt-4 border-top">
                    <h6 class="mb-3">Important Information</h6>
                    <ul class="small text-muted ps-3">
                        <li>Check-in opens 24 hours before departure</li>
                        <li>Baggage allowance: 30kg checked + 7kg cabin</li>
                        <li>Photo ID required for check-in</li>
                        <li>Visa requirements apply for some destinations</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h6>Processing Booking...</h6>
                <p class="text-muted small mb-0">Please wait while we confirm your details.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('bookingForm');
        const submitButton = document.getElementById('submitButton');
        const loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'));
        
        // Form validation
        const validateForm = () => {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            // Email validation
            const emailFields = form.querySelectorAll('input[type="email"]');
            emailFields.forEach(field => {
                if (field.value && !isValidEmail(field.value)) {
                    field.classList.add('is-invalid');
                    isValid = false;
                }
            });
            
            // Date validation
            const dobFields = form.querySelectorAll('input[name*="date_of_birth"]');
            dobFields.forEach(dobField => {
                if (dobField.value) {
                    const dob = new Date(dobField.value);
                    const minAge = new Date();
                    minAge.setFullYear(minAge.getFullYear() - 12);
                    
                    if (dob > minAge) {
                        dobField.classList.add('is-invalid');
                        dobField.nextElementSibling.textContent = 'Passenger must be at least 12 years old.';
                        isValid = false;
                    }
                }
            });
            
            // Passport expiry validation
            const passportExpiryFields = form.querySelectorAll('input[name*="passport_expiry"]');
            passportExpiryFields.forEach(passportExpiry => {
                if (passportExpiry.value) {
                    const expiry = new Date(passportExpiry.value);
                    const minValid = new Date();
                    minValid.setMonth(minValid.getMonth() + 6);
                    
                    if (expiry < minValid) {
                        passportExpiry.classList.add('is-invalid');
                        passportExpiry.nextElementSibling.textContent = 'Passport must be valid for at least 6 months.';
                        isValid = false;
                    }
                }
            });
            
            return isValid;
        };
        
        const isValidEmail = (email) => {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        };
        
        // Real-time validation
        form.addEventListener('input', function(e) {
            const field = e.target;
            if (field.hasAttribute('required')) {
                if (field.value.trim()) {
                    field.classList.remove('is-invalid');
                } else {
                    field.classList.add('is-invalid');
                }
            }
            
            // Email validation in real-time
            if (field.type === 'email' && field.value) {
                if (isValidEmail(field.value)) {
                    field.classList.remove('is-invalid');
                } else {
                    field.classList.add('is-invalid');
                }
            }
        });
        
        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateForm()) {
                // Scroll to first error
                const firstError = form.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
                return;
            }
            
            // Show loading state
            submitButton.disabled = true;
            submitButton.classList.add('loading');
            loadingModal.show();
            
            // Submit the form
            setTimeout(() => {
                form.submit();
            }, 2000);
        });
        
        // Initialize date restrictions
        const today = new Date().toISOString().split('T')[0];
        
        // Set max date for date of birth (12 years ago)
        const dobFields = document.querySelectorAll('input[name*="date_of_birth"]');
        dobFields.forEach(dobField => {
            if (dobField) {
                const maxDob = new Date();
                maxDob.setFullYear(maxDob.getFullYear() - 12);
                dobField.max = maxDob.toISOString().split('T')[0];
            }
        });
        
        // Set min date for passport expiry (6 months from now)
        const passportExpiryFields = document.querySelectorAll('input[name*="passport_expiry"]');
        passportExpiryFields.forEach(passportExpiry => {
            if (passportExpiry) {
                const minExpiry = new Date();
                minExpiry.setMonth(minExpiry.getMonth() + 6);
                passportExpiry.min = minExpiry.toISOString().split('T')[0];
            }
        });
    });
</script>
@endpush