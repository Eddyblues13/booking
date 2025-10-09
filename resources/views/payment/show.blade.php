@extends('layouts.app')

@section('title', 'Payment - Adibiyas Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endpush

@section('content')
<div class="payment-container">
    <div class="container">
        <!-- Payment Progress -->
        <div class="payment-progress">
            <div class="progress-steps">
                <div class="step completed">
                    <div class="step-number">1</div>
                    <div class="step-label">Passenger Details</div>
                </div>
                <div class="step active">
                    <div class="step-number">2</div>
                    <div class="step-label">Review & Payment</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-label">Confirmation</div>
                </div>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 66%"></div>
            </div>
        </div>

        <div class="payment-content">
            <div class="payment-main">
                <form action="{{ route('booking.process-payment', $booking) }}" method="POST" id="paymentForm">
                    @csrf

                    <!-- Booking Summary -->
                    <div class="payment-card">
                        <div class="card-header">
                            <h2><i class="fas fa-receipt"></i> Booking Summary</h2>
                        </div>
                        <div class="booking-summary">
                            <div class="summary-section">
                                <h4>Flight Details</h4>
                                <div class="flight-info-compact">
                                    <div class="airline">
                                        <img src="{{ $booking->flight->airline->logo }}"
                                            alt="{{ $booking->flight->airline->name }}">
                                        <span>{{ $booking->flight->airline->name }}</span>
                                    </div>
                                    <div class="route">
                                        <div class="route-segment">
                                            <strong>{{ $booking->flight->departure_airport->code }}</strong>
                                            <span>{{ $booking->flight->departure_time->format('M d, Y - h:i A')
                                                }}</span>
                                        </div>
                                        <div class="route-duration">
                                            <i class="fas fa-plane"></i>
                                            <span>{{ floor($booking->flight->duration / 60) }}h {{
                                                $booking->flight->duration % 60 }}m</span>
                                        </div>
                                        <div class="route-segment">
                                            <strong>{{ $booking->flight->arrival_airport->code }}</strong>
                                            <span>{{ $booking->flight->arrival_time->format('M d, Y - h:i A') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="summary-section">
                                <h4>Passengers</h4>
                                <div class="passengers-list">
                                    @foreach($booking->passengers as $passenger)
                                    <div class="passenger-item">
                                        <i class="fas fa-user"></i>
                                        <span>{{ $passenger->title }} {{ $passenger->first_name }} {{
                                            $passenger->last_name }}</span>
                                        <small>Seat: {{ $passenger->seat_number }}</small>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="summary-section">
                                <h4>Contact Information</h4>
                                <div class="contact-info">
                                    <p><strong>Email:</strong> {{ $booking->contact_email }}</p>
                                    <p><strong>Phone:</strong> {{ $booking->contact_phone }}</p>
                                    <p><strong>Emergency Contact:</strong> {{ $booking->emergency_contact_name }} ({{
                                        $booking->emergency_contact_phone }})</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="payment-card">
                        <div class="card-header">
                            <h2><i class="fas fa-credit-card"></i> Select Payment Method</h2>
                        </div>

                        <div class="payment-methods">
                            <div class="payment-method-tabs">
                                <button type="button" class="method-tab active" data-method="credit_card">
                                    <i class="fas fa-credit-card"></i>
                                    Credit Card
                                </button>
                                <button type="button" class="method-tab" data-method="debit_card">
                                    <i class="fas fa-credit-card"></i>
                                    Debit Card
                                </button>
                                <button type="button" class="method-tab" data-method="paypal">
                                    <i class="fab fa-paypal"></i>
                                    PayPal
                                </button>
                                <button type="button" class="method-tab" data-method="bank_transfer">
                                    <i class="fas fa-university"></i>
                                    Bank Transfer
                                </button>
                            </div>

                            <!-- Credit/Debit Card Form -->
                            <div class="payment-form active" id="credit_card_form">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label>Card Number *</label>
                                        <div class="card-input-wrapper">
                                            <input type="text" name="card_number" class="form-control card-number"
                                                placeholder="1234 5678 9012 3456" maxlength="19">
                                            <i class="fas fa-credit-card card-icon"></i>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Card Holder Name *</label>
                                        <input type="text" name="card_holder" class="form-control"
                                            placeholder="John Doe">
                                    </div>

                                    <div class="form-group">
                                        <label>Expiry Date *</label>
                                        <input type="text" name="expiry_date" class="form-control" placeholder="MM/YY"
                                            maxlength="5">
                                    </div>

                                    <div class="form-group">
                                        <label>CVV *</label>
                                        <div class="cvv-input-wrapper">
                                            <input type="text" name="cvv" class="form-control cvv" placeholder="123"
                                                maxlength="4">
                                            <i class="fas fa-question-circle cvv-info"
                                                title="3 or 4 digit security code"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-logos">
                                    <img src="https://cdn.jsdelivr.net/gh/atomiclabs/cryptocurrency-icons@1a63530be6e374711a8554f31b17e4cb92c25fa5/svg/color/visa.svg"
                                        alt="Visa" class="card-logo">
                                    <img src="https://cdn.jsdelivr.net/gh/atomiclabs/cryptocurrency-icons@1a63530be6e374711a8554f31b17e4cb92c25fa5/svg/color/mastercard.svg"
                                        alt="Mastercard" class="card-logo">
                                    <img src="https://cdn.jsdelivr.net/gh/atomiclabs/cryptocurrency-icons@1a63530be6e374711a8554f31b17e4cb92c25fa5/svg/color/amex.svg"
                                        alt="Amex" class="card-logo">
                                </div>
                            </div>

                            <!-- PayPal Form -->
                            <div class="payment-form" id="paypal_form">
                                <div class="paypal-info">
                                    <i class="fab fa-paypal"></i>
                                    <p>You will be redirected to PayPal to complete your payment securely.</p>
                                    <div class="form-group">
                                        <label>PayPal Email *</label>
                                        <input type="email" name="paypal_email" class="form-control"
                                            placeholder="your-email@paypal.com">
                                    </div>
                                </div>
                            </div>

                            <!-- Bank Transfer Form -->
                            <div class="payment-form" id="bank_transfer_form">
                                <div class="bank-transfer-info">
                                    <i class="fas fa-university"></i>
                                    <p>Complete your booking and transfer the amount to our bank account. Your booking
                                        will be confirmed once payment is received.</p>
                                    <div class="form-grid">
                                        <div class="form-group">
                                            <label>Bank Name *</label>
                                            <input type="text" name="bank_name" class="form-control"
                                                placeholder="e.g., Chase Bank">
                                        </div>
                                        <div class="form-group">
                                            <label>Account Number *</label>
                                            <input type="text" name="account_number" class="form-control"
                                                placeholder="Your account number">
                                        </div>
                                    </div>

                                    <div class="bank-details">
                                        <h5>Our Bank Details:</h5>
                                        <div class="bank-info">
                                            <p><strong>Bank:</strong> Adibiyas Tour Bank</p>
                                            <p><strong>Account:</strong> 1234 5678 9012</p>
                                            <p><strong>Routing:</strong> 021000021</p>
                                            <p><strong>Amount:</strong> ${{ number_format($booking->total_amount, 2) }}
                                            </p>
                                            <p><strong>Reference:</strong> {{ $booking->booking_reference }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="payment-card">
                        <div class="terms-agreement">
                            <label class="checkbox-label">
                                <input type="checkbox" name="terms_agreed" required>
                                <span class="checkmark"></span>
                                I agree to the <a href="#" target="_blank">Terms & Conditions</a> and
                                <a href="#" target="_blank">Privacy Policy</a>. I understand that my payment
                                is secure and my personal information will be protected.
                            </label>
                        </div>
                    </div>

                    <div class="payment-actions">
                        <a href="{{ route('booking.create', $booking->flight) }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i>
                            Back to Details
                        </a>
                        <button type="submit" class="btn-pay-now" id="payNowBtn">
                            <i class="fas fa-lock"></i>
                            Pay Now ${{ number_format($booking->total_amount, 2) }}
                            <div class="btn-shine"></div>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Payment Summary Sidebar -->
            <div class="payment-sidebar">
                <div class="price-summary-card">
                    <h3>Payment Summary</h3>

                    <div class="booking-reference">
                        <strong>Booking Reference:</strong>
                        <span class="ref-number">{{ $booking->booking_reference }}</span>
                    </div>

                    <div class="price-breakdown">
                        <div class="price-row">
                            <span>Base Fare</span>
                            <span>${{ number_format($booking->base_fare, 2) }}</span>
                        </div>

                        <div class="price-row">
                            <span>Taxes & Fees</span>
                            <span>${{ number_format($booking->taxes, 2) }}</span>
                        </div>

                        <div class="price-row">
                            <span>Service Fee</span>
                            <span>${{ number_format($booking->service_fee, 2) }}</span>
                        </div>

                        <div class="price-row total">
                            <span>Total Amount</span>
                            <span class="total-amount">${{ number_format($booking->total_amount, 2) }}</span>
                        </div>
                    </div>

                    <div class="payment-security">
                        <div class="security-badge">
                            <i class="fas fa-shield-alt"></i>
                            <div>
                                <strong>Secure Payment</strong>
                                <small>256-bit SSL encryption</small>
                            </div>
                        </div>
                        <div class="trust-icons">
                            <img src="https://cdn.jsdelivr.net/gh/atomiclabs/cryptocurrency-icons@1a63530be6e374711a8554f31b17e4cb92c25fa5/svg/color/ssl.svg"
                                alt="SSL Secure">
                            <img src="https://cdn.jsdelivr.net/gh/atomiclabs/cryptocurrency-icons@1a63530be6e374711a8554f31b17e4cb92c25fa5/svg/color/pci.svg"
                                alt="PCI Compliant">
                        </div>
                    </div>
                </div>

                <div class="support-card">
                    <h4><i class="fas fa-headset"></i> Need Help?</h4>
                    <p>Our payment specialists are here to assist you.</p>
                    <div class="support-contacts">
                        <a href="tel:+15551234567" class="support-link">
                            <i class="fas fa-phone"></i>
                            +1 (555) 123-4567
                        </a>
                        <a href="mailto:payments@adibiyastour.com" class="support-link">
                            <i class="fas fa-envelope"></i>
                            payments@adibiyastour.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Processing Modal -->
<div class="modal-overlay" id="processingModal">
    <div class="modal-content processing-modal">
        <div class="processing-animation">
            <div class="spinner"></div>
            <div class="processing-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <h3>Processing Your Payment</h3>
        <p>Please wait while we process your payment. Do not refresh or close this page.</p>
        <div class="processing-timer">
            <i class="fas fa-clock"></i>
            <span id="processingTime">This may take up to 30 seconds</span>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/payment.js') }}"></script>
@endpush