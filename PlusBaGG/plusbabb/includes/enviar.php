<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp1.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'adrianaanzolazz@gmail.com';                     // SMTP username
    $mail->Password   = 'pradaybebe2704';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('adrianaanzolazz@gmail.com', 'Alexandra');
    $mail->addAddress('aanzola5@misena.edu.co', 'Joe User');     // Add a recipient
  
   
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Recuperar Contraseña';
    $mail->Body    = 'Prueba';
  

    $mail->send();
    echo 'Se envio correctamente';
} catch (Exception $e) {
    echo "Lo siento no se pudo enviar el mensaje";
}
