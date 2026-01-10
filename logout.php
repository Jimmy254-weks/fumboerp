<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/session.php';

// Destroy session
session_destroy();

// Clear any session cookies
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Set success message
session_start();
setFlash('success', 'You have been logged out successfully.');

// Redirect to home page
header('Location: index.php');
exit();
?>