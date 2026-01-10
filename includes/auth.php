<?php
// Authentication functions
class Auth {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    // Register new user
    public function register($email, $password, $full_name, $company_name = '', $phone = '') {
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email address');
        }
        
        // Check if email exists
        $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            throw new Exception('Email already registered');
        }
        
        // Validate password strength
        if (strlen($password) < 8) {
            throw new Exception('Password must be at least 8 characters');
        }
        
        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user
        $stmt = $this->db->prepare("
            INSERT INTO users (email, password_hash, full_name, company_name, phone, trial_end_date) 
            VALUES (?, ?, ?, ?, ?, DATE_ADD(NOW(), INTERVAL 14 DAY))
        ");
        
        $success = $stmt->execute([
            $email, 
            $password_hash, 
            $full_name, 
            $company_name, 
            $phone
        ]);
        
        return $success ? $this->db->lastInsertId() : false;
    }
    
    // Login user
    public function login($email, $password) {
        // Get user
        $stmt = $this->db->prepare("
            SELECT id, email, password_hash, full_name, company_name, 
                   subscription_plan, account_status, is_trial_active
            FROM users 
            WHERE email = ? AND account_status = 'active'
        ");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if (!$user) {
            throw new Exception('Invalid email or password');
        }
        
        // Verify password
        if (!password_verify($password, $user['password_hash'])) {
            throw new Exception('Invalid email or password');
        }
        
        // Update last login
        $stmt = $this->db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
        $stmt->execute([$user['id']]);
        
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'full_name' => $user['full_name'],
            'company_name' => $user['company_name'],
            'subscription_plan' => $user['subscription_plan'],
            'is_trial_active' => $user['is_trial_active']
        ];
        
        return $user;
    }
    
    // Logout user
    public function logout() {
        session_destroy();
        return true;
    }
    
// Request password reset
public function requestPasswordReset($email) {
    $stmt = $this->db->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user) {
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        $stmt = $this->db->prepare("UPDATE users SET reset_token = ?, reset_expiry = ? WHERE id = ?");
        if ($stmt->execute([$token, $expiry, $user['id']])) {
            return $token;
        }
    }
    
    return false;
}
    
    // Reset password with token
    public function resetPassword($token, $new_password) {
        $stmt = $this->db->prepare("SELECT id FROM users WHERE reset_token = ? AND reset_expiry > NOW()");
        $stmt->execute([$token]);
        $user = $stmt->fetch();
        
        if ($user) {
            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            
            $stmt = $this->db->prepare("
                UPDATE users 
                SET password_hash = ?, reset_token = NULL, reset_expiry = NULL 
                WHERE id = ?
            ");
            $stmt->execute([$password_hash, $user['id']]);
            
            return true;
        }
        
        return false;
    }
}
?>