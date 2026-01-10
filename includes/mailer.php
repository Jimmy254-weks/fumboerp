<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mailer {
    private $from_email = 'erp@pamojahomefiber.com';
    private $from_name = 'FUMBO ERP';
    
    // Gmail SMTP Settings
    private $smtp_host = 'smtp.gmail.com';
    private $smtp_port = 587; // Use 465 for SSL
    private $smtp_user = 'erp@pamojahomefiber.com'; // Your Gmail address
    private $smtp_pass = 'jqzpwtqczlsrrxhm'; // Your Gmail App Password
    
    public function sendPasswordReset($to_email, $to_name, $token) {
        $reset_link = SITE_URL . "reset-password.php?token=$token&email=" . urlencode($to_email);

        $mail = new PHPMailer(true);
        try {
            // Enable verbose debugging (optional, for testing)
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            
            // Server settings
            $mail->isSMTP();
            $mail->Host       = $this->smtp_host;
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->smtp_user;
            $mail->Password   = $this->smtp_pass;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS encryption
            $mail->Port       = $this->smtp_port;
            
            // Important: Gmail requires these settings
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Recipients
            $mail->setFrom($this->from_email, $this->from_name);
            $mail->addAddress($to_email, $to_name);
            $mail->addReplyTo($this->from_email, $this->from_name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request - FUMBO ERP';
            
            // Better HTML email template
            $mail->Body = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Password Reset</title>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; background-color: #f4f4f4; margin: 0; padding: 20px; }
                    .container { max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
                    .header { background: linear-gradient(135deg, #0A2463, #1EA896); color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
                    .content { padding: 30px; }
                    .button { display: inline-block; background: linear-gradient(135deg, #0A2463, #1EA896); color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold; margin: 20px 0; }
                    .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; border-top: 1px solid #eee; margin-top: 20px; }
                    .code { background: #f8f9fa; padding: 10px; border-radius: 5px; font-family: monospace; word-break: break-all; }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>FUMBO ERP</h1>
                    </div>
                    <div class="content">
                        <h2>Password Reset Request</h2>
                        <p>Hello ' . htmlspecialchars($to_name) . ',</p>
                        <p>You requested to reset your password for your FUMBO ERP account.</p>
                        <p>Click the button below to set a new password:</p>
                        <p style="text-align: center;">
                            <a href="' . $reset_link . '" class="button">Reset Password</a>
                        </p>
                        <p>Or copy and paste this link in your browser:</p>
                        <div class="code">' . $reset_link . '</div>
                        <p>This link will expire in 1 hour.</p>
                        <p>If you didn\'t request this password reset, please ignore this email.</p>
                        <p>Best regards,<br><strong>The FUMBO ERP Team</strong></p>
                    </div>
                    <div class="footer">
                        <p>&copy; ' . date('Y') . ' FUMBO ERP. All rights reserved.</p>
                        <p>This is an automated message, please do not reply to this email.</p>
                    </div>
                </div>
            </body>
            </html>
            ';
            
            // Plain text alternative
            $mail->AltBody = "Password Reset Request\n\nHello $to_name,\n\nYou requested to reset your password. Click this link to reset: $reset_link\n\nThis link expires in 1 hour.\n\nIf you didn't request this, please ignore this email.\n\nFUMBO ERP Team";

            $mail->send();
            
            // Log success
            error_log("Email sent successfully to: $to_email at " . date('Y-m-d H:i:s'));
            
            return true;
        } catch (Exception $e) {
            // Log detailed error
            $error_msg = "Mailer Error: " . $e->getMessage() . " | PHP: " . phpversion();
            error_log($error_msg);
            
            // Also log to a file for easier debugging
            $log_file = __DIR__ . '/../logs/mail_errors.log';
            $log_entry = date('Y-m-d H:i:s') . " - Error sending to $to_email: " . $e->getMessage() . "\n";
            @file_put_contents($log_file, $log_entry, FILE_APPEND);
            
            return false;
        }
    }
}
?>