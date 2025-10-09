document.addEventListener('DOMContentLoaded', function() {
    // Form tab switching
    const formTabs = document.querySelectorAll('.form-tab');
    const forms = document.querySelectorAll('.booking-form');
    
    formTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Update active tab
            formTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Show target form
            forms.forEach(form => {
                form.classList.remove('active');
                if (form.id === `${targetTab}-form`) {
                    form.classList.add('active');
                }
            });
        });
    });
    
    // Trip type handling
    const tripOptions = document.querySelectorAll('input[name="trip_type"]');
    const returnDateGroup = document.querySelector('.return-date');
    const returnDateInput = returnDateGroup.querySelector('input');
    
    tripOptions.forEach(option => {
        option.addEventListener('change', function() {
            if (this.value === 'roundtrip') {
                returnDateGroup.classList.add('active');
                returnDateInput.disabled = false;
                returnDateInput.required = true;
            } else {
                returnDateGroup.classList.remove('active');
                returnDateInput.disabled = true;
                returnDateInput.required = false;
            }
        });
    });
    
    // Swap locations
    const swapButton = document.getElementById('swapLocations');
    swapButton.addEventListener('click', function() {
        const fromInput = document.querySelector('input[name="from"]');
        const toInput = document.querySelector('input[name="to"]');
        const fromCode = document.querySelector('.location-input:first-child .location-code');
        const toCode = document.querySelector('.location-input:last-child .location-code');
        
        // Swap input values
        const tempFrom = fromInput.value;
        const tempCode = fromCode.textContent;
        
        fromInput.value = toInput.value;
        fromCode.textContent = toCode.textContent;
        
        toInput.value = tempFrom;
        toCode.textContent = tempCode;
        
        // Add animation
        this.style.transform = 'rotate(180deg)';
        setTimeout(() => {
            this.style.transform = 'rotate(0deg)';
        }, 300);
    });
    
    // Passenger selector
    const passengerSelector = document.getElementById('passengerSelector');
    const passengerDisplay = passengerSelector.querySelector('.passenger-display');
    const passengerDropdown = passengerSelector.querySelector('.passenger-dropdown');
    const passengerCounts = passengerSelector.querySelectorAll('.passenger-count');
    const passengerBtns = passengerSelector.querySelectorAll('.passenger-btn');
    const passengerHidden = document.querySelector('input[name="passengers"]');
    
    let adults = 1;
    let children = 0;
    let infants = 0;
    
    passengerDisplay.addEventListener('click', function(e) {
        e.stopPropagation();
        passengerSelector.classList.toggle('active');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function() {
        passengerSelector.classList.remove('active');
    });
    
    passengerDropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    // Passenger count controls
    passengerBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.closest('.passenger-type').querySelector('span').textContent.toLowerCase();
            const isPlus = this.classList.contains('plus');
            const countElement = this.parentElement.querySelector('.passenger-count');
            let count = parseInt(countElement.textContent);
            
            if (isPlus) {
                if (type === 'adults' && adults < 9) adults++;
                else if (type === 'children' && children < 9) children++;
                else if (type === 'infants' && infants < adults) infants++;
            } else {
                if (type === 'adults' && adults > 1) adults--;
                else if (type === 'children' && children > 0) children--;
                else if (type === 'infants' && infants > 0) infants--;
            }
            
            updatePassengerDisplay();
        });
    });
    
    function updatePassengerDisplay() {
        const totalPassengers = adults + children;
        passengerHidden.value = totalPassengers;
        
        let displayText = `${adults} Adult${adults > 1 ? 's' : ''}`;
        if (children > 0) displayText += `, ${children} Child${children > 1 ? 'ren' : ''}`;
        if (infants > 0) displayText += `, ${infants} Infant${infants > 1 ? 's' : ''}`;
        
        passengerDisplay.querySelector('span').textContent = displayText;
        
        // Update individual counts
        passengerCounts[0].textContent = adults;
        passengerCounts[1].textContent = children;
        passengerCounts[2].textContent = infants;
        
        // Update button states
        const minusBtns = passengerDropdown.querySelectorAll('.minus');
        minusBtns[0].disabled = adults <= 1;
        minusBtns[1].disabled = children <= 0;
        minusBtns[2].disabled = infants <= 0;
        
        const plusBtns = passengerDropdown.querySelectorAll('.plus');
        plusBtns[0].disabled = adults >= 9;
        plusBtns[1].disabled = children >= 9;
        plusBtns[2].disabled = infants >= adults;
    }
    
    // Date input enhancements
    const today = new Date().toISOString().split('T')[0];
    const dateInputs = document.querySelectorAll('input[type="date"]');
    
    dateInputs.forEach(input => {
        input.min = today;
        
        // Set return date to 7 days from today by default
        if (input.name === 'return_date') {
            const nextWeek = new Date();
            nextWeek.setDate(nextWeek.getDate() + 7);
            input.value = nextWeek.toISOString().split('T')[0];
        }
    });
    
    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observe elements for animation
    document.querySelectorAll('.feature-card, .destination-card, .offer-card').forEach(el => {
        observer.observe(el);
    });
    
    // Add loading animation to search button
    const searchForm = document.getElementById('flight-form');
    const searchBtn = searchForm.querySelector('.search-btn');
    
    searchForm.addEventListener('submit', function(e) {
        const originalText = searchBtn.innerHTML;
        searchBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Searching...';
        searchBtn.disabled = true;
        
        setTimeout(() => {
            searchBtn.innerHTML = originalText;
            searchBtn.disabled = false;
        }, 2000);
    });
    
    // Initialize
    updatePassengerDisplay();
});