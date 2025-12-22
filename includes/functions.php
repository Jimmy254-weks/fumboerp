<?php
// Helper functions

// Sanitize input
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

// Validate email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Generate random string
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Format date
function formatDate($date, $format = 'F j, Y') {
    $dateTime = new DateTime($date);
    return $dateTime->format($format);
}

// Get remaining trial days
function getRemainingTrialDays($trial_end_date) {
    $end = new DateTime($trial_end_date);
    $now = new DateTime();
    
    if ($end < $now) {
        return 0;
    }
    
    $interval = $now->diff($end);
    return $interval->days;
}

// Get modules from database
function getModules($limit = null) {
    global $db;
    $sql = "SELECT * FROM modules WHERE is_active = TRUE ORDER BY display_order ASC";
    if ($limit) {
        $sql .= " LIMIT " . intval($limit);
    }
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Get testimonials
function getTestimonials($featured_only = false, $limit = null) {
    global $db;
    $sql = "SELECT * FROM testimonials WHERE 1=1";
    if ($featured_only) {
        $sql .= " AND is_featured = TRUE";
    }
    $sql .= " ORDER BY display_order ASC";
    if ($limit) {
        $sql .= " LIMIT " . intval($limit);
    }
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Add contact message
function addContactMessage($data) {
    global $db;
    $stmt = $db->prepare("
        INSERT INTO contacts (name, email, phone, company, subject, message, ip_address)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    
    return $stmt->execute([
        $data['name'],
        $data['email'],
        $data['phone'] ?? '',
        $data['company'] ?? '',
        $data['subject'] ?? '',
        $data['message'],
        $_SERVER['REMOTE_ADDR']
    ]);
}

// Add demo request
function addDemoRequest($data) {
    global $db;
    $stmt = $db->prepare("
        INSERT INTO demo_requests (name, email, company, employees, industry, preferred_date, message)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    
    return $stmt->execute([
        $data['name'],
        $data['email'],
        $data['company'] ?? '',
        $data['employees'] ?? 0,
        $data['industry'] ?? '',
        $data['preferred_date'] ?? null,
        $data['message'] ?? ''
    ]);
}

// Redirect with message
function redirect($url, $message = null, $type = 'success') {
    if ($message) {
        setFlash($type, $message);
    }
    header("Location: $url");
    exit();
}
?>