<?php
require 'PHPMailer/PHPMailerAutoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = $_POST["email"];
    $subject = "Thank you for subscribing!";
    $message = "Thank you for subscribing! We will reach out to you with our new products.";
    
    $mail = new PHPMailer;

    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'cloud-94c950.managed-vps.net';         // Specify main SMTP server
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@daaralamirat.com';            // SMTP username (your email address)
    $mail->Password = 'ANmh251tFM5dw';                    // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->setFrom('info@daaralamirat.com', 'Daar Alamirat');  // Set sender's email address and name
    $mail->addAddress($to);                               // Add a recipient
    $mail->addReplyTo('info@daaralamirat.com', 'Daar Alamirat');
    // No need to add CC and BCC if not required

    // No need to add attachments in this case

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = $message;
    // No need to set AltBody for HTML emails

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        // Redirect to index.php with success message
        header("Location: index.php?msg=Thanks for subscribing");
        exit();
    }
}
?>
