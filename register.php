<?php 
require_once __DIR__ . '/layouts/header.php';

// If already logged in, redirect to home
if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $data = [];
    
    // Sanitize input
    $fields = ['email', 'password', 'confirm_password', 'full_name', 'company_name', 'phone'];
    foreach ($fields as $field) {
        $data[$field] = $_POST[$field] ?? '';
    }
    
    // Validation
    if (empty($data['email'])) {
        $errors['email'] = 'Email is required';
    } elseif (!isValidEmail($data['email'])) {
        $errors['email'] = 'Invalid email address';
    }
    
    if (empty($data['password'])) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($data['password']) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    }
    
    if ($data['password'] !== $data['confirm_password']) {
        $errors['confirm_password'] = 'Passwords do not match';
    }
    
    if (empty($data['full_name'])) {
        $errors['full_name'] = 'Full name is required';
    }
    
    if (empty($data['company_name'])) {
        $errors['company_name'] = 'Company name is required';
    }
    
    if (empty($errors)) {
        try {
            $auth = new Auth($db);
            $userId = $auth->register(
                $data['email'],
                $data['password'],
                $data['full_name'],
                $data['company_name'],
                $data['phone']
            );
            
            if ($userId) {
                // Auto-login after registration
                $user = $auth->login($data['email'], $data['password']);
                setFlash('success', 'Account created successfully! Your 14-day free trial has started.');
                header('Location: index.php');
                exit();
            }
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}
?>

<div class="auth-container">
    <div class="auth-box fade-in-up">
        <div class="auth-header">
            <h2>Start Your Free Trial</h2>
            <p class="text-muted">No credit card required • 14 days free</p>
        </div>

        <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Full Name *</label>
                <input type="text" name="full_name" class="form-control"
                    value="<?php echo htmlspecialchars($data['full_name'] ?? ''); ?>" required autofocus>
                <?php if (isset($errors['full_name'])): ?>
                <div class="form-text error"><?php echo htmlspecialchars($errors['full_name']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label class="form-label">Company Name *</label>
                <input type="text" name="company_name" class="form-control"
                    value="<?php echo htmlspecialchars($data['company_name'] ?? ''); ?>" required>
                <?php if (isset($errors['company_name'])): ?>
                <div class="form-text error"><?php echo htmlspecialchars($errors['company_name']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label class="form-label">Work Email *</label>
                <input type="email" name="email" class="form-control"
                    value="<?php echo htmlspecialchars($data['email'] ?? ''); ?>" required>
                <?php if (isset($errors['email'])): ?>
                <div class="form-text error"><?php echo htmlspecialchars($errors['email']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="phone" class="form-control"
                    value="<?php echo htmlspecialchars($data['phone'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Password *</label>
                <input type="password" name="password" class="form-control" required>
                <div class="form-text">Minimum 8 characters with letters and numbers</div>
                <?php if (isset($errors['password'])): ?>
                <div class="form-text error"><?php echo htmlspecialchars($errors['password']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password *</label>
                <input type="password" name="confirm_password" class="form-control" required>
                <?php if (isset($errors['confirm_password'])): ?>
                <div class="form-text error"><?php echo htmlspecialchars($errors['confirm_password']); ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="terms" id="terms" class="form-check-input" required>
                    <label for="terms" class="form-check-label">
                        I agree to the <a href="#" class="text-primary">Terms of Service</a> and <a href="#"
                            class="text-primary">Privacy Policy</a>
                    </label>
                </div>
                <div class="form-check mt-2">
                    <input type="checkbox" name="newsletter" id="newsletter" class="form-check-input" checked>
                    <label for="newsletter" class="form-check-label">
                        Send me tips, updates, and offers from FUMBO ERP
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-rocket"></i> Start Free Trial
            </button>
        </form>

        <div class="auth-footer">
            <p>Already have an account? <a href="login.php" class="text-primary">Sign in here</a></p>
        </div>

    </div>
</div>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>