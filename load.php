<?php
// Set the content type to HTML for the browser and specify the character set to UTF-8.
// author: HO CHAN HOU, Alvin, BC102362
// author: WANG TSZ CHING, Phoebe, BC102628
// author: QU YU MING, Macro, BC103444

header("Content-Type:text/html;charset=utf-8");

// Set the default timezone to Coordinated Universal Time (UTC).
date_default_timezone_set('UTC');

// Include necessary PHP files for database connection and common functions.
include('include/database.php');
include('include/common.php');

// Start a new or resume an existing session to manage user state.
session_start();

// Initialize user ID and user data array.
$user_id = 0;
$u = [];

// Check if user_id exists in the session and validate it.
if(!empty($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $u = GetRow('users', ['id' => $_SESSION['user_id']]);

    // If no valid user is found, clear the session and reset user_id.
    if (empty($u)){
        unset($_SESSION['user_id']);
        $user_id = 0;
    }
}

// Import classes from PHPMailer for sending emails.
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Require PHPMailer library files.
require 'include/PHPMailer/src/Exception.php';
require 'include/PHPMailer/src/PHPMailer.php';
require 'include/PHPMailer/src/SMTP.php';

/**
 * Function to send an email.
 * 
 * @param string $email Recipient's email address.
 * @param string $title The subject of the email.
 * @param string $content The HTML content of the email.
 * @return bool Returns true if the email was sent successfully, false otherwise.
 */
function sendEmail($email, $title, $content)
{
    // Create an instance of PHPMailer and enable exceptions.
    $mail = new PHPMailer(true);

    try {
        // Configure SMTP server settings.
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output.
        $mail->isSMTP(); // Set mailer to use SMTP.
        $mail->Host = 'smtp.qq.com'; // Specify main SMTP server.
        $mail->SMTPAuth = true; // Enable SMTP authentication.
        $mail->Username = '805327309@qq.com'; // SMTP username.
        $mail->Password = 'zdhlztdeassobefb'; // SMTP password.
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption.
        $mail->Port = 465; // TCP port to connect to.
        $mail->SMTPDebug = 1; // Set SMTP debug to level 1.

        // Set sender and recipient information.
        $mail->setFrom('805327309@qq.com', 'Shop');
        $mail->addAddress($email); // Add a recipient.

        // Set email format to HTML and assign subject and body.
        $mail->isHTML(true);
        $mail->Subject = $title;
        $mail->Body = $content;

        // Send the email.
        $mail->send();
        return true;
    } catch (Exception $e) {
        // Return false if the email could not be sent.
        return false;
    }
}
?>
