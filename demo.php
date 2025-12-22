<?php 
require_once __DIR__ . '/layouts/header.php';

// Handle demo request submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $data = [];
    
    // Sanitize and validate input
    $fields = ['name', 'email', 'company', 'employees', 'industry', 'message'];
    
    foreach ($fields as $field) {
        $data[$field] = sanitize($_POST[$field] ?? '');
    }
    
    $data['preferred_date'] = $_POST['preferred_date'] ?? '';
    
    // Validation
    if (empty($data['name'])) $errors['name'] = 'Name is required';
    if (empty($data['email'])) {
        $errors['email'] = 'Email is required';
    } elseif (!isValidEmail($data['email'])) {
        $errors['email'] = 'Invalid email address';
    }
    if (empty($data['company'])) $errors['company'] = 'Company name is required';
    if (!empty($data['preferred_date']) && !Validator::date($data['preferred_date'])) {
        $errors['preferred_date'] = 'Invalid date format';
    }
    
    if (empty($errors)) {
        // Save to database
        if (addDemoRequest($data)) {
            setFlash('success', 'Demo request submitted successfully! We will contact you within 24 hours.');
        } else {
            setFlash('error', 'There was an error submitting your request. Please try again.');
        }
    } else {
        // Store errors in session to display
        $_SESSION['demo_errors'] = $errors;
        $_SESSION['demo_data'] = $data;
    }
}
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <h1>Request a Demo</h1>
        <p>See FUMBO ERP in action with a personalized walkthrough</p>
    </div>
</section>

<!-- Demo Steps -->
<section class="section">
    <div class="container">
        <div class="demo-steps">
            <div class="demo-step active">
                <div class="step-number">1</div>
                <h4>Schedule</h4>
                <p>Pick a convenient time</p>
            </div>
            <div class="demo-step">
                <div class="step-number">2</div>
                <h4>Prepare</h4>
                <p>We review your needs</p>
            </div>
            <div class="demo-step">
                <div class="step-number">3</div>
                <h4>Demo</h4>
                <p>Personalized walkthrough</p>
            </div>
            <div class="demo-step">
                <div class="step-number">4</div>
                <h4>Follow-up</h4>
                <p>Q&A and next steps</p>
            </div>
        </div>
    </div>
</section>

