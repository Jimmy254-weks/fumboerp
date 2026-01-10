<?php
// Validation functions
class Validator {
    
    // Validate required fields
    public static function required($fields, $data) {
        $errors = [];
        foreach ($fields as $field) {
            if (empty($data[$field] ?? '')) {
                $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' is required';
            }
        }
        return $errors;
    }
    
    // Validate email
    public static function email($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'Invalid email address';
        }
        return null;
    }
    
    // Validate password
    public static function password($password) {
        if (strlen($password) < 8) {
            return 'Password must be at least 8 characters';
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return 'Password must contain at least one uppercase letter';
        }
        if (!preg_match('/[a-z]/', $password)) {
            return 'Password must contain at least one lowercase letter';
        }
        if (!preg_match('/[0-9]/', $password)) {
            return 'Password must contain at least one number';
        }
        return null;
    }
    
    // Validate phone number
    public static function phone($phone) {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phone) < 10) {
            return 'Invalid phone number';
        }
        return null;
    }
    
    // Validate date
    public static function date($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        if ($d && $d->format($format) === $date) {
            return null;
        }
        return 'Invalid date format';
    }
    
    // Validate number range
    public static function numberRange($number, $min, $max) {
        if (!is_numeric($number) || $number < $min || $number > $max) {
            return "Must be between $min and $max";
        }
        return null;
    }
    
    // Validate file upload
    public static function file($file, $allowed_types, $max_size) {
        $errors = [];
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'File upload failed';
            return $errors;
        }
        
        // Check size
        if ($file['size'] > $max_size) {
            $errors[] = 'File is too large. Maximum size is ' . ($max_size / 1024 / 1024) . 'MB';
        }
        
        // Check type
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $allowed_types)) {
            $errors[] = 'Invalid file type. Allowed: ' . implode(', ', $allowed_types);
        }
        
        return $errors;
    }
}
?>