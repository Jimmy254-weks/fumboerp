<?php
require_once __DIR__ . '/layouts/header.php';

// Initialize database
$database = new Database();
$db = $database->getConnection();
$auth = new Auth($db);

$token = $_GET['token'] ?? '';
$email = $_GET['email'] ?? '';
$step = 'request';
$error = '';
$success = '';

// Verify token from email link
if (!empty($token) && !empty($email)) {
    $step = 'verify';
    
    $stmt = $db->prepare("SELECT id, reset_expiry FROM users WHERE email = ? AND reset_token = ?");
    $stmt->execute([$email, $token]);
    $user = $stmt->fetch();
    
    if (!$user) {
        $error = 'Invalid or expired reset link.';
        $step = 'request';
    } elseif (strtotime($user['reset_expiry']) < time()) {
        $error = 'Reset link has expired. Please request a new one.';
        $step = 'request';
    }
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    // Request reset link
    if ($action === 'request') {
        $request_email = sanitize($_POST['email'] ?? '');
        
        if (empty($request_email)) {
            $error = 'Please enter your email address';
        } elseif (!isValidEmail($request_email)) {
            $error = 'Please enter a valid email address';
        } else {
            $token = $auth->requestPasswordReset($request_email);
            if ($token) {
                // Get user info
                $stmt = $db->prepare("SELECT full_name FROM users WHERE email = ?");
                $stmt->execute([$request_email]);
                $user = $stmt->fetch();
                $user_name = $user['full_name'] ?? 'User';
                
                // Generate the reset link
                $reset_link = SITE_URL . "reset-password.php?token=$token&email=" . urlencode($request_email);
                
                // Try to send email (optional for development)
                $email_sent = false;
                try {
                    if (file_exists(__DIR__ . '/includes/mailer.php')) {
                        require_once __DIR__ . '/includes/mailer.php';
                        $mailer = new Mailer();
                        $email_sent = $mailer->sendPasswordReset($request_email, $user_name, $token);
                    }
                } catch (Exception $e) {
                    // Email failed, that's okay for development
                    $email_sent = false;
                }
                
                // Always show the reset link (perfect for development)
                if ($email_sent) {
                    $success = "✅ Password reset link has been sent to <strong>$request_email</strong>. Please check your inbox.";
                } else {
                    // DEVELOPMENT MODE: Show the reset link directly
                    $success = "
                    <div class='alert alert-info'>
                        <h5><i class='fas fa-code'></i> Development Mode</h5>
                        <p>Email sending is disabled in development. Use this link to reset your password:</p>
                        <div class='mt-3'>
                            <a href='$reset_link' class='btn btn-primary btn-lg btn-block'>
                                <i class='fas fa-key'></i> Click to Reset Password
                            </a>
                        </div>
                        <div class='mt-3 small'>
                            <p class='mb-1'><strong>Or copy this link:</strong></p>
                            <div class='p-2 bg-light rounded'>
                                <code style='word-break: break-all;'>$reset_link</code>
                            </div>
                        </div>
                    </div>
                    ";
                }
                
            } else {
                $error = 'Email not found in our system. Try: demo@fumboerp.com';
            }
        }
    }
    
    // Reset password
    elseif ($action === 'reset') {
        $reset_token = sanitize($_POST['token'] ?? '');
        $reset_email = sanitize($_POST['email'] ?? '');
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        
        if (empty($new_password) || empty($confirm_password)) {
            $error = 'Please fill in all password fields';
        } elseif (strlen($new_password) < 8) {
            $error = 'Password must be at least 8 characters';
        } elseif ($new_password !== $confirm_password) {
            $error = 'Passwords do not match';
        } else {
            if ($auth->resetPassword($reset_token, $new_password)) {
                $success = '
                <div class="alert alert-success">
                    <h4><i class="fas fa-check-circle"></i> Password Reset Successful!</h4>
                    <p class="mb-3">Your password has been updated successfully.</p>
                    <a href="login.php" class="btn btn-success">
                        <i class="fas fa-sign-in-alt"></i> Go to Login
                    </a>
                </div>';
                $step = 'success';
            } else {
                $error = 'Invalid or expired reset link. Please request a new one.';
                $step = 'request';
            }
        }
    }
}
?>

<div class="auth-container">
    <div class="auth-box fade-in-up">

        <!-- Request Password Reset -->
        <?php if ($step === 'request'): ?>
        <div class="auth-header">
            <h2>Reset Password</h2>
            <p class="text-muted">Enter your email to get a reset link</p>
        </div>

        <?php if ($error): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <?php if ($success): ?>
        <?php echo $success; ?>
        <?php endif; ?>

        <form method="POST" action="" class="mt-4">
            <input type="hidden" name="action" value="request">

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>"
                    placeholder="Enter your email address" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-key"></i> Get Reset Link
            </button>
        </form>

        <div class="auth-footer mt-4">
            <p class="text-center">
                <a href="login.php" class="text-primary">
                    <i class="fas fa-arrow-left"></i> Back to Login
                </a>
            </p>
            <p class="text-center small text-muted mt-2">
                For testing: <code>demo@fumboerp.com</code>
            </p>
        </div>

        <!-- Verify Token & Reset Password -->
        <?php elseif ($step === 'verify'): ?>
        <div class="auth-header">
            <h2>Set New Password</h2>
            <p class="text-muted">Create a new secure password</p>
        </div>

        <?php if ($error): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="hidden" name="action" value="reset">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">

            <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-control" placeholder="Enter new password"
                    required>
                <div class="form-text">Minimum 8 characters</div>
            </div>

            <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Confirm new password"
                    required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-save"></i> Save New Password
            </button>
        </form>

        <div class="auth-footer mt-4">
            <p class="text-center">
                <a href="reset-password.php" class="text-primary">
                    <i class="fas fa-arrow-left"></i> Request New Link
                </a>
            </p>
        </div>

        <!-- Success Message -->
        <?php elseif ($step === 'success'): ?>
        <div class="auth-header">
            <h2><i class="fas fa-check-circle text-success"></i> Success!</h2>
            <p class="text-muted">Your password has been updated</p>
        </div>

        <?php echo $success; ?>

        <div class="text-center mt-4">
            <a href="login.php" class="btn btn-primary btn-lg">
                <i class="fas fa-sign-in-alt"></i> Login Now
            </a>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>