<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'cortarot_fumboerp');
define('DB_USER', 'cortarot_admincaleb');
define('DB_PASS', 'Wekesa_2019');

// Site configuration
define('SITE_NAME', 'FUMBO ERP');
define('SITE_URL', 'https://smartmonitor.pamojahomefiber.com/');

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
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
?>