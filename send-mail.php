<?php

use PHPMailer\PHPMailer\PHPMailer;

require './includes/PHPMailer/PHPMailer/src/Exception.php';
require './includes/PHPMailer/PHPMailer/src/PHPMailer.php';
require './includes/PHPMailer/PHPMailer/src/SMTP.php';


$mail = new PHPMailer();
//Server settings
$mail->SMTPDebug = 0;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'tumcafeedback@gmail.com';                 // SMTP username
$mail->Password = 'csm20024';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to


//Recipients
$mail->setFrom('tumcafeedback@gmail.com', 'TU Feedback');
$mail->addAddress($email, '');     // Add a recipient
// $mail->addAddress('ellen@exampl  e.com');               // Name is optional
$mail->addReplyTo('tumcafeedback@gmail.com', 'TU Feedback');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');


//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Verify Account';
$mail->Body    = '<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
        a {
          background: #592f80;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #fff;
        }
      </style>
    </head>
    <body>
      <div class="wrapper">
        <p>Thank you for signing up for the TU Feedback. Please click on the link below to verify your account:.</p>
        <a href="http://localhost/FeedBack_Management_And_Analysis/verify_email.php?token=' . $token . '">Verify Email!</a>
      </div>
    </body>
    </html>';

$mail->AltBody = '';
// $mail->send();
if (!$mail->send()) {
  echo "<div class='container' style='text-align:center;'><h2>Message could not be able to sent .<br>Try Again Later</div>";
  echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
  $message = "success";
        echo '<script type="text/javascript">';
				echo 'alert("Registration Successcull \n Please Verify Your Email to Login !!");';
				echo 'window.location.href = "login.php";';
				echo '</script>';
  return true;
}