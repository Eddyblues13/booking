<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aero Trova - Book Flights & Manage Your Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    // Current passenger selection
    let passengerSelection = {
        adults: 1,
        children: 0,
        infants: 0,
        class: 'economy'
    };

    // Airport search functionality
    const setupAirportSearch = (inputElement, dropdownElement) => {
        let debounceTimer;
        
        // Show dropdown on focus
        inputElement.addEventListener('focus', function() {
            const query = this.value.trim();
            if (query.length >= 2) {
                searchAirports(query, dropdownElement);
            } else {
                // Show popular airports when empty
                showPopularAirports(dropdownElement);
            }
        });
        
        inputElement.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();
            
            if (query.length < 2) {
                if (query.length === 0) {
                    showPopularAirports(dropdownElement);
                } else {
                    dropdownElement.classList.remove('show');
                }
                return;
            }
            
            debounceTimer = setTimeout(() => {
                searchAirports(query, dropdownElement);
            }, 300);
        });
        
        // Select airport from dropdown
        dropdownElement.addEventListener('click', function(e) {
            const airportItem = e.target.closest('.airport-item');
            if (airportItem && !airportItem.classList.contains('no-results')) {
                const airportCode = airportItem.getAttribute('data-code');
                const airportName = airportItem.getAttribute('data-name');
                const airportCity = airportItem.getAttribute('data-city');
                const airportCountry = airportItem.getAttribute('data-country');
                
                inputElement.value = `${airportCity}, ${airportCountry} (${airportCode})`;
                dropdownElement.classList.remove('show');
                
                // Trigger change event for form validation
                inputElement.dispatchEvent(new Event('change', { bubbles: true }));
            }
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-input-wrapper')) {
                dropdownElement.classList.remove('show');
            }
        });
        
        // Close dropdown on escape key
        inputElement.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                dropdownElement.classList.remove('show');
            }
        });
    };
    
    async function searchAirports(query, dropdownElement) {
        try {
            const response = await fetch(`/api/airports?query=${encodeURIComponent(query)}`);
            
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            
            const airports = await response.json();
            
            let html = '';
            if (airports.length > 0) {
                airports.forEach(airport => {
                    html += `
                        <div class="airport-item" 
                             data-code="${airport.code}" 
                             data-name="${airport.name}" 
                             data-city="${airport.city}" 
                             data-country="${airport.country}">
                            <div class="flex-grow-1">
                                <div class="airport-name">${airport.name}</div>
                                <div class="airport-city">${airport.city}, ${airport.country}</div>
                            </div>
                            <span class="airport-code">${airport.code}</span>
                        </div>
                    `;
                });
            } else {
                html = '<div class="airport-item no-results">No airports found</div>';
            }
            
            dropdownElement.innerHTML = html;
            dropdownElement.classList.add('show');
        } catch (error) {
            console.error('Error fetching airports:', error);
            dropdownElement.innerHTML = '<div class="airport-item no-results">Error loading airports. Please try again.</div>';
            dropdownElement.classList.add('show');
        }
    }
    
    function showPopularAirports(dropdownElement) {
        const popularAirports = [
            { code: 'DOH', name: 'Hamad International Airport', city: 'Doha', country: 'Qatar' },
            { code: 'DXB', name: 'Dubai International Airport', city: 'Dubai', country: 'UAE' },
            { code: 'LHR', name: 'Heathrow Airport', city: 'London', country: 'UK' },
            { code: 'JFK', name: 'John F. Kennedy Airport', city: 'New York', country: 'USA' },
            { code: 'CDG', name: 'Charles de Gaulle Airport', city: 'Paris', country: 'France' }
        ];
        
        let html = '<div class="airport-item no-results" style="font-weight: 600; color: #333;">Popular Airports</div>';
        
        popularAirports.forEach(airport => {
            html += `
                <div class="airport-item" 
                     data-code="${airport.code}" 
                     data-name="${airport.name}" 
                     data-city="${airport.city}" 
                     data-country="${airport.country}">
                    <div class="flex-grow-1">
                        <div class="airport-name">${airport.name}</div>
                        <div class="airport-city">${airport.city}, ${airport.country}</div>
                    </div>
                    <span class="airport-code">${airport.code}</span>
                </div>
            `;
        });
        
        dropdownElement.innerHTML = html;
        dropdownElement.classList.add('show');
    }
    
    // Initialize airport search for both from and to inputs
    const fromInput = document.getElementById('fromInput');
    const toInput = document.getElementById('toInput');
    const fromDropdown = document.getElementById('fromDropdown');
    const toDropdown = document.getElementById('toDropdown');
    
    if (fromInput && fromDropdown) {
        setupAirportSearch(fromInput, fromDropdown);
        
        // Set default value for from input
        fromInput.value = "Doha, Qatar (DOH)";
    }
    
    if (toInput && toDropdown) {
        setupAirportSearch(toInput, toDropdown);
        
        // Set default value for to input
        toInput.value = "London, UK (LHR)";
    }

    // Swap from/to locations
    const swapBtn = document.querySelector('.btn-swap');
    if (swapBtn) {
        swapBtn.addEventListener('click', function() {
            const fromInput = document.getElementById('fromInput');
            const toInput = document.getElementById('toInput');
            const temp = fromInput.value;
            fromInput.value = toInput.value;
            toInput.value = temp;
        });
    }

    // Handle trip type changes
    const tripTypeRadios = document.querySelectorAll('input[name="tripType"]');
    const returnDateField = document.querySelector('.return-date-field');
    
    tripTypeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'oneway') {
                returnDateField.classList.add('oneway');
                returnDateField.querySelector('input').disabled = true;
            } else {
                returnDateField.classList.remove('oneway');
                returnDateField.querySelector('input').disabled = false;
            }
        });
    });

    // Calendar functionality
    let selectedDate = null;
    let currentModalType = null;
    
    const generateCalendar = (month, year, modalType) => {
        const calendarGrid = document.querySelector(`#${modalType}Calendar .calendar-grid`);
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        
        document.querySelector(`#${modalType}Calendar .current-month`).textContent = `${monthNames[month]} ${year}`;
        
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();
        
        let calendarHTML = '';
        
        // Add day headers
        const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        dayNames.forEach(day => {
            calendarHTML += `<div class="calendar-day text-muted small fw-bold">${day}</div>`;
        });
        
        // Add empty cells for days before the first day of the month
        for (let i = 0; i < firstDay; i++) {
            calendarHTML += '<div class="calendar-day"></div>';
        }
        
        // Add days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const currentDate = new Date(year, month, day);
            const isToday = currentDate.toDateString() === today.toDateString();
            const isPast = currentDate < new Date(today.getFullYear(), today.getMonth(), today.getDate());
            const isSelected = selectedDate && currentDate.toDateString() === selectedDate.toDateString();
            
            let dayClass = 'calendar-day';
            if (isToday) dayClass += ' today';
            if (isPast) dayClass += ' disabled';
            if (isSelected) dayClass += ' selected';
            
            calendarHTML += `<div class="${dayClass}" data-day="${day}" data-month="${month}" data-year="${year}">${day}</div>`;
        }
        
        calendarGrid.innerHTML = calendarHTML;
        
        // Add click event to calendar days
        calendarGrid.querySelectorAll('.calendar-day:not(.disabled)').forEach(day => {
            day.addEventListener('click', function() {
                if (!this.classList.contains('disabled')) {
                    // Remove selected class from all days
                    calendarGrid.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
                    // Add selected class to clicked day
                    this.classList.add('selected');
                    
                    const day = this.getAttribute('data-day');
                    const month = this.getAttribute('data-month');
                    const year = this.getAttribute('data-year');
                    selectedDate = new Date(year, month, day);
                    currentModalType = modalType;
                }
            });
        });
    };
    
    // Initialize calendars when modals are shown
    document.getElementById('departureCalendar')?.addEventListener('show.bs.modal', function() {
        const today = new Date();
        generateCalendar(today.getMonth(), today.getFullYear(), 'departure');
    });
    
    document.getElementById('returnCalendar')?.addEventListener('show.bs.modal', function() {
        const today = new Date();
        generateCalendar(today.getMonth(), today.getFullYear(), 'return');
    });
    
    // Calendar navigation
    document.querySelectorAll('.prev-month').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.calendar-modal');
            const currentMonthEl = modal.querySelector('.current-month');
            const [monthName, year] = currentMonthEl.textContent.split(' ');
            const monthIndex = new Date(Date.parse(monthName + " 1, " + year)).getMonth();
            let newMonth = monthIndex - 1;
            let newYear = parseInt(year);
            
            if (newMonth < 0) {
                newMonth = 11;
                newYear--;
            }
            
            const modalType = modal.id.replace('Calendar', '');
            generateCalendar(newMonth, newYear, modalType);
        });
    });
    
    document.querySelectorAll('.next-month').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.calendar-modal');
            const currentMonthEl = modal.querySelector('.current-month');
            const [monthName, year] = currentMonthEl.textContent.split(' ');
            const monthIndex = new Date(Date.parse(monthName + " 1, " + year)).getMonth();
            let newMonth = monthIndex + 1;
            let newYear = parseInt(year);
            
            if (newMonth > 11) {
                newMonth = 0;
                newYear++;
            }
            
            const modalType = modal.id.replace('Calendar', '');
            generateCalendar(newMonth, newYear, modalType);
        });
    });
    
    // Confirm date selection
    document.getElementById('confirmDepartureDate')?.addEventListener('click', function() {
        if (selectedDate) {
            const formattedDate = selectedDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
            document.querySelector('input[name="departure_date"]').value = formattedDate;
        }
    });
    
    document.getElementById('confirmReturnDate')?.addEventListener('click', function() {
        if (selectedDate) {
            const formattedDate = selectedDate.toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
            document.querySelector('input[name="return_date"]').value = formattedDate;
        }
    });
    
    // Passenger counter functionality
    document.querySelectorAll('.counter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const valueElement = document.querySelector(`.counter-value[data-type="${type}"]`);
            let value = parseInt(valueElement.textContent);
            
            if (this.classList.contains('increase')) {
                value++;
                // Business rules
                if (type === 'infants' && value > passengerSelection.adults) {
                    value = passengerSelection.adults;
                }
                if (type === 'adults' && value < passengerSelection.infants) {
                    passengerSelection.infants = value;
                    document.querySelector('.counter-value[data-type="infants"]').textContent = value;
                }
            } else if (this.classList.contains('decrease') && value > 0) {
                value--;
                // Business rules
                if (type === 'adults' && value < passengerSelection.infants) {
                    passengerSelection.infants = value;
                    document.querySelector('.counter-value[data-type="infants"]').textContent = value;
                }
            }
            
            valueElement.textContent = value;
            passengerSelection[type] = value;
            
            // Update hidden inputs
            document.querySelector('input[name="adults"]').value = passengerSelection.adults;
            document.querySelector('input[name="children"]').value = passengerSelection.children;
            document.querySelector('input[name="infants"]').value = passengerSelection.infants;
        });
    });
    
    // Travel class selection
    document.getElementById('travelClass')?.addEventListener('change', function() {
        passengerSelection.class = this.value;
        document.querySelector('input[name="class"]').value = this.value;
    });
    
    // Confirm passenger selection
    document.getElementById('confirmPassengers')?.addEventListener('click', function() {
        const totalPassengers = passengerSelection.adults + passengerSelection.children;
        const classNames = {
            economy: 'Economy',
            premium_economy: 'Premium Economy',
            business: 'Business',
            first: 'First'
        };
        
        const passengerText = totalPassengers === 1 ? '1 Passenger' : `${totalPassengers} Passengers`;
        const classText = classNames[passengerSelection.class];
        
        document.querySelector('.passenger-input').value = `${passengerText}, ${classText}`;
    });
    
    // Form validation and submission
    const searchForm = document.getElementById('searchForm');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const fromInput = document.getElementById('fromInput');
            const toInput = document.getElementById('toInput');
            
            if (!fromInput.value.trim() || !toInput.value.trim()) {
                alert('Please select both departure and arrival locations.');
                return false;
            }
            
            if (fromInput.value === toInput.value) {
                alert('Departure and arrival airports cannot be the same.');
                return false;
            }
            
            // Show loading state
            const submitButton = this.querySelector('#searchButton');
            const originalText = submitButton.innerHTML;
            submitButton.innerHTML = '<i class="bi bi-search me-2"></i> Searching...';
            submitButton.disabled = true;
            
            // Submit the form
            this.submit();
        });
    }

    // Mobile collapsible functionality
    const bookingHeader = document.querySelector('.booking-header');
    if (bookingHeader) {
        bookingHeader.addEventListener('click', function() {
            const icon = this.querySelector('.collapse-icon');
            icon.classList.toggle('collapsed');
        });
    }

    // Debug: Check if elements exist
    console.log('From input:', fromInput);
    console.log('To input:', toInput);
    console.log('From dropdown:', fromDropdown);
    console.log('To dropdown:', toDropdown);
});
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>