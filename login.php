<?php 
require_once __DIR__ . '/layouts/header.php';

// If already logged in, redirect to home
if (isLoggedIn()) {
    header('Location: index.php');
    exit();
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    try {
        $auth = new Auth($db);
        $user = $auth->login($email, $password);
        
        // Set flash message
        setFlash('success', 'Welcome back, ' . htmlspecialchars($user['full_name']) . '!');
        
        // Redirect to intended page or home
        $redirect_url = $_SESSION['redirect_url'] ?? 'index.php';
        unset($_SESSION['redirect_url']);
        header('Location: ' . $redirect_url);
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<div class="auth-container">
    <div class="auth-box fade-in-up">
        <div class="auth-header">
            <h2>Welcome Back</h2>
            <p class="text-muted">Sign in to your FUMBO ERP account</p>
        </div>

        <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($error); ?>
        </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control"
                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required autofocus>
            </div>

            <div class="form-group">
                <div class="d-flex justify-between align-center">
                    <label class="form-label">Password</label>
                </div>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember" class="form-check-input">
                    <label for="remember" class="form-check-label">Remember me</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                <i class="fas fa-sign-in-alt"></i> Sign In
            </button>
        </form>

        <!-- Forgot Password Link -->
        <div class="auth-footer">
            <p>Don't have an account? <a href="register.php" class="text-primary">Start your free trial</a></p>
            <p class="mt-2"><a href="reset-password.php" class="text-primary">Forgot your password?</a></p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple forgot password toggle
    const forgotLink = document.querySelector('a[href="#forgot-password"]');
    const forgotModal = document.getElementById('forgot-password');

    if (forgotLink && forgotModal) {
        forgotLink.addEventListener('click', function(e) {
            e.preventDefault();
            forgotModal.style.display = forgotModal.style.display === 'none' ? 'block' : 'none';
        });
    }
});
</script>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>