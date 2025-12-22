<?php 
require_once __DIR__ . '/layouts/header.php';

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $data = [];
    
    // Sanitize input
    $fields = ['name', 'email', 'phone', 'company', 'subject', 'message'];
    foreach ($fields as $field) {
        $data[$field] = sanitize($_POST[$field] ?? '');
    }
    
    // Validation
    if (empty($data['name'])) $errors['name'] = 'Name is required';
    if (empty($data['email'])) {
        $errors['email'] = 'Email is required';
    } elseif (!isValidEmail($data['email'])) {
        $errors['email'] = 'Invalid email address';
    }
    if (empty($data['message'])) $errors['message'] = 'Message is required';
    
    if (empty($errors)) {
        // Save to database
        if (addContactMessage($data)) {
            setFlash('success', 'Thank you for your message! We will get back to you within 24 hours.');
            // Clear form data
            $data = array_fill_keys($fields, '');
        } else {
            setFlash('error', 'There was an error sending your message. Please try again.');
        }
    }
}
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Contact Us</h1>
        <p>We're here to help. Get in touch with our team.</p>
    </div>
</section>

<!-- Contact Section -->
<section class="section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="fade-in-up">
                <h2>Get in Touch</h2>
                <p>Have questions about FUMBO ERP? Our team is ready to help you transform your business operations.</p>

                <div class="contact-info mt-5">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4>Visit Us</h4>
                            <p>Honey Pot Rd<br>Ongata Rongai</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h4>Call Us</h4>
                            <p>0207653000 / +254799745714<br>Mon-Fri, 9am-6pm EST</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4>Email Us</h4>
                            <p>erp@pamojahomefiber.com
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h4>Follow Us</h4>
                    <div class="social-links mt-3">
                        <a href="https://www.facebook.com/pamojahome/" aria-label="Facebook"><i
                                class="fab fa-facebook"></i></a>
                        <a href="https://x.com/HomePamoja79495" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="https://wa.me/254799745714" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://www.instagram.com/pamojahomefiber/" aria-label="Instagram"><i
                                class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="fade-in-up">
                <div class="card">
                    <h3>Send us a Message</h3>

                    <form method="POST" action="">
                        <div class="form-group">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" class="form-control"
                                value="<?php echo htmlspecialchars($data['name'] ?? ''); ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <input type="email" name="email" class="form-control"
                                value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control"
                                value="<?php echo htmlspecialchars($data['phone'] ?? ''); ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Company</label>
                            <input type="text" name="company" class="form-control"
                                value="<?php echo htmlspecialchars($data['company'] ?? ''); ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control"
                                value="<?php echo htmlspecialchars($data['subject'] ?? ''); ?>">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Message *</label>
                            <textarea name="message" class="form-control" rows="5"
                                required><?php echo htmlspecialchars($data['message'] ?? ''); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Preview -->
<section class="section section-light">
    <div class="container">
        <div class="section-title">
            <h2>Frequently Asked Questions</h2>
            <p class="text-muted">Quick answers to frequent inquiries</p>
        </div>

        <div class="grid grid-2 gap-4">
            <div class="card">
                <h4>How long does implementation take?</h4>
                <p>Most businesses are up and running within 1-2 weeks. Complex implementations may take 3-4 weeks with
                    our guidance.</p>
            </div>
            <div class="card">
                <h4>Do you offer training?</h4>
                <p>Yes! We provide comprehensive training sessions, documentation, and ongoing support to ensure your
                    team succeeds.</p>
            </div>
            <div class="card">
                <h4>Can I integrate with other tools?</h4>
                <p>FUMBO ERP offers API access and pre-built integrations with popular tools like QuickBooks, Shopify,
                    and more.</p>
            </div>
            <div class="card">
                <h4>Is there a mobile app?</h4>
                <p>Yes! Access your business data on the go with our iOS and Android apps available for all subscription
                    plans.</p>
            </div>
        </div>

        <div class="text-center mt-5">
            <p>Don't see your question here? <a href="demo.php" class="text-primary">Schedule a demo</a> to get
                personalized answers.</p>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="section">
    <div class="container">
        <div class="card">
            <div class="text-center p-5">
                <i class="fas fa-map-marked-alt text-primary" style="font-size: 4rem;"></i>
                <h3 class="mt-3">Our Location</h3>
                <p class="text-muted">Visit our headquarters or connect with us remotely</p>

                <!-- Embedded Google Map -->
                <div class="mt-4" style="height: 300px; border-radius: var(--radius-md); overflow: hidden;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.324307214882!2d36.75136751533853!3d-1.4017481999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f0b6c3f6765df%3A0x8706d23d76f7c72e!2sHoney%20Pot%20Rd%2C%20Ongata%20Rongai!5e0!3m2!1sen!2ske!4v1708703470000!5m2!1sen!2ske"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="mt-4">
                    <p><i class="fas fa-map-marker-alt text-primary"></i> Honey Pot Rd, Ongata Rongai</p>
                </div>
            </div>
        </div>
    </div>
</section>


<?php require_once __DIR__ . '/layouts/footer.php'; ?>