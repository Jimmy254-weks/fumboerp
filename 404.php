<?php
require_once __DIR__ . '/layouts/header.php';
?>

<section class="error-page">
    <div class="container">
        <div class="error-content">
            <h1>404</h1>
            <h2>Page Not Found</h2>
            <p>Oops! The page you're looking for doesn't exist or has been moved.</p>
            <div class="error-actions">
                <a href="index.php" class="btn btn-primary">
                    <i class="fas fa-home"></i> Back to Home
                </a>
                <a href="contact.php" class="btn btn-outline">
                    <i class="fas fa-envelope"></i> Contact Support
                </a>
            </div>
            <div class="error-search">
                <form action="search.php" method="get" class="search-form">
                    <input type="text" name="q" placeholder="Search our site..." required>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/layouts/footer.php';
?>