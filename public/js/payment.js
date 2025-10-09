document.addEventListener('DOMContentLoaded', function() {
    // Payment method tabs
    const methodTabs = document.querySelectorAll('.method-tab');
    const paymentForms = document.querySelectorAll('.payment-form');
    const paymentMethodInput = document.createElement('input');
    paymentMethodInput.type = 'hidden';
    paymentMethodInput.name = 'payment_method';
    paymentMethodInput.value = 'credit_card';
    document.getElementById('paymentForm').appendChild(paymentMethodInput);

    methodTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const method = this.dataset.method;
            
            // Update active tab
            methodTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Show corresponding form
            paymentForms.forEach(form => {
                form.classList.remove('active');
                if (form.id === `${method}_form`) {
                    form.classList.add('active');
                }
            });
            
            // Update hidden input
            paymentMethodInput.value = method;
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
    const expiryInput = document.querySelector('input[name="expiry_date"]');
    if (expiryInput) {
        expiryInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });
    }

    // CVV input restriction
    const cvvInput = document.querySelector('.cvv');
    if (cvvInput) {
        cvvInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
        });
    }

    // Form validation
    const paymentForm = document.getElementById('paymentForm');
    const payNowBtn = document.getElementById('payNowBtn');
    const processingModal = document.getElementById('processingModal');

    paymentForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic validation
        const termsAgreed = document.querySelector('input[name="terms_agreed"]').checked;
        if (!termsAgreed) {
            alert('Please agree to the Terms & Conditions to proceed.');
            return;
        }

        // Method-specific validation
        const method = paymentMethodInput.value;
        let isValid = true;
        
        switch(method) {
            case 'credit_card':
            case 'debit_card':
                const cardNumber = document.querySelector('input[name="card_number"]').value.replace(/\s/g, '');
                const cardHolder = document.querySelector('input[name="card_holder"]').value;
                const expiryDate = document.querySelector('input[name="expiry_date"]').value;
                const cvv = document.querySelector('input[name="cvv"]').value;
                
                if (!cardNumber || cardNumber.length < 16) {
                    isValid = false;
                    alert('Please enter a valid card number.');
                } else if (!cardHolder) {
                    isValid = false;
                    alert('Please enter card holder name.');
                } else if (!expiryDate || !/^\d{2}\/\d{2}$/.test(expiryDate)) {
                    isValid = false;
                    alert('Please enter a valid expiry date (MM/YY).');
                } else if (!cvv || cvv.length < 3) {
                    isValid = false;
                    alert('Please enter a valid CVV.');
                }
                break;
                
            case 'paypal':
                const paypalEmail = document.querySelector('input[name="paypal_email"]').value;
                if (!paypalEmail || !isValidEmail(paypalEmail)) {
                    isValid = false;
                    alert('Please enter a valid PayPal email address.');
                }
                break;
                
            case 'bank_transfer':
                const bankName = document.querySelector('input[name="bank_name"]').value;
                const accountNumber = document.querySelector('input[name="account_number"]').value;
                if (!bankName) {
                    isValid = false;
                    alert('Please enter bank name.');
                } else if (!accountNumber) {
                    isValid = false;
                    alert('Please enter account number.');
                }
                break;
        }

        if (isValid) {
            // Show processing modal
            processingModal.classList.add('active');
            payNowBtn.disabled = true;
            
            // Simulate payment processing
            setTimeout(() => {
                // In real implementation, this would be an API call to your payment processor
                paymentForm.submit();
            }, 3000);
        }
    });

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Card type detection
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function(e) {
            const value = e.target.value.replace(/\s/g, '');
            let cardType = 'unknown';
            
            if (/^4/.test(value)) {
                cardType = 'visa';
            } else if (/^5[1-5]/.test(value)) {
                cardType = 'mastercard';
            } else if (/^3[47]/.test(value)) {
                cardType = 'amex';
            } else if (/^6(?:011|5)/.test(value)) {
                cardType = 'discover';
            }
            
            // You could add visual feedback for card type here
            console.log('Detected card type:', cardType);
        });
    }

    // Auto-fill for testing (remove in production)
    if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
        const testFillBtn = document.createElement('button');
        testFillBtn.type = 'button';
        testFillBtn.textContent = 'Fill Test Data';
        testFillBtn.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #ff6b00;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1000;
            font-size: 12px;
        `;
        testFillBtn.addEventListener('click', fillTestData);
        document.body.appendChild(testFillBtn);
    }

    function fillTestData() {
        // Fill credit card form
        document.querySelector('input[name="card_number"]').value = '4111 1111 1111 1111';
        document.querySelector('input[name="card_holder"]').value = 'John Doe';
        document.querySelector('input[name="expiry_date"]').value = '12/25';
        document.querySelector('input[name="cvv"]').value = '123';
        document.querySelector('input[name="terms_agreed"]').checked = true;
        
        alert('Test data filled! Use any future expiry date and 3-digit CVV.');
    }
});