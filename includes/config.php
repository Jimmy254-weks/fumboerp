<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'fumboerp');
define('DB_USER', 'root'); // Change this in production
define('DB_PASS', ''); // Change this in production

// Site configuration
define('SITE_NAME', 'FUMBO ERP');
define('SITE_URL', 'http://localhost/fumboerp/'); // Change to your domain
define('ADMIN_EMAIL', 'support@fumboerp.com');

// Security
define('SALT', 'your-secure-salt-here-change-in-production'); // Change this!
define('SESSION_TIMEOUT', 3600); // 1 hour

// File upload settings
define('MAX_UPLOAD_SIZE', 5242880); // 5MB
define('ALLOWED_IMAGE_TYPES', ['jpg', 'jpeg', 'png', 'gif']);

// Set timezone
date_default_timezone_set('UTC');

// Error reporting (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>