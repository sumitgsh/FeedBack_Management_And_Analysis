<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../includes/PHPMailer/PHPMailer/src/Exception.php';
require '../includes/PHPMailer/PHPMailer/src/PHPMailer.php';
require '../includes/PHPMailer/PHPMailer/src/SMTP.php';

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
// $mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('tumcafeedback@gmail.com', 'TU Feedback');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');


//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Account Create';
$mail->Body    = 'TU Feedback<br>
                        Hi there!<br>
                        You account is create successfully<br>
                        Email:' . $email . '<br>
                        Password:' . $tpass . '
                        <br>Thank You';
$mail->AltBody = '';
// $mail->send();
if (!$mail->send()) {
    echo "<div class='container' style='text-align:center;'><h2>Message could not be able to sent .<br>Try Again Later</div>";
} else {
    $message = "success";
}