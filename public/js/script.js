// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    const heroSection = document.querySelector('.hero-section');
    
    if (window.scrollY > heroSection.offsetHeight - 100) {
        navbar.classList.remove('transparent-nav');
        navbar.style.background = 'white';
        navbar.style.boxShadow = '0 2px 4px rgba(0, 0, 0, 0.08)';
        
        // Change navbar text color for better contrast
        const navLinks = document.querySelectorAll('.transparent-nav .nav-link');
        navLinks.forEach(link => {
            link.style.color = '#333';
        });
    } else {
        navbar.classList.add('transparent-nav');
        navbar.style.background = 'transparent';
        navbar.style.boxShadow = 'none';
        
        // Reset navbar text color
        const navLinks = document.querySelectorAll('.transparent-nav .nav-link');
        navLinks.forEach(link => {
            link.style.color = 'white';
        });
    }
});

// Collapsible booking form for mobile
document.addEventListener('DOMContentLoaded', function() {
    const bookingHeader = document.querySelector('.booking-header');
    const collapseIcon = document.querySelector('.collapse-icon');
    
    if (bookingHeader) {
        bookingHeader.addEventListener('click', function() {
            collapseIcon.classList.toggle('collapsed');
        });
    }
    
    // Swap button functionality
    const swapButton = document.querySelector('.btn-swap');
    if (swapButton) {
        swapButton.addEventListener('click', function() {
            const fromInput = document.querySelector('input[placeholder="From"]');
            const toInput = document.querySelector('input[placeholder="To"]');
            
            if (fromInput && toInput) {
                const tempValue = fromInput.value;
                fromInput.value = toInput.value;
                toInput.value = tempValue;
            }
        });
    }
    
    // Add animation to destination cards
    const destinationCards = document.querySelectorAll('.destination-card');
    destinationCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Auto-rotate destination cards in phone mockup
    let currentCard = 0;
    const cards = document.querySelectorAll('.destination-card');
    
    if (cards.length > 0) {
        setInterval(() => {
            cards.forEach(card => card.classList.remove('featured'));
            currentCard = (currentCard + 1) % cards.length;
            cards[currentCard].classList.add('featured');
            
            // Update nav dots
            const dots = document.querySelectorAll('.nav-dots .dot');
            dots.forEach((dot, index) => {
                if (index === currentCard) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }, 4000);
    }
});