<!-- Demo Form -->
<section class="section section-light">
    <div class="container">
        <div class="grid grid-2 gap-5 align-start">
            <div class="fade-in-up">
                <h2>Schedule Your Personalized Demo</h2>
                <p>Our experts will show you how FUMBO ERP can transform your business operations. We'll tailor the demo
                    to your specific needs and industry.</p>

                <div class="mt-5">
                    <h4><i class="fas fa-check-circle text-success"></i> What to expect</h4>
                    <ul class="mt-3" style="list-style: none; padding-left: 0;">
                        <li class="mb-2"><i class="fas fa-play text-primary"></i> 30-45 minute live demo</li>
                        <li class="mb-2"><i class="fas fa-play text-primary"></i> Focus on your pain points</li>
                        <li class="mb-2"><i class="fas fa-play text-primary"></i> Q&A session</li>
                        <li class="mb-2"><i class="fas fa-play text-primary"></i> Follow-up materials</li>
                        <li><i class="fas fa-play text-primary"></i> No sales pressure</li>
                    </ul>
                </div>
            </div>

            <div class="fade-in-up">
                <div class="card">
                    <form id="demoForm" method="POST" action="">
                        <?php 
                        // Display errors if any
                        if (isset($_SESSION['demo_errors'])): 
                            $errors = $_SESSION['demo_errors'];
                            $data = $_SESSION['demo_data'] ?? [];
                            unset($_SESSION['demo_errors'], $_SESSION['demo_data']);
                        ?>
                        <div class="alert alert-danger">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mt-2">
                                <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <!-- Step 1: Basic Information -->
                        <div class="demo-step active" id="step1">
                            <h4 class="mb-4">Tell us about yourself</h4>

                            <div class="form-group">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="name" class="form-control"
                                    value="<?php echo htmlspecialchars($data['name'] ?? ''); ?>" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Work Email *</label>
                                <input type="email" name="email" class="form-control"
                                    value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Company Name *</label>
                                <input type="text" name="company" class="form-control"
                                    value="<?php echo htmlspecialchars($data['company'] ?? ''); ?>" required>
                            </div>

                            <div class="d-flex justify-between mt-4">
                                <button type="button" class="btn btn-next">Next <i
                                        class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>

                        <!-- Step 2: Business Details -->
                        <div class="demo-step" id="step2">
                            <h4 class="mb-4">About your business</h4>

                            <div class="form-group">
                                <label class="form-label">Number of Employees</label>
                                <select name="employees" class="form-control">
                                    <option value="">Select...</option>
                                    <option value="1-10"
                                        <?php echo ($data['employees'] ?? '') == '1-10' ? 'selected' : ''; ?>>1-10
                                    </option>
                                    <option value="11-50"
                                        <?php echo ($data['employees'] ?? '') == '11-50' ? 'selected' : ''; ?>>11-50
                                    </option>
                                    <option value="51-200"
                                        <?php echo ($data['employees'] ?? '') == '51-200' ? 'selected' : ''; ?>>51-200
                                    </option>
                                    <option value="201-500"
                                        <?php echo ($data['employees'] ?? '') == '201-500' ? 'selected' : ''; ?>>201-500
                                    </option>
                                    <option value="501+"
                                        <?php echo ($data['employees'] ?? '') == '501+' ? 'selected' : ''; ?>>500+
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Industry</label>
                                <select name="industry" class="form-control">
                                    <option value="">Select...</option>
                                    <option value="retail"
                                        <?php echo ($data['industry'] ?? '') == 'retail' ? 'selected' : ''; ?>>Retail
                                    </option>
                                    <option value="manufacturing"
                                        <?php echo ($data['industry'] ?? '') == 'manufacturing' ? 'selected' : ''; ?>>
                                        Manufacturing</option>
                                    <option value="services"
                                        <?php echo ($data['industry'] ?? '') == 'services' ? 'selected' : ''; ?>>
                                        Services</option>
                                    <option value="technology"
                                        <?php echo ($data['industry'] ?? '') == 'technology' ? 'selected' : ''; ?>>
                                        Technology</option>
                                    <option value="healthcare"
                                        <?php echo ($data['industry'] ?? '') == 'healthcare' ? 'selected' : ''; ?>>
                                        Healthcare</option>
                                    <option value="education"
                                        <?php echo ($data['industry'] ?? '') == 'education' ? 'selected' : ''; ?>>
                                        Education</option>
                                    <option value="other"
                                        <?php echo ($data['industry'] ?? '') == 'other' ? 'selected' : ''; ?>>Other
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Preferred Demo Date</label>
                                <input type="date" name="preferred_date" class="form-control"
                                    value="<?php echo htmlspecialchars($data['preferred_date'] ?? ''); ?>"
                                    min="<?php echo date('Y-m-d'); ?>">
                            </div>

                            <div class="d-flex justify-between mt-4">
                                <button type="button" class="btn btn-outline btn-prev">
                                    <i class="fas fa-arrow-left"></i> Back
                                </button>
                                <button type="button" class="btn btn-next">Next <i
                                        class="fas fa-arrow-right"></i></button>
                            </div>
                        </div>

                        <!-- Step 3: Additional Info -->
                        <div class="demo-step" id="step3">
                            <h4 class="mb-4">Any specific requirements?</h4>

                            <div class="form-group">
                                <label class="form-label">What challenges are you facing?</label>
                                <textarea name="message" class="form-control" rows="5"
                                    placeholder="Tell us about your current processes, pain points, or specific features you're interested in..."><?php echo htmlspecialchars($data['message'] ?? ''); ?></textarea>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" name="newsletter" id="newsletter" class="form-check-input"
                                        checked>
                                    <label for="newsletter" class="form-check-label">
                                        Send me updates, tips, and offers from FUMBO ERP
                                    </label>
                                </div>
                                <div class="form-check mt-2">
                                    <input type="checkbox" name="terms" id="terms" class="form-check-input" required>
                                    <label for="terms" class="form-check-label">
                                        I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a
                                            href="#" class="text-primary">Privacy Policy</a>
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-between mt-4">
                                <button type="button" class="btn btn-outline btn-prev">
                                    <i class="fas fa-arrow-left"></i> Back
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-calendar-check"></i> Schedule Demo
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Demo -->
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Why Schedule a Demo?</h2>
            <p class="text-muted">See the value before you commit</p>
        </div>

        <div class="grid grid-3">
            <div class="text-center">
                <div class="feature-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <h4>Personalized</h4>
                <p>We tailor the demo to your specific business needs and challenges.</p>
            </div>
            <div class="text-center">
                <div class="feature-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <h4>Ask Questions</h4>
                <p>Get immediate answers from our product experts during the demo.</p>
            </div>
            <div class="text-center">
                <div class="feature-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4>No Pressure</h4>
                <p>Educational session focused on your needs, not sales pitches.</p>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>