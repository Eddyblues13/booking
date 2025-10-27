@extends('layouts.app')

@section('title', 'Payment - Aero Trova')

@section('content')
<div class="payment-container">
    <div class="container">
        <!-- Booking Steps -->
        <div class="booking-steps">
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

        <div class="row">
            <div class="col-lg-8">
                <div class="booking-card">
                    <h2 class="card-title">
                        <i class="fas fa-credit-card"></i>
                        Payment Method
                    </h2>

                    <form action="{{ route('booking.process-payment', $booking) }}" method="POST" id="paymentForm">
                        @csrf

                        <div class="payment-methods">
                            <!-- Credit Card -->
                            <div class="payment-method">
                                <input type="radio" name="payment_method" value="credit_card" id="credit_card"
                                    class="payment-radio" required>
                                <label for="credit_card" class="payment-label">
                                    <div class="payment-icons">
                                        <i class="fab fa-cc-visa"></i>
                                        <i class="fab fa-cc-mastercard"></i>
                                        <i class="fab fa-cc-amex"></i>
                                    </div>
                                    <div class="payment-text">
                                        <span class="payment-name">Credit Card</span>
                                        <small class="text-muted">Visa, Mastercard, American Express</small>
                                    </div>
                                </label>
                            </div>

                            <!-- Debit Card -->
                            <div class="payment-method">
                                <input type="radio" name="payment_method" value="debit_card" id="debit_card"
                                    class="payment-radio">
                                <label for="debit_card" class="payment-label">
                                    <div class="payment-icons">
                                        <i class="fas fa-credit-card"></i>
                                    </div>
                                    <div class="payment-text">
                                        <span class="payment-name">Debit Card</span>
                                        <small class="text-muted">All major debit cards</small>
                                    </div>
                                </label>
                            </div>

                            <!-- PayPal -->
                            <div class="payment-method">
                                <input type="radio" name="payment_method" value="paypal" id="paypal"
                                    class="payment-radio">
                                <label for="paypal" class="payment-label">
                                    <div class="payment-icons">
                                        <i class="fab fa-paypal"></i>
                                    </div>
                                    <div class="payment-text">
                                        <span class="payment-name">PayPal</span>
                                        <small class="text-muted">Pay with your PayPal account</small>
                                    </div>
                                </label>
                            </div>

                            <!-- Bank Transfer -->
                            <div class="payment-method">
                                <input type="radio" name="payment_method" value="bank_transfer" id="bank_transfer"
                                    class="payment-radio">
                                <label for="bank_transfer" class="payment-label">
                                    <div class="payment-icons">
                                        <i class="fas fa-university"></i>
                                    </div>
                                    <div class="payment-text">
                                        <span class="payment-name">Bank Transfer</span>
                                        <small class="text-muted">Direct bank transfer</small>
                                    </div>
                                </label>
                            </div>

                            <!-- Contact Agent -->
                            <div class="payment-method">
                                <input type="radio" name="payment_method" value="contact_agent" id="contact_agent"
                                    class="payment-radio">
                                <label for="contact_agent" class="payment-label">
                                    <div class="payment-icons">
                                        <i class="fas fa-headset"></i>
                                    </div>
                                    <div class="payment-text">
                                        <span class="payment-name">Contact Agent</span>
                                        <small class="text-muted">Can't pay online? Our agent will contact you.</small>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Credit/Debit Card Form -->
                        <div id="cardPaymentForm" class="payment-details-card" style="display: none;">
                            <h5 class="mb-3">Card Details</h5>
                            <div class="form-row">
                                <div class="form-group form-group-full">
                                    <label class="form-label">Card Number *</label>
                                    <input type="text" name="card_number" class="form-control card-number"
                                        placeholder="1234 5678 9012 3456" maxlength="19">
                                    <div class="card-icons mt-2">
                                        <i class="fab fa-cc-visa text-muted"></i>
                                        <i class="fab fa-cc-mastercard text-muted"></i>
                                        <i class="fab fa-cc-amex text-muted"></i>
                                        <i class="fab fa-cc-discover text-muted"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">Expiry Date *</label>
                                    <input type="text" name="card_expiry" class="form-control card-expiry"
                                        placeholder="MM/YY">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">CVV *</label>
                                    <input type="text" name="card_cvv" class="form-control card-cvv" placeholder="123"
                                        maxlength="4">
                                    <small class="text-muted">3 or 4 digits on back of card</small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group form-group-full">
                                    <label class="form-label">Cardholder Name *</label>
                                    <input type="text" name="card_name" class="form-control card-name"
                                        placeholder="John Doe">
                                </div>
                            </div>
                        </div>

                        <!-- PayPal Info -->
                        <div id="paypalInfo" class="alert alert-info mt-3" style="display: none;">
                            <i class="fab fa-paypal me-2"></i>
                            <strong>PayPal Payment</strong>
                            <p class="mb-0">You will be redirected to PayPal to complete your payment securely.</p>
                        </div>

                        <!-- Bank Transfer Info -->
                        <div id="bankTransferInfo" class="alert alert-info mt-3" style="display: none;">
                            <i class="fas fa-university me-2"></i>
                            <strong>Bank Transfer</strong>
                            <p class="mb-0">After confirming your booking, we will send you our bank details for
                                transfer.</p>
                        </div>

                        <!-- Contact Agent Info -->
                        <div id="contactAgentInfo" class="alert alert-info mt-3" style="display: none;">
                            <i class="fas fa-headset me-2"></i>
                            <strong>Contact Agent Payment</strong>
                            <p class="mb-0">Our booking agent will contact you within 24 hours to complete your payment
                                and confirm your booking.</p>
                            <div class="mt-2">
                                <small><strong>Available:</strong> Monday - Sunday, 8:00 AM - 10:00 PM</small><br>
                                <small><strong>Phone:</strong> +1 (555) 123-4567</small>
                            </div>
                        </div>

                        <!-- Billing Address -->
                        <div id="billingAddress" class="payment-details-card mt-4" style="display: none;">
                            <h5 class="mb-3">Billing Address</h5>
                            <div class="form-row">
                                <div class="form-group form-group-full">
                                    <label class="form-label">Address Line 1</label>
                                    <input type="text" name="billing_address_1" class="form-control"
                                        placeholder="Street address">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group form-group-full">
                                    <label class="form-label">Address Line 2</label>
                                    <input type="text" name="billing_address_2" class="form-control"
                                        placeholder="Apartment, suite, unit (optional)">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">City</label>
                                    <input type="text" name="billing_city" class="form-control" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">State/Province</label>
                                    <input type="text" name="billing_state" class="form-control" placeholder="State">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label">ZIP/Postal Code</label>
                                    <input type="text" name="billing_zip" class="form-control" placeholder="ZIP code">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Country</label>
                                    <select name="billing_country" class="form-select">
                                        <option value="">Select Country</option>
                                        <option value="US">United States</option>
                                        <option value="QA">Qatar</option>
                                        <option value="GB">United Kingdom</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="SA">Saudi Arabia</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Security -->
                        <div class="payment-security mt-4">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="payment_terms" id="paymentTerms"
                                    required>
                                <label class="form-check-label" for="paymentTerms">
                                    I authorize Aero Trova to charge my payment method for the total amount of
                                    <strong>${{ number_format($booking->total_amount, 2) }}</strong>
                                </label>
                            </div>

                            <div class="security-badge">
                                <i class="fas fa-lock me-2"></i>
                                <span>Your payment is secured with SSL encryption</span>
                                <div class="security-icons mt-2">
                                    <i class="fab fa-cc-visa text-muted" title="Visa Secure"></i>
                                    <i class="fab fa-cc-mastercard text-muted" title="Mastercard SecureCode"></i>
                                    <i class="fas fa-shield-alt text-muted" title="PCI DSS Compliant"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ url()->previous() }}" class="btn-back">
                                <i class="fas fa-arrow-left me-2"></i> Back to Details
                            </a>
                            <button type="submit" class="btn-pay-now" id="submitButton">
                                <i class="fas fa-lock me-2"></i>
                                <span class="button-text">Complete Payment</span>
                                <div class="spinner-border spinner-border-sm ms-2 d-none" role="status"
                                    id="paymentSpinner">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Price Summary -->
                <div class="price-breakdown">
                    <h3 class="card-title mb-4">
                        <i class="fas fa-receipt"></i>
                        Price Summary
                    </h3>

                    <div class="price-row">
                        <span>Base Fare ({{ $booking->passenger_count }} {{ $booking->passenger_count > 1 ? 'Passengers'
                            : 'Passenger' }})</span>
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
                    <div class="price-row price-total">
                        <span>Total Amount</span>
                        <span>${{ number_format($booking->total_amount, 2) }}</span>
                    </div>

                    <!-- Booking Details -->
                    <div class="mt-4 pt-4 border-top">
                        <h5 class="mb-3">Booking Details</h5>
                        <div class="booking-details">
                            <div class="detail-item">
                                <strong>Booking Reference:</strong>
                                <span class="text-primary">{{ $booking->booking_reference }}</span>
                            </div>
                            <div class="detail-item">
                                <strong>Flight:</strong> {{ $booking->flight->flight_number }}
                            </div>
                            <div class="detail-item">
                                <strong>Route:</strong> {{ $booking->flight->departureAirport->code }} → {{
                                $booking->flight->arrivalAirport->code }}
                            </div>
                            <div class="detail-item">
                                <strong>Departure:</strong> {{ $booking->flight->departure_time->format('d M Y, H:i') }}
                            </div>
                            <div class="detail-item">
                                <strong>Airline:</strong> {{ $booking->flight->airline->name }}
                            </div>
                            <div class="detail-item">
                                <strong>Passengers:</strong> {{ $booking->passenger_count }}
                            </div>
                        </div>
                    </div>

                    <!-- Support Information -->
                    <div class="support-info mt-4 p-3 bg-light rounded">
                        <h6><i class="fas fa-life-ring me-2"></i>Need Help?</h6>
                        <p class="small mb-2">Our support team is here to help you with your payment.</p>
                        <div class="support-contact">
                            <div class="contact-item">
                                <i class="fas fa-phone me-2"></i>
                                <span>+1 (555) 123-4567</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-envelope me-2"></i>
                                <span>support@aerotrova.com</span>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-clock me-2"></i>
                                <span>24/7 Support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Modal -->
<div class="modal fade" id="processingModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Processing...</span>
                </div>
                <h6>Processing Payment...</h6>
                <p class="text-muted small mb-0">Please wait while we process your payment.</p>
                <p class="text-muted small">Do not refresh or close this page.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .payment-methods {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .payment-method {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 0;
        transition: all 0.3s ease;
    }

    .payment-method:hover {
        border-color: #007bff;
    }

    .payment-radio {
        display: none;
    }

    .payment-radio:checked+.payment-label {
        background-color: #f8f9fa;
        border-color: #007bff;
    }

    .payment-radio:checked+.payment-label::before {
        content: '✓';
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #007bff;
        font-weight: bold;
        font-size: 16px;
    }

    .payment-label {
        display: flex;
        align-items: center;
        padding: 15px;
        cursor: pointer;
        margin: 0;
        position: relative;
        transition: all 0.3s ease;
    }

    .payment-icons {
        display: flex;
        gap: 8px;
        margin-right: 15px;
        font-size: 24px;
    }

    .payment-text {
        display: flex;
        flex-direction: column;
    }

    .payment-name {
        font-weight: 600;
        margin-bottom: 2px;
    }

    .payment-details-card {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        border-left: 4px solid #007bff;
    }

    .card-icons {
        display: flex;
        gap: 10px;
    }

    .security-badge {
        background: #e8f5e8;
        border: 1px solid #28a745;
        border-radius: 6px;
        padding: 12px;
        text-align: center;
        color: #155724;
    }

    .security-icons {
        display: flex;
        justify-content: center;
        gap: 15px;
        font-size: 20px;
    }

    .support-contact {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        font-size: 14px;
    }

    .booking-details {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-pay-now {
        background: linear-gradient(135deg, #28a745, #20c997);
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        color: white;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-pay-now:hover {
        background: linear-gradient(135deg, #218838, #1e9e8a);
        transform: translateY(-1px);
    }

    .btn-pay-now:disabled {
        background: #6c757d;
        transform: none;
    }

    .btn-back {
        color: #6c757d;
        text-decoration: none;
        padding: 12px 20px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        color: #495057;
        background-color: #f8f9fa;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentRadios = document.querySelectorAll('.payment-radio');
        const cardPaymentForm = document.getElementById('cardPaymentForm');
        const paypalInfo = document.getElementById('paypalInfo');
        const bankTransferInfo = document.getElementById('bankTransferInfo');
        const contactAgentInfo = document.getElementById('contactAgentInfo');
        const billingAddress = document.getElementById('billingAddress');
        const paymentForm = document.getElementById('paymentForm');
        const submitButton = document.getElementById('submitButton');
        const buttonText = submitButton.querySelector('.button-text');
        const paymentSpinner = document.getElementById('paymentSpinner');

        // Payment method selection handler
        paymentRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Hide all additional forms and info
                cardPaymentForm.style.display = 'none';
                paypalInfo.style.display = 'none';
                bankTransferInfo.style.display = 'none';
                contactAgentInfo.style.display = 'none';
                billingAddress.style.display = 'none';

                // Remove required attributes from card fields when not selected
                const cardFields = cardPaymentForm.querySelectorAll('input, select');
                cardFields.forEach(field => {
                    field.removeAttribute('required');
                    field.removeAttribute('name');
                });

                // Remove required attributes from billing fields
                const billingFields = billingAddress.querySelectorAll('input, select');
                billingFields.forEach(field => {
                    field.removeAttribute('required');
                    field.removeAttribute('name');
                });

                // Show relevant form based on selection
                switch(this.value) {
                    case 'credit_card':
                    case 'debit_card':
                        cardPaymentForm.style.display = 'block';
                        billingAddress.style.display = 'block';
                        
                        // Add required attributes back to card fields
                        const cardInputs = cardPaymentForm.querySelectorAll('input');
                        cardInputs.forEach(input => {
                            input.setAttribute('required', 'required');
                            // Restore name attributes
                            const fieldName = input.classList[1].replace('card-', '');
                            input.setAttribute('name', fieldName);
                        });
                        
                        // Add required attributes to billing fields
                        const billingInputs = billingAddress.querySelectorAll('input, select');
                        billingInputs.forEach(input => {
                            input.setAttribute('required', 'required');
                            // Restore name attributes
                            const fieldName = input.getAttribute('name') || input.classList[0];
                            input.setAttribute('name', fieldName);
                        });
                        break;
                    case 'paypal':
                        paypalInfo.style.display = 'block';
                        break;
                    case 'bank_transfer':
                        bankTransferInfo.style.display = 'block';
                        break;
                    case 'contact_agent':
                        contactAgentInfo.style.display = 'block';
                        break;
                }

                // Update button text for contact agent
                if (this.value === 'contact_agent') {
                    buttonText.textContent = 'Confirm Booking';
                } else {
                    buttonText.textContent = 'Complete Payment';
                }
            });
        });

        // Card number formatting
        const cardNumberInput = document.querySelector('.card-number');
        if (cardNumberInput) {
            cardNumberInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
                let matches = value.match(/\d{4,16}/g);
                let match = matches && matches[0] || '';
                let parts = [];
                
                for (let i = 0; i < match.length; i += 4) {
                    parts.push(match.substring(i, i + 4));
                }
                
                if (parts.length) {
                    e.target.value = parts.join(' ');
                } else {
                    e.target.value = value;
                }
            });
        }

        // Expiry date formatting
        const expiryInput = document.querySelector('.card-expiry');
        if (expiryInput) {
            expiryInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
                if (value.length >= 2) {
                    e.target.value = value.substring(0, 2) + '/' + value.substring(2, 4);
                }
            });
        }

        // Form validation
        paymentForm.addEventListener('submit', function(e) {
            const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
            const termsAccepted = document.getElementById('paymentTerms').checked;

            if (!selectedPayment) {
                e.preventDefault();
                showAlert('Please select a payment method.', 'warning');
                return;
            }

            if (!termsAccepted) {
                e.preventDefault();
                showAlert('Please accept the payment terms to continue.', 'warning');
                return;
            }

            // Additional validation for card payments
            if (selectedPayment.value === 'credit_card' || selectedPayment.value === 'debit_card') {
                const cardNumber = document.querySelector('.card-number').value;
                const cardExpiry = document.querySelector('.card-expiry').value;
                const cardCVV = document.querySelector('.card-cvv').value;
                const cardName = document.querySelector('.card-name').value;

                if (!cardNumber || !cardExpiry || !cardCVV || !cardName) {
                    e.preventDefault();
                    showAlert('Please fill in all card details.', 'warning');
                    return;
                }

                // Basic card number validation
                const cleanCardNumber = cardNumber.replace(/\s/g, '');
                if (cleanCardNumber.length < 13 || cleanCardNumber.length > 19) {
                    e.preventDefault();
                    showAlert('Please enter a valid card number.', 'warning');
                    return;
                }

                // Expiry date validation
                const [month, year] = cardExpiry.split('/');
                if (!month || !year || month.length !== 2 || year.length !== 2) {
                    e.preventDefault();
                    showAlert('Please enter a valid expiry date (MM/YY).', 'warning');
                    return;
                }

                const currentDate = new Date();
                const currentYear = currentDate.getFullYear() % 100;
                const currentMonth = currentDate.getMonth() + 1;

                if (parseInt(month) < 1 || parseInt(month) > 12) {
                    e.preventDefault();
                    showAlert('Please enter a valid month (01-12).', 'warning');
                    return;
                }

                if (parseInt(year) < currentYear || (parseInt(year) === currentYear && parseInt(month) < currentMonth)) {
                    e.preventDefault();
                    showAlert('Your card has expired. Please check the expiry date.', 'warning');
                    return;
                }
            }

            // Show loading state
            submitButton.disabled = true;
            buttonText.textContent = 'Processing...';
            paymentSpinner.classList.remove('d-none');

            // For non-card payments, allow immediate submission
            if (selectedPayment.value !== 'credit_card' && selectedPayment.value !== 'debit_card') {
                return true;
            }
        });

        function showAlert(message, type = 'info') {
            // Remove existing alerts
            const existingAlert = document.querySelector('.payment-alert');
            if (existingAlert) {
                existingAlert.remove();
            }

            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show payment-alert mt-3`;
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            paymentForm.insertBefore(alertDiv, paymentForm.firstChild);

            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (alertDiv.parentNode) {
                    alertDiv.remove();
                }
            }, 5000);
        }
    });

    // Fix for the script.js error - prevent the error from breaking our functionality
    window.addEventListener('error', function(e) {
        if (e.message.includes('script.js') && e.message.includes('offsetHeight')) {
            e.preventDefault();
            console.log('Suppressed script.js error');
        }
    });
</script>
@endpush