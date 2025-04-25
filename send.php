<?php
// Manually include the PHPMailer classes using their full path

//require 'proyecto/vendor/phpmailer/src/PHPMailer.php';  // PHPMailer class
//require 'proyecto/vendor/phpmailer/src/SMTP.php';       // SMTP class
//require 'proyecto/vendor/phpmailer/src/Exception.php'; // Exception class
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Try a simple echo to see if the page is loading
echo "Page is working";

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Create an instance of PHPMailer
$mail = new PHPMailer(true);  // Passing true enables exceptions

try {
    // Set mailer to use SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Gmail's SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'sysfero@gmail.com';  // Your Gmail email address
    $mail->Password = 'Hafsa@2005';  // Your Gmail App password (if 2FA enabled)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable STARTTLS encryption
    $mail->Port = 587;  // Use port 587 for TLS (or 465 for SSL)

    // If form is submitted (POST request)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the user's email and message from the form
        $userEmail = $_POST['email'];  // The user's email address
        $userMessage = $_POST['message'];  // The message typed by the user

        // Set the sender's email address (the user’s email)
        $mail->setFrom($userEmail, 'User');  // Sender’s email (the user’s email)

        // Set the recipient's email address (your admin email)
        $mail->addAddress('sysfero@gmail.com');  // Replace with your admin email

        // Set the subject and body of the email
        $mail->Subject = 'Message from Website';
        $mail->Body    = "Message from: " . $userEmail . "\n\n" . $userMessage;  // Include user’s email and message

        // Try sending the email
        if ($mail->send()) {
            echo 'Message has been sent!';
        }
    }
} catch (Exception $e) {
    // Handle any errors that occur
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
