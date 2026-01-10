<?php
// Include necessary files
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/database.php';
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/validation.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Check if user is logged in
$is_logged_in = isLoggedIn();
$user = getCurrentUser();

// Get current page
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php 
        $page_titles = [
            'index' => 'Home',
            'about' => 'About Us',
            'modules' => 'Modules',
            'pricing' => 'Pricing',
            'demo' => 'Request Demo',
            'contact' => 'Contact Us',
            'login' => 'Login',
            'register' => 'Register'
        ];
        echo ($page_titles[$current_page] ?? 'Page') . ' | ' . SITE_NAME; 
    ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo SITE_URL; ?>assets/images/logo/fumbo_logo.png">

    <!-- CSS -->
<link rel="stylesheet" href="https://smartmonitor.pamojahomefiber.com/assets/css/main.css">
<link rel="stylesheet" href="https://smartmonitor.pamojahomefiber.com/assets/css/layout.css">
<link rel="stylesheet" href="https://smartmonitor.pamojahomefiber.com/assets/css/responsive.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <!-- Meta tags -->
    <meta name="description" content="Manage your entire business, all in one place with FUMBO ERP">
    <meta name="keywords" content="ERP, Business Management, Software, Inventory, CRM, Finance">
</head>

<body>
    <!-- Flash messages -->
    <div id="flash-messages">
        <?php showFlash(); ?>
    </div>

    <!-- Header & Navigation -->
    <?php include __DIR__ . '/navbar.php'; ?>

    <!-- Main Content -->
    <main>