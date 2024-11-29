<?php

use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require 'phpmailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMPT::DEBUG_OFF;    //SMPT::DEBUG_OFF  PARA PRODUCCION YA NO MUESTRA MENSAJES                //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '21031400@itcelaya.edu.mx';                     //SMTP username
    $mail->Password   = 'tlep dmgz pplr noeg';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('21031400@itcelaya.edu.mx', 'BOKEN SHOP');
    $mail->addAddress('caracheojavier410@gmail.com', 'Yo personal');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Detalles de su compra';
    $cuerpo  = '<h4> Gracias por su compra</h4>';
    $cuerpo .= '<p>El Id de su compra es<b>'. $idTransaccion.'</b></p>';
    $mail->Body    = uft8_decode($cuerpo);
    $mail->AltBody = 'Le enviamos los detalles de su compra';

    $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

    $mail->send();
} catch (Exception $e) {
    echo "Error al enviar el correo de compra: {$mail->ErrorInfo}";
}
