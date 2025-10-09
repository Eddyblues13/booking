document.addEventListener('DOMContentLoaded', function() {
    // Filter Toggle
    const filterToggle = document.getElementById('filterToggle');
    const filtersSidebar = document.getElementById('filtersSidebar');
    
    filterToggle.addEventListener('click', function() {
        filtersSidebar.classList.toggle('active');
    });
    
    // Sort Modal
    const sortToggle = document.getElementById('sortToggle');
    const sortModal = document.getElementById('sortModal');
    const closeSortModal = document.getElementById('closeSortModal');
    const cancelSort = document.getElementById('cancelSort');
    const applySort = document.getElementById('applySort');
    const sortSelect = document.getElementById('sortSelect');
    
    sortToggle.addEventListener('click', function() {
        sortModal.classList.add('active');
    });
    
    function closeModal() {
        sortModal.classList.remove('active');
    }
    
    closeSortModal.addEventListener('click', closeModal);
    cancelSort.addEventListener('click', closeModal);
    
    applySort.addEventListener('click', function() {
        const selectedSort = document.querySelector('input[name="sort"]:checked');
        if (selectedSort) {
            sortSelect.value = selectedSort.value;
            sortFlights(selectedSort.value);
        }
        closeModal();
    });
    
    // Sort Functionality
    function sortFlights(sortBy) {
        const flightCards = Array.from(document.querySelectorAll('.flight-card'));
        const resultsContainer = document.querySelector('.flight-results');
        
        flightCards.sort((a, b) => {
            let aValue, bValue;
            
            switch(sortBy) {
                case 'price_asc':
                    aValue = parseFloat(a.dataset.price);
                    bValue = parseFloat(b.dataset.price);
                    return aValue - bValue;
                    
                case 'price_desc':
                    aValue = parseFloat(a.dataset.price);
                    bValue = parseFloat(b.dataset.price);
                    return bValue - aValue;
                    
                case 'duration_asc':
                    aValue = parseInt(a.dataset.duration);
                    bValue = parseInt(b.dataset.duration);
                    return aValue - bValue;
                    
                case 'departure_asc':
                    aValue = parseInt(a.dataset.departure);
                    bValue = parseInt(b.dataset.departure);
                    return aValue - bValue;
                    
                case 'departure_desc':
                    aValue = parseInt(a.dataset.departure);
                    bValue = parseInt(b.dataset.departure);
                    return bValue - aValue;
                    
                default:
                    return 0;
            }
        });
        
        // Clear and re-append sorted flights
        resultsContainer.innerHTML = '';
        flightCards.forEach(card => resultsContainer.appendChild(card));
    }
    
    sortSelect.addEventListener('change', function() {
        sortFlights(this.value);
    });
    
    // Filter Functionality
    const applyFiltersBtn = document.querySelector('.btn-apply-filters');
    
    applyFiltersBtn.addEventListener('click', function() {
        const priceRange = parseFloat(document.getElementById('priceRange').value);
        const selectedStops = Array.from(document.querySelectorAll('input[name="stops"]:checked')).map(cb => cb.value);
        const selectedAirlines = Array.from(document.querySelectorAll('input[name="airlines"]:checked')).map(cb => cb.value);
        const selectedTimes = Array.from(document.querySelectorAll('input[name="departure_time"]:checked')).map(cb => cb.value);
        
        const flightCards = document.querySelectorAll('.flight-card');
        
        flightCards.forEach(card => {
            let showCard = true;
            
            // Price filter
            const price = parseFloat(card.dataset.price);
            if (price > priceRange) {
                showCard = false;
            }
            
            // Stops filter
            const stops = card.dataset.stops;
            if (selectedStops.length > 0 && !selectedStops.includes(stops)) {
                showCard = false;
            }
            
            // Airlines filter
            const airline = card.dataset.airline;
            if (selectedAirlines.length > 0 && !selectedAirlines.includes(airline)) {
                showCard = false;
            }
            
            // Time filter
            if (selectedTimes.length > 0) {
                const departureTime = new Date(parseInt(card.dataset.departure) * 1000);
                const hours = departureTime.getHours();
                let timeCategory = '';
                
                if (hours >= 6 && hours < 12) timeCategory = 'morning';
                else if (hours >= 12 && hours < 18) timeCategory = 'afternoon';
                else timeCategory = 'evening';
                
                if (!selectedTimes.includes(timeCategory)) {
                    showCard = false;
                }
            }
            
            // Show/hide card
            card.style.display = showCard ? 'block' : 'none';
        });
        
        // Update results count
        const visibleCards = document.querySelectorAll('.flight-card[style="display: block"]');
        const resultsCount = document.querySelector('.results-count h2');
        resultsCount.textContent = `${visibleCards.length} Flights Found`;
    });
    
    // Price Range Slider
    const priceRange = document.getElementById('priceRange');
    const minPrice = document.getElementById('minPrice');
    const maxPrice = document.getElementById('maxPrice');
    
    priceRange.addEventListener('input', function() {
        maxPrice.value = this.value;
    });
    
    maxPrice.addEventListener('input', function() {
        priceRange.value = this.value;
    });
    
    // Flight Card Expand
    const flightCards = document.querySelectorAll('.flight-card');
    
    flightCards.forEach(card => {
        const header = card.querySelector('.flight-card-header');
        
        header.addEventListener('click', function(e) {
            if (!e.target.closest('.btn-select-flight')) {
                card.classList.toggle('expanded');
            }
        });
    });
    
    // Load More Functionality
    const loadMoreBtn = document.getElementById('loadMore');
    
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            const spinner = this.querySelector('.fa-spinner');
            this.classList.add('loading');
            spinner.style.display = 'inline-block';
            
            // Simulate API call
            setTimeout(() => {
                // In real implementation, this would fetch more data from the server
                this.classList.remove('loading');
                spinner.style.display = 'none';
                this.textContent = 'No More Flights';
                this.disabled = true;
            }, 2000);
        });
    }
    
    // Close modal when clicking outside
    sortModal.addEventListener('click', function(e) {
        if (e.target === sortModal) {
            closeModal();
        }
    });
});