<?php
@ob_start();
@session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/SMTP.php';
//Load Composer's autoloader
require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    // Server settings
      //$mail->SMTPDebug = 3;                               // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'localhost';                            // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'eng.makarious@gmail.com';          // SMTP username
      $mail->Password = '';                                 // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 465;                                    // TCP port to connect to

    // Recipients
      $mail->setFrom('eng.makarious@gmail.com', $sender);
      foreach ($emails as $value) {
        $mail->addAddress($value);     // Add a recipient
      }

      $mail->addReplyTo('eng.makarious@gmail.com', $sender);

    // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $subject;
      $mail->Body    = $body;

      $mail->send();

    // Insert Log Mail
      $emails = implode(',',$emails);
} catch (Exception $e) {
    // Insert Log Mail
      $emails = implode(',',$emails);
} ?>
