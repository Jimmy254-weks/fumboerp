/* ===== MAIN JAVASCRIPT ===== */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all components
    initNavigation();
    initScrollEffects();
    initAnimations();
    initForms();
    initTestimonials();
    initModulesFilter();
    initCounters();
    initTooltips();
});

/* ===== NAVIGATION ===== */
function initNavigation() {
    const header = document.querySelector('.site-header');
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const userBtn = document.querySelector('.user-btn');
    
    // Header scroll effect
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
    
    // Mobile menu toggle
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
            document.body.classList.toggle('nav-open');
            
            // Close dropdowns when opening mobile menu
            if (navMenu.classList.contains('active')) {
                closeAllDropdowns();
            }
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.navbar') && navMenu.classList.contains('active')) {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.classList.remove('nav-open');
            }
        });
        
        // Close mobile menu when clicking a link
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function() {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.classList.remove('nav-open');
            });
        });
    }
    
    // User dropdown
    if (userBtn) {
        const dropdown = userBtn.closest('.user-dropdown').querySelector('.dropdown-menu');
        
        userBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            dropdown.classList.remove('show');
        });
    }
}

/* ===== SCROLL EFFECTS ===== */
function initScrollEffects() {
    // Reveal elements on scroll
    const revealElements = document.querySelectorAll('.fade-in-up');
    
    const revealOnScroll = function() {
        revealElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const elementVisible = 150;
            
            if (elementTop < window.innerHeight - elementVisible) {
                element.classList.add('active');
            }
        });
    };
    
    // Initial check
    revealOnScroll();
    
    // Check on scroll
    window.addEventListener('scroll', revealOnScroll);
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if (href === '#') return;
            
            e.preventDefault();
            
            const targetElement = document.querySelector(href);
            if (targetElement) {
                const headerHeight = document.querySelector('.site-header').offsetHeight;
                const targetPosition = targetElement.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

/* ===== ANIMATIONS ===== */
function initAnimations() {
    // Parallax effect
    const parallaxElements = document.querySelectorAll('.parallax');
    
    if (parallaxElements.length > 0) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            
            parallaxElements.forEach(element => {
                const speed = element.getAttribute('data-speed') || 0.5;
                const yPos = -(scrolled * speed);
                element.style.transform = `translate3d(0, ${yPos}px, 0)`;
            });
        });
    }
    
    // Staggered animations
    const staggeredItems = document.querySelectorAll('.stagger-item');
    
    if (staggeredItems.length > 0) {
        staggeredItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
        });
    }
}

/* ===== FORMS ===== */
function initForms() {
    // Auto-hide flash messages
    const flashMessages = document.querySelectorAll('.flash-message');
    
    flashMessages.forEach(message => {
        setTimeout(() => {
            message.style.opacity = '0';
            setTimeout(() => message.remove(), 300);
        }, 5000);
        
        // Close button for flash messages
        const closeBtn = document.createElement('button');
        closeBtn.innerHTML = '&times;';
        closeBtn.className = 'flash-close';
        closeBtn.style.cssText = `
            background: none;
            border: none;
            color: inherit;
            font-size: 1.5rem;
            cursor: pointer;
            margin-left: 10px;
            padding: 0;
            line-height: 1;
        `;
        
        closeBtn.addEventListener('click', function() {
            message.style.opacity = '0';
            setTimeout(() => message.remove(), 300);
        });
        
        message.style.display = 'flex';
        message.style.justifyContent = 'space-between';
        message.style.alignItems = 'center';
        message.appendChild(closeBtn);
    });
    
    // Form validation
    const forms = document.querySelectorAll('form[data-validate]');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
    });
    
    // Real-time validation
    document.querySelectorAll('.form-control').forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('error')) {
                validateField(this);
            }
        });
    });
}

/* ===== TESTIMONIALS ===== */
function initTestimonials() {
    const testimonialsContainer = document.querySelector('.testimonial-slider');
    
    if (!testimonialsContainer) return;
    
    // Create testimonial slider if there are multiple testimonials
    const testimonials = testimonialsContainer.querySelectorAll('.testimonial-card');
    
    if (testimonials.length > 1) {
        let currentIndex = 0;
        let autoSlideInterval;
        
        // Create navigation dots
        const dotsContainer = document.createElement('div');
        dotsContainer.className = 'testimonial-dots';
        dotsContainer.style.cssText = `
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        `;
        
        testimonials.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.className = 'testimonial-dot';
            dot.setAttribute('data-index', index);
            dot.innerHTML = '●';
            dot.style.cssText = `
                background: none;
                border: none;
                color: var(--light-gray);
                font-size: 1.5rem;
                cursor: pointer;
                padding: 0;
                line-height: 1;
                transition: color 0.3s ease;
            `;
            
            dot.addEventListener('click', () => goToSlide(index));
            dotsContainer.appendChild(dot);
        });
        
        testimonialsContainer.appendChild(dotsContainer);
        
        // Create navigation arrows
        const prevBtn = document.createElement('button');
        prevBtn.innerHTML = '❮';
        prevBtn.className = 'testimonial-prev';
        prevBtn.style.cssText = `
            position: absolute;
            left: -50px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 2rem;
            color: var(--primary-color);
            cursor: pointer;
            padding: 10px;
        `;
        
        const nextBtn = document.createElement('button');
        nextBtn.innerHTML = '❯';
        nextBtn.className = 'testimonial-next';
        nextBtn.style.cssText = `
            position: absolute;
            right: -50px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 2rem;
            color: var(--primary-color);
            cursor: pointer;
            padding: 10px;
        `;
        
        prevBtn.addEventListener('click', () => prevSlide());
        nextBtn.addEventListener('click', () => nextSlide());
        
        testimonialsContainer.style.position = 'relative';
        testimonialsContainer.appendChild(prevBtn);
        testimonialsContainer.appendChild(nextBtn);
        
        // Function to go to specific slide
        function goToSlide(index) {
            testimonials.forEach(testimonial => {
                testimonial.style.display = 'none';
            });
            
            currentIndex = index;
            testimonials[currentIndex].style.display = 'block';
            
            // Update dots
            updateDots();
        }
        
        // Function for next slide
        function nextSlide() {
            currentIndex = (currentIndex + 1) % testimonials.length;
            goToSlide(currentIndex);
        }
        
        // Function for previous slide
        function prevSlide() {
            currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
            goToSlide(currentIndex);
        }
        
        // Function to update dots
        function updateDots() {
            dotsContainer.querySelectorAll('.testimonial-dot').forEach((dot, index) => {
                dot.style.color = index === currentIndex ? 'var(--primary-color)' : 'var(--light-gray)';
            });
        }
        
        // Auto slide
        function startAutoSlide() {
            autoSlideInterval = setInterval(nextSlide, 5000);
        }
        
        function stopAutoSlide() {
            clearInterval(autoSlideInterval);
        }
        
        // Initialize
        goToSlide(0);
        startAutoSlide();
        
        // Pause on hover
        testimonialsContainer.addEventListener('mouseenter', stopAutoSlide);
        testimonialsContainer.addEventListener('mouseleave', startAutoSlide);
    }
}

/* ===== MODULES FILTER ===== */
function initModulesFilter() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const moduleCards = document.querySelectorAll('.module-card');
    
    if (filterButtons.length === 0 || moduleCards.length === 0) return;
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter modules
            moduleCards.forEach(card => {
                const category = card.getAttribute('data-category');
                
                if (filter === 'all' || category === filter) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
}

/* ===== COUNTERS ===== */
function initCounters() {
    const counters = document.querySelectorAll('.counter');
    
    if (counters.length === 0) return;
    
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.5
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = +counter.getAttribute('data-target');
                const duration = +counter.getAttribute('data-duration') || 2000;
                const increment = target / (duration / 16); // 60fps
                let current = 0;
                
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                updateCounter();
                observer.unobserve(counter);
            }
        });
    }, observerOptions);
    
    counters.forEach(counter => observer.observe(counter));
}

/* ===== TOOLTIPS ===== */
function initTooltips() {
    const tooltipElements = document.querySelectorAll('[data-tooltip]');
    
    tooltipElements.forEach(element => {
        element.addEventListener('mouseenter', function(e) {
            const tooltipText = this.getAttribute('data-tooltip');
            const tooltip = document.createElement('div');
            
            tooltip.className = 'tooltip';
            tooltip.textContent = tooltipText;
            tooltip.style.cssText = `
                position: absolute;
                background: var(--dark-color);
                color: white;
                padding: 5px 10px;
                border-radius: 4px;
                font-size: 0.875rem;
                white-space: nowrap;
                z-index: 1000;
                pointer-events: none;
                transform: translateY(5px);
                opacity: 0;
                transition: opacity 0.2s ease, transform 0.2s ease;
            `;
            
            document.body.appendChild(tooltip);
            
            const rect = this.getBoundingClientRect();
            tooltip.style.left = `${rect.left + rect.width / 2 - tooltip.offsetWidth / 2}px`;
            tooltip.style.top = `${rect.top - tooltip.offsetHeight - 10}px`;
            
            setTimeout(() => {
                tooltip.style.opacity = '1';
                tooltip.style.transform = 'translateY(0)';
            }, 10);
            
            this._tooltip = tooltip;
        });
        
        element.addEventListener('mouseleave', function() {
            if (this._tooltip) {
                this._tooltip.style.opacity = '0';
                this._tooltip.style.transform = 'translateY(5px)';
                
                setTimeout(() => {
                    if (this._tooltip && this._tooltip.parentNode) {
                        this._tooltip.parentNode.removeChild(this._tooltip);
                    }
                    delete this._tooltip;
                }, 200);
            }
        });
    });
}

/* ===== HELPER FUNCTIONS ===== */
function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('.form-control[required]');
    
    inputs.forEach(input => {
        if (!validateField(input)) {
            isValid = false;
        }
    });
    
    return isValid;
}

function validateField(input) {
    const value = input.value.trim();
    const type = input.getAttribute('type');
    const errorElement = input.nextElementSibling?.classList.contains('form-text') 
        ? input.nextElementSibling 
        : null;
    
    let error = '';
    
    // Required validation
    if (input.hasAttribute('required') && !value) {
        error = 'This field is required';
    }
    
    // Email validation
    if (type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            error = 'Please enter a valid email address';
        }
    }
    
    // Password validation
    if (type === 'password' && value) {
        if (value.length < 8) {
            error = 'Password must be at least 8 characters';
        }
    }
    
    // Phone validation
    if (input.getAttribute('name') === 'phone' && value) {
        const phoneRegex = /^[\d\s\-\+\(\)]{10,}$/;
        if (!phoneRegex.test(value)) {
            error = 'Please enter a valid phone number';
        }
    }
    
    // Update UI
    if (error) {
        input.classList.add('error');
        if (errorElement) {
            errorElement.textContent = error;
            errorElement.classList.add('error');
        }
        return false;
    } else {
        input.classList.remove('error');
        if (errorElement) {
            errorElement.textContent = '';
            errorElement.classList.remove('error');
        }
        return true;
    }
}

function closeAllDropdowns() {
    document.querySelectorAll('.dropdown-menu').forEach(dropdown => {
        dropdown.classList.remove('show');
    });
}

// Export functions for use in other files
window.FUMBO = window.FUMBO || {};
window.FUMBO.utils = {
    validateForm,
    validateField,
    closeAllDropdowns
};