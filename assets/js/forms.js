/* ===== FORMS JAVASCRIPT ===== */

document.addEventListener('DOMContentLoaded', function() {
    initDemoForm();
    initPasswordToggle();
    initFileUploads();
    initFormAnimations();
});

/* ===== DEMO FORM ===== */
function initDemoForm() {
    const demoForm = document.getElementById('demoForm');
    if (!demoForm) return;
    
    const steps = demoForm.querySelectorAll('.demo-step');
    const nextButtons = demoForm.querySelectorAll('.btn-next');
    const prevButtons = demoForm.querySelectorAll('.btn-prev');
    const progressBar = document.querySelector('.demo-progress');
    let currentStep = 0;
    
    // Initialize steps
    updateSteps();
    
    // Next button handlers
    nextButtons.forEach((button, index) => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (validateStep(currentStep)) {
                currentStep++;
                updateSteps();
                
                // Scroll to top of form
                demoForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
    
    // Previous button handlers
    prevButtons.forEach((button, index) => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            currentStep--;
            updateSteps();
            
            // Scroll to top of form
            demoForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
    
    // Form submission
    demoForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateStep(currentStep)) {
            // Show loading state
            const submitBtn = demoForm.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
            submitBtn.disabled = true;
            
            // Simulate API call
            setTimeout(() => {
                // In production, this would be an actual form submission
                alert('Demo request submitted successfully! We will contact you within 24 hours.');
                demoForm.reset();
                currentStep = 0;
                updateSteps();
                
                // Reset button
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
                
                // Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }, 1500);
        }
    });
    
    // Function to update steps UI
    function updateSteps() {
        steps.forEach((step, index) => {
            if (index === currentStep) {
                step.classList.add('active');
                step.style.display = 'block';
            } else {
                step.classList.remove('active');
                step.style.display = 'none';
            }
        });
        
        // Update progress bar if exists
        if (progressBar) {
            const progress = ((currentStep + 1) / steps.length) * 100;
            progressBar.style.width = `${progress}%`;
        }
        
        // Update step indicators
        const stepIndicators = document.querySelectorAll('.step-number');
        stepIndicators.forEach((indicator, index) => {
            if (index === currentStep) {
                indicator.classList.add('active');
            } else if (index < currentStep) {
                indicator.classList.add('completed');
                indicator.innerHTML = '✓';
            } else {
                indicator.classList.remove('active', 'completed');
                indicator.innerHTML = index + 1;
            }
        });
    }
    
    // Function to validate current step
    function validateStep(stepIndex) {
        const currentStepElement = steps[stepIndex];
        const inputs = currentStepElement.querySelectorAll('.form-control[required]');
        let isValid = true;
        
        inputs.forEach(input => {
            if (!window.FUMBO.utils.validateField(input)) {
                isValid = false;
                
                // Scroll to first invalid input
                if (isValid === false) {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    input.focus();
                }
            }
        });
        
        return isValid;
    }
}

/* ===== PASSWORD TOGGLE ===== */
function initPasswordToggle() {
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    
    passwordInputs.forEach(input => {
        // Create toggle button
        const toggleBtn = document.createElement('button');
        toggleBtn.type = 'button';
        toggleBtn.className = 'password-toggle';
        toggleBtn.innerHTML = '<i class="fas fa-eye"></i>';
        toggleBtn.style.cssText = `
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-color);
            cursor: pointer;
            padding: 5px;
        `;
        
        // Wrap input in a container
        const wrapper = document.createElement('div');
        wrapper.style.position = 'relative';
        input.parentNode.insertBefore(wrapper, input);
        wrapper.appendChild(input);
        wrapper.appendChild(toggleBtn);
        
        // Toggle functionality
        toggleBtn.addEventListener('click', function() {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Update icon
            const icon = this.querySelector('i');
            icon.className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
        });
    });
}

/* ===== FILE UPLOADS ===== */
function initFileUploads() {
    const fileInputs = document.querySelectorAll('input[type="file"]');
    
    fileInputs.forEach(input => {
        // Create custom file upload UI
        const customUpload = document.createElement('div');
        customUpload.className = 'custom-file-upload';
        customUpload.style.cssText = `
            border: 2px dashed var(--light-gray);
            border-radius: var(--radius-md);
            padding: var(--spacing-lg);
            text-align: center;
            cursor: pointer;
            transition: var(--transition-normal);
            margin-bottom: var(--spacing-md);
        `;
        
        const uploadIcon = document.createElement('div');
        uploadIcon.innerHTML = '<i class="fas fa-cloud-upload-alt"></i>';
        uploadIcon.style.cssText = `
            font-size: 2.5rem;
            color: var(--gray-color);
            margin-bottom: var(--spacing-sm);
        `;
        
        const uploadText = document.createElement('div');
        uploadText.className = 'upload-text';
        uploadText.textContent = 'Click to upload or drag and drop';
        uploadText.style.marginBottom = 'var(--spacing-xs)';
        
        const uploadHint = document.createElement('div');
        uploadHint.className = 'upload-hint';
        uploadHint.textContent = 'Maximum file size: 5MB';
        uploadHint.style.cssText = `
            font-size: 0.875rem;
            color: var(--gray-color);
        `;
        
        const fileName = document.createElement('div');
        fileName.className = 'file-name';
        fileName.style.cssText = `
            margin-top: var(--spacing-sm);
            font-weight: 500;
            color: var(--primary-color);
            display: none;
        `;
        
        customUpload.appendChild(uploadIcon);
        customUpload.appendChild(uploadText);
        customUpload.appendChild(uploadHint);
        customUpload.appendChild(fileName);
        
        // Hide original input
        input.style.display = 'none';
        
        // Insert custom upload before input
        input.parentNode.insertBefore(customUpload, input);
        
        // Click custom upload to trigger file input
        customUpload.addEventListener('click', () => input.click());
        
        // Update UI when file is selected
        input.addEventListener('change', function() {
            if (this.files.length > 0) {
                const file = this.files[0];
                fileName.textContent = file.name;
                fileName.style.display = 'block';
                customUpload.style.borderColor = 'var(--success-color)';
                customUpload.style.backgroundColor = 'rgba(40, 167, 69, 0.05)';
                uploadIcon.style.color = 'var(--success-color)';
            } else {
                fileName.style.display = 'none';
                customUpload.style.borderColor = 'var(--light-gray)';
                customUpload.style.backgroundColor = 'transparent';
                uploadIcon.style.color = 'var(--gray-color)';
            }
        });
        
        // Drag and drop functionality
        customUpload.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = 'var(--primary-color)';
            this.style.backgroundColor = 'rgba(10, 36, 99, 0.05)';
        });
        
        customUpload.addEventListener('dragleave', function(e) {
            e.preventDefault();
            if (!input.files.length) {
                this.style.borderColor = 'var(--light-gray)';
                this.style.backgroundColor = 'transparent';
            }
        });
        
        customUpload.addEventListener('drop', function(e) {
            e.preventDefault();
            const files = e.dataTransfer.files;
            
            if (files.length > 0) {
                // Create a new DataTransfer object and add the file
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(files[0]);
                
                // Assign the file to the input
                input.files = dataTransfer.files;
                
                // Trigger change event
                const event = new Event('change', { bubbles: true });
                input.dispatchEvent(event);
            }
        });
    });
}

/* ===== FORM ANIMATIONS ===== */
function initFormAnimations() {
    // Auto-resize textareas
    const textareas = document.querySelectorAll('textarea[auto-resize]');
    
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });
        
        // Trigger initial resize
        const event = new Event('input', { bubbles: true });
        textarea.dispatchEvent(event);
    });
    
    // Input focus effects
    const formControls = document.querySelectorAll('.form-control');
    
    formControls.forEach(control => {
        control.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        control.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
        
        // Check initial value
        if (control.value) {
            control.parentElement.classList.add('focused');
        }
    });
    
    // Form submission animation
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            
            if (submitBtn && !submitBtn.hasAttribute('data-no-loading')) {
                // Add loading animation
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
                
                // Store original content
                const originalHTML = submitBtn.innerHTML;
                const originalWidth = submitBtn.offsetWidth;
                
                // Set loading content
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                submitBtn.style.width = originalWidth + 'px';
                
                // Re-enable button after form submission (or timeout for demo)
                setTimeout(() => {
                    submitBtn.classList.remove('loading');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalHTML;
                    submitBtn.style.width = '';
                }, 3000);
            }
        });
    });
}

/* ===== FORM VALIDATION ENHANCEMENTS ===== */
function enhanceFormValidation() {
    // Add real-time validation for specific patterns
    const patternInputs = document.querySelectorAll('[data-pattern]');
    
    patternInputs.forEach(input => {
        input.addEventListener('input', function() {
            const pattern = this.getAttribute('data-pattern');
            const regex = new RegExp(pattern);
            const value = this.value;
            
            if (value && !regex.test(value)) {
                this.classList.add('error');
                
                // Show pattern hint
                let hint = this.getAttribute('data-pattern-hint');
                if (!hint) {
                    hint = 'Invalid format';
                }
                
                let errorElement = this.nextElementSibling;
                if (!errorElement || !errorElement.classList.contains('form-text')) {
                    errorElement = document.createElement('div');
                    errorElement.className = 'form-text error';
                    this.parentNode.insertBefore(errorElement, this.nextSibling);
                }
                
                errorElement.textContent = hint;
            } else {
                this.classList.remove('error');
                
                const errorElement = this.nextElementSibling;
                if (errorElement && errorElement.classList.contains('form-text')) {
                    errorElement.textContent = '';
                    errorElement.classList.remove('error');
                }
            }
        });
    });
    
    // Character counters for textareas
    const charCountTextareas = document.querySelectorAll('[data-maxlength]');
    
    charCountTextareas.forEach(textarea => {
        const maxLength = parseInt(textarea.getAttribute('data-maxlength'));
        const counter = document.createElement('div');
        counter.className = 'char-counter';
        counter.style.cssText = `
            text-align: right;
            font-size: 0.875rem;
            color: var(--gray-color);
            margin-top: 5px;
        `;
        
        textarea.parentNode.insertBefore(counter, textarea.nextSibling);
        
        function updateCounter() {
            const currentLength = textarea.value.length;
            counter.textContent = `${currentLength}/${maxLength}`;
            
            if (currentLength > maxLength * 0.9) {
                counter.style.color = 'var(--warning-color)';
            } else if (currentLength > maxLength) {
                counter.style.color = 'var(--danger-color)';
            } else {
                counter.style.color = 'var(--gray-color)';
            }
        }
        
        textarea.addEventListener('input', updateCounter);
        updateCounter(); // Initial count
    });
}

// Initialize enhanced validation
document.addEventListener('DOMContentLoaded', enhanceFormValidation);